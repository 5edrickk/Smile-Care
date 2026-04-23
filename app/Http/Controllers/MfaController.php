<?php

namespace App\Http\Controllers;

use App\Mail\LienMfa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MfaController extends Controller
{
    /**
     * Envoyer le lien MFA par courriel après un login réussi.
     * Appelée par le LoginController de Breeze après vérification du mdp.
     */
    public function send(Request $request): mixed
    {
        // Récupérer l'utilisateur qui vient d'entrer ses credentials
        // Il n'est PAS encore connecté (Auth::login pas encore appelé)
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Utilisateur introuvable.']);
        }

        // Générer un token aléatoire unique de 64 caractères
        // Str::random() est une helper Laravel — pas besoin d'importer quoi que ce soit d'autre
        $token = Str::random(64);

        // Sauvegarder le token en BD avec une expiration de 15 minutes
        $user->mfa_token            = $token;
        $user->mfa_token_expires_at = now()->addMinutes(15);
        $user->mfa_verified         = false;
        $user->save();

        // Envoyer le courriel avec le lien de vérification
        // On passe $user au Mailable pour qu'il ait accès au token
        Mail::to($user->email)->send(new LienMfa($user));

        // Stocker l'email en session pour la page de confirmation
        // (on en aura besoin si l'utilisateur veut renvoyer le lien)
        $request->session()->put('mfa_email', $user->email);

        // Rediriger vers la page "vérifiez votre courriel"
        // L'utilisateur N'EST PAS encore connecté ici
        return redirect()->route('mfa.notice');
    }

    /**
     * Afficher la page "Vérifiez votre courriel".
     */
    public function notice(): View
    {
        return view('auth.mfa-notice');
    }

    /**
     * Vérifier le token quand l'utilisateur clique le lien dans son courriel.
     */
    public function verify(Request $request): mixed
    {
        $token = $request->query('token');

        // Chercher l'utilisateur qui possède ce token
        $user = User::where('mfa_token', $token)->first();

        // Cas 1 : token introuvable en BD
        if (!$user) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Lien de vérification invalide.']);
        }

        // Cas 2 : token expiré (plus de 15 minutes)
        // now() retourne la date/heure actuelle
        if (now()->isAfter($user->mfa_token_expires_at)) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Lien expiré. Veuillez vous reconnecter.']);
        }

        // Token valide — connecter l'utilisateur
        Auth::login($user);

        // Nettoyer le token en BD (sécurité — un token ne sert qu'une fois)
        $user->mfa_token            = null;
        $user->mfa_token_expires_at = null;
        $user->mfa_verified         = true;
        $user->save();

        // Régénérer la session pour éviter les attaques de fixation de session
        $request->session()->regenerate();

        return redirect()->intended(route('pageeinitial'));
    }

    /**
     * Renvoyer le lien MFA si l'utilisateur ne l'a pas reçu.
     */
    public function resend(Request $request): mixed
    {
        $email = $request->session()->get('mfa_email');

        if (!$email) {
            return redirect()->route('login');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        // Générer un nouveau token et renvoyer
        $token = Str::random(64);
        $user->mfa_token            = $token;
        $user->mfa_token_expires_at = now()->addMinutes(15);
        $user->mfa_verified         = false;
        $user->save();

        Mail::to($user->email)->send(new LienMfa($user));

        return back()->with('succes', 'Un nouveau lien vous a été envoyé.');
    }
}
