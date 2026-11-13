<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\WeddingSetting;
use App\Models\Wish;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the main admin wedding command center.
     */
    public function index(): Response
    {
        $metrics = [
            'total_guests' => Guest::count(),
            'total_attending_people' => (int)Guest::where('status', 'attending')->sum('attending_count'),
            'attending_count' => Guest::where('status', 'attending')->count(),
            'declined_count' => Guest::where('status', 'declined')->count(),
            'pending_count' => Guest::where('status', 'pending')->count(),
            'opened_count' => Guest::whereNotNull('opened_at')->count(),
            'total_wishes' => Wish::count(),
        ];

        $recentRsvps = Guest::whereNotNull('rsvp_at')
            ->latest('rsvp_at')
            ->take(6)
            ->get();

        $recentWishes = Wish::latest()
            ->take(6)
            ->get();

        $settings = WeddingSetting::getAll();

        return Inertia::render('Dashboard', [
            'metrics' => $metrics,
            'recentRsvps' => $recentRsvps,
            'recentWishes' => $recentWishes,
            'settings' => $settings,
            'previewUrl' => route('invitation.preview'),
        ]);
    }
}
