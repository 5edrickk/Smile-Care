<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaiementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'montant'        => $this->montant,
            'id_rendez_vous' => $this->id_rendez_vous,
            'etat'           => $this->etatPaiement->name ?? null,
            'type'           => $this->typePaiement->name ?? null,
        ];
    }
}
