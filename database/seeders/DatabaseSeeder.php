<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\User;
use App\Models\WeddingSetting;
use App\Models\Wish;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@wedding.com'],
            [
                'name' => 'Wedding Host',
                'password' => Hash::make('password'),
            ]
        );

        // Reset settings
        WeddingSetting::truncate();
        foreach (WeddingSetting::getAll() as $key => $val) {
            WeddingSetting::set($key, $val);
        }

        // Clean and reseed sample guests
        Wish::truncate();
        Guest::truncate();

        Schema::enableForeignKeyConstraints();

        $guest1 = Guest::create([
            'name' => 'Mr & Mrs Silva',
            'slug' => 'mr-mrs-silva',
            'phone' => '+94771234567',
            'custom_greeting' => 'MR & MRS SILVA',
            'max_guests' => 2,
            'status' => 'pending',
            'attending_count' => 1,
            'dietary_notes' => null,
            'notes' => 'Close family friends',
            'opened_at' => now()->subHours(2),
        ]);

        $guest2 = Guest::create([
            'name' => 'Dr. & Mrs. Roshan Rodrigo',
            'slug' => 'roshan-rodrigo',
            'phone' => '+94719876543',
            'custom_greeting' => 'DR. & MRS. ROSHAN RODRIGO',
            'max_guests' => 2,
            'status' => 'attending',
            'attending_count' => 2,
            'notes' => 'Family physician',
            'opened_at' => now()->subDays(1),
            'rsvp_at' => now()->subHours(8),
        ]);

        $guest3 = Guest::create([
            'name' => 'Rev. Fr. Jude Peiris',
            'slug' => 'fr-jude-peiris',
            'phone' => '+94773344556',
            'custom_greeting' => 'REV. FR. JUDE PEIRIS',
            'max_guests' => 1,
            'status' => 'attending',
            'attending_count' => 1,
            'notes' => 'Officiating Priest',
            'opened_at' => now()->subDays(1),
            'rsvp_at' => now()->subHours(12),
        ]);

        // Sample wishes
        Wish::create([
            'guest_id' => $guest1->id,
            'guest_name' => 'Mr & Mrs Silva',
            'message' => 'May the Lord abundantly bless your marriage with endless joy, peace, and health! Shenali & Rovan, you both look so radiant together.',
            'is_approved' => true,
        ]);

        Wish::create([
            'guest_id' => $guest3->id,
            'guest_name' => 'Rev. Fr. Jude Peiris',
            'message' => 'May God unite your hearts in Holy Matrimony and guide your steps every day of your shared life. Prayers and blessings for Shenali and Rovan.',
            'is_approved' => true,
        ]);
    }
}
