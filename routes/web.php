<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('dashboard');
});
Route::get('/location', function () {
    return view('location');
});

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload-property', [PropertyController::class, 'upload'])->name('property.upload');

