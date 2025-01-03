<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProcessoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/processos', [ProcessoController::class, 'index'])->name('processos.index');

Route::post('/import-excel', [ProcessoController::class, 'importExcel'])->name('processos.import');
Route::post('/processos/upload', [ProcessoController::class, 'upload'])->name('processos.upload');
