<template>
    <div class="w-full max-w-3xl mx-auto my-12 px-4">
        <div class="relative bg-gradient-to-b from-amber-50 via-white to-amber-50 rounded-3xl p-8 sm:p-10 border-2 border-amber-300 shadow-xl text-center overflow-hidden">
            <!-- Background Mandala Glow -->
            <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full bg-amber-200/40 blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 rounded-full bg-yellow-200/40 blur-2xl pointer-events-none"></div>

            <div class="relative z-10">
                <!-- Venue Badge -->
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100/80 text-amber-900 text-xs font-serif uppercase tracking-widest font-semibold mb-3">
                    <span>🏛️</span> The Wedding Destination
                </div>

                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 mb-2">
                    {{ venueName }}
                </h2>

                <p class="text-stone-600 text-sm sm:text-base max-w-lg mx-auto mb-6 leading-relaxed">
                    {{ venueAddress }}
                </p>

                <!-- Action Buttons: Google Maps & Add to Calendar -->
                <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                    <!-- Google Maps Button -->
                    <a
                        :href="venueMapUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-amber-600 via-yellow-500 to-amber-700 text-white font-medium text-sm shadow-md hover:shadow-lg hover:from-amber-700 hover:to-amber-800 transition-all transform active:scale-95"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span>Open in Google Maps</span>
                    </a>

                    <!-- Copy Address Button -->
                    <button
                        type="button"
                        @click="copyAddress"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-white text-stone-700 border border-amber-300 font-medium text-sm shadow-sm hover:bg-amber-50 hover:border-amber-400 transition-all"
                    >
                        <span>{{ copied ? '✓ Address Copied!' : '📋 Copy Address' }}</span>
                    </button>

                    <!-- Add to Calendar Button -->
                    <a
                        :href="googleCalendarLink"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-white text-amber-800 border border-amber-300 font-medium text-sm shadow-sm hover:bg-amber-50 hover:border-amber-400 transition-all"
                    >
                        <span>📅 Add to Calendar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    venueName: { type: String, default: 'The Grand Palace Banquet' },
    venueAddress: { type: String, default: 'Palace Road, City Center' },
    venueMapUrl: { type: String, default: 'https://maps.google.com' },
    weddingDate: { type: String, default: '2026-12-18 10:30:00' },
    brideName: { type: String, default: 'Pooja' },
    groomName: { type: String, default: 'Rahul' },
});

const copied = ref(false);

const copyAddress = () => {
    navigator.clipboard.writeText(`${props.venueName}, ${props.venueAddress}`).then(() => {
        copied.value = true;
        setTimeout(() => (copied.value = false), 2500);
    });
};

const googleCalendarLink = computed(() => {
    try {
        const title = encodeURIComponent(`The Wedding of ${props.brideName} & ${props.groomName}`);
        const details = encodeURIComponent(`We cordially invite you to celebrate the wedding ceremony of ${props.brideName} & ${props.groomName}. Venue: ${props.venueName}, ${props.venueAddress}`);
        const location = encodeURIComponent(`${props.venueName}, ${props.venueAddress}`);
        // Format to YYYYMMDDTHHMMSSZ roughly
        const cleanDate = props.weddingDate.replace(/[- :]/g, '');
        return `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${title}&details=${details}&location=${location}`;
    } catch {
        return '#';
    }
});
</script>

