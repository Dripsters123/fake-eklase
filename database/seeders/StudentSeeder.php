<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Alfrēds',
                'last_name' => 'Smirdpēdis',
                'email' => 'alfreds@example.com',
                'role' => 'student',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Evija',
                'last_name' => 'Smaržpuķīte',
                'email' => 'evija@example.com',
                'role' => 'student',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Teds',
                'last_name' => 'Melnais',
                'email' => 'teds@example.com',
                'role' => 'student',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
