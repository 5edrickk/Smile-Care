<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaiementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('paiements')->insert([
            [
                'montant'        => 150.00,
                'id_rendez_vous' => 1,
                'id_etat'        => 1,
                'id_type'        => 1,
            ],
            [
                'montant'        => 75.50,
                'id_rendez_vous' => 2,
                'id_etat'        => 2,
                'id_type'        => 2,
            ],
            [
                'montant'        => 200.00,
                'id_rendez_vous' => 3,
                'id_etat'        => 1,
                'id_type'        => 1,
            ],
            [
                'montant'        => 50.25,
                'id_rendez_vous' => 4,
                'id_etat'        => 2,
                'id_type'        => 2,
            ],
            [
                'montant'        => 320.75,
                'id_rendez_vous' => 5,
                'id_etat'        => 1,
                'id_type'        => 1,
            ],
        ]);
    }
}
