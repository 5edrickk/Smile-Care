<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PaiementController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — SmileCare
|--------------------------------------------------------------------------
| Toutes les routes ici sont préfixées automatiquement par /api
| Ex: /token devient localhost/api/token
|
| Chaque membre de l'équipe ajoute ses routes dans ce fichier
|--------------------------------------------------------------------------
*/

// -----------------------------------------------------------------------
// AUTH — Abdoulaye
// Obtenir un token Sanctum pour s'authentifier via l'API
// -----------------------------------------------------------------------
Route::post('/token', [AuthenticatedSessionController::class, 'generateToken'])
    ->name('api.token');

// -----------------------------------------------------------------------
// PAIEMENTS — Abdoulaye
// -----------------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {

    // Lire — accessible à tous les utilisateurs authentifiés
    Route::controller(PaiementController::class)->group(function () {
        Route::get('/paiements', 'index')->name('api.paiements.index');
        Route::get('/paiements/{id}', 'show')->name('api.paiements.show');
    });

    // Écrire — accessible aux admins seulement
    Route::controller(PaiementController::class)
        ->middleware(EnsureUserIsAdmin::class)
        ->group(function () {
            Route::post('/paiements', 'store')->name('api.paiements.store');
            Route::put('/paiements/{id}', 'update')->name('api.paiements.update');
        });
});

// -----------------------------------------------------------------------
// Ajouter vos routes API ici
// -----------------------------------------------------------------------
