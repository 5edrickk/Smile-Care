<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    use HasFactory;

    protected $table      = 'paiements';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'montant',
        'id_rendez_vous',
        'id_etat',
        'id_type',
    ];

    // Un paiement appartient à un rendez-vous
    public function rendezVous(): BelongsTo
    {
        return $this->belongsTo(RendezVous::class, 'id_rendez_vous');
    }

    public function etatPaiement(): BelongsTo
    {
        return $this->belongsTo(EtatsPaiement::class, 'id_etat');
    }

    public function typePaiement(): BelongsTo
    {
        return $this->belongsTo(TypesPaiements::class, 'id_type');
    }
}
