<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\TypesServicesController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MfaController;
use App\Http\Controllers\PaiementController;

// Route::controller(NomDuControleur::class)->group(function() {
//     Route::get('/Route', 'MethodeDuControleur')->name('NomDeLaRoute');
//     });

// Route--> c'est l'url que l'on va utiliser pour accéder à la page
// NomDeLaRoute--> c'est le nom de la route que l'on va utiliser pour accéder à la page
// MethodeDuControleur--> c'est la méthode que l'on va utiliser pour afficher la page
// NomDuControleur--> c'est le nom du contrôleur que l'on va utiliser pour afficher la page

Route::get('/', function () {
    return view('welcome');
})->name('pageeinitial');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(UserController::class)->group(function() {
    Route::get('utilisateurs/{id_role}/page{num_page}', 'index')->name('utilisateurs');
    Route::post('utilisateurs/{id_role}/page{num_page}', 'index')->name('utilisateursSearch');
    Route::post('utilisateurAdd', 'store')->name('utilisateurAdd');
    Route::get('utilisateurDelete/{id}', 'destroy')->name('utilisateurDelete');
    Route::get('utilisateurForm/{id}', 'show')->name('utilisateurForm');
    Route::post('utilisateurEdit/{id}', 'edit')->name('utilisateurEdit');
});

Route::controller(ShiftsController::class)->group(function() {
    Route::get('shifts', 'index')->name('shifts');
    Route::get('shiftPunch', 'punch')->name('shiftPunch');
});

Route::controller(RendezVousController::class)->group(function() {
    Route::get('/rendezvous', 'index')->name('rendezvous');
    Route::get('/rendezvous/create', 'create')->name('rendezvousCreate');
    Route::post('/rendezvous', 'store')->name('rendezvousStore');
    Route::get('/rendezvous/{id}', 'show')->name('rendezvousID'); // ajouter un middleware pour verifier l'auth et verifier si l'user a le droit d'acceder a cette route
    Route::get('/rendezvous/{id}/edit', 'edit')->name('rendezvousEdit');
    Route::put('/rendezvous/{id}', 'update')->name('rendezvousUpdate');
    Route::post('/rendezvous/destroy', 'destroy')->name('rendezvousDestroy');
});

Route::controller(MfaController::class)->group(function () {
    // Page "vérifiez votre courriel" — accessible sans être connecté
    Route::get('/mfa/notice', 'notice')->name('mfa.notice');

    // Lien cliqué depuis le courriel — accessible sans être connecté
    Route::get('/mfa/verify', 'verify')->name('mfa.verify');

    // Renvoyer le lien — accessible sans être connecté
    Route::post('/mfa/resend', 'resend')->name('mfa.resend');
});

Route::middleware('auth')->group(function () {
    Route::controller(PaiementController::class)->group(function () {
        Route::get('/paiements', 'index')->name('paiements.index');
        Route::get('/paiements/create', 'create')->name('paiements.create');
        Route::post('/paiements', 'store')->name('paiements.store');
        Route::get('/paiements/search', 'search')->name('paiements.search');
        Route::get('/paiements/{id}', 'show')->name('paiements.show');
        Route::get('/paiements/{id}/edit', 'edit')->name('paiements.edit');
        Route::put('/paiements/{id}', 'update')->name('paiements.update');
    });
});

Route::controller(ServicesController::class)->group(function() {
    Route::get('/services', 'index')->name('services');
    Route::get('/services/create', 'create')->name('services.create');
    Route::post('/services/store', 'store')->name('services.store');
    Route::get('/services/edit/{id}', 'edit')->name('services.edit');
    Route::put('/services/update/{id}', 'update')->name('services.update');
    Route::get('/services/destroy/{id}', 'destroy')->name('services.destroy');
    Route::get('/services/{id}', 'show')->name('services.show');
});

require __DIR__.'/auth.php';
