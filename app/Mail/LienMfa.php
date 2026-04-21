<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LienMfa extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vérification de votre connexion — SmileCare',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'courriel.lien-mfa',
            // On passe le lien complet à la vue
            with: [
                'lienVerification' => route('mfa.verify', [
                    'token' => $this->user->mfa_token
                ]),
                'prenom' => $this->user->prenom,
                'expiration' => 15, // minutes
            ]
        );
    }
}
