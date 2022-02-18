<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
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
Route::resource('prestamos', PrestamoController::class)->middleware("auth");
Route::resource('prestamo', PrestamoController::class)->middleware("auth");

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/libros', [App\Http\Controllers\LibroController::class, 'index'])->name('libros');
Route::get('/prestamos', [App\Http\Controllers\PrestamoController::class, 'index'])->name('prestamos');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/prestamo/{id}', [App\Http\Controllers\PrestamoController::class, 'show'])->name('prestamo');
