<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('states')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::table('states')->insert([
            ['name' => 'En Reparación'],
            ['name' => 'En Espera de'],
            ['name' => 'Repuesto'],
            ['name' => 'Para dar de baja'],
            ['name' => 'Solucionado']
        ]);
    }
}
