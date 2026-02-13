<?php

// Inicjalizacja GD
$courses = [
    ['name' => 'English', 'file' => 'english.jpg', 'color' => [66, 133, 244]],
    ['name' => 'German', 'file' => 'german.jpg', 'color' => [52, 168, 83]],
    ['name' => 'French', 'file' => 'french.jpg', 'color' => [251, 188, 5]],
    ['name' => 'Spanish', 'file' => 'spanish.jpg', 'color' => [234, 67, 53]],
    ['name' => 'Italian', 'file' => 'italian.jpg', 'color' => [0, 150, 136]],
    ['name' => 'Russian', 'file' => 'russian.jpg', 'color' => [103, 58, 183]],
    ['name' => 'Mandarin', 'file' => 'mandarin.jpg', 'color' => [233, 30, 99]],
    ['name' => 'Japanese', 'file' => 'japanese.jpg', 'color' => [255, 87, 34]],
    ['name' => 'Portuguese', 'file' => 'portuguese.jpg', 'color' => [0, 188, 212]],
    ['name' => 'Korean', 'file' => 'korean.jpg', 'color' => [156, 39, 176]],
    ['name' => 'Arabic', 'file' => 'arabic.jpg', 'color' => [121, 85, 72]],
    ['name' => 'Greek', 'file' => 'greek.jpg', 'color' => [33, 150, 243]],
    ['name' => 'Swedish', 'file' => 'swedish.jpg', 'color' => [76, 175, 80]],
    ['name' => 'Dutch', 'file' => 'dutch.jpg', 'color' => [255, 152, 0]],
    ['name' => 'Turkish', 'file' => 'turkish.jpg', 'color' => [244, 67, 54]],
];

$baseDir = '/var/www/html/storage/app/public/img/courses';

// Utwórz katalogi jeśli nie istnieją
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0755, true);
}

foreach ($courses as $course) {
    $filePath = $baseDir . '/' . $course['file'];
    
    // Generuj tylko jeśli plik nie istnieje
    if (!file_exists($filePath)) {
        // Utwórz obrazek 800x600
        $image = imagecreatetruecolor(800, 600);
        
        // Wypełnij kolorem tła
        $bgColor = imagecolorallocate($image, $course['color'][0], $course['color'][1], $course['color'][2]);
        imagefill($image, 0, 0, $bgColor);
        
        // Dodaj tekst (biały)
        $textColor = imagecolorallocate($image, 255, 255, 255);
        
        // Gradient effect - prostokąt na dole
        $overlayColor = imagecolorallocatealpha($image, 0, 0, 0, 50);
        imagefilledrectangle($image, 0, 450, 800, 600, $overlayColor);
        
        // Nazwa języka (duża czcionka) - używamy imagestring dla prostoty
        $text = strtoupper($course['name']);
        $textX = (800 - (strlen($text) * 18)) / 2;  // Centruj tekst (przybliżona szerokość)
        $textY = 500;
        
        // Narysuj tekst 3 razy (efekt pogrubienia)
        imagestring($image, 5, $textX, $textY, $text, $textColor);
        imagestring($image, 5, $textX + 1, $textY, $text, $textColor);
        imagestring($image, 5, $textX, $textY + 1, $text, $textColor);
        
        // Ikona książki (prosty symbol)
        $iconColor = imagecolorallocatealpha($image, 255, 255, 255, 30);
        imagefilledrectangle($image, 300, 200, 500, 380, $iconColor);
        
        // Zapisz obrazek
        imagejpeg($image, $filePath, 90);
        
        imagedestroy($image);
        
        echo "✓ Wygenerowano: {$course['file']}\n";
    }
}

echo "✅ Wszystkie obrazy kursów zostały wygenerowane!\n";
