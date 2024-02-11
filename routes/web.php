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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\ProductController;
Route::post('/regist',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('submit');
Route::get('/detail/{id}', [ProductController::class, 'showDetail'])->name('detail');
Route::get('/regist', [ProductController::class, 'showRegistForm'])->name('regist.form');
Route::delete('/{id}', [ProductController::class, 'destroy'])->name('delete');
Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
Route::get('/list', [ProductController::class, 'list'])->name('list');
Route::get('/search', [ProductController::class, 'search'])->name('search');

use App\Http\Controllers\CompanyController;

Route::resource('companies', CompanyController::class);

use App\Http\Controllers\Auth\LoginController;

Route::post('/login', [LoginController::class, 'login'])->name('login');