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

/*
 * Create directories if they do not exist
 */
if (!is_dir($baseDir)) {
    mkdir($baseDir, 0755, true);
}

foreach ($courses as $course) {
    $filePath = $baseDir . '/' . $course['file'];
    
    /*
     * Generate only if the file does not exist
     */
    if (!file_exists($filePath)) {
        /*
         * Create an 800x600 image
         */
        $image = imagecreatetruecolor(800, 600);
        
        /*
         * Fill with the background colour
         */
        $bgColor = imagecolorallocate($image, $course['color'][0], $course['color'][1], $course['color'][2]);
        imagefill($image, 0, 0, $bgColor);
        
        /*
         * Add text (white)
         */
        $textColor = imagecolorallocate($image, 255, 255, 255);
        
        /*
         * Gradient effect: rectangle at the bottom
         */
        $overlayColor = imagecolorallocatealpha($image, 0, 0, 0, 50);
        imagefilledrectangle($image, 0, 450, 800, 600, $overlayColor);
        
        /*
         * Language name (large font), using imagestring for simplicity
         */
        $text = strtoupper($course['name']);
        /*
         * Centre the text (approximate width)
         */
        $textX = (800 - (strlen($text) * 18)) / 2;
        $textY = 500;
        
        /*
         * Draw the text 3 times for a bold effect
         */
        imagestring($image, 5, $textX, $textY, $text, $textColor);
        imagestring($image, 5, $textX + 1, $textY, $text, $textColor);
        imagestring($image, 5, $textX, $textY + 1, $text, $textColor);
        
        /*
         * Book icon (simple symbol)
         */
        $iconColor = imagecolorallocatealpha($image, 255, 255, 255, 30);
        imagefilledrectangle($image, 300, 200, 500, 380, $iconColor);
        
        /*
         * Save the image
         */
        imagejpeg($image, $filePath, 90);
        
        imagedestroy($image);
        
        echo "✓ Wygenerowano: {$course['file']}\n";
    }
}

echo "✅ All course images have been generated!\n";
