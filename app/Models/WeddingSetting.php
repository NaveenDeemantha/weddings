<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        if (!$setting || $setting->value === null) {
            return $default;
        }

        $decoded = json_decode($setting->value, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $setting->value;
    }

    public static function set(string $key, mixed $value): void
    {
        $encoded = is_array($value) || is_object($value) ? json_encode($value) : (string)$value;
        static::updateOrCreate(['key' => $key], ['value' => $encoded]);
    }

    public static function getAll(): array
    {
        $defaults = [
            'bride_name' => 'Pooja',
            'groom_name' => 'Rahul',
            'bride_parents' => 'Mr. & Mrs. Sharma',
            'groom_parents' => 'Mr. & Mrs. Verma',
            'wedding_date' => '2026-12-18 10:30:00',
            'wedding_title' => 'The Wedding Celebration',
            'venue_name' => 'The Grand Palace Banquet & Royal Lawns',
            'venue_address' => 'Palace Road, Near Heritage Club, City Center',
            'venue_map_url' => 'https://maps.google.com/?q=The+Grand+Palace+Banquet',
            'our_story' => 'Two hearts, one soul, and a lifetime of shared dreams. We warmly invite you to witness and celebrate the sacred union of Pooja & Rahul as they take their seven vows together.',
            'music_url' => 'https://assets.mixkit.co/music/preview/mixkit-serene-view-443.mp3',
            'events' => [
                [
                    'name' => 'Haldi & Mehendi Ceremony',
                    'date' => 'Dec 17, 2026',
                    'time' => '03:30 PM Onwards',
                    'venue' => 'Saffron Poolside Gardens',
                    'dress_code' => 'Sunshine Yellow & Floral Ethnic',
                    'icon' => 'sun',
                ],
                [
                    'name' => 'Sangeet & Musical Night',
                    'date' => 'Dec 17, 2026',
                    'time' => '07:30 PM Onwards',
                    'venue' => 'Crystal Ballroom',
                    'dress_code' => 'Glamorous Ethnic & Sparkles',
                    'icon' => 'music',
                ],
                [
                    'name' => 'The Wedding Ceremony (Muhurtham)',
                    'date' => 'Dec 18, 2026',
                    'time' => '10:30 AM Onwards',
                    'venue' => 'Main Royal Mandap Lawns',
                    'dress_code' => 'Traditional Indian / Formal Festivities',
                    'icon' => 'ring',
                ],
                [
                    'name' => 'Grand Reception & Dinner',
                    'date' => 'Dec 18, 2026',
                    'time' => '07:30 PM Onwards',
                    'venue' => 'Imperial Banquet Hall',
                    'dress_code' => 'Elegant Evening Wear',
                    'icon' => 'utensils',
                ],
            ],
            'whatsapp_template' => "Namaste :greeting! 🌸✨\n\nWith immense joy and the blessings of our elders, our family cordially invites you to the wedding celebrations of our dear sister :bride with :groom! 💍💖\n\nTap to open your exclusive personal invitation card:\n:link\n\nPlease join us to shower your love and blessings upon the happy couple!\n\nWarm regards,\nFamily",
        ];

        $stored = static::pluck('value', 'key')->toArray();

        foreach ($stored as $k => $v) {
            $decoded = json_decode($v, true);
            $stored[$k] = (json_last_error() === JSON_ERROR_NONE) ? $decoded : $v;
        }

        return array_merge($defaults, $stored);
    }
}
