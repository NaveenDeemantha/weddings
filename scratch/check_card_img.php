<?php
$path = 'C:/Users/Nimas/.gemini/antigravity/brain/4f2ffd69-ea6f-475a-844b-3bf86a82160b/.user_uploaded/media_1794719715404_d9e93df3.jpg';
$info = getimagesize($path);
echo "Width: " . $info[0] . ", Height: " . $info[1] . ", MIME: " . $info['mime'] . "\n";
