<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    use HasFactory;
    protected $table = "paiements";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function rendezVous(): BelongsTo
    {
        return this->belongsTo(RendezVous::class, "id");
    }
    public function etatsPaiement(): BelongsTo
    {
        return this->belongsTo(EtatsPaiement::class, "id");
    }
}
