<?php
// Let's create a pristine background from card_sample.jpg
$src = imagecreatefromjpeg('public/images/wedding/card_sample.jpg');
$w = imagesx($src);
$h = imagesy($src);

$bg = imagecreatetruecolor($w, $h);
imagecopy($bg, $src, 0, 0, 0, 0, $w, $h);

// The text in the center is on pure white (rgb 254, 254, 254)
// Let's inspect coordinates of text vs flowers
// Top right flower: starts around x=340, y=0 to y=340
// Bottom left flower: x=0 to x=370, y=640 to y=1024
// Center area with text:
// y from 160 to 920, x from 50 to 650 (avoiding bottom left flower at x < 380, y > 640)

$white = imagecolorallocate($bg, 254, 254, 254);

// Top scripture area: x=60..370, y=50..160 has soft watercolor wash.
// Let's check average color around scripture:
$c = imagecolorat($src, 100, 100);
$r = ($c >> 16) & 0xFF; $g = ($c >> 8) & 0xFF; $b = ($c >> 0) & 0xFF;
echo "Scripture bg at (100,100): rgb($r,$g,$b)\n";

// Let's save a copy of the original as card_exact_original.jpg
imagejpeg($src, 'public/images/wedding/card_exact_original.jpg', 96);
echo "Saved original sample image.\n";
