<?php

use Illuminate\Support\Facades\Route;
use Sunarc\ImportExcel\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('file-upload', [ImportController::class, 'index'])->name('import.index');
Route::get('start-import', [ImportController::class, 'create'])->name('import.create');

Route::post('file-upload', [ImportController::class, 'store'])->name('import.store');
Route::post('start-import', [ImportController::class, 'update'])->name('import.update');
