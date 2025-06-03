<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[ServiceRequestController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/solicitacoes/criar', [ServiceRequestController::class, 'create'])->name('solicitacoes.create');
Route::post('/solicitacoes', [ServiceRequestController::class, 'store'])->name('solicitacoes.store');
Route::resource('solicitacoes', ServiceRequestController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home');
});
Route::get('/cadastro/profissional', function () {
    return view('auth.register.professional');
})->name('professional.register');

Route::post('/cadastro/profissional', function (Request $request) {
    // Aqui você pode tratar os dados recebidos
    dd($request->all()); // só para teste
})->name('profissional.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

