<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesPaiementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('types_paiements')->insert([
            ['name' => 'Carte de crédit', 'description' => 'Visa, Mastercard'],
            ['name' => 'Comptant',        'description' => 'Argent liquide'],
            ['name' => 'Virement',        'description' => 'Transfert bancaire'],
        ]);
    }
}
