<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanilhaController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    // Rotas de processos
    Route::get('/planilhas', [PlanilhaController::class, 'index'])->name('planilhas.index');
    Route::post('/planilhas/import', [PlanilhaController::class, 'import'])->name('planilhas.import');
    Route::get('/planilhas/{id}', [PlanilhaController::class, 'show'])->name('planilhas.show');
    Route::post('/planilhas/{id}/valor', [PlanilhaController::class, 'atualizarValor'])->name('planilhas.atualizar-valor');
    Route::get('/planilha/{id}/editar', [PlanilhaController::class, 'editar'])->name('planilha.editar');
    Route::post('/planilha/{id}/atualizar', [PlanilhaController::class, 'atualizar'])->name('planilha.atualizar');
    Route::delete('/planilha/{id}/', [PlanilhaController::class, 'destroy'])->name('planilha.excluir');
    Route::get('/planilha/{id}/export', [PlanilhaController::class, 'export'])->name('planilha.baixar');
});
