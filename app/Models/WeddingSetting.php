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
            'groom_parents' => '(Late) Mr. Sumith Rodrigo & Mrs. Banduwathi',
            'bride_parents' => 'Mr. Lalith Fernando & Mrs. Priska Pieris',
            'wedding_date' => '2026-12-29 16:00:00',
            'wedding_title' => 'The Wedding of Buddhima & Shavindi',
            'scripture_verse' => '"And now these three remain: faith, hope and love. But the greatest of these is love." — 1 Corinthians 13:13',
            'church_name' => "St. Sebastian's Church",
            'church_address' => 'Moratuwa, Sri Lanka',
            'church_time' => '4:00 PM',
            'venue_name' => 'Vinrich Lake Resort',
            'venue_address' => 'No. 18/3, Duwawatta Road, Piliyandala',
            'venue_map_url' => 'https://maps.google.com/?q=Vinrich+Lake+Resort+Piliyandala',
            'rsvp_phone' => '+94 718626389',
            'our_story' => 'Two hearts, one faith. We are delighted to invite you to celebrate as we exchange our vows before God and the people we love. Your presence and prayers will make our special day even more memorable.',
            'music_url' => '/music/wedding.mp3',
            'events' => [
                [
                    'name' => 'THE WEDDING MASS',
                    'date' => '29th December 2026',
                    'time' => '4:00 PM',
                    'venue' => "St. Sebastian's Church, Moratuwa",
                    'dress_code' => 'Formal Church Attire',
                    'icon' => 'church',
                ],
                [
                    'name' => 'THE RECEPTION',
                    'date' => '29th December 2026',
                    'time' => '6:30 PM to 12:00 AM',
                    'venue' => 'Vinrich Lake Resort, Piliyandala',
                    'dress_code' => 'Formal / Elegant Evening Wear',
                    'icon' => 'reception',
                ],
            ],
            'whatsapp_template' => "Dear :greeting,\n\nTogether with our families, we cordially invite you to celebrate the Holy Matrimony of :groom & :bride on Tuesday, 29th December 2026.\n\nWedding Mass: 4:00 PM at St. Sebastian's Church, Moratuwa.\nFollowed by the Reception from 6:30 PM to 12:00 AM at Vinrich Lake Resort, Piliyandala.\n\nPlease find your exclusive, personalized invitation card here:\n:link\n\nKindly RSVP (Buddhima - 0718626389). We joyfully await your presence and prayers!\n\nWarm regards,\nThe Rodrigo & Fernando Families",
            'whatsapp_template_si' => "ආදරණීය :greeting,\n\nඅප දෙපාර්ශවයේ දෙමාපියන්ගේ ආශීර්වාදය ඇතිව, :groom සහ :bride වන අපගේ ශුද්ධ වූ විවාහ මංගලෝත්සවය සඳහා ඔබ සැමට සාදරයෙන් ඇරයුම් කරමු.\n\nශුද්ධ වූ මංගල දිව්‍ය පූජාව: 2026 දෙසැම්බර් 29 වන අඟහරුවාදා පස්වරු 4:00 ට මොරටුව ශාන්ත සෙබස්තියන් දේවස්ථානයේදී.\nඉන් අනතුරුව මංගල සාදය: පස්වරු 6:30 සිට පිළියන්දල වින්රිච් ලේක් රිසෝට් හිදී.\n\nඔබ වෙනුවෙන්ම වෙන් කළ විශේෂ ඩිජිටල් ආරාධනා පත්‍රය මෙතැනින් විවෘත කරන්න:\n:link\n\nඔබගේ පැමිණීම කාරුණිකව දන්වන්න (බුද්ධිම - 0718626389). ඔබ සැමගේ ආශීර්වාදය සහ සහභාගීත්වය ඉමහත් සතුටින් අපේක්ෂා කරමු!\n\nමෙත් සිතින්,\nරුද්‍රිගු සහ ප්‍රනාන්දු පවුල්වල සැම",
        ];

        $stored = static::pluck('value', 'key')->toArray();

        foreach ($stored as $k => $v) {
            $decoded = json_decode($v, true);
            $stored[$k] = (json_last_error() === JSON_ERROR_NONE) ? $decoded : $v;
        }

        return array_merge($defaults, $stored);
    }
}
