<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GuestController extends Controller
{
    /**
     * Display a listing of wedding guests with search, filters & metrics.
     */
    public function index(Request $request): Response
    {
        $query = Guest::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('custom_greeting', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        $guests = $query->latest()->paginate(15)->withQueryString();

        $metrics = [
            'total_guests' => Guest::count(),
            'total_attending_people' => (int)Guest::where('status', 'attending')->sum('attending_count'),
            'attending_count' => Guest::where('status', 'attending')->count(),
            'declined_count' => Guest::where('status', 'declined')->count(),
            'pending_count' => Guest::where('status', 'pending')->count(),
            'opened_count' => Guest::whereNotNull('opened_at')->count(),
        ];

        return Inertia::render('Guests/Index', [
            'guests' => $guests,
            'filters' => $request->only(['search', 'status']),
            'metrics' => $metrics,
        ]);
    }

    /**
     * Store a newly created guest.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'custom_greeting' => 'nullable|string|max:255',
            'max_guests' => 'required|integer|min:1|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        Guest::create($validated);

        return back()->with('success', 'Guest invitation generated successfully!');
    }

    /**
     * Bulk store guests from multiline input.
     */
    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'raw_list' => 'required|string',
            'default_max_guests' => 'nullable|integer|min:1|max:10',
        ]);

        $lines = preg_split('/\r\n|\r|\n/', trim($validated['raw_list']));
        $defaultMax = $validated['default_max_guests'] ?? 2;
        $created = 0;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            $parts = array_map('trim', explode(',', $line));
            $name = $parts[0] ?? '';
            $phone = $parts[1] ?? null;
            $maxGuests = isset($parts[2]) && is_numeric($parts[2]) ? (int)$parts[2] : $defaultMax;

            if (!empty($name)) {
                Guest::create([
                    'name' => $name,
                    'phone' => $phone,
                    'custom_greeting' => $name,
                    'max_guests' => $maxGuests,
                ]);
                $created++;
            }
        }

        return back()->with('success', "{$created} guests added with personal invitation links!");
    }

    /**
     * Update the specified guest.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'custom_greeting' => 'nullable|string|max:255',
            'max_guests' => 'required|integer|min:1|max:20',
            'status' => 'required|in:pending,attending,declined',
            'attending_count' => 'required|integer|min:0',
            'dietary_notes' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        $guest->update($validated);

        return back()->with('success', 'Guest details updated successfully!');
    }

    /**
     * Remove the specified guest.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return back()->with('success', 'Guest deleted successfully.');
    }
}
