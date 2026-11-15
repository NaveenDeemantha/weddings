<template>
    <div class="relative w-full bg-[#ad2c51] text-center pt-12 sm:pt-14 pb-20 sm:pb-24 px-4 overflow-hidden rounded-b-3xl">
        <FlowerCluster class="absolute bottom-0 left-0 w-40 sm:w-60 opacity-95" />
        <FlowerCluster class="absolute bottom-0 right-0 w-40 sm:w-60 -scale-x-100 opacity-95" />

        <div class="relative max-w-xs sm:max-w-sm mx-auto mb-4 flex flex-col items-center justify-center">
            <!-- Bespoke Floral Rose Medallion (Pure SVG, absolutely no baked-in photo text) -->
            <div class="relative w-64 h-64 sm:w-72 sm:h-72 rounded-full overflow-hidden border-2 border-[#d8ab43]/70 shadow-2xl flex items-center justify-center bg-gradient-to-br from-[#9c2447] via-[#ad2c51] to-[#6e1a34]">
                <!-- Delicate Geometric Rose Rosette in Gold Foil Vector SVG -->
                <svg class="absolute inset-0 w-full h-full opacity-35 pointer-events-none select-none" viewBox="0 0 200 200" fill="none">
                    <circle cx="100" cy="100" r="92" stroke="#f5dc8a" stroke-width="1.2" stroke-dasharray="3 3" />
                    <circle cx="100" cy="100" r="80" stroke="#e8c86d" stroke-width="1" />
                    <circle cx="100" cy="100" r="48" stroke="#f5dc8a" stroke-width="1" />
                    <circle cx="100" cy="100" r="28" stroke="#fff2bd" stroke-width="0.8" />
                    <g v-for="i in 12" :key="i" :transform="`rotate(${i * 30} 100 100)`">
                        <line x1="100" y1="8" x2="100" y2="192" stroke="#e8c86d" stroke-width="0.75" />
                        <ellipse cx="100" cy="38" rx="8" ry="16" stroke="#f5dc8a" stroke-width="0.75" fill="none" />
                    </g>
                </svg>

                <!-- Foreground Text Content: Dynamic Props Only -->
                <div class="relative z-10 flex flex-col items-center justify-center text-center px-4">
                    <p class="font-display text-xs sm:text-sm uppercase tracking-[0.35em] font-semibold text-pink-200">
                        SAVE THE DATE
                    </p>

                    <h3 class="font-serif text-3xl sm:text-4xl font-normal tracking-widest text-[#fff0f5] my-2 drop-shadow">
                        29 . 12 . 26
                    </h3>

                    <p class="font-serif italic text-sm text-pink-100/90 max-w-[210px] leading-relaxed">
                        Thank you for being part of our special day.
                    </p>

                    <!-- Delicate Heart -->
                    <div class="my-2 text-pink-200 text-sm">🤍</div>

                    <p class="font-serif text-xl sm:text-2xl font-semibold tracking-wide text-white">
                        {{ groomName }} <span class="font-script text-2xl text-pink-200 font-normal italic">&amp;</span> {{ brideName }}
                    </p>

                    <p class="text-xs sm:text-sm font-display uppercase tracking-[0.25em] font-semibold text-pink-200/90 mt-1">
                        {{ venueName }}
                    </p>
                </div>
            </div>
        </div>

        <p class="text-xs sm:text-sm text-pink-100/80 font-serif italic mt-4">
            With blessings and gratitude · {{ groomName }} &amp; {{ brideName }}
        </p>
    </div>
</template>

<script setup>
import FlowerCluster from '@/Components/Invitation/FlowerCluster.vue';

defineProps({
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
    venueName: { type: String, default: "St. Mary's Church" },
});
</script>
