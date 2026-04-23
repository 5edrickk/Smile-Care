<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $utilisateur = $request->user();

        if ($utilisateur !== null) {
            // Vérifier si l'utilisateur a le rôle Admin
            if ($utilisateur->role->name === 'Admin') {
                return $next($request); // laisser passer
            }

            // Connecté mais pas admin
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Requête API → retourner JSON
        if ($request->bearerToken() && $request->accepts('application/json')) {
            return response()->json([
                'ERREUR' => 'Compte administrateur requis.'
            ], 400);
        }

        // Requête Web → rediriger vers login
        return redirect('/login')
            ->with('alerte', 'Compte administrateur requis.');
    }
}
