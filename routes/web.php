<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\TypesServicesController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

// Route::controller(NomDuControleur::class)->group(function() {
//     Route::get('/Route', 'MethodeDuControleur')->name('NomDeLaRoute');
//     });

//Route--> c'est l'url que l'on va utiliser pour accéder à la page
//NomDeLaRoute--> c'est le nom de la route que l'on va utiliser pour accéder à la page
//MethodeDuControleur--> c'est la méthode que l'on va utiliser pour afficher la page
//NomDuControleur--> c'est le nom du contrôleur que l'on va utiliser pour afficher la page

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

Route::controller(TypesServicesController::class)->group(function() {
    Route::get('/services', 'index')->name('services');
    Route::get('/services/categorie/{id}', 'indexByCategory')->name('services.categorie');
});

Route::controller(ServicesController::class)->group(function() {
    Route::get('/services/servicesCreate', 'create')->name('services.new');
});

require __DIR__.'/auth.php';
