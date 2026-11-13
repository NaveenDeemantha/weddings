<template>
    <Head :title="`${settings.wedding_title || 'Holy Matrimony'} - ${settings.groom_name} & ${settings.bride_name}`" />

    <div class="relative min-h-screen bg-[#f9f7f2] text-stone-800 font-sans selection:bg-[#f4e9c7] selection:text-stone-900 pb-28 md:pb-36 overflow-x-hidden">
        <!-- Floating Falling White Araliya & Jasmine Petals -->
        <PetalRain />

        <!-- Screen 1 & 2: Architectural Cathedral Door Entrance with 3D Open Animation (Responsive Desktop & Mobile) -->
        <CathedralDoorCover
            :guest-name="guest.name"
            :guest-greeting="guest.custom_greeting"
            :bride-name="settings.bride_name"
            :groom-name="settings.groom_name"
            @opened="onDoorsOpened"
        />

        <!-- Floating Music Player Button (Top Right Dark Navy Circle ♪) -->
        <MusicPlayer
            ref="musicPlayerRef"
            :music-url="settings.music_url"
        />

        <!-- Floating Dock Navigation (Mobile & Desktop with labels) -->
        <BottomFloatingDock />

        <!-- Preview Mode Banner (If in Preview) -->
        <div v-if="isPreview" class="bg-[#15253b] text-amber-100 text-xs py-2.5 px-4 text-center font-serif shadow-inner flex items-center justify-center gap-2">
            <span>✨ Previewing Invitation Mode</span>
            <Link :href="route('dashboard')" class="underline hover:text-white ml-2">
                Host Portal ↗
            </Link>
        </div>

        <!-- Master Invitation Card (Optimized Luxury Stationery Proportions) -->
        <main class="relative max-w-md sm:max-w-lg md:max-w-xl mx-auto px-3 sm:px-4 pt-4 sm:pt-8">
            <!-- The Elegant Off-White Wedding Card with Rounded Top & Subtle Gold Border -->
            <div class="relative bg-[#ffffff] rounded-3xl border border-[#d8b878]/70 shadow-2xl overflow-hidden card-deckled">
                <!-- 1. Master Header: Stained Glass Arch, Holy Matrimony, Names, Date, Cute Catholic Couple & Candelabras -->
                <MasterInvitationHeader
                    :bride-name="settings.bride_name"
                    :groom-name="settings.groom_name"
                    :bride-parents="settings.bride_parents"
                    :groom-parents="settings.groom_parents"
                />

                <!-- 2. Our Story & Journey Milestones Timeline & Countdown -->
                <OurStoryTimeline
                    :wedding-date="settings.wedding_date"
                />

                <!-- 3. Wedding Events (Registration, Nuptial Mass, Poruwa & Reception) -->
                <WeddingEventsList
                    :events="settings.events"
                />

                <!-- 4. Captured Moments Gallery & Calendar Banner -->
                <WeddingGallery
                    :wedding-date="settings.wedding_date"
                    :bride-name="settings.bride_name"
                    :groom-name="settings.groom_name"
                />

                <!-- 5. The Setting - Wedding Venue & Google Maps -->
                <VenueSection
                    :venue-name="settings.venue_name"
                    :venue-address="settings.venue_address"
                    :venue-map-url="settings.venue_map_url"
                />

                <!-- 6. Kindly Reply - RSVP Form -->
                <RsvpCard
                    :guest-slug="guest.slug"
                    :guest-name="guest.name"
                    :guest-greeting="guest.custom_greeting"
                    :guest-status="guest.status"
                    :attending-count="guest.attending_count"
                    :max-guests="guest.max_guests"
                    :is-preview="isPreview"
                />

                <!-- 7. Wishes & Blessings Guestbook -->
                <WishesGuestbook
                    :wishes="wishes"
                    :guest-slug="guest.slug"
                    :guest-name="guest.name"
                    :bride-name="settings.bride_name"
                    :groom-name="settings.groom_name"
                    :is-preview="isPreview"
                />

                <!-- 8. Midnight Navy Gothic Rose Window Footer (Screen 13) -->
                <NavySaveTheDateFooter
                    :bride-name="settings.bride_name"
                    :groom-name="settings.groom_name"
                    :venue-name="settings.venue_name"
                />
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PetalRain from '@/Components/Invitation/PetalRain.vue';
import CathedralDoorCover from '@/Components/Invitation/CathedralDoorCover.vue';
import MasterInvitationHeader from '@/Components/Invitation/MasterInvitationHeader.vue';
import OurStoryTimeline from '@/Components/Invitation/OurStoryTimeline.vue';
import WeddingEventsList from '@/Components/Invitation/WeddingEventsList.vue';
import WeddingGallery from '@/Components/Invitation/WeddingGallery.vue';
import VenueSection from '@/Components/Invitation/VenueSection.vue';
import RsvpCard from '@/Components/Invitation/RsvpCard.vue';
import WishesGuestbook from '@/Components/Invitation/WishesGuestbook.vue';
import NavySaveTheDateFooter from '@/Components/Invitation/NavySaveTheDateFooter.vue';
import BottomFloatingDock from '@/Components/Invitation/BottomFloatingDock.vue';
import MusicPlayer from '@/Components/Invitation/MusicPlayer.vue';

const props = defineProps({
    guest: { type: Object, required: true },
    settings: { type: Object, required: true },
    wishes: { type: Array, default: () => [] },
    isPreview: { type: Boolean, default: false },
});

const musicPlayerRef = ref(null);

const onDoorsOpened = () => {
    if (musicPlayerRef.value) {
        musicPlayerRef.value.playDirectly();
    }
};
</script>
