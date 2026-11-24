<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'phone',
        'custom_greeting',
        'max_guests',
        'status',
        'attending_count',
        'dietary_notes',
        'notes',
        'opened_at',
        'rsvp_at',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'rsvp_at' => 'datetime',
        'max_guests' => 'integer',
        'attending_count' => 'integer',
    ];

    protected $appends = [
        'invitation_url',
        'whatsapp_url',
        'whatsapp_url_si',
    ];

    protected static function booted(): void
    {
        static::creating(function (Guest $guest) {
            if (empty($guest->slug)) {
                $baseSlug = Str::slug($guest->name);
                $uniquePart = strtolower(Str::random(6));
                $slug = $baseSlug ? "{$baseSlug}-{$uniquePart}" : "guest-{$uniquePart}";
                while (static::where('slug', $slug)->exists()) {
                    $uniquePart = strtolower(Str::random(6));
                    $slug = $baseSlug ? "{$baseSlug}-{$uniquePart}" : "guest-{$uniquePart}";
                }
                $guest->slug = $slug;
            }
        });
    }

    public function wishes(): HasMany
    {
        return $this->hasMany(Wish::class);
    }

    public function getInvitationUrlAttribute(): string
    {
        return url("/invite/{$this->slug}");
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', (string)$this->phone);
        $bride = WeddingSetting::get('bride_name', 'Shavindi');
        $groom = WeddingSetting::get('groom_name', 'Buddhima');
        $greeting = $this->custom_greeting ?: $this->name;
        
        $defaultTemplate = "Dear :greeting,\n\nTogether with our families, we cordially invite you to celebrate the Holy Matrimony of :groom & :bride on Tuesday, 29th December 2026.\n\nWedding Mass: 4:00 PM at St. Sebastian's Church, Moratuwa.\nFollowed by the Reception from 6:30 PM to 12:00 AM at Vinrich Lake Resort, Piliyandala.\n\nPlease find your exclusive, personalized invitation card here:\n:link\n\nKindly RSVP (Buddhima - 0718626389). We joyfully await your presence and prayers!\n\nWarm regards,\nThe Rodrigo & Fernando Families";
        $template = WeddingSetting::get('whatsapp_template', $defaultTemplate);

        $link = url("/invite/{$this->slug}?lang=en");

        $message = str_replace(
            [':greeting', ':name', ':bride', ':groom', ':link'],
            [$greeting, $this->name, $bride, $groom, $link],
            $template
        );

        $encoded = urlencode($message);

        return $phone ? "https://wa.me/{$phone}?text={$encoded}" : "https://wa.me/?text={$encoded}";
    }

    public function getWhatsappUrlSiAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', (string)$this->phone);
        $bride = 'ශාවින්දි';
        $groom = 'බුද්ධිම';
        $greeting = $this->custom_greeting ?: $this->name;
        
        $defaultTemplateSi = "ආදරණීය :greeting,\n\nඅප දෙපාර්ශවයේ දෙමාපියන්ගේ ආශීර්වාදය ඇතිව, :groom සහ :bride වන අපගේ ශුද්ධ වූ විවාහ මංගලෝත්සවය සඳහා ඔබ සැමට සාදරයෙන් ඇරයුම් කරමු.\n\nශුද්ධ වූ මංගල දිව්‍ය පූජාව: 2026 දෙසැම්බර් 29 වන අඟහරුවාදා පස්වරු 4:00 ට මොරටුව ශාන්ත සෙබස්තියන් දේවස්ථානයේදී.\nඉන් අනතුරුව මංගල සාදය: පස්වරු 6:30 සිට පිළියන්දල වින්රිච් ලේක් රිසෝට් හිදී.\n\nඔබ වෙනුවෙන්ම වෙන් කළ විශේෂ ඩිජිටල් ආරාධනා පත්‍රය මෙතැනින් විවෘත කරන්න:\n:link\n\nඔබගේ පැමිණීම කාරුණිකව දන්වන්න (බුද්ධිම - 0718626389). ඔබ සැමගේ ආශීර්වාදය සහ සහභාගීත්වය ඉමහත් සතුටින් අපේක්ෂා කරමු!\n\nමෙත් සිතින්,\nරුද්‍රිගු සහ ප්‍රනාන්දු පවුල්වල සැම";
        $template = WeddingSetting::get('whatsapp_template_si', $defaultTemplateSi);

        $link = url("/invite/{$this->slug}?lang=si");

        $message = str_replace(
            [':greeting', ':name', ':bride', ':groom', ':link'],
            [$greeting, $this->name, $bride, $groom, $link],
            $template
        );

        $encoded = urlencode($message);

        return $phone ? "https://wa.me/{$phone}?text={$encoded}" : "https://wa.me/?text={$encoded}";
    }
}
