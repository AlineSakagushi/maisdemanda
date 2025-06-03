<?php

use App\Http\Controllers\SolicitacaoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    // API Resource routes
    Route::apiResource('solicitacoes', SolicitacaoController::class)->except(['destroy']);
    
    // Custom action routes
    Route::post('solicitacoes/{solicitacao}/aceitar', [SolicitacaoController::class, 'aceitar']);
    Route::post('solicitacoes/{solicitacao}/recusar', [SolicitacaoController::class, 'recusar']);
    Route::post('solicitacoes/{solicitacao}/cancelar', [SolicitacaoController::class, 'cancelar']);
});