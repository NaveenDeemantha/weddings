<template>
    <Head :title="`${settings.wedding_title || 'Holy Matrimony'} - ${settings.groom_name} & ${settings.bride_name}`" />

    <div class="relative min-h-screen bg-gradient-to-b from-[#faf8f5] via-[#f7f4ed] to-[#f2ece1] text-stone-800 font-sans selection:bg-[#f5dc8a]/60 selection:text-stone-900 pb-28 md:pb-36 overflow-x-hidden">
        <!-- Floating Falling White Araliya & Jasmine Petals -->
        <PetalRain />
        <SideVines />
        <ClickBurst />

        <!-- Screen 1 & 2: Architectural Cathedral Door Entrance with 3D Open Animation (Responsive Desktop & Mobile) -->
        <CathedralDoorCover
            :guest-name="guest.name"
            :guest-greeting="guest.custom_greeting"
            :bride-name="settings.bride_name"
            :groom-name="settings.groom_name"
            :church-name="settings.church_name"
            :church-address="settings.church_address"
            :wedding-date="settings.wedding_date"
            @opened="onDoorsOpened"
        />

        <!-- Floating Music Player Button (Top Right Dark Navy Circle) -->
        <MusicPlayer
            ref="musicPlayerRef"
            :music-url="settings.music_url"
        />

        <!-- Floating Dock Navigation (Mobile & Desktop with labels) -->
        <BottomFloatingDock />

        <!-- Preview Mode Banner (If in Preview) -->
        <div v-if="isPreview" class="bg-[#ad2c51] text-gold-100 text-xs py-2 px-4 text-center font-serif shadow-inner flex flex-wrap items-center justify-center gap-3">
            <span class="inline-flex items-center gap-1.5 font-sans font-medium tracking-wide">
                <svg class="w-3.5 h-3.5 fill-current text-gold-200" viewBox="0 0 24 24">
                    <path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z" />
                </svg>
                Previewing Invitation For: <strong class="text-white uppercase tracking-wider underline decoration-gold-300 ml-1">{{ guest.custom_greeting || guest.name }}</strong>
            </span>
            <Link :href="route('invitation.print')" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 hover:bg-white/30 text-white font-sans text-[11px] font-semibold transition-colors">
                <svg class="w-3.5 h-3.5 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
                <span>Print Wedding Card</span>
            </Link>
            <Link :href="route('dashboard')" class="underline hover:text-white text-[11px] font-sans">
                Host Portal ↗
            </Link>
        </div>

        <!-- Master Invitation Card (Optimized Luxury Stationery Proportions) -->
        <main class="relative max-w-7xl mx-auto px-3 sm:px-6 lg:px-10 pt-2 sm:pt-4">
            <!-- The Elegant Off-White Wedding Card with Rounded Top & Subtle Gold Border -->
            <div ref="cardRef" class="relative bg-[#ffffff] rounded-3xl border border-[#d8ab43]/50 shadow-2xl overflow-hidden card-deckled">
                <!-- 1. Master Header: Stained Glass Arch, Holy Matrimony, Names, Date, Cute Catholic Couple & Candelabras -->
                <MasterInvitationHeader
                    :guest-name="guest.name"
                    :guest-greeting="guest.custom_greeting"
                    :bride-name="settings.bride_name"
                    :groom-name="settings.groom_name"
                    :bride-parents="settings.bride_parents"
                    :groom-parents="settings.groom_parents"
                />

                <!-- 2. Wedding Events (Registration, Nuptial Mass, Poruwa & Reception) -->
                <FloralSection side="both">
                    <WeddingEventsList
                        :events="settings.events"
                    />
                </FloralSection>

                <!-- 3. The Setting - Wedding Venue & Google Maps -->
                <FloralSection side="left">
                    <VenueSection
                        :venue-name="settings.venue_name"
                        :venue-address="settings.venue_address"
                        :venue-map-url="settings.venue_map_url"
                    />
                </FloralSection>

                <!-- 4. Kindly Reply - RSVP Form -->
                <FloralSection side="right" top>
                    <RsvpCard
                        :guest-slug="guest.slug"
                        :guest-name="guest.name"
                        :guest-greeting="guest.custom_greeting"
                        :guest-status="guest.status"
                        :attending-count="guest.attending_count"
                        :max-guests="guest.max_guests"
                        :is-preview="isPreview"
                    />
                </FloralSection>

                <!-- 5. Midnight Navy Gothic Rose Window Footer -->
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
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import FloralSection from '@/Components/Invitation/FloralSection.vue';
import SideVines from '@/Components/Invitation/SideVines.vue';
import ClickBurst from '@/Components/Invitation/ClickBurst.vue';
import PetalRain from '@/Components/Invitation/PetalRain.vue';
import CathedralDoorCover from '@/Components/Invitation/CathedralDoorCover.vue';
import MasterInvitationHeader from '@/Components/Invitation/MasterInvitationHeader.vue';
import WeddingEventsList from '@/Components/Invitation/WeddingEventsList.vue';
import VenueSection from '@/Components/Invitation/VenueSection.vue';
import RsvpCard from '@/Components/Invitation/RsvpCard.vue';
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
const cardRef = ref(null);

onMounted(() => {
    const els = Array.from(cardRef.value?.children || []).slice(1, -1);
    els.forEach((el) => el.classList.add('reveal'));
    const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('reveal-in'); io.unobserve(e.target); } });
    }, { threshold: 0.12 });
    els.forEach((el) => io.observe(el));
});

const onDoorsOpened = () => {
    if (musicPlayerRef.value) {
        musicPlayerRef.value.playDirectly();
    }
};
</script>
