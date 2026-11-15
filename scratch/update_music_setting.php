<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
App\Models\WeddingSetting::set('music_url', '/music/wedding.mp3');
echo "Updated music_url to: " . App\Models\WeddingSetting::get('music_url') . "\n";
