<?php

namespace Sunarc\ImportExcel\Services;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Media Service Class
|--------------------------------------------------------------------------
|
| Define all your helper function related to Media here.
|
*/

class Media
{
    protected $path = '';
    public function __construct()
    {
        $this->path = config('ImportExcel.default_path');
    }

    public function upload(Request $request, $field, $path = null)
    {
        if (!$path)
            $path = $this->path;

        $imageName = "{$this->generateName()}.{$request->$field->getClientOriginalExtension()}";
        $imagePath = "{$path}/{$imageName}";
        $request->$field->move(public_path($path), $imageName);
        return $imagePath;
    }

    protected function generateName()
    {
        $times = time();
        $random = rand(1, 999);
        return md5($times * $random);
    }
}
