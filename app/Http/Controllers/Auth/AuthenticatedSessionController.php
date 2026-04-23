<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Controllers\MfaController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Au lieu de connecter directement, on déconnecte immédiatement
        // et on lance le processus MFA
        Auth::logout();

        // Appeler le MfaController pour envoyer le lien courriel
        return app(MfaController::class)->send($request);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Générer un token Sanctum pour l'API mobile
     */
    public function generateToken(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'courriel'      => 'required|email',
            'mot_de_passe'  => 'required',
            'nom_token'     => 'required',
        ], [
            'courriel.required'     => 'Veuillez entrer votre courriel.',
            'courriel.email'        => 'Le courriel doit être valide.',
            'mot_de_passe.required' => 'Veuillez entrer votre mot de passe.',
            'nom_token.required'    => 'Veuillez entrer un nom pour le token.',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'ERREUR' => $validation->errors()
            ], 400);
        }

        // Chercher l'utilisateur par courriel
        $utilisateur = User::where('email', $request->courriel)->first();

        // Vérifier que l'utilisateur existe et que le mdp est correct
        if (!$utilisateur || !Hash::check($request->mot_de_passe, $utilisateur->password)) {
            return response()->json([
                'ERREUR' => 'Informations d\'authentification invalides.'
            ], 401);
        }

        // Générer et retourner le token
        return response()->json([
            'SUCCÈS' => $utilisateur->createToken($request->nom_token)->plainTextToken
        ], 200);
    }
}
