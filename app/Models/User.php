<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'prenom',
        'email',
        'password',
        'id_role',
        'telephone',
        'dateNaissance',
        'codeEmploye',
        'photo',
        'addresse',
        'num_assurance',
        'note_clinique',
        'mfa_token',
        'mfa_token_expires_at',
        'mfa_verified',
        'password_changed_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'mfa_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'     => 'datetime',
            'password'              => 'hashed',
            'mfa_token_expires_at'  => 'datetime',
            'mfa_verified'          => 'boolean',
        ];
    }

    // Relation avec le rôle
    public function role(): BelongsTo
    {
        return $this->belongsTo(Roles::class, 'id_role'); // ← corrigé
    }

    // Relation avec les médicaments (ordonnance principale)
    public function medicament(): BelongsTo
    {
        return $this->belongsTo(Medicament::class, 'ordonnance');
    }

    public function shifts(): HasMany
    {
        return $this->hasMany(Shift::class, 'id_user');
    }

    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class, 'id_user');
    }

    public function rendezVousComeDentiste(): HasMany
    {
        return $this->hasMany(RendezVous::class, 'id_dentiste');
    }
}
