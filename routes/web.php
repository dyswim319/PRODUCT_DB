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
Route::post('/regist',[ProductController::class, 'registSubmit'])->name('submit');
Route::get('/regist', [ProductController::class, 'showRegistForm'])->name('regist.form');
Route::get('/detail/{id}', [ProductController::class, 'showDetail'])->name('detail');
Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
Route::get('/list', [ProductController::class, 'list'])->name('list');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
Route::delete('/{id}', [ProductController::class, 'destroy'])->name('delete');

//use App\Http\Controllers\CompanyController;
//Route::resource('companies', CompanyController::class);

use App\Http\Controllers\Auth\LoginController;
Route::post('/login', [LoginController::class, 'login'])->name('login');