<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EnrollmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Enrollment::insert([
            [
                'status' => Enrollment::STATUSES[0],
                'lesson_date' => Carbon::now()->addDays(7),
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => Enrollment::STATUSES[1],
                'lesson_date' => Carbon::now()->addDays(14),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => Enrollment::STATUSES[2],
                'lesson_date' => Carbon::now()->addDays(21),
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => Enrollment::STATUSES[0],
                'lesson_date' => Carbon::now()->addDays(28),
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => Enrollment::STATUSES[1],
                'lesson_date' => Carbon::now()->addDays(35),
                'user_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
