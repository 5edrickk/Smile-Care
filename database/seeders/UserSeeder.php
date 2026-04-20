<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Da Goose',
            'prenom' => 'Bob',
            'id_role' => '1',
            'email' => 'honky.bobdagoose@mail.com',
            'password' => Hash::make('HONK')],

            ['name' => 'Boring',
            'prenom' => 'Mr.',
            'id_role' => '1',
            'email' => 'admin@mail.com',
            'password' => Hash::make('=user123')]
        ]);
    }
}
