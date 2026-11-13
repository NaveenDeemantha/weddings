<template>
    <div class="w-full max-w-4xl mx-auto my-10 sm:my-14 px-2 sm:px-4">
        <!-- Section Title with Artisan Gold Accent -->
        <div class="text-center mb-8 sm:mb-12">
            <div class="inline-flex items-center gap-1.5 text-gold-700 mb-1.5">
                <span class="text-gold-500 text-xs">✝</span>
                <span class="font-sans text-[9px] sm:text-[10px] uppercase tracking-[0.2em] font-semibold">Liturgy &amp; Order of Events</span>
                <span class="text-gold-500 text-xs">✝</span>
            </div>
            <h2 class="font-serif text-2xl sm:text-4xl text-stone-900 font-normal">
                Order of Celebrations
            </h2>
            <div class="mt-2.5 flex items-center justify-center gap-2.5">
                <div class="h-px bg-gradient-to-r from-transparent via-[#d8b878] to-transparent w-20 sm:w-24"></div>
                <span class="text-gold-600 text-xs sm:text-sm">❦</span>
                <div class="h-px bg-gradient-to-r from-transparent via-[#d8b878] to-transparent w-20 sm:w-24"></div>
            </div>
            <p class="mt-1.5 text-stone-600 font-serif italic text-xs sm:text-sm">
                Saturday, 19th December 2026 • Colombo, Sri Lanka
            </p>
        </div>

        <!-- Events List with Haute Editorial Design -->
        <div class="space-y-4 sm:space-y-6">
            <div
                v-for="(event, idx) in events"
                :key="idx"
                class="relative bg-[#ffffff] rounded-2xl p-5 sm:p-8 border border-[#d8b878]/60 shadow-sm hover:border-[#c5a059] transition-all duration-300"
            >
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 sm:gap-4">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <!-- Roman Numeral Pill -->
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-[#faf8f4] border border-[#d8b878] text-gold-800 flex items-center justify-center font-serif font-bold text-xs sm:text-sm shrink-0 mt-0.5">
                            {{ toRoman(idx + 1) }}
                        </div>

                        <div>
                            <div class="inline-block px-2 py-0.5 rounded-full bg-[#f6f2e8] text-gold-800 text-[9px] sm:text-[10px] uppercase tracking-wider font-sans font-semibold mb-1">
                                {{ event.tag || (idx === 0 ? 'Sacred Service' : (idx === 1 ? 'Traditional Blessing' : 'Reception & Dance')) }}
                            </div>

                            <h3 class="font-serif text-lg sm:text-2xl font-semibold text-stone-900 leading-snug">
                                {{ event.name }}
                            </h3>

                            <!-- Venue & Address -->
                            <p class="mt-1.5 text-xs sm:text-sm text-stone-700 flex items-center gap-1.5 font-medium">
                                <span class="text-gold-600">📍</span>
                                <span>{{ event.venue }}</span>
                            </p>

                            <!-- Dress Code -->
                            <p v-if="event.dress_code" class="mt-1 text-[11px] sm:text-xs text-stone-500 font-serif italic">
                                Recommended Attire: <span class="text-stone-700 not-italic font-medium">{{ event.dress_code }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Date & Time Column -->
                    <div class="sm:text-right shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-stone-100 pl-11 sm:pl-0">
                        <span class="block font-serif text-xs sm:text-sm font-semibold text-stone-900">
                            {{ event.time }}
                        </span>
                        <span class="block text-[11px] sm:text-xs text-stone-500 mt-0.5">
                            {{ event.date }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    events: {
        type: Array,
        default: () => [],
    },
});

const toRoman = (num) => {
    const romans = ['I', 'II', 'III', 'IV', 'V'];
    return romans[num - 1] || `${num}`;
};
</script>
