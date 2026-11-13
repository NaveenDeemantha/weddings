<template>
    <div id="hero" class="relative text-center pt-6 sm:pt-8 pb-8 px-4 sm:px-6">
        <!-- Top Gothic Stained Glass Window Arch Motif (Authentic Leaded Rose Window) -->
        <div class="relative w-full max-w-[280px] sm:max-w-xs mx-auto mb-5 overflow-hidden flex justify-center">
            <svg class="w-full h-auto drop-shadow-sm select-none" viewBox="0 0 300 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Outer Arch Frame -->
                <path d="M 15 150 A 135 135 0 0 1 285 150 Z" fill="#faf6ee" stroke="#c5a059" stroke-width="2.5" />
                <path d="M 28 150 A 122 122 0 0 1 272 150 Z" fill="#f5ede0" stroke="#d8b878" stroke-width="1.5" />

                <!-- Radiating Stained Glass Segments with Soft Cathedral Colors -->
                <!-- Segment 1 (Leftmost) -->
                <path d="M 28 150 L 115 150 A 35 35 0 0 1 123 125 L 52 75 A 122 122 0 0 0 28 150 Z" fill="#4a6585" fill-opacity="0.35" stroke="#68563c" stroke-width="1.5" />
                <!-- Segment 2 -->
                <path d="M 52 75 L 123 125 A 35 35 0 0 1 138 116 L 95 38 A 122 122 0 0 0 52 75 Z" fill="#d4a359" fill-opacity="0.35" stroke="#68563c" stroke-width="1.5" />
                <!-- Segment 3 -->
                <path d="M 95 38 L 138 116 A 35 35 0 0 1 150 115 L 150 28 A 122 122 0 0 0 95 38 Z" fill="#6d8a77" fill-opacity="0.35" stroke="#68563c" stroke-width="1.5" />
                <!-- Segment 4 (Center Right) -->
                <path d="M 150 28 L 150 115 A 35 35 0 0 1 162 116 L 205 38 A 122 122 0 0 0 150 28 Z" fill="#6d8a77" fill-opacity="0.35" stroke="#68563c" stroke-width="1.5" />
                <!-- Segment 5 -->
                <path d="M 205 38 L 162 116 A 35 35 0 0 1 177 125 L 248 75 A 122 122 0 0 0 205 38 Z" fill="#d4a359" fill-opacity="0.35" stroke="#68563c" stroke-width="1.5" />
                <!-- Segment 6 (Rightmost) -->
                <path d="M 248 75 L 177 125 A 35 35 0 0 1 185 150 L 272 150 A 122 122 0 0 0 248 75 Z" fill="#4a6585" fill-opacity="0.35" stroke="#68563c" stroke-width="1.5" />

                <!-- Intermediate Decorative Traceries (Quatrefoil arcs) -->
                <path d="M 45 150 A 105 105 0 0 1 255 150" stroke="#c5a059" stroke-width="1.2" stroke-dasharray="3 3" />

                <!-- Center Hub Ring & Golden Cross -->
                <circle cx="150" cy="150" r="35" fill="#fcf9f2" stroke="#c5a059" stroke-width="2" />
                <circle cx="150" cy="150" r="24" fill="#ebd6b0" stroke="#8c6d37" stroke-width="1.2" />

                <!-- Altar Cross in Hub -->
                <line x1="150" y1="128" x2="150" y2="148" stroke="#5a3d1c" stroke-width="3" stroke-linecap="round" />
                <line x1="140" y1="136" x2="160" y2="136" stroke="#5a3d1c" stroke-width="2.5" stroke-linecap="round" />

                <!-- Bottom Horizontal Lead Border Line -->
                <line x1="15" y1="150" x2="285" y2="150" stroke="#c5a059" stroke-width="2" />
            </svg>
        </div>

        <!-- HOLY MATRIMONY Title -->
        <h2 class="font-serif text-2xl sm:text-3xl font-bold tracking-[0.22em] text-[#15253b] uppercase leading-tight">
            Holy Matrimony
        </h2>

        <!-- Subtitle -->
        <p class="font-sans text-[10px] sm:text-[11px] uppercase tracking-[0.25em] font-semibold text-gold-700 mt-2.5">
            You Are Invited To The Wedding Of
        </p>

        <!-- Delicate Gold Hairline with Center Latin Cross -->
        <div class="flex items-center justify-center gap-3 my-3">
            <div class="w-12 h-px bg-gradient-to-r from-transparent to-[#c5a059]/70"></div>
            <span class="text-gold-600 text-xs">✝</span>
            <div class="w-12 h-px bg-gradient-to-l from-transparent to-[#c5a059]/70"></div>
        </div>

        <!-- Couple Names -->
        <h1 class="font-serif text-3xl sm:text-4xl text-[#15253b] tracking-wide font-normal leading-tight">
            {{ groomName }} <span class="font-script text-3xl sm:text-4xl text-gold-700 italic font-normal">&amp;</span> {{ brideName }}
        </h1>

        <!-- Parents Row -->
        <div class="my-5 max-w-sm sm:max-w-md mx-auto grid grid-cols-2 gap-3 text-xs font-serif text-stone-600 px-2">
            <div class="border-r border-stone-200/80 pr-3">
                <span class="block text-[9px] sm:text-[10px] uppercase tracking-wider font-sans font-semibold text-stone-400 mb-0.5">Son of</span>
                <span class="font-medium text-stone-800 text-xs sm:text-sm">{{ groomParents }}</span>
            </div>
            <div class="pl-3">
                <span class="block text-[9px] sm:text-[10px] uppercase tracking-wider font-sans font-semibold text-stone-400 mb-0.5">Daughter of</span>
                <span class="font-medium text-stone-800 text-xs sm:text-sm">{{ brideParents }}</span>
            </div>
        </div>

        <!-- The Iconic Horizontal Lines Date Display -->
        <div class="my-6 max-w-[280px] sm:max-w-xs mx-auto flex items-center justify-center gap-3">
            <div class="flex-1 text-center border-t border-b border-stone-300 py-1.5">
                <span class="font-serif text-xs uppercase tracking-widest font-semibold text-stone-800">
                    December
                </span>
            </div>
            <div class="px-2">
                <span class="font-serif text-4xl sm:text-5xl font-bold text-[#15253b] leading-none">
                    12
                </span>
            </div>
            <div class="flex-1 text-center border-t border-b border-stone-300 py-1.5">
                <span class="font-serif text-xs uppercase tracking-widest font-semibold text-stone-800">
                    2026
                </span>
            </div>
        </div>

        <!-- Gold Cross -->
        <div class="my-2.5 text-gold-600 text-xs">✝</div>

        <!-- Scripture Quote -->
        <p class="font-serif italic text-xs sm:text-sm text-stone-600 max-w-sm sm:max-w-md mx-auto leading-relaxed px-4">
            "Therefore what God has joined together, let no one separate."
        </p>

        <!-- Centerpiece: Cute Catholic Bride & Groom Animated Vector Figure -->
        <div class="relative my-7 max-w-xs sm:max-w-sm mx-auto px-2">
            <!-- Arch Card Frame -->
            <div class="relative overflow-hidden rounded-t-[100px] rounded-b-2xl border-2 border-[#d8b878]/70 shadow-lg bg-[#ffffff] pt-5 pb-3">
                <CuteCatholicCouple
                    :bride-name="brideName"
                    :groom-name="groomName"
                />
            </div>

            <!-- Floral Candelabra Base Illustration -->
            <div class="flex items-center justify-between -mt-3 px-3 text-gold-700 pointer-events-none">
                <!-- Left Floral Candelabra -->
                <div class="text-xs font-serif flex items-center gap-1.5 opacity-90">
                    <span>🕯️</span>
                    <span class="text-[9px] text-stone-500 font-sans tracking-wider uppercase font-semibold">White Lilies</span>
                </div>
                <!-- Right Floral Candelabra -->
                <div class="text-xs font-serif flex items-center gap-1.5 opacity-90">
                    <span class="text-[9px] text-stone-500 font-sans tracking-wider uppercase font-semibold">Eucalyptus</span>
                    <span>🕯️</span>
                </div>
            </div>
        </div>

        <!-- Scroll Down Prompt -->
        <div class="mt-4 flex flex-col items-center text-stone-400">
            <span class="text-[9px] uppercase tracking-[0.25em] font-sans font-semibold">Scroll Down</span>
            <span class="animate-bounce text-sm text-gold-600 mt-0.5">⌄</span>
        </div>
    </div>
</template>

<script setup>
import CuteCatholicCouple from '@/Components/Invitation/CuteCatholicCouple.vue';

defineProps({
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
    brideParents: { type: String, default: 'Mr. & Mrs. Perera' },
    groomParents: { type: String, default: 'Mr. & Mrs. Fernando' },
});
</script>
