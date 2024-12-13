<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Lesson::insert([
            [
                'title' => 'Podstawy Języka Angielskiego',
                'description' => 'Nauka podstawowych zwrotów w języku angielskim, w tym gramatyka i słownictwo.',
                'course_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rozmówki Angielskie',
                'description' => 'Praktyczne rozmówki w języku angielskim dla początkujących.',
                'course_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zaawansowana Gramatyka Niemiecka',
                'description' => 'Kurs gramatyki niemieckiej dla zaawansowanych.',
                'course_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rozmówki Niemieckie',
                'description' => 'Praktyczne rozmówki w języku niemieckim.',
                'course_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Francuskiego',
                'description' => 'Nauka podstawowych zwrotów w języku francuskim, w tym gramatyka i słownictwo.',
                'course_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Konwersacje po Francusku',
                'description' => 'Praktyczne lekcje konwersacji w języku francuskim.',
                'course_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zwroty Hiszpańskie dla Podróżników',
                'description' => 'Nauka praktycznych zwrotów w języku hiszpańskim.',
                'course_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Hiszpańskiego',
                'description' => 'Nauka podstawowych zwrotów w języku hiszpańskim, w tym gramatyka i słownictwo.',
                'course_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zwroty Włoskie w Biznesie',
                'description' => 'Nauka zwrotów w języku włoskim przydatnych w biznesie.',
                'course_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Włoskiego',
                'description' => 'Podstawy języka włoskiego, w tym gramatyka i słownictwo.',
                'course_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Rosyjskiego',
                'description' => 'Podstawy języka rosyjskiego, w tym gramatyka i słownictwo.',
                'course_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Konwersacje po Rosyjsku',
                'description' => 'Praktyczne lekcje konwersacji w języku rosyjskim.',
                'course_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Mandaryńskiego',
                'description' => 'Podstawy języka mandaryńskiego, w tym gramatyka i słownictwo.',
                'course_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zwroty Mandaryńskie w Biznesie',
                'description' => 'Nauka zwrotów w języku mandaryńskim przydatnych w biznesie.',
                'course_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Japońskiego',
                'description' => 'Podstawy języka japońskiego, w tym gramatyka i słownictwo.',
                'course_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Konwersacje po Japońsku',
                'description' => 'Praktyczne lekcje konwersacji w języku japońskim.',
                'course_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zwroty Portugalskie dla Podróżników',
                'description' => 'Nauka praktycznych zwrotów w języku portugalskim.',
                'course_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Portugalskiego',
                'description' => 'Podstawy języka portugalskiego, w tym gramatyka i słownictwo.',
                'course_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zwroty Koreańskie dla Początkujących',
                'description' => 'Podstawowy kurs języka koreańskiego, w tym gramatyka i słownictwo.',
                'course_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Koreańskiego',
                'description' => 'Podstawowy kurs języka koreańskiego dla osób zaczynających naukę.',
                'course_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zwroty Arabskie dla Podróżników',
                'description' => 'Nauka praktycznych zwrotów w języku arabskim.',
                'course_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Arabskiego',
                'description' => 'Podstawy języka arabskiego, w tym gramatyka i słownictwo.',
                'course_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Greckiego',
                'description' => 'Podstawowy kurs języka greckiego, w tym gramatyka i słownictwo.',
                'course_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Konwersacje po Grecku',
                'description' => 'Praktyczne lekcje konwersacji w języku greckim.',
                'course_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zaawansowana Gramatyka Szwedzka',
                'description' => 'Kurs zaawansowanej gramatyki szwedzkiej.',
                'course_id' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Konwersacje po Szwedzku',
                'description' => 'Praktyczne lekcje konwersacji w języku szwedzkim.',
                'course_id' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zwroty Holenderskie dla Średniozaawansowanych',
                'description' => 'Kurs praktycznych zwrotów w języku holenderskim.',
                'course_id' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Holenderskiego',
                'description' => 'Podstawowy kurs języka holenderskiego.',
                'course_id' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zwroty Tureckie w Biznesie',
                'description' => 'Kurs zwrotów w języku tureckim przydatnych w biznesie.',
                'course_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Podstawy Języka Tureckiego',
                'description' => 'Podstawy języka tureckiego, w tym gramatyka i słownictwo.',
                'course_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
