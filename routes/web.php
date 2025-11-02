<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // ✅ CRUD protegido
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);

    // ✅ Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ✅ CORREGIDO: Cambiar POST por PUT para la foto
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
});

require __DIR__ . '/auth.php';