<template>
    <div class="relative w-full bg-[#15253b] text-center pt-12 sm:pt-14 pb-20 sm:pb-24 px-4 overflow-hidden rounded-b-3xl">
        <!-- Circular Gothic Rose Window Illustration Backdrop -->
        <div class="relative max-w-xs mx-auto mb-6 flex flex-col items-center justify-center">
            <!-- Subtle Radial Stained Glass SVG -->
            <svg class="w-56 h-56 sm:w-64 sm:h-64 text-gold-500/20 drop-shadow-sm select-none" viewBox="0 0 200 200" fill="none">
                <circle cx="100" cy="100" r="92" stroke="#d8b878" stroke-width="1.2" stroke-opacity="0.35" />
                <circle cx="100" cy="100" r="82" stroke="#d8b878" stroke-width="0.8" stroke-dasharray="2 3" stroke-opacity="0.3" />
                <circle cx="100" cy="100" r="42" stroke="#d8b878" stroke-width="1" stroke-opacity="0.4" />
                <!-- Radiating Petals -->
                <line x1="100" y1="18" x2="100" y2="182" stroke="#d8b878" stroke-width="0.8" stroke-opacity="0.25" />
                <line x1="18" y1="100" x2="182" y2="100" stroke="#d8b878" stroke-width="0.8" stroke-opacity="0.25" />
                <line x1="42" y1="42" x2="158" y2="158" stroke="#d8b878" stroke-width="0.8" stroke-opacity="0.25" />
                <line x1="158" y1="42" x2="42" y2="158" stroke="#d8b878" stroke-width="0.8" stroke-opacity="0.25" />
            </svg>

            <!-- Text Placed Inside Circular Motif -->
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
                <p class="font-sans text-[9px] uppercase tracking-[0.3em] font-semibold text-gold-400">
                    Save The Date
                </p>

                <h3 class="font-serif text-3xl sm:text-4xl font-normal tracking-widest text-[#f5ede0] my-2">
                    12 . 12 . 26
                </h3>

                <p class="font-serif italic text-xs text-stone-300 max-w-[200px] leading-relaxed">
                    Thank you for being part of our special day.
                </p>

                <div class="my-2.5 text-gold-400 text-xs">🤍</div>

                <p class="font-serif text-lg sm:text-xl font-normal tracking-wide text-amber-100">
                    {{ groomName }} <span class="font-script text-xl text-gold-400 italic">&amp;</span> {{ brideName }}
                </p>

                <p class="text-[9px] font-sans uppercase tracking-[0.2em] font-semibold text-gold-500 mt-1">
                    {{ venueName }}
                </p>
            </div>
        </div>

        <p class="text-[10px] text-stone-400 font-serif italic mt-4">
            Made with love for our beloved families &amp; friends
        </p>
    </div>
</template>

<script setup>
defineProps({
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
    venueName: { type: String, default: "St. Mary's Church" },
});
</script>

