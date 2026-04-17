<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RendezVous extends Model
{
    //
    use HasFactory;
    protected $table = "rendez_vous";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return this->belongsTo(User::class, "id");
    }

    public function etatsRendezVous(): BelongsTo
    {
        return this->belongsTo(EtatsRendezVous::class, "id");
    }
}
