<template>
    <div class="w-full max-w-4xl mx-auto my-10 sm:my-14 px-2 sm:px-4">
        <div class="text-center mb-6 sm:mb-10">
            <div class="inline-flex items-center gap-1.5 text-gold-700 mb-1.5">
                <svg class="w-3 h-3 text-gold-500 fill-current" viewBox="0 0 24 24">
                    <path d="M10 2h4v6h6v4h-6v10h-4V12H4V8h6V2z" />
                </svg>
                <span class="font-sans text-[9px] sm:text-[10px] uppercase tracking-[0.2em] font-semibold">Venues &amp; Directions</span>
                <svg class="w-3 h-3 text-gold-500 fill-current" viewBox="0 0 24 24">
                    <path d="M10 2h4v6h6v4h-6v10h-4V12H4V8h6V2z" />
                </svg>
            </div>
            <h2 class="font-serif text-2xl sm:text-4xl text-stone-900 font-normal">
                Where We Celebrate
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <!-- Church Venue -->
            <div class="bg-[#ffffff] rounded-2xl p-5 sm:p-8 border border-[#d8ab43]/50 shadow-sm flex flex-col justify-between text-left">
                <div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#faf8f2] text-gold-800 text-[9px] sm:text-[10px] uppercase tracking-wider font-sans font-semibold mb-2">
                        Church Ceremony
                    </span>
                    <h3 class="font-serif text-xl sm:text-2xl font-semibold text-stone-900 mb-1.5 leading-snug">
                        {{ churchName }}
                    </h3>
                    <p class="text-xs text-stone-600 leading-relaxed mb-3">
                        {{ churchAddress }}
                    </p>
                    <p class="text-[11px] sm:text-xs text-gold-800 font-serif italic mb-5 leading-normal">
                        Service commences promptly at {{ churchTime }}. Guests are kindly requested to be seated by 3:00 PM.
                    </p>
                </div>

                <div class="pt-3 border-t border-stone-100 flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                    <a
                        :href="`https://maps.google.com/?q=${encodeURIComponent(churchName + ' ' + churchAddress)}`"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-full bg-[#ad2c51] hover:bg-[#8a2342] text-gold-50 font-serif text-xs tracking-wider transition-colors inline-flex items-center justify-center gap-1.5 active:scale-95"
                    >
                        <span>Maps Directions</span> ↗
                    </a>
                </div>
            </div>

            <!-- Reception Venue -->
            <div class="bg-[#ffffff] rounded-2xl p-5 sm:p-8 border border-[#d8ab43]/50 shadow-sm flex flex-col justify-between text-left">
                <div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#faf8f2] text-gold-800 text-[9px] sm:text-[10px] uppercase tracking-wider font-sans font-semibold mb-2">
                        Poruwa &amp; Reception
                    </span>
                    <h3 class="font-serif text-xl sm:text-2xl font-semibold text-stone-900 mb-1.5 leading-snug">
                        {{ venueName }}
                    </h3>
                    <p class="text-xs text-stone-600 leading-relaxed mb-3">
                        {{ venueAddress }}
                    </p>
                    <p class="text-[11px] sm:text-xs text-gold-800 font-serif italic mb-5 leading-normal">
                        Followed by Cocktails on the Jubilee Lawn, Dinner &amp; Dancing into the night.
                    </p>
                </div>

                <div class="pt-3 border-t border-stone-100 flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                    <a
                        :href="venueMapUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-full bg-[#ad2c51] hover:bg-[#8a2342] text-gold-50 font-serif text-xs tracking-wider transition-colors inline-flex items-center justify-center gap-1.5 active:scale-95"
                    >
                        <span>Maps Directions</span> ↗
                    </a>
                    <a
                        :href="googleCalendarLink"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full sm:w-auto px-4 py-2.5 rounded-full bg-[#faf8f2] hover:bg-[#f3ede1] text-stone-700 border border-[#d8ab43] font-serif text-xs text-center transition-colors active:scale-95"
                    >
                        Add to Calendar
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    churchName: { type: String, default: "St. Mary's Church" },
    churchAddress: { type: String, default: 'Nayakakanda, Hendala, Sri Lanka' },
    churchTime: { type: String, default: '03:30 PM' },
    venueName: { type: String, default: 'The Grand Ballroom, Galle Face Hotel' },
    venueAddress: { type: String, default: '2 Galle Road, Colombo 03, Sri Lanka' },
    venueMapUrl: { type: String, default: 'https://maps.google.com/?q=Galle+Face+Hotel+Colombo' },
    weddingDate: { type: String, default: '2026-12-19 15:30:00' },
    brideName: { type: String, default: 'Shenali' },
    groomName: { type: String, default: 'Dilan' },
});

const googleCalendarLink = computed(() => {
    try {
        const title = encodeURIComponent(`The Wedding of ${props.brideName} & ${props.groomName}`);
        const details = encodeURIComponent(`Holy Matrimony at ${props.churchName} followed by Poruwa & Reception at ${props.venueName}.`);
        const location = encodeURIComponent(`${props.churchName}, Sri Lanka`);
        return `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${title}&details=${details}&location=${location}`;
    } catch {
        return '#';
    }
});
</script>
