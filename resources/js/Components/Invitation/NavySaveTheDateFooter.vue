<template>
    <div class="relative w-full bg-[#15253b] text-center pt-12 sm:pt-14 pb-20 sm:pb-24 px-4 overflow-hidden rounded-b-3xl">
        <!-- Circular Gothic Rose Window Backdrop (Matching Screenshot 13) -->
        <div class="relative max-w-xs mx-auto mb-4 flex flex-col items-center justify-center">
            <!-- Rose window background disc -->
            <div class="relative w-64 h-64 sm:w-72 sm:h-72 rounded-full overflow-hidden border border-[#d8b878]/30 shadow-2xl flex items-center justify-center">
                <img
                    src="/images/wedding/rose_window_circular.jpg"
                    alt="Rose Window"
                    class="absolute inset-0 w-full h-full object-cover opacity-35 mix-blend-screen pointer-events-none select-none"
                />
                <div class="absolute inset-0 bg-[#15253b]/70 backdrop-blur-[1px]"></div>

                <!-- Text Placed Inside Circular Motif -->
                <div class="relative z-10 flex flex-col items-center justify-center text-center px-4">
                    <p class="font-sans text-sm uppercase tracking-[0.3em] font-semibold text-gold-400">
                        Save The Date
                    </p>

                    <h3 class="font-serif text-3xl sm:text-4xl font-normal tracking-widest text-[#f5ede0] my-2">
                        12 . 12 . 26
                    </h3>

                    <p class="font-serif italic text-sm text-stone-300 max-w-[200px] leading-relaxed">
                        Thank you for being part of our special day.
                    </p>

                    <!-- Delicate Heart -->
                    <div class="my-2 text-gold-400 text-sm">🤍</div>

                    <p class="font-serif text-lg sm:text-xl font-normal tracking-wide text-amber-100">
                        {{ groomName }} <span class="font-script text-xl text-gold-400 italic">&amp;</span> {{ brideName }}
                    </p>

                    <p class="text-sm font-sans uppercase tracking-[0.2em] font-semibold text-gold-500 mt-1">
                        {{ venueName }}
                    </p>
                </div>
            </div>
        </div>

        <p class="text-sm text-stone-700 font-serif italic mt-3">
            With blessings and gratitude · Buddhima &amp; Shavindi
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
