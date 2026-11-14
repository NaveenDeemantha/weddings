<template>
    <div id="events" class="my-10 sm:my-14 scroll-mt-10 px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center mb-7">
            <p class="font-sans text-sm uppercase tracking-[0.25em] font-semibold text-gold-700">
                Celebrate With Us
            </p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#15253b] mt-1">
                Wedding Events
            </h2>
            <div class="my-2.5 text-gold-600 text-sm">✝</div>
        </div>

        <!-- Event Cards Stack (Matching Screenshot 9) -->
        <div class="max-w-md lg:max-w-6xl mx-auto space-y-4 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-6">
            <div
                v-for="(event, idx) in defaultEvents"
                :key="idx"
                class="p-5 sm:p-6 rounded-2xl bg-[#faf8f4] border border-[#d8b878]/70 shadow-sm text-center flex flex-col items-center hover:border-[#c5a059] transition-all"
            >
                <!-- Circular Dark Navy Badge with Gold Rim & Icon -->
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-[#15253b] border-2 border-[#d8b878] flex items-center justify-center text-amber-200 text-lg mb-3 shadow-md">
                    <!-- Icon 1: Registration Quill / Monogram -->
                    <svg v-if="idx === 0" class="w-6 h-6 text-amber-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <!-- Icon 2: Nuptial Mass Cathedral -->
                    <svg v-else-if="idx === 1" class="w-6 h-6 text-amber-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <!-- Icon 3: Reception Toast & Celebration -->
                    <svg v-else class="w-6 h-6 text-amber-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9V9a2 2 0 00-2-2H8a2 2 0 00-2 2v3h10z" />
                    </svg>
                </div>

                <!-- Event Title -->
                <h3 class="font-serif text-sm sm:text-base font-bold tracking-widest text-[#15253b] uppercase">
                    {{ event.name }}
                </h3>

                <!-- Date -->
                <div class="mt-2 text-sm font-serif text-stone-700 flex items-center justify-center gap-1.5 font-medium">
                    <span class="text-gold-700">📅</span>
                    <span>{{ event.date || '12th December 2026' }}</span>
                </div>

                <!-- Time -->
                <div class="mt-1 text-sm font-serif text-stone-700 flex items-center justify-center gap-1.5 font-medium">
                    <span class="text-gold-700">🕒</span>
                    <span>{{ event.time }}</span>
                </div>

                <!-- Venue -->
                <div class="mt-1 text-sm font-serif text-stone-700 flex items-center justify-center gap-1.5">
                    <span class="text-gold-700">📍</span>
                    <span>{{ event.venue }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    events: {
        type: Array,
        default: () => [],
    },
});

const defaultEvents = computed(() => {
    if (props.events && props.events.length > 0) {
        return props.events;
    }
    return [
        {
            name: 'Registration',
            date: '12th December 2026',
            time: '8:30 AM',
            venue: "St. Mary's Church, Negombo",
        },
        {
            name: 'Nuptial Mass',
            date: '12th December 2026',
            time: '9:00 AM',
            venue: "St. Mary's Church, Negombo",
        },
        {
            name: 'Poruwa Ceremony & Reception',
            date: '12th December 2026',
            time: '12:00 PM',
            venue: 'Negombo Grand Ballroom',
        },
    ];
});
</script>
