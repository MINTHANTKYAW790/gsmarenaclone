<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SpecCategoryController;
use App\Http\Controllers\SpecController;
use Illuminate\Support\Facades\Route;

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

// routes/web.php


Route::get('/', function () {
    return view('welcome'); // or return view('your_custom_welcome');
})->name('welcome');

// Then keep the brand routes
Route::resource('brand', BrandController::class);
Route::resource('device', DeviceController::class);
Route::resource('spec', SpecController::class);
Route::resource('category', SpecCategoryController::class);






