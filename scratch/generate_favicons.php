<?php
// Generate crisp PNGs and ICO for favicon

function createFaviconImage($size) {
    $img = imagecreatetruecolor($size, $size);
    imagealphablending($img, false);
    imagesavealpha($img, true);

    $transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
    imagefill($img, 0, 0, $transparent);
    imagealphablending($img, true);

    $cx = $size / 2;
    $cy = $size / 2;
    $r = ($size / 2) - 1;

    // Outer circle burgundy
    $burgundy = imagecolorallocate($img, 173, 44, 81); // #ad2c51
    $pink = imagecolorallocate($img, 246, 120, 164); // #F678A4
    $lightPink = imagecolorallocate($img, 255, 220, 235);
    $gold = imagecolorallocate($img, 245, 194, 83);
    $white = imagecolorallocate($img, 255, 255, 255);

    // Draw circular background with anti-aliasing approximation
    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < $size; $x++) {
            $dist = sqrt(pow($x - $cx, 2) + pow($y - $cy, 2));
            if ($dist <= $r) {
                // Radial gradient from #C8636F to #ad2c51
                $ratio = $dist / $r;
                $red = (int)(200 * (1 - $ratio) + 173 * $ratio);
                $green = (int)(99 * (1 - $ratio) + 44 * $ratio);
                $blue = (int)(111 * (1 - $ratio) + 81 * $ratio);
                $color = imagecolorallocate($img, $red, $green, $blue);
                imagesetpixel($img, $x, $y, $color);
            }
        }
    }

    // 8 Petals
    $numPetals = 8;
    $petalDist = $r * 0.45;
    $petalRadius = $r * 0.32;
    for ($i = 0; $i < $numPetals; $i++) {
        $angle = $i * (2 * M_PI / $numPetals);
        $px = $cx + cos($angle) * $petalDist;
        $py = $cy + sin($angle) * $petalDist;
        imagefilledellipse($img, (int)$px, (int)$py, (int)($petalRadius * 1.5), (int)($petalRadius * 2.1), $pink);
        imagefilledellipse($img, (int)$px, (int)$py, (int)($petalRadius * 1.1), (int)($petalRadius * 1.6), $lightPink);
    }

    // Center Gold Bead
    $goldRadius = (int)($r * 0.38);
    imagefilledellipse($img, (int)$cx, (int)$cy, $goldRadius, $goldRadius, $gold);
    imagefilledellipse($img, (int)($cx - $goldRadius * 0.2), (int)($cy - $goldRadius * 0.2), (int)($goldRadius * 0.35), (int)($goldRadius * 0.35), $white);

    return $img;
}

$img32 = createFaviconImage(32);
imagepng($img32, 'public/favicon-32x32.png');
imagepng($img32, 'public/favicon.png');

$img180 = createFaviconImage(180);
imagepng($img180, 'public/apple-touch-icon.png');

// Simple standard ICO file format containing 32x32 PNG
$pngData = file_get_contents('public/favicon-32x32.png');
$pngLength = strlen($pngData);

// ICONDIR header: 6 bytes
// ICONDIRENTRY: 16 bytes
// Image data follows
$icoHeader = pack('vvv', 0, 1, 1);
$icoEntry = pack('CCCCvvVV', 32, 32, 0, 0, 1, 32, $pngLength, 22);

file_put_contents('public/favicon.ico', $icoHeader . $icoEntry . $pngData);

echo "Favicons successfully generated!\n";
