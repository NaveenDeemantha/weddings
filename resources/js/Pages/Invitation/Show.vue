<template>
    <Head :title="`${settings.wedding_title || 'Wedding Invitation'} - ${settings.bride_name} & ${settings.groom_name}`" />

    <div class="relative min-h-screen bg-gradient-to-b from-[#fdfbf7] via-[#faf5e8] to-[#f7eed4] text-stone-800 font-sans selection:bg-amber-200 selection:text-amber-900 pb-20 overflow-x-hidden">
        <!-- Floating Falling Petals -->
        <PetalRain />

        <!-- Interactive Envelope Opening Overlay -->
        <WaxSealEnvelope
            :guest-name="guest.name"
            :guest-greeting="guest.custom_greeting"
            :max-guests="guest.max_guests"
            :bride-name="settings.bride_name"
            :groom-name="settings.groom_name"
            @opened="onEnvelopeOpened"
        />

        <!-- Background Wedding Music Player -->
        <MusicPlayer
            ref="musicPlayerRef"
            :music-url="settings.music_url"
        />

        <!-- Top Navigation Bar -->
        <nav class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-amber-200/60 shadow-sm px-4 py-3">
            <div class="max-w-5xl mx-auto flex items-center justify-between">
                <!-- Brand / Couple Monogram -->
                <a href="#hero" class="flex items-center gap-2 group">
                    <span class="w-8 h-8 rounded-full bg-gradient-to-tr from-amber-600 to-yellow-400 text-white flex items-center justify-center font-display text-sm font-bold shadow-sm">
                        {{ settings.bride_name ? settings.bride_name.charAt(0) : 'P' }}&{{ settings.groom_name ? settings.groom_name.charAt(0) : 'R' }}
                    </span>
                    <span class="font-serif font-bold text-stone-800 text-sm hidden sm:inline group-hover:text-amber-700 transition-colors">
                        {{ settings.bride_name }} & {{ settings.groom_name }}
                    </span>
                </a>

                <!-- Nav Links -->
                <div class="flex items-center gap-2 sm:gap-4 text-xs font-serif font-semibold text-stone-600">
                    <a href="#events" class="px-2.5 py-1 rounded-full hover:bg-amber-100/60 hover:text-amber-900 transition-colors">
                        Ceremonies
                    </a>
                    <a href="#venue" class="px-2.5 py-1 rounded-full hover:bg-amber-100/60 hover:text-amber-900 transition-colors">
                        Venue
                    </a>
                    <a href="#rsvp" class="px-3 py-1 rounded-full bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all transform active:scale-95">
                        RSVP
                    </a>
                    <a href="#wishes" class="px-2.5 py-1 rounded-full hover:bg-amber-100/60 hover:text-amber-900 transition-colors">
                        Wishes
                    </a>

                    <!-- Host Dashboard Link -->
                    <Link
                        v-if="$page.props.auth?.user"
                        :href="route('dashboard')"
                        class="ml-2 text-amber-700 underline hover:text-amber-900"
                    >
                        Host Dashboard
                    </Link>
                </div>
            </div>
        </nav>

        <!-- Preview Mode Banner (If in Preview) -->
        <div v-if="isPreview" class="bg-amber-500 text-white text-xs py-2 px-4 text-center font-medium shadow-inner flex items-center justify-center gap-2">
            <span>✨ You are viewing in Preview Mode!</span>
            <Link :href="route('dashboard')" class="underline font-bold hover:text-amber-100">
                Back to Admin Dashboard
            </Link>
        </div>

        <!-- Main Dedicated Invitation Card -->
        <main class="relative max-w-4xl mx-auto px-4 pt-6 sm:pt-10">
            <!-- Dedicated Invitation Card Container with Royal Gold Foil Border -->
            <div class="relative bg-white/95 rounded-3xl p-6 sm:p-12 border-2 border-amber-300 shadow-2xl overflow-hidden">
                <!-- Ornate Gold Foil Floral Corners -->
                <div class="absolute top-3 left-3 text-amber-400 select-none text-2xl">𑁍</div>
                <div class="absolute top-3 right-3 text-amber-400 select-none text-2xl">𑁍</div>
                <div class="absolute bottom-3 left-3 text-amber-400 select-none text-2xl">𑁍</div>
                <div class="absolute bottom-3 right-3 text-amber-400 select-none text-2xl">𑁍</div>

                <!-- Auspicious Vedic Invocation -->
                <div id="hero" class="text-center pt-2 pb-6">
                    <div class="inline-flex items-center gap-2 text-amber-700 mb-2">
                        <span class="text-amber-500">✦</span>
                        <span class="font-serif tracking-widest text-xs uppercase font-semibold">
                            Om Shree Ganeshay Namah
                        </span>
                        <span class="text-amber-500">✦</span>
                    </div>

                    <!-- Parents' Announcement -->
                    <p class="font-serif text-xs sm:text-sm text-stone-600 max-w-lg mx-auto leading-relaxed mt-2">
                        With the heavenly blessings of our elders and Almighty God,
                        <br class="hidden sm:inline" />
                        <span class="font-semibold text-stone-800">{{ settings.bride_parents }}</span>
                        &amp;
                        <span class="font-semibold text-stone-800">{{ settings.groom_parents }}</span>
                    </p>

                    <p class="font-script text-2xl sm:text-3xl text-amber-800 mt-3 font-normal">
                        cordially invite you to celebrate the wedding union of their beloved sister &amp; daughter
                    </p>
                </div>

                <!-- Cute Animated Couple Illustration Section -->
                <div class="my-4">
                    <CuteCartoonCouple
                        :bride-name="settings.bride_name"
                        :groom-name="settings.groom_name"
                    />
                </div>

                <!-- Couple Names in Gold Foil Headline -->
                <div class="text-center my-6">
                    <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-wide text-gold-foil drop-shadow-sm">
                        {{ settings.bride_name }}
                    </h1>
                    <div class="my-2 flex items-center justify-center gap-3">
                        <div class="h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent w-20 sm:w-32"></div>
                        <span class="font-script text-3xl sm:text-4xl text-amber-700">&amp;</span>
                        <div class="h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent w-20 sm:w-32"></div>
                    </div>
                    <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-wide text-gold-foil drop-shadow-sm">
                        {{ settings.groom_name }}
                    </h1>
                </div>

                <!-- Prominent Dedicated Guest Greeting Card -->
                <div class="my-8 max-w-xl mx-auto p-6 rounded-2xl bg-gradient-to-r from-amber-50 via-yellow-50 to-amber-50 border-2 border-amber-300 shadow-md text-center">
                    <p class="text-xs uppercase tracking-widest text-amber-700 font-bold mb-1">
                        Dedicated Invitation For
                    </p>
                    <h2 class="font-serif text-xl sm:text-3xl font-extrabold text-stone-900">
                        {{ guest.custom_greeting || guest.name }}
                    </h2>
                    <p class="text-xs sm:text-sm text-stone-600 mt-2 font-serif italic max-w-md mx-auto">
                        Your gracious presence and heartfelt blessings will make this sacred occasion truly unforgettable for our family.
                    </p>
                    <div class="mt-4 inline-flex items-center gap-2">
                        <a
                            href="#rsvp"
                            class="px-5 py-2 rounded-full bg-gradient-to-r from-amber-600 to-yellow-500 text-white text-xs font-semibold shadow hover:shadow-md transition-all transform active:scale-95"
                        >
                            Confirm Your Attendance
                        </a>
                    </div>
                </div>

                <!-- Live Countdown Timer -->
                <CountdownTimer :wedding-date="settings.wedding_date" />

                <!-- Our Love Story / Family Blessing Note -->
                <div class="my-10 max-w-2xl mx-auto text-center px-4">
                    <div class="inline-flex items-center gap-2 text-amber-600 mb-2">
                        <span class="text-amber-500">✦</span>
                        <span class="font-serif text-xs uppercase tracking-widest font-semibold">Our Journey</span>
                        <span class="text-amber-500">✦</span>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-stone-800 mb-3">
                        Two Souls, One Sacred Promise
                    </h3>
                    <p class="text-stone-600 font-serif italic text-sm sm:text-base leading-relaxed">
                        "{{ settings.our_story }}"
                    </p>
                </div>

                <!-- Ceremonies & Itinerary -->
                <div id="events">
                    <EventTimeline :events="settings.events" />
                </div>

                <!-- Venue & Directions -->
                <div id="venue">
                    <VenueCard
                        :venue-name="settings.venue_name"
                        :venue-address="settings.venue_address"
                        :venue-map-url="settings.venue_map_url"
                        :wedding-date="settings.wedding_date"
                        :bride-name="settings.bride_name"
                        :groom-name="settings.groom_name"
                    />
                </div>

                <!-- Interactive RSVP Section -->
                <RsvpSection
                    :guest-slug="guest.slug"
                    :guest-name="guest.name"
                    :guest-greeting="guest.custom_greeting"
                    :guest-status="guest.status"
                    :attending-count="guest.attending_count"
                    :max-guests="guest.max_guests"
                    :dietary-notes="guest.dietary_notes"
                    :is-preview="isPreview"
                />

                <!-- Wishes & Blessings Guestbook -->
                <WishesGuestbook
                    :wishes="wishes"
                    :guest-slug="guest.slug"
                    :guest-name="guest.name"
                    :bride-name="settings.bride_name"
                    :groom-name="settings.groom_name"
                    :is-preview="isPreview"
                />

                <!-- Traditional Family Sign-off -->
                <div class="mt-14 pt-8 border-t border-amber-200/80 text-center">
                    <p class="font-script text-3xl text-amber-800 font-normal">
                        With Warm Regards &amp; Love,
                    </p>
                    <p class="font-serif text-sm font-bold text-stone-800 mt-1 uppercase tracking-widest">
                        The Sharma &amp; Verma Families
                    </p>
                    <p class="text-xs text-stone-500 mt-2">
                        We eagerly look forward to welcoming you!
                    </p>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PetalRain from '@/Components/Invitation/PetalRain.vue';
import WaxSealEnvelope from '@/Components/Invitation/WaxSealEnvelope.vue';
import CuteCartoonCouple from '@/Components/Invitation/CuteCartoonCouple.vue';
import CountdownTimer from '@/Components/Invitation/CountdownTimer.vue';
import EventTimeline from '@/Components/Invitation/EventTimeline.vue';
import VenueCard from '@/Components/Invitation/VenueCard.vue';
import RsvpSection from '@/Components/Invitation/RsvpSection.vue';
import WishesGuestbook from '@/Components/Invitation/WishesGuestbook.vue';
import MusicPlayer from '@/Components/Invitation/MusicPlayer.vue';

const props = defineProps({
    guest: { type: Object, required: true },
    settings: { type: Object, required: true },
    wishes: { type: Array, default: () => [] },
    isPreview: { type: Boolean, default: false },
});

const musicPlayerRef = ref(null);

const onEnvelopeOpened = () => {
    // Attempt gentle music start once user interacted with wax seal
    if (musicPlayerRef.value) {
        musicPlayerRef.value.playDirectly();
    }
};
</script>

