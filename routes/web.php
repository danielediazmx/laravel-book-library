<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/category', CategoryController::class, ['name' => 'category'])
    ->middleware(['auth']);

Route::resource('/book', BookController::class, ['name' => 'book'])
    ->middleware(['auth']);

Route::get('/book/request/{id}', 'App\Http\Controllers\BookController@request_book')->name('book.request');
Route::get('/book/change_availability/{id}', 'App\Http\Controllers\BookController@change_availability')->name('book.change_availability');

require __DIR__ . '/auth.php';
