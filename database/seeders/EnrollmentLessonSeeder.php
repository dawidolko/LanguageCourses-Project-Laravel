<?php

namespace Database\Seeders;

use App\Models\EnrollmentLesson;
use Illuminate\Database\Seeder;

class EnrollmentLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EnrollmentLesson::truncate();

        EnrollmentLesson::insert([
            [
                'enrollment_id' => 1,
                'lesson_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enrollment_id' => 1,
                'lesson_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enrollment_id' => 2,
                'lesson_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enrollment_id' => 3,
                'lesson_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enrollment_id' => 4,
                'lesson_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enrollment_id' => 5,
                'lesson_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
