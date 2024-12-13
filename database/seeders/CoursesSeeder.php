<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Course::insert([
            [
                'name' => 'Angielski dla Początkujących',
                'description' => 'Podstawowy kurs języka angielskiego dla osób, które chcą zacząć naukę od podstaw.',
                'language' => 'English',
                'teacher_id' => 1,
                'path' => 'courses/english.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Niemiecki dla Zaawansowanych',
                'description' => 'Zaawansowany kurs języka niemieckiego dla osób chcących pogłębić swoją znajomość języka.',
                'language' => 'German',
                'teacher_id' => 2,
                'path' => 'courses/german.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Francuski Konwersacyjny',
                'description' => 'Kurs języka francuskiego skoncentrowany na praktycznych umiejętnościach konwersacji.',
                'language' => 'French',
                'teacher_id' => 3,
                'path' => 'courses/french.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hiszpański dla Podróżników',
                'description' => 'Kurs języka hiszpańskiego dla osób chcących nauczyć się przydatnych zwrotów na wakacje.',
                'language' => 'Spanish',
                'teacher_id' => 4,
                'path' => 'courses/spanish.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Włoski w Biznesie',
                'description' => 'Kurs języka włoskiego dla osób pracujących w środowisku biznesowym.',
                'language' => 'Italian',
                'teacher_id' => 5,
                'path' => 'courses/italian.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rosyjski dla Początkujących',
                'description' => 'Podstawowy kurs języka rosyjskiego dla osób chcących nauczyć się podstawowych zwrotów.',
                'language' => 'Russian',
                'teacher_id' => 1,
                'path' => 'courses/russian.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mandaryński dla Średniozaawansowanych',
                'description' => 'Kurs języka mandaryńskiego dla osób chcących pogłębić swoje umiejętności językowe.',
                'language' => 'Mandarin',
                'teacher_id' => 2,
                'path' => 'courses/mandarin.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Japoński dla Biznesu',
                'description' => 'Kurs języka japońskiego dla osób pracujących w środowisku biznesowym.',
                'language' => 'Japanese',
                'teacher_id' => 3,
                'path' => 'courses/japanese.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Portugalski dla Podróżników',
                'description' => 'Podstawowy kurs języka portugalskiego dla osób planujących podróże do krajów portugalskojęzycznych.',
                'language' => 'Portuguese',
                'teacher_id' => 4,
                'path' => 'courses/portuguese.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Koreański dla Początkujących',
                'description' => 'Podstawowy kurs języka koreańskiego dla osób zaczynających naukę.',
                'language' => 'Korean',
                'teacher_id' => 5,
                'path' => 'courses/korean.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arabski dla Podróżników',
                'description' => 'Kurs języka arabskiego skoncentrowany na podstawowych zwrotach przydatnych podczas podróży.',
                'language' => 'Arabic',
                'teacher_id' => 1,
                'path' => 'courses/arabic.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grecki dla Początkujących',
                'description' => 'Podstawowy kurs języka greckiego dla osób chcących nauczyć się podstawowych zwrotów.',
                'language' => 'Greek',
                'teacher_id' => 2,
                'path' => 'courses/greek.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Szwedzki dla Zaawansowanych',
                'description' => 'Zaawansowany kurs języka szwedzkiego dla osób chcących pogłębić swoje umiejętności.',
                'language' => 'Swedish',
                'teacher_id' => 3,
                'path' => 'courses/swedish.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Holenderski dla Średniozaawansowanych',
                'description' => 'Kurs języka holenderskiego dla osób chcących podnieść swoje umiejętności językowe.',
                'language' => 'Dutch',
                'teacher_id' => 4,
                'path' => 'courses/dutch.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Turecki dla Biznesu',
                'description' => 'Kurs języka tureckiego dla osób pracujących w środowisku biznesowym.',
                'language' => 'Turkish',
                'teacher_id' => 5,
                'path' => 'courses/turkish.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
