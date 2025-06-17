<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemandsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\AdminController;

Route::get('/dashboard',[ServiceRequestController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'checkusertype:Client'])->group(function () {
    Route::get('/solicitacoes/criar', [ServiceRequestController::class, 'create'])->name('solicitacoes.create');
    Route::post('/solicitacoes', [ServiceRequestController::class, 'store'])->name('solicitacoes.store');
    Route::resource('solicitacoes', ServiceRequestController::class);
});


Route::middleware(['auth', 'checkusertype:Professional'])->group(function () {
    Route::get('/demandas', [DemandsController::class, 'index'])->name('demands.list');
    Route::put('/demandas/{id}/aceitar', [DemandsController::class, 'accept'])->name('demands.accept');
});


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

Route::middleware(['auth', 'checkusertype:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/service-requests', [AdminController::class, 'serviceRequests'])->name('service-requests');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    
    // Ações de gerenciamento
    Route::patch('/users/{user}/status', [AdminController::class, 'updateUserStatus'])->name('users.update-status');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
});

Route::post('/notificacoes/{id}/marcar-como-lida', function ($id) {
    $notificacao = \App\Models\Notification::where('user_id', auth()->id())->findOrFail($id);
    $notificacao->update(['read' => true, 'read_at' => now()]);
    return back();
})->name('notificacoes.marcar-como-lida');
