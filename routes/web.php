<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

// Route::controller(NomDuControleur::class)->group(function() { 
//     Route::get('/Route', 'MethodeDuControleur')->name('NomDeLaRoute'); 
//     });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(RendezVousController::class)->group(function() {
    Route::get('/rendezvous', 'index')->name('rendezvous');
});

require __DIR__.'/auth.php';
