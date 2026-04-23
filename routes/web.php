<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/utilisateurs/{id_role}', 'index')->name('utilisateurs');
    Route::get('utilisateurAdd', 'store')->name('utilisateurAdd');
    Route::get('utilisateurDelete/{id}', 'destroy')->name('utilisateurDelete');
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

require __DIR__.'/auth.php';
