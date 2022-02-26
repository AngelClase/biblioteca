<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\SancionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::resource('libros', LibroController::class);
Route::resource('prestamo', PrestamoController::class)->middleware("auth");
Route::resource('devolver', PrestamoController::class)->middleware("auth");
Route::resource('categorias', CategoriaController::class)->middleware("auth");
Route::resource('sancion', SancionController::class)->middleware("auth");

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/libros', [App\Http\Controllers\LibroController::class, 'index'])->name('libros');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/gestion/prestamo/{id}', [App\Http\Controllers\PrestamoController::class, 'prestar'])->name('prestar');
Route::get('/gestion/devolver/{id}', [App\Http\Controllers\PrestamoController::class, 'devolver'])->name('devolver');
Route::get('categorias', [App\Http\Controllers\CategoriaController::class, 'devolver'])->name('categorias');
