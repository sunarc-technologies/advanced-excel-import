<?php

namespace Sunarc\ImportExcel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;
use Sunarc\ImportExcel\Http\Validators\Validator;
use Sunarc\ImportExcel\Services\ExtractHeaders;
use Sunarc\ImportExcel\Services\DatabaseService;
use Sunarc\ImportExcel\Services\ExcelToCollection;
use Sunarc\ImportExcel\Services\Media;

class ImportController extends Controller
{
    use Validator;
    public function index()
    {
        return view('ImportExcel::import.file-upload');
    }

    public function store(Request $request, Media $media)
    {
        $filepath = $media->upload($request, 'excel-file');
        Cookie::queue(Cookie::make('file', $filepath, config('ImportExcel.session_lifetime')));
        return redirect(route('import.create'))->with('file', $filepath);
    }

    public function create(DatabaseService $databaseService)
    {
        $headers = $this->getExcelHeader(session('file') ?? Cookie::get('file'))->first()->first();
        $tables = $databaseService->tables();

        return view('ImportExcel::import.start-import', compact('tables', 'headers'));
    }

    public function update(Request $request, DatabaseService $databaseService)
    {
        $errors = [];
        $this->startImport((array)json_decode($request->finalArray, true), $errors, $databaseService);
        return back()->withErrors($errors);
    }

    public function getColumns(Request $request, DatabaseService $databaseService)
    {
        return $databaseService->tableSchema($request->table);
    }

    public function startImport(array $data, &$errors, DatabaseService $databaseService)
    {
        $rules = [];
        if (!count($data))
            $errors['general'] = "Data can not be imported without any columns";

        foreach ($data as $table => $value) {
            $tableSchema = collect(json_decode(json_encode($databaseService->tableSchema($table)), true))->where('Null', 'NO')->map(function ($value, $key) use (&$rules, $table) {
                $this->makeValidators($rules, $table, $value);
                if (isset($value['Field']) && in_array($value['Field'], config('ImportExcel.fields_to_be_excluded'))) {
                    unset($value);
                    return null;
                }
                return $value;
            });
            $requiredColumns = $tableSchema->pluck('Field')->filter()->toArray();
            $diff = array_diff($requiredColumns, collect($value)->pluck('column')->toArray());
            if (!(count($requiredColumns) == 0 || count($diff) == 0)) {
                $errors[$table] = "This columns {" . implode(', ', $diff) . "} are required in order to import data in table {$table}";
                continue;
            }

            $this->generateSQLToImport($table, collect($value), $rules);
        }
    }

    public function makeValidators(&$rules, $table, $field)
    {
        if (!in_array($field['Field'], config('ImportExcel.fields_to_be_excluded'))) {
            $column = \Illuminate\Support\Facades\Schema::getConnection()->getDoctrineColumn($table, $field['Field']);
            $rules[$field['Field']] = $this->start()->required($column->getNotnull())->max($column->getLength())->rule();
        }
    }

    /**
     * This will generate the SQL query responsible to import data into databse and will start importing.
     *
     * @param string $table Table Name
     * @param \Illuminate\Support\Collection $data
     * @return void
     */
    public function generateSQLToImport(string $table, \Illuminate\Support\Collection $data,$rules)
    {
        if ($data->isNotEmpty()) {
            foreach ($this->readExcelAndConvertToCollection(public_path('sampleimport.xlsx'))->toArray() as $index => $values) {
                foreach ($values as $value) {
                    $this->validateRules($this->getTableDataToBeImported($data, $value), $rules);
                    DB::table($table)->insert($this->getTableDataToBeImported($data, $value));
                }
            }
        }
    }

    /**
     * This will create a new data array which will be imported.
     *
     * @param \Illuminate\Support\Collection $data
     * @param array $value
     * @return array
     */

    public function getTableDataToBeImported(\Illuminate\Support\Collection  $data, array $value): array
    {
        $table_data = [];
        foreach ($data as $column) {
            $empty_string = '';
            if (isset($table_data)) {
                $empty_string = $value[$column['header']] ?? '';
                $table_data = array_merge($table_data, [
                    $column['column'] => $empty_string
                ]);
            } else {
                $table_data = [
                    $column['column'] => $empty_string
                ];
            }
        }

        return $table_data;
    }

    /**
     * Responsible for reading excel and converting it to laravel collection
     *
     * @param string $filename
     * @return \Illuminate\Support\Collection
     */
    public function readExcelAndConvertToCollection(string $filename)
    {
        return Excel::toCollection(new ExcelToCollection, $filename);
    }

    /**
     * Read the excel and return the Headers!
     *
     * @param string $filename
     * @return \Illuminate\Support\Collection
     */
    public function getExcelHeader(string $filename)
    {
        return (new ExtractHeaders)->toCollection($filename);
    }
}
