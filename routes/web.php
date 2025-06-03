<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\ServicoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/solicitacoes/criar', [SolicitacaoController::class, 'create'])->name('solicitacoes.create');
Route::post('/solicitacoes', [SolicitacaoController::class, 'store'])->name('solicitacoes.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Resource routes
    Route::resource('servicos', ServicoController::class);
    
    // Search routes
    Route::get('servicos/categoria/{categoria_id}', [ServicoController::class, 'buscarPorCategoria'])
         ->name('servicos.por-categoria');
         
    Route::get('servicos/localizacao/{localizacao}', [ServicoController::class, 'buscarPorLocalizacao'])
         ->name('servicos.por-localizacao');
});

Route::middleware(['auth'])->group(function () {
    // Resource routes
    Route::resource('solicitacoes', SolicitacaoController::class)->except(['destroy']);
    
    // Custom action routes
    Route::post('solicitacoes/{solicitacao}/aceitar', [SolicitacaoController::class, 'aceitar'])
         ->name('solicitacoes.aceitar');
         
    Route::post('solicitacoes/{solicitacao}/recusar', [SolicitacaoController::class, 'recusar'])
         ->name('solicitacoes.recusar');
         
    Route::post('solicitacoes/{solicitacao}/cancelar', [SolicitacaoController::class, 'cancelar'])
         ->name('solicitacoes.cancelar');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('ordens-servico', OrdemServicoController::class)->except(['destroy']);
    
    // Action routes
    Route::post('ordens-servico/{ordem_servico}/iniciar', [OrdemServicoController::class, 'iniciar']);
    Route::post('ordens-servico/{ordem_servico}/concluir', [OrdemServicoController::class, 'concluir']);
    Route::post('ordens-servico/{ordem_servico}/cancelar', [OrdemServicoController::class, 'cancelar']);
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
