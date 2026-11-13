<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\WeddingSetting;
use App\Models\Wish;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InvitationController extends Controller
{
    /**
     * Show dedicated wedding invitation card for a specific guest.
     */
    public function show(string $slug): Response
    {
        $guest = Guest::where('slug', $slug)->firstOrFail();

        // Track when guest opened their invitation
        if (is_null($guest->opened_at)) {
            $guest->update(['opened_at' => now()]);
        }

        $settings = WeddingSetting::getAll();
        $wishes = Wish::where('is_approved', true)
            ->latest()
            ->take(20)
            ->get();

        return Inertia::render('Invitation/Show', [
            'guest' => $guest,
            'settings' => $settings,
            'wishes' => $wishes,
            'isPreview' => false,
        ]);
    }

    /**
     * Preview mode for host/admin testing.
     */
    public function preview(): Response
    {
        $mockGuest = new Guest([
            'id' => 0,
            'name' => 'Honored Guest & Family',
            'slug' => 'sample-preview',
            'phone' => '+919876543210',
            'custom_greeting' => 'Respected Guest & Beloved Family',
            'max_guests' => 3,
            'status' => 'pending',
            'attending_count' => 0,
            'dietary_notes' => null,
        ]);

        $settings = WeddingSetting::getAll();
        $wishes = Wish::where('is_approved', true)
            ->latest()
            ->take(20)
            ->get();

        return Inertia::render('Invitation/Show', [
            'guest' => $mockGuest,
            'settings' => $settings,
            'wishes' => $wishes,
            'isPreview' => true,
        ]);
    }

    /**
     * Submit RSVP.
     */
    public function rsvp(Request $request, string $slug)
    {
        $guest = Guest::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'status' => 'required|in:attending,declined',
            'attending_count' => 'required|integer|min:0|max:' . max(1, $guest->max_guests),
            'dietary_notes' => 'nullable|string|max:500',
        ]);

        $guest->update([
            'status' => $validated['status'],
            'attending_count' => $validated['status'] === 'attending' ? max(1, $validated['attending_count']) : 0,
            'dietary_notes' => $validated['dietary_notes'] ?? null,
            'rsvp_at' => now(),
        ]);

        return back()->with('success', 'Thank you! Your RSVP response has been joyfully recorded.');
    }

    /**
     * Leave a sweet wish in the guestbook.
     */
    public function wish(Request $request, string $slug)
    {
        $guest = Guest::where('slug', $slug)->first();

        $validated = $request->validate([
            'guest_name' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        Wish::create([
            'guest_id' => $guest?->id,
            'guest_name' => $validated['guest_name'],
            'message' => $validated['message'],
            'is_approved' => true,
        ]);

        return back()->with('success', 'Your heartwarming blessings have been posted to the couple’s guestbook!');
    }
}
