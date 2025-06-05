<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Dāvids',
            'last_name' => 'Plikdirsis',
            'email' => 'admin@example.com',
            'role' => 'teacher',
            'password' => 'password',
        ]);
        User::factory()->create([
            'name' => 'Ādolfs',
            'last_name' => 'Kurzempirdis',
            'email' => 'student@example.com',
            'role' => 'student',
            'password' => 'password',
        ]);
    }
}
