<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LienMfa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        // Validation avec le bag 'updatePassword'
        // Le bag permet d'avoir des erreurs séparées si plusieurs
        // formulaires sont sur la même page (comme dans profile/edit)
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.required' => 'Le mot de passe actuel est obligatoire.',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required'         => 'Le nouveau mot de passe est obligatoire.',
            'password.confirmed'        => 'Les mots de passe ne correspondent pas.',
        ]);

        // Mettre à jour le mot de passe en BD
        $request->user()->update([
            'password'           => Hash::make($validated['password']),
            'password_changed_at' => now(), // enregistrer la date du changement
        ]);

        // Générer un token MFA et envoyer un courriel de confirmation
        $user        = $request->user();
        $token       = Str::random(64);

        $user->mfa_token            = $token;
        $user->mfa_token_expires_at = now()->addMinutes(15);
        $user->mfa_verified         = false;
        $user->save();

        Mail::to($user->email)->send(new LienMfa($user));

        // Déconnecter l'utilisateur — il doit re-vérifier via MFA
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('mfa.notice')
            ->with('status', 'password-updated');
    }
}
