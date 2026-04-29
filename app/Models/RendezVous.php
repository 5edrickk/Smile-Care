<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable('id_user', 'id_dentiste', 'id_etat', 'id_service', 'heure_date', 'commentaire')]
class RendezVous extends Model
{
    //
    use HasFactory;

    protected $table = 'rendez_vous';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function dentiste(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dentiste');
    }

    public function etatsRendezVous(): BelongsTo
    {
        return $this->belongsTo(EtatsRendezVous::class, 'id_etat');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'id_service');
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class, 'id_rendez_vous');
    }

    public function formaterDate(): string
    {
        // modifier pour permettre de mettre anglais aussi jsp comment
        return Carbon::parse($this->heure_date)->locale('fr')->translatedFormat('j F Y');
    }

    public function formaterHeure(): string
    {
        return Carbon::parse($this->heure_date)->format('H:i');
    }
}
