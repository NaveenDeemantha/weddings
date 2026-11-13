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
            'wedding_title' => 'required|string|max:200',
            'scripture_verse' => 'nullable|string|max:500',
            'church_name' => 'nullable|string|max:200',
            'church_address' => 'nullable|string|max:500',
            'church_time' => 'nullable|string|max:100',
            'venue_name' => 'required|string|max:200',
            'venue_address' => 'required|string|max:500',
            'venue_map_url' => 'required|url|max:500',
            'our_story' => 'required|string|max:2000',
            'music_url' => 'nullable|url|max:500',
            'whatsapp_template' => 'required|string|max:2000',
            'events' => 'required|array',
            'events.*.name' => 'required|string|max:100',
            'events.*.date' => 'required|string|max:50',
            'events.*.time' => 'required|string|max:50',
            'events.*.venue' => 'required|string|max:100',
            'events.*.dress_code' => 'nullable|string|max:100',
            'events.*.tag' => 'nullable|string|max:50',
        ]);

        foreach ($validated as $key => $value) {
            WeddingSetting::set($key, $value);
        }

        return back()->with('success', 'Wedding details and liturgy schedule successfully updated!');
    }
}
