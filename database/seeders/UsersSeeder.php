<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = Role::where('name', 'admin')->first()->id;
        $userRoleId = Role::where('name', 'user')->first()->id;

        User::insert([
            [
                'name' => 'Jan Kowalski',
                'email' => 'kowalski@example.com',
                'password' => Hash::make('Admin12345%'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $adminRoleId
            ],
            [
                'name' => 'Anna Nowak',
                'email' => 'nowak@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Ewa Wiśniewska',
                'email' => 'wisniewska@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Robert Lewandowski',
                'email' => 'lewandowski@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Krzysztof Zieliński',
                'email' => 'zielinski@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Marta Wójcik',
                'email' => 'wojcik@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Andrzej Kamiński',
                'email' => 'kaminski@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Beata Lewandowska',
                'email' => 'lewandowska@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Paweł Kwiatkowski',
                'email' => 'kwiatkowski@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Agnieszka Szymańska',
                'email' => 'szymanska@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Jakub Woźniak',
                'email' => 'wozniak@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Karolina Kozłowska',
                'email' => 'kozlowska@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Marek Król',
                'email' => 'krol@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Piotr Tomaszewski',
                'email' => 'tomaszewski@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
            [
                'name' => 'Barbara Nowicka',
                'email' => 'nowicka@example.com',
                'password' => Hash::make('password12345%A'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $userRoleId
            ],
        ]);
    }
}
