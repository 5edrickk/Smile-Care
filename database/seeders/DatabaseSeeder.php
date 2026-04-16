<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RolesSeeder::class,
            MedicamentsSeeder::class,
            EtatRendezVousSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Debug',
            'prenom' => 'Debug',
            'id_role' => 1,
            'email' => 'debug@debug.com',
            'password' => 'debug',
        ]);
    }
}
