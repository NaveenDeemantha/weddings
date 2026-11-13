<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\User;
use App\Models\WeddingSetting;
use App\Models\Wish;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@wedding.com'],
            [
                'name' => 'Wedding Host',
                'password' => Hash::make('password'),
            ]
        );

        // Seed initial wedding settings
        foreach (WeddingSetting::getAll() as $key => $val) {
            WeddingSetting::set($key, $val);
        }

        // Sample guests
        $guest1 = Guest::create([
            'name' => 'Rajesh Sharma & Family',
            'slug' => 'rajesh-sharma-family',
            'phone' => '+919876543210',
            'custom_greeting' => 'Respected Rajesh Uncle, Aunty & Family',
            'max_guests' => 4,
            'status' => 'attending',
            'attending_count' => 4,
            'dietary_notes' => 'Pure Vegetarian',
            'notes' => 'Close family, arriving on Dec 16',
            'opened_at' => now()->subDays(2),
            'rsvp_at' => now()->subDay(),
        ]);

        $guest2 = Guest::create([
            'name' => 'Ananya & Vikram Malhotra',
            'slug' => 'ananya-vikram',
            'phone' => '+919811223344',
            'custom_greeting' => 'Dearest Ananya & Vikram',
            'max_guests' => 2,
            'status' => 'pending',
            'attending_count' => 0,
            'dietary_notes' => null,
            'notes' => 'College best friends',
            'opened_at' => now()->subHours(6),
        ]);

        $guest3 = Guest::create([
            'name' => 'Dr. Sameer Sen',
            'slug' => 'dr-sameer-sen',
            'phone' => '+919988776655',
            'custom_greeting' => 'Respected Dr. Sameer Sen',
            'max_guests' => 2,
            'status' => 'declined',
            'attending_count' => 0,
            'dietary_notes' => null,
            'notes' => 'Travelling abroad for medical conference',
            'opened_at' => now()->subDays(3),
            'rsvp_at' => now()->subDays(2),
        ]);

        // Sample wishes
        Wish::create([
            'guest_id' => $guest1->id,
            'guest_name' => 'Rajesh & Sunita Sharma',
            'message' => 'Heartiest congratulations to the beautiful couple! May your journey ahead be blessed with immense love, joy, and laughter. Can’t wait to celebrate!',
            'is_approved' => true,
        ]);

        Wish::create([
            'guest_id' => null,
            'guest_name' => 'Uncle Arvind & Family',
            'message' => 'Wishing our sweet Pooja and Rahul a lifetime of companionship and happiness. Stay blessed always!',
            'is_approved' => true,
        ]);
    }
}
