<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('upload',[FileUploadController::class,'upload'])->name('upload');
Route::post('compress',[FileUploadController::class,'compress'])->name('compress');
Route::get('download',[FileUploadController::class,'download'])->name('download');