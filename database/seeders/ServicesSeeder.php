<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('services')->insert([
            ['id' => 1,
            'name' => 'Obturation (carie)',
            'duree' => 1,
            'id_type' => 1],

            ['id' => 2,
            'name' => 'Incrustation',
            'duree' => 2,
            'id_type' => 1],

            ['id' => 3,
            'name' => 'Facette',
            'duree' => 1,
            'id_type' => 1],

            ['id' => 4,
            'name' => 'Blanchiment',
            'duree' => 1.5,
            'id_type' => 1],

            ['id' => 5,
            'name' => 'Biopsie',
            'duree' => 1,
            'id_type' => 2],

            ['id' => 6,
            'name' => 'Pathologie bucale',
            'duree' => 2,
            'id_type' => 2],

            ['id' => 7,
            'name' => 'Santé dentaire et parodontale',
            'duree' => 2,
            'id_type' => 3],

            ['id' => 8,
            'name' => 'Nettoyage',
            'duree' => 1,
            'id_type' => 3],

            ['id' => 9,
            'name' => 'Protecteurs buccaux (sport)',
            'duree' => 1,
            'id_type' => 3],

            ['id' => 10,
            'name' => 'Grincement des dents',
            'duree' => 2,
            'id_type' => 3],

            ['id' => 11,
            'name' => 'Greffe osseuse',
            'duree' => 2,
            'id_type' => 3],

            ['id' => 12,
            'name' => 'Chirurgie des gencives',
            'duree' => 3,
            'id_type' => 3],

            ['id' => 13,
            'name' => 'Soins préventifs / nettoyage',
            'duree' => 2,
            'id_type' => 4],

            ['id' => 14,
            'name' => 'Obturation (carie)',
            'duree' => 1,
            'id_type' => 4],

            ['id' => 15,
            'name' => 'Urgences',
            'duree' => 3,
            'id_type' => 4],

            ['id' => 16,
            'name' => 'Traitement de canal',
            'duree' => 2,
            'id_type' => 6],

            ['id' => 17,
            'name' => 'Pont / couronne',
            'duree' => 2,
            'id_type' => 7],

            ['id' => 18,
            'name' => 'Prothèse complète (dentier) / partielle',
            'duree' => 3,
            'id_type' => 7],

            ['id' => 19,
            'name' => 'Prothèse implanto portée (sur implant)',
            'duree' => 2,
            'id_type' => 7],

            ['id' => 20,
            'name' => 'Pose d\'implant',
            'duree' => 1,
            'id_type' => 7],

            ['id' => 21,
            'name' => 'Extraction de dent',
            'duree' => 2,
            'id_type' => 8],

        ]);
    }
}
