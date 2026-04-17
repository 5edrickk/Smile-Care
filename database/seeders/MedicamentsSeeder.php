<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medicaments')->insert([
            ['id' => 1,
            'name' => 'Tylenol'],

            ['id' => 2,
            'name' => 'Advil'],
        ]);
    }
}
