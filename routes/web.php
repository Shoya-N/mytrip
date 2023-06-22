<?php

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\TripController;
Route::controller(TripController::class)->prefix('trip')->name('trip.')->middleware('auth')->group(function () {
    Route::get('create', 'add')->name('add');
    Route::post('create', 'create')->name('create');
    Route::get('/', 'index')->name('index');
    Route::get('edit', 'edit')->name('edit');
    Route::post('edit', 'update')->name('update');
    Route::get('delete', 'delete')->name('delete');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



use App\Http\Controllers\UserController;
Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/users', 'index')->name('users');
    Route::get('/profile', 'show')->name('profile');
    Route::put('/profile', 'profileUpdate')->name('profile_edit');
});

use App\Http\Controllers\LikeController;
Route::controller(LikeController::class)->middleware('auth')->group(function () {
    Route::post('/like/{id}', 'store')->name('like');
    Route::delete('/unlike/{id}', 'destroy')->name('unlike');
});