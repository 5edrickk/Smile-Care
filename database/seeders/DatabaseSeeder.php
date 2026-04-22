<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            MedicamentsSeeder::class,
            EtatsRendezVousSeeder::class,
            UserSeeder::class,
            TypesServicesSeeder::class,
            ServicesSeeder::class,
            EtatsPaiementSeeder::class,
            TypesPaiementSeeder::class,
            RendezVousSeeder::class,
            PaiementSeeder::class,
        ]);
    }
}
