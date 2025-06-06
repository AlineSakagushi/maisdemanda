<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/dashboard',[ServiceRequestController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/solicitacoes/criar', [ServiceRequestController::class, 'create'])->name('solicitacoes.create');
Route::post('/solicitacoes', [ServiceRequestController::class, 'store'])->name('solicitacoes.store');
Route::resource('solicitacoes', ServiceRequestController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/register/professional', [RegisteredUserController::class, 'createProfessional'])
    ->middleware('guest')
    ->name('register.professional');

Route::post('/register/professional', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register.professional.store');

Route::get('/register', [RegisteredUserController::class, 'create']);


require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home');

});

Route::get('/home', function () {
    return view('home');  
})->name('home');




