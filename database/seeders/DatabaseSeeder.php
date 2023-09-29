<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'username' => 'test',
            'dni' => '10101010',
            'password' => Hash::make('12345678'),
            'role' => 'administrador'
        ]);

        $this->call([
            StatusSeeder::class
        ]);

        \App\Models\Secretary::factory(10)->create();
    }
}
