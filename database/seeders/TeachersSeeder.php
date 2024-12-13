<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Teacher::insert([
            [
                'name' => 'Pan Kowalski',
                'email' => 'kowalski@example.com',
                'phone' => '123-456-789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pani Nowak',
                'email' => 'nowak@example.com',
                'phone' => '098-765-432',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dr Wiśniewski',
                'email' => 'wisniewski@example.com',
                'phone' => '111-222-333',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'prof. Zieliński',
                'email' => 'zielinski@example.com',
                'phone' => '444-555-666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pani Wójcik',
                'email' => 'wojcik@example.com',
                'phone' => '777-888-999',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dr Kamiński',
                'email' => 'kaminski@example.com',
                'phone' => '888-999-000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pani Lewandowska',
                'email' => 'lewandowska@example.com',
                'phone' => '111-222-333',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pan Kwiatkowski',
                'email' => 'kwiatkowski@example.com',
                'phone' => '222-333-444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dr Szymański',
                'email' => 'szymanski@example.com',
                'phone' => '333-444-555',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'prof. Woźniak',
                'email' => 'wozniak@example.com',
                'phone' => '444-555-666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pani Kozłowska',
                'email' => 'kozlowska@example.com',
                'phone' => '555-666-777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pani Król',
                'email' => 'krol@example.com',
                'phone' => '666-777-888',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pan Tomaszewski',
                'email' => 'tomaszewski@example.com',
                'phone' => '777-888-999',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
