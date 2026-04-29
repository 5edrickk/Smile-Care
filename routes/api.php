<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PaiementController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

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
// UTILISATEURS - Alexandre
// -----------------------------------------------------------------------
Route::controller(UserController::class)->group(function(){
    Route::post('api/utilisateurAdd', 'store')->name('api.utilisateurAdd');
    Route::get('api/utilisateur/{id}', 'show')->name('api.utilisateur.show');
    Route::delete('api/utilisateurDelete/{id}', 'destroy')->name('api.utilisateurDelete');
});

// -----------------------------------------------------------------------
// Ajouter vos routes API ici
// -----------------------------------------------------------------------
