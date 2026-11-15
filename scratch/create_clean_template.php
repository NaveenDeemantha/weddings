<?php
$src = imagecreatefromjpeg('public/images/wedding/card_sample.jpg');
$w = imagesx($src);
$h = imagesy($src);

$clean = imagecreatetruecolor($w, $h);
imagecopy($clean, $src, 0, 0, 0, 0, $w, $h);

$white = imagecolorallocate($clean, 255, 255, 255);

// The text is roughly in these bounding boxes:
// 1. Scripture at top-left: x=85 to 370, y=55 to 155.
// Let's sample the watercolor background around it:
// Let's see if we leave scripture in place or clean it.
// 2. Parents: x=40 to 665, y=185 to 255.
// Background at (200, 200) is rgb(253, 253, 253).
// 3. Request: y=270 to 295, x=120 to 585
// 4. Guest line: y=320 to 350, x=45 to 660
// 5. As we celebrate: y=350 to 375, x=170 to 535
// 6. Buddhima & Shavindi: y=375 to 550, x=110 to 600
// 7. Date: y=555 to 625, x=60 to 645
// 8. Nuptial Mass: y=630 to 720, x=120 to 585
// 9. Reception: y=735 to 845, x=340 to 675
// 10. We look forward: y=825 to 900, x=270 to 680
// 11. RSVP: y=905 to 970, x=400 to 675

// Notice: In the center of the card (between x=100..600, y=170..970), the card is PURE WHITE!
// The flowers are in the top-right (x > 380, y < 350) and bottom-left (x < 370, y > 640).
// In fact, the text in the middle is completely on pure white!
// Let's test filling the white text area with pure white:

// Parents & middle text area:
imagefilledrectangle($clean, 40, 180, 670, 630, $white);
// Ceremony & Reception text area (avoiding bottom left flower at x < 360, y > 640):
imagefilledrectangle($clean, 120, 630, 670, 725, $white);
imagefilledrectangle($clean, 350, 725, 680, 970, $white);

// For the top scripture: it's on soft green watercolor wash.
// If we want crisp typography, we can clone/blend the soft wash or keep the original scripture!
imagejpeg($clean, 'public/images/wedding/card_clean_template.jpg', 96);
echo "Successfully created card_clean_template.jpg!\n";
