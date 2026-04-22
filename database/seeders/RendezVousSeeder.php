<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RendezVousSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rendez_vous')->insert([
            [
                'heure_date'  => '2026-05-01 09:00:00',
                'commentaire' => 'Nettoyage dentaire',
                'id_etat'     => 1,
                'id_service'  => 1,
                'id_user'     => 1,
                'id_dentiste' => 2,
            ],
            [
                'heure_date'  => '2026-05-02 10:30:00',
                'commentaire' => 'Extraction dent de sagesse',
                'id_etat'     => 1,
                'id_service'  => 1,
                'id_user'     => 1,
                'id_dentiste' => 2,
            ],
            [
                'heure_date'  => '2026-05-03 14:00:00',
                'commentaire' => 'Plombage',
                'id_etat'     => 1,
                'id_service'  => 1,
                'id_user'     => 1,
                'id_dentiste' => 2,
            ],
            [
                'heure_date'  => '2026-05-05 11:00:00',
                'commentaire' => 'Consultation',
                'id_etat'     => 1,
                'id_service'  => 1,
                'id_user'     => 1,
                'id_dentiste' => 2,
            ],
            [
                'heure_date'  => '2026-05-06 15:30:00',
                'commentaire' => 'Radiographie',
                'id_etat'     => 1,
                'id_service'  => 1,
                'id_user'     => 1,
                'id_dentiste' => 2,
            ],
        ]);
    }
}
