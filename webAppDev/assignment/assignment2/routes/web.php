<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [HomeController::class, 'index']);
Route::post('/approve', [AdminController::class, 'approve']);

Route::resource('restaurant', RestaurantController::class);
Route::resource('dish', DishController::class);
Route::resource('image', ImageController::class);
Route::resource('order', OrderController::class);
Route::resource('favourite', FavouriteController::class);
Route::resource('admin', AdminController::class);

/** Assignmnet Requirement Docs Routes */
Route::get('requirement', function () {
  return view('document/detail');
});

require __DIR__.'/auth.php';
