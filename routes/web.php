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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/list', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/regist',[App\Http\Controllers\ProductController::class, 'showRegistForm'])->name('regist');
Route::post('/regist',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('submit');


use App\Http\Controllers\ProductController;

Route::get('/detail/{id}', [ProductController::class, 'showDetail'])->name('detail');
Route::get('/regist', [ProductController::class, 'regist'])->name('regist');
Route::delete('/{id}', [ProductController::class, 'destroy'])->name('delete');
Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
Route::get('/list', [ProductController::class, 'list'])->name('list');
Route::get('/regist', [ProductController::class, 'showRegistForm'])->name('regist.form');
//Route::post('/regist', [ProductController::class, 'regist'])->name('regist');
Route::get('/search', [ProductController::class, 'search'])->name('search');



use App\Http\Controllers\CompanyController;

Route::resource('companies', CompanyController::class);