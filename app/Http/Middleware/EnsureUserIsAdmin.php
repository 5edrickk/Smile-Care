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
            if ($utilisateur->role->name === 'Admin') {
                return $next($request);
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($request->bearerToken() && $request->accepts('application/json')) {
            return response()->json([
                'ERREUR' => 'Compte administrateur requis.'
            ], 400);
        }

        return redirect('/login')
            ->with('alerte', 'Compte administrateur requis.');
    }
}
