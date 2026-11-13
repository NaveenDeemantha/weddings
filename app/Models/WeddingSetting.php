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
            'bride_name' => 'Shavindi',
            'groom_name' => 'Buddhima',
            'bride_full_name' => 'Shavindi',
            'groom_full_name' => 'Buddhima',
            'bride_parents' => 'Mr. & Mrs. Perera',
            'groom_parents' => 'Mr. & Mrs. Fernando',
            'wedding_date' => '2026-12-12 09:00:00',
            'wedding_title' => 'Holy Matrimony - Buddhima & Shavindi',
            'scripture_verse' => 'Therefore what God has joined together, let no one separate. — Matthew 19:6',
            'church_name' => "St. Mary's Church",
            'church_address' => 'Grand Street, Negombo, Sri Lanka',
            'church_time' => '09:00 AM',
            'venue_name' => "St. Mary's Church",
            'venue_address' => 'Grand Street, Negombo, Sri Lanka',
            'venue_map_url' => 'https://maps.google.com/?q=St.+Mary%27s+Church+Grand+Street+Negombo',
            'our_story' => 'Two hearts, one faith. We are delighted to invite you to the church as we exchange our vows before God and the people we love. Your presence and your prayers will make our special day even more memorable.',
            'music_url' => 'https://assets.mixkit.co/music/preview/mixkit-serene-view-443.mp3',
            'events' => [
                [
                    'name' => 'REGISTRATION',
                    'date' => '12th December 2026',
                    'time' => '8:30 AM',
                    'venue' => "St. Mary's Church, Negombo",
                    'dress_code' => 'Formal Church Attire',
                    'icon' => 'signature',
                ],
                [
                    'name' => 'NUPTIAL MASS',
                    'date' => '12th December 2026',
                    'time' => '9:00 AM',
                    'venue' => "St. Mary's Church, Negombo",
                    'dress_code' => 'Formal Church Attire',
                    'icon' => 'church',
                ],
                [
                    'name' => 'PORUWA & RECEPTION',
                    'date' => '12th December 2026',
                    'time' => '12:00 PM Onwards',
                    'venue' => 'The Grand Ballroom',
                    'dress_code' => 'Formal / Sri Lankan National / Elegant Evening Wear',
                    'icon' => 'reception',
                ],
            ],
            'whatsapp_template' => "Dear :greeting,\n\nTogether with our families, we cordially invite you to celebrate the Holy Matrimony of :bride & :groom on Saturday, 12th December 2026 at St. Mary's Church, Negombo, Sri Lanka.\n\nPlease find your exclusive, personalized invitation card here:\n:link\n\nKindly RSVP at your earliest convenience. We joyfully await your presence and prayers!\n\nWarm regards,\nThe Perera & Fernando Families",
        ];

        $stored = static::pluck('value', 'key')->toArray();

        foreach ($stored as $k => $v) {
            $decoded = json_decode($v, true);
            $stored[$k] = (json_last_error() === JSON_ERROR_NONE) ? $decoded : $v;
        }

        return array_merge($defaults, $stored);
    }
}
