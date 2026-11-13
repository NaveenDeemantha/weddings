<?php

namespace Tests\Feature;

use App\Models\Guest;
use App\Models\User;
use App\Models\WeddingSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed default wedding settings
        foreach (WeddingSetting::getAll() as $k => $v) {
            WeddingSetting::set($k, $v);
        }
    }

    public function test_preview_page_is_accessible(): void
    {
        $response = $this->get('/preview');
        $response->assertStatus(200);
    }

    public function test_guest_invitation_page_can_be_viewed(): void
    {
        $guest = Guest::create([
            'name' => 'Amit Sharma & Family',
            'slug' => 'amit-sharma-family',
            'custom_greeting' => 'Dearest Amit & Family',
            'max_guests' => 3,
        ]);

        $response = $this->get("/invite/{$guest->slug}");
        $response->assertStatus(200);

        // Verify that opened_at was tracked
        $this->assertNotNull($guest->fresh()->opened_at);
    }

    public function test_guest_can_submit_rsvp(): void
    {
        $guest = Guest::create([
            'name' => 'Priya Sen',
            'slug' => 'priya-sen',
            'max_guests' => 2,
            'status' => 'pending',
        ]);

        $response = $this->post("/invite/{$guest->slug}/rsvp", [
            'status' => 'attending',
            'attending_count' => 2,
            'dietary_notes' => 'Vegetarian',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertEquals('attending', $guest->fresh()->status);
        $this->assertEquals(2, $guest->fresh()->attending_count);
        $this->assertEquals('Vegetarian', $guest->fresh()->dietary_notes);
        $this->assertNotNull($guest->fresh()->rsvp_at);
    }

    public function test_guest_can_leave_a_wish(): void
    {
        $guest = Guest::create([
            'name' => 'Vikram Seth',
            'slug' => 'vikram-seth',
        ]);

        $response = $this->post("/invite/{$guest->slug}/wish", [
            'guest_name' => 'Vikram Seth',
            'message' => 'Wishing both of you a wonderful married life!',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('wishes', [
            'guest_name' => 'Vikram Seth',
            'message' => 'Wishing both of you a wonderful married life!',
        ]);
    }

    public function test_admin_dashboard_requires_auth(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_host_can_access_dashboard_and_guests(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);

        $guestResponse = $this->actingAs($user)->get('/guests');
        $guestResponse->assertStatus(200);
    }
}

