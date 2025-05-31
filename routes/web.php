<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\SpecCategoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ReviewController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Public routes
Route::get('/filter', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/reviews', [WelcomeController::class, 'reviews'])->name('reviews');
Route::get('/filter/device/{device}', [WelcomeController::class, 'showDevices'])->name('devices.show');
Route::get('/branded/{id}', [WelcomeController::class, 'filterByBrand'])->name('branded.filter');

Route::get('/filter/review/{id}', [WelcomeController::class, 'deviceReview'])->name('devices.reviews');


Route::get('/', [CompareController::class, 'index'])->name('compare.index');
Route::get('/compare/load-device/{device}', [CompareController::class, 'loadDevice'])->name('compare.loadDevice');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    // Only logged-in users can access these
    Route::resource('brand', BrandController::class);
    Route::resource('device', DeviceController::class);
    Route::resource('spec', SpecController::class);
    Route::resource('category', SpecCategoryController::class);
    Route::resource('review', ReviewController::class);
});
