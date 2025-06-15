<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;
class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::insert([
            ['student_id' => 2, 'subject_id' => 1, 'grade' => 7, 'date' => now()],
            ['student_id' => 3, 'subject_id' => 2, 'grade' => 9, 'date' => now()],
            ['student_id' => 2, 'subject_id' => 2, 'grade' => 8, 'date' => now()],
            ['student_id' => 3, 'subject_id' => 3, 'grade' => 5, 'date' => now()],
        ]);
    }
}
