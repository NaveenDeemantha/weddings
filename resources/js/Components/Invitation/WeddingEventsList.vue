<template>
    <div id="events" class="my-10 sm:my-14 scroll-mt-10 px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center mb-8">
            <p class="font-sans text-sm sm:text-base uppercase tracking-[0.3em] font-bold text-gold-700">
                {{ t('events', 'celebrateWithUs') }}
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-[#ad2c51] mt-1.5 tracking-wide">
                {{ t('events', 'weddingEvents') }}
            </h2>
            <FlowerDivider />
        </div>

        <!-- Event Cards Stack (Centered flex container responsive to any count of events) -->
        <div class="max-w-md lg:max-w-5xl mx-auto flex flex-col sm:flex-row flex-wrap items-stretch justify-center gap-6">
            <div
                v-for="(event, idx) in defaultEvents"
                :key="idx"
                class="w-full sm:w-[22rem] lg:w-[26rem] p-6 sm:p-8 rounded-2xl bg-[#faf8f2] border-2 border-[#d8ab43]/50 shadow-sm text-center flex flex-col items-center justify-between hover:border-[#d8ab43] transition-all hover:-translate-y-2 hover:shadow-[0_18px_40px_-12px_rgba(216,171,67,.3)] duration-500 group cursor-pointer"
            >
                <!-- Circular Dark Burgundy Badge with Gold Rim & Icon -->
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-[#ad2c51] border-2 border-[#d8ab43] flex items-center justify-center text-gold-200 text-lg mb-4 shadow-md group-hover:rotate-[360deg] group-hover:scale-110 transition-transform duration-700">
                    <!-- Church / Wedding Mass Icon -->
                    <svg v-if="getEventIcon(event.name, idx) === 'church'" class="w-7 h-7 text-gold-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <!-- Reception / Celebration / Toast Icon -->
                    <svg v-else-if="getEventIcon(event.name, idx) === 'celebration'" class="w-7 h-7 text-gold-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9V9a2 2 0 00-2-2H8a2 2 0 00-2 2v3h10z" />
                    </svg>
                    <!-- Registration Quill / Monogram Icon -->
                    <svg v-else class="w-7 h-7 text-gold-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>

                <!-- Event Title (Enlarged, Bold Burgundy) -->
                <h3 class="font-serif text-xl sm:text-2xl font-bold tracking-[0.14em] text-[#ad2c51] uppercase mb-1">
                    {{ getDisplayEventName(event, idx) }}
                </h3>

                <!-- Date (Enlarged, Bold Black) -->
                <div class="mt-2.5 text-base sm:text-lg font-serif text-stone-950 flex items-center justify-center gap-2 font-bold">
                    <svg class="w-5 h-5 text-gold-700 fill-none stroke-current shrink-0" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    <span>{{ getDisplayEventDate(event) }}</span>
                </div>

                <!-- Time (Enlarged, Bold Black) -->
                <div class="mt-1.5 text-base sm:text-lg font-serif text-stone-950 flex items-center justify-center gap-2 font-bold">
                    <svg class="w-5 h-5 text-gold-700 fill-none stroke-current shrink-0" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    <span>{{ getDisplayEventTime(event) }}</span>
                </div>

                <!-- Venue (Enlarged, Bold Black) -->
                <div class="mt-1.5 text-base sm:text-lg font-serif text-stone-950 flex items-center justify-center gap-2 font-semibold">
                    <svg class="w-5 h-5 text-gold-700 fill-none stroke-current shrink-0" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <span>{{ getDisplayEventVenue(event) }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import FlowerDivider from '@/Components/Invitation/FlowerDivider.vue';
import { computed } from 'vue';
import { useLanguage } from '@/composables/useLanguage';

const { t, isSinhala } = useLanguage();

const props = defineProps({
    events: {
        type: Array,
        default: () => [],
    },
});

const getDisplayEventName = (event, idx) => {
    if (!isSinhala.value) return event.name;
    const lower = (event.name || '').toLowerCase();
    if (lower.includes('mass') || lower.includes('church') || idx === 0) {
        return t('events', 'weddingMass');
    }
    if (lower.includes('reception') || idx === 1) {
        return t('events', 'reception');
    }
    return event.name;
};

const getDisplayEventDate = (event) => {
    if (!isSinhala.value) return event.date || '29th December 2026';
    return t('events', 'massDate');
};

const getDisplayEventTime = (event) => {
    if (!isSinhala.value) return event.time;
    const lower = (event.name || '').toLowerCase();
    if (lower.includes('reception')) {
        return t('events', 'receptionTime');
    }
    return t('events', 'massTime');
};

const getDisplayEventVenue = (event) => {
    if (!isSinhala.value) return event.venue;
    const lower = (event.venue || event.name || '').toLowerCase();
    if (lower.includes('vinrich') || lower.includes('reception')) {
        return t('events', 'receptionVenue');
    }
    return t('events', 'massVenue');
};

const getEventIcon = (name = '', idx = 0) => {
    const lower = (name || '').toLowerCase();
    if (lower.includes('church') || lower.includes('mass') || lower.includes('cathedral') || lower.includes('nuptial') || lower.includes('blessing') || lower.includes('ceremony')) {
        return 'church';
    }
    if (lower.includes('reception') || lower.includes('toast') || lower.includes('party') || lower.includes('dinner') || lower.includes('celebrat') || lower.includes('resort')) {
        return 'celebration';
    }
    if (lower.includes('register') || lower.includes('quill') || lower.includes('sign')) {
        return 'registration';
    }
    return idx === 0 ? 'church' : (idx === 1 ? 'celebration' : 'registration');
};

const defaultEvents = computed(() => {
    if (props.events && props.events.length > 0) {
        return props.events;
    }
    return [
        {
            name: 'Registration',
            date: '29th December 2026',
            time: '8:30 AM',
            venue: "St. Mary's Church, Moratuwa",
        },
        {
            name: 'Wedding Mass',
            date: '29th December 2026',
            time: '9:00 AM',
            venue: "St. Mary's Church, Moratuwa",
        },
        {
            name: 'Poruwa Ceremony & Reception',
            date: '29th December 2026',
            time: '12:00 PM',
            venue: 'Moratuwa, Sri Lanka',
        },
    ];
});
</script>
