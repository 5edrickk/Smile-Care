<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EtatRendezVousSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('etats_rendez_vous')->insert([
            ['id' => 1,
            'name' => 'À faire'],

            ['id' => 2,
            'name' => 'En cours'],

            ['id' => 3,
            'name' => 'Fait'],
        ]);
    }
}
