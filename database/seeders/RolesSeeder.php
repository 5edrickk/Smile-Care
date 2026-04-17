<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert([
            ['id' => 1,
            'name' => 'Admin',
            'description' => 'Role administrateur'],

            ['id' => 2,
            'name' => 'Employé',
            'description' => 'Role de base des employés standards'],

            ['id' => 3,
            'name' => 'receptionniste',
            'description' => 'Role propre au receptionnistes'],

            ['id' => 4,
            'name' => 'Dentiste',
            'description' => 'Role propre au dentistes'],
        ]);
    }
}
