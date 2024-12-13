<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UsersSeeder::class,
            TeachersSeeder::class,
            CoursesSeeder::class,
            LessonsSeeder::class,
            EnrollmentsSeeder::class,
            EnrollmentLessonSeeder::class,
        ]);
    }
}
