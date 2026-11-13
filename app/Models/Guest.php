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
        
        $template = WeddingSetting::get('whatsapp_template', "Namaste :greeting! 🌸✨\n\nWith the blessings of our elders and the grace of the Almighty, we cordially invite you and your family to celebrate the wedding ceremony of our beloved sister :bride with :groom! 💍💖\n\nPlease find your exclusive, personalized invitation card here:\n:link\n\nWe look forward to celebrating this joyful milestone together!\n\nWarm regards,\nFamily");

        $message = str_replace(
            [':greeting', ':name', ':bride', ':groom', ':link'],
            [$greeting, $this->name, $bride, $groom, $this->invitation_url],
            $template
        );

        $encoded = urlencode($message);

        return $phone ? "https://wa.me/{$phone}?text={$encoded}" : "https://wa.me/?text={$encoded}";
    }
}
