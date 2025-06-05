<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::insert([
            ['subject_name' => 'Matemātika'],
            ['subject_name' => 'Fizika'],
            ['subject_name' => 'Sports'],
        ]);
    }
}
