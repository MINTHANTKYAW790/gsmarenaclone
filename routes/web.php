<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\SpecCategoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SavedDeviceController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Public routes accessible to both 'customer' and 'admin' roles
Route::get('/filter', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/reviews', [WelcomeController::class, 'reviews'])->name('reviews');
Route::get('/filter/device/{device}', [WelcomeController::class, 'showDevices'])->name('devices.show');
Route::get('/branded/{id}', [WelcomeController::class, 'filterByBrand'])->name('branded.filter');
Route::get('/filter/review/{id}', [WelcomeController::class, 'deviceReview'])->name('devices.reviews');

Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/compare/load-device/{device}', [CompareController::class, 'loadDevice'])->name('compare.loadDevice');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');

Route::get('/search', [WelcomeController::class, 'searchAll'])->name('search.all');


Route::middleware(['auth', 'role:customer,admin'])->group(function () {
    Route::get('/create-review', [WelcomeController::class, 'createReview'])->name('createReview');
    Route::post('/store-review', [WelcomeController::class, 'storeReview'])->name('storeReview');
    Route::post('/save-device/{device}', [SavedDeviceController::class, 'store'])->name('savedDevices.store');
    Route::get('/saved_list', [WelcomeController::class, 'savedList'])->name('savedlist');
    Route::delete('/saved_list/{device}', [WelcomeController::class, 'deleteFromSavedList'])->name('savedDevices.destroy');
});
// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes for admin role
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Only logged-in users with 'admin' role can access these
    Route::resource('brand', BrandController::class);
    Route::resource('device', DeviceController::class);
    Route::resource('spec', SpecController::class);
    Route::resource('category', SpecCategoryController::class);
    Route::resource('review', ReviewController::class);
});
