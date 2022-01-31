<?php

namespace Sunarc\ImportExcel\Services;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ExcelToCollection implements ToCollection, WithHeadingRow
{

    public function collection(Collection $collection)
    {
        return $collection;
    }
}
