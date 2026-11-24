<?php

namespace App\Http\Controllers;

use App\Models\WeddingSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WeddingSettingController extends Controller
{
    /**
     * Show the wedding settings editor.
     */
    public function index(): Response
    {
        return Inertia::render('Settings/Index', [
            'settings' => WeddingSetting::getAll(),
        ]);
    }

    /**
     * Save updated wedding settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'bride_name' => 'required|string|max:100',
            'groom_name' => 'required|string|max:100',
            'bride_full_name' => 'nullable|string|max:200',
            'groom_full_name' => 'nullable|string|max:200',
            'bride_parents' => 'nullable|string|max:200',
            'groom_parents' => 'nullable|string|max:200',
            'wedding_date' => 'required|string',
            'wedding_title' => 'nullable|string|max:200',
            'scripture_verse' => 'nullable|string|max:500',
            'church_name' => 'nullable|string|max:200',
            'church_address' => 'nullable|string|max:500',
            'church_time' => 'nullable|string|max:100',
            'venue_name' => 'nullable|string|max:200',
            'venue_address' => 'nullable|string|max:500',
            'venue_map_url' => 'nullable|string|max:500',
            'rsvp_phone' => 'nullable|string|max:50',
            'our_story' => 'nullable|string|max:2000',
            'music_url' => 'nullable|string|max:500',
            'whatsapp_template' => 'nullable|string|max:3000',
            'whatsapp_template_si' => 'nullable|string|max:3000',
            'events' => 'nullable|array',
            'events.*.name' => 'nullable|string|max:100',
            'events.*.date' => 'nullable|string|max:50',
            'events.*.time' => 'nullable|string|max:50',
            'events.*.venue' => 'nullable|string|max:100',
            'events.*.dress_code' => 'nullable|string|max:100',
            'events.*.tag' => 'nullable|string|max:50',
        ]);

        // Synchronize Church Time & Church Name with the Mass event
        if (!empty($validated['events'])) {
            $massIndex = null;
            foreach ($validated['events'] as $idx => $ev) {
                $name = strtolower($ev['name'] ?? '');
                if (str_contains($name, 'mass') || str_contains($name, 'church') || str_contains($name, 'service')) {
                    $massIndex = $idx;
                    break;
                }
            }
            if ($massIndex === null && count($validated['events']) > 0) {
                $massIndex = 0;
            }

            if ($massIndex !== null) {
                $currentChurchTime = WeddingSetting::get('church_time');
                if (!empty($validated['church_time']) && $validated['church_time'] !== $currentChurchTime) {
                    $validated['events'][$massIndex]['time'] = $validated['church_time'];
                } elseif (!empty($validated['events'][$massIndex]['time'])) {
                    $validated['church_time'] = $validated['events'][$massIndex]['time'];
                }

                if (!empty($validated['church_name'])) {
                    $validated['events'][$massIndex]['venue'] = $validated['church_name'];
                }
            }
        }

        foreach ($validated as $key => $value) {
            WeddingSetting::set($key, $value);
        }

        return back()->with('success', 'Wedding details and liturgy schedule successfully updated!');
    }
}
