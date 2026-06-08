<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [PageController::class, 'dashboard']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'attemptLogin'])->name('login.attempt');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/laporan', [PageController::class, 'laporan'])
    ->middleware('presto.auth')
    ->name('laporan');

Route::get('/arsip-prestasi', [PageController::class, 'arsip'])->name('arsip');
Route::get('/hall-of-fame', [PageController::class, 'hallOfFame'])->name('hall');
