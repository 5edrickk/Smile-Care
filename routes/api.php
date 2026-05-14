<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RendezVousController;
/*
|--------------------------------------------------------------------------
| API Routes — SmileCare
| Chaque membre de l'équipe ajoute ses routes dans ce fichier
|--------------------------------------------------------------------------
*/

// -----------------------------------------------------------------------
// AUTH — Abdoulaye
// -----------------------------------------------------------------------
Route::post('/token', [AuthenticatedSessionController::class, 'generateToken'])
    ->name('api.token');

// -----------------------------------------------------------------------
// PAIEMENTS — Abdoulaye
// -----------------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {

    Route::controller(PaiementController::class)->group(function () {
        Route::get('/paiements', 'index')->name('api.paiements.index');
        Route::get('/paiements/{id}', 'show')->name('api.paiements.show');
    });


    Route::controller(PaiementController::class)
        ->middleware(EnsureUserIsAdmin::class)
        ->group(function () {
            Route::post('/paiements', 'store')->name('api.paiements.store');
            Route::put('/paiements/{id}', 'update')->name('api.paiements.update');
        });
});

// -----------------------------------------------------------------------
// SERVICES - Bernardo
// -----------------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ServicesController::class)->group(function() {
        Route::get('/services', 'index')->name('api.services');
        Route::get('/services/destroy/{id}', 'destroy')->name('api.services.destroy');
        Route::get('/services/{id}', 'show')->name('api.services.show');
    });

    Route::controller(ServicesController::class)
    ->middleware(EnsureUserIsAdmin::class)
    ->group(function() {
        Route::post('/services/store', 'store')->name('api.services.store');
        Route::put('/services/update/{id}', 'update')->name('api.services.update');
    });
});

// -----------------------------------------------------------------------
// UTILISATEURS - Alexandre
// -----------------------------------------------------------------------
Route::controller(UserController::class)->group(function(){
        Route::post('/utilisateurAdd', 'store')->name('api.utilisateurAdd');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function(){
        Route::put('utilisateurEdit/{id}', 'putEdit')->name('api.utilisateurEdit');
        Route::get('/utilisateur/{id}', 'show')->name('api.utilisateur.show');
        Route::get('/utilisateurs/{id_role}', 'index')->name('api.utilisateurs.index');
        Route::delete('/utilisateurDelete/{id}', 'destroy')->name('api.utilisateurDelete');
    });
});

// -----------------------------------------------------------------------
// RENDEZ-VOUS — Sedrick
// -----------------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
        Route::controller(RendezVousController::class)->group(function () {
            Route::get('/rendezvous/user/{id}', 'user')->name('api.rendezvous.showUser');
            Route::get('/rendezvous/{id}', 'show')->name('api.rendezvous.show');
            Route::post('/rendezvous', 'store')->name('api.rendezvous.store');
            Route::put('/rendezvous/{id}', 'update')->name('api.rendezvous.update');
        });
});
