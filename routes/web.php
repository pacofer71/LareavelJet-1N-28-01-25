<?php

use App\Http\Controllers\InicioController;
use App\Livewire\Prueba;
use App\Livewire\ShowUserPosts;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio'])->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Aquí pondermos todas las rutas para que necesite logearse
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('posts', ShowUserPosts::class)->name('posts');
});
