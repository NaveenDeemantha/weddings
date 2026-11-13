<template>
    <div id="events" class="my-10 sm:my-14 scroll-mt-10 px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center mb-7">
            <p class="font-sans text-[9px] uppercase tracking-[0.25em] font-semibold text-gold-700">
                Celebrate With Us
            </p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#15253b] mt-1">
                Wedding Events
            </h2>
            <div class="my-2.5 text-gold-600 text-xs">✝</div>
        </div>

        <!-- Event Cards Stack (Stacked cleanly matching screenshot 9) -->
        <div class="max-w-md mx-auto space-y-4">
            <div
                v-for="(event, idx) in events"
                :key="idx"
                class="p-5 sm:p-6 rounded-2xl bg-[#faf8f4] border border-[#d8b878]/70 shadow-sm text-center flex flex-col items-center hover:border-[#c5a059] transition-all"
            >
                <!-- Circular Icon Badge -->
                <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-full bg-[#15253b] border-2 border-[#d8b878] flex items-center justify-center text-amber-200 text-xl mb-3 shadow-sm">
                    <span v-if="idx === 0">✍️</span>
                    <span v-else-if="idx === 1">⛪</span>
                    <span v-else>🥂</span>
                </div>

                <!-- Event Name -->
                <h3 class="font-serif text-base sm:text-lg font-bold tracking-wider text-[#15253b] uppercase">
                    {{ event.name }}
                </h3>

                <!-- Date -->
                <div class="mt-2 text-xs font-serif text-stone-700 flex items-center justify-center gap-1.5 font-medium">
                    <span>📅</span>
                    <span>{{ event.date }}</span>
                </div>

                <!-- Time -->
                <div class="mt-1 text-xs font-serif text-stone-700 flex items-center justify-center gap-1.5 font-medium">
                    <span>🕒</span>
                    <span>{{ event.time }}</span>
                </div>

                <!-- Venue -->
                <div class="mt-1.5 text-xs font-serif text-stone-600 flex items-center justify-center gap-1.5">
                    <span class="text-gold-700">📍</span>
                    <span>{{ event.venue }}</span>
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
</script>

