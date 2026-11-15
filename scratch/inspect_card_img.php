<?php
// Inspect card_sample.jpg text regions
$img = imagecreatefromjpeg('public/images/wedding/card_sample.jpg');
$w = imagesx($img);
$h = imagesy($img);

echo "Dimensions: {$w}x{$h}\n";

// Let's sample pixels at various coordinates
// Background at (200, 200):
$rgb = imagecolorat($img, 200, 200);
$r = ($rgb >> 16) & 0xFF; $g = ($rgb >> 8) & 0xFF; $b = ($rgb >> 0) & 0xFF;
echo "Color at (200, 200): rgb($r, $g, $b)\n";

// Background at (350, 500):
$rgb = imagecolorat($img, 350, 500);
$r = ($rgb >> 16) & 0xFF; $g = ($rgb >> 8) & 0xFF; $b = ($rgb >> 0) & 0xFF;
echo "Color at (350, 500): rgb($r, $g, $b)\n";
