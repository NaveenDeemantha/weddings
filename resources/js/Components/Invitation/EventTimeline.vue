<template>
    <div class="w-full max-w-4xl mx-auto my-12 px-4">
        <!-- Section Title with Gold Accents -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 text-amber-600 mb-2">
                <span class="text-amber-500">✦</span>
                <span class="font-serif text-xs uppercase tracking-widest font-semibold">Program & Itinerary</span>
                <span class="text-amber-500">✦</span>
            </div>
            <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-bold">
                Wedding Celebrations
            </h2>
            <div class="mt-3 flex items-center justify-center gap-3">
                <div class="h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent w-24"></div>
                <span class="text-amber-600 text-lg">𑁍</span>
                <div class="h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent w-24"></div>
            </div>
            <p class="mt-2 text-stone-600 font-serif italic text-sm">
                Each celebration is incomplete without your presence and blessings
            </p>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div
                v-for="(event, idx) in events"
                :key="idx"
                class="relative bg-gradient-to-br from-white via-amber-50/50 to-yellow-50/30 rounded-2xl p-6 sm:p-7 border border-amber-300/80 shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group"
            >
                <!-- Corner Motif -->
                <div class="absolute top-3 right-3 text-amber-400/40 text-xs font-serif select-none">
                    0{{ idx + 1 }}
                </div>

                <div class="flex items-start gap-4">
                    <!-- Event Icon Circle -->
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-amber-500 to-yellow-400 text-white flex items-center justify-center text-xl shadow-md shrink-0 group-hover:scale-110 transition-transform">
                        <span v-if="event.icon === 'sun' || idx === 0">🌼</span>
                        <span v-else-if="event.icon === 'music' || idx === 1">🪕</span>
                        <span v-else-if="event.icon === 'ring' || idx === 2">💍</span>
                        <span v-else>🥂</span>
                    </div>

                    <div class="flex-1">
                        <h3 class="font-serif text-lg sm:text-xl font-bold text-stone-900 group-hover:text-amber-800 transition-colors">
                            {{ event.name }}
                        </h3>

                        <!-- Date & Time Pills -->
                        <div class="mt-2 flex flex-wrap items-center gap-2 text-xs">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-amber-100 text-amber-900 font-medium">
                                📅 {{ event.date }}
                            </span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-amber-100 text-amber-900 font-medium">
                                ⏰ {{ event.time }}
                            </span>
                        </div>

                        <!-- Venue Details -->
                        <div class="mt-3 flex items-start gap-1.5 text-xs text-stone-700">
                            <span class="text-amber-600 mt-0.5">📍</span>
                            <span class="font-medium">{{ event.venue }}</span>
                        </div>

                        <!-- Dress Code -->
                        <div v-if="event.dress_code" class="mt-2.5 pt-2.5 border-t border-amber-200/60 flex items-center gap-1.5 text-xs text-amber-800">
                            <span class="font-semibold">Attire:</span>
                            <span class="italic text-stone-600">{{ event.dress_code }}</span>
                        </div>
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
</script>

