<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RendezVousResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'id' => $this->id,
            'nom_patient' => $this->user->name,
            'prenom_patient' => $this->user->prenom,
            'dentiste' => $this->dentiste->name . ' ' . $this->dentiste->prenom,
            'service' => $this->service->name,
            'heure_date' => $this->heure_date,
            'commentaire' => $this->commentaire,
            'etat' => $this->etatsRendezVous->name,
        ];
    }
}
