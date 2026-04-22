<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtatsPaiementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('etats_paiements')->insert([
            ['name' => 'Payé',        'description' => 'Paiement complété'],
            ['name' => 'En attente',  'description' => 'Paiement en attente'],
            ['name' => 'Annulé',      'description' => 'Paiement annulé'],
        ]);
    }
}
