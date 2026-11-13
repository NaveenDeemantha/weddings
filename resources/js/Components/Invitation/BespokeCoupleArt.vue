<template>
    <div class="relative py-6 flex flex-col items-center justify-center select-none text-center">
        <!-- Delicate Sacred Cross & Botanical Araliya Wreath Motif -->
        <div class="relative w-48 h-48 sm:w-56 sm:h-56 flex items-center justify-center mb-2">
            <!-- Subtle Antique Gold Halo Aura -->
            <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-amber-100/40 via-yellow-100/20 to-amber-200/30 blur-xl pointer-events-none"></div>

            <!-- Fine-line Artisan SVG Wreath with Araliya & Olive Branches -->
            <svg
                class="w-full h-full text-gold-500 drop-shadow-sm"
                viewBox="0 0 240 240"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <!-- Outer delicate circle ring -->
                <circle cx="120" cy="120" r="102" stroke="#d8b878" stroke-width="0.75" stroke-dasharray="3 4" opacity="0.6" />
                <circle cx="120" cy="120" r="95" stroke="#c5a059" stroke-width="1.2" opacity="0.8" />

                <!-- Catholic Cross Emblem at Top of Wreath -->
                <g transform="translate(120, 26)">
                    <line x1="0" y1="-14" x2="0" y2="10" stroke="#8c6d37" stroke-width="2.5" stroke-linecap="round" />
                    <line x1="-7" y1="-6" x2="7" y2="-6" stroke="#8c6d37" stroke-width="2.2" stroke-linecap="round" />
                    <circle cx="0" cy="-2" r="1.5" fill="#c5a059" />
                </g>

                <!-- Left Botanical Leaf Garland (Olive & Araliya Frangipani leaves) -->
                <path d="M 40 120 C 35 155, 65 195, 120 205" stroke="#a7823b" stroke-width="1.4" stroke-linecap="round" />
                <path d="M 40 120 C 35 85, 65 45, 105 32" stroke="#a7823b" stroke-width="1.4" stroke-linecap="round" />

                <!-- Right Botanical Leaf Garland -->
                <path d="M 200 120 C 205 155, 175 195, 120 205" stroke="#a7823b" stroke-width="1.4" stroke-linecap="round" />
                <path d="M 200 120 C 205 85, 175 45, 135 32" stroke="#a7823b" stroke-width="1.4" stroke-linecap="round" />

                <!-- Sri Lankan Araliya (Frangipani) Flowers hand-placed along wreath -->
                <!-- Bottom center flower -->
                <g transform="translate(120, 205)">
                    <circle cx="0" cy="0" r="3" fill="#fef3c7" stroke="#c5a059" stroke-width="1" />
                    <ellipse cx="0" cy="-7" rx="3" ry="5.5" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="6.5" cy="-2" rx="3" ry="5.5" transform="rotate(72 6.5 -2)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="4" cy="5.5" rx="3" ry="5.5" transform="rotate(144 4 5.5)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="-4" cy="5.5" rx="3" ry="5.5" transform="rotate(216 -4 5.5)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="-6.5" cy="-2" rx="3" ry="5.5" transform="rotate(288 -6.5 -2)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <circle cx="0" cy="0" r="2" fill="#f59e0b" />
                </g>

                <!-- Left Araliya bloom -->
                <g transform="translate(42, 115) scale(0.85)">
                    <circle cx="0" cy="0" r="2.5" fill="#fef3c7" stroke="#c5a059" stroke-width="1" />
                    <ellipse cx="0" cy="-6" rx="2.5" ry="4.5" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="5" cy="-2" rx="2.5" ry="4.5" transform="rotate(72 5 -2)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="3" cy="5" rx="2.5" ry="4.5" transform="rotate(144 3 5)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="-3" cy="5" rx="2.5" ry="4.5" transform="rotate(216 -3 5)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="-5" cy="-2" rx="2.5" ry="4.5" transform="rotate(288 -5 -2)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <circle cx="0" cy="0" r="1.5" fill="#f59e0b" />
                </g>

                <!-- Right Araliya bloom -->
                <g transform="translate(198, 115) scale(0.85)">
                    <circle cx="0" cy="0" r="2.5" fill="#fef3c7" stroke="#c5a059" stroke-width="1" />
                    <ellipse cx="0" cy="-6" rx="2.5" ry="4.5" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="5" cy="-2" rx="2.5" ry="4.5" transform="rotate(72 5 -2)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="3" cy="5" rx="2.5" ry="4.5" transform="rotate(144 3 5)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="-3" cy="5" rx="2.5" ry="4.5" transform="rotate(216 -3 5)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <ellipse cx="-5" cy="-2" rx="2.5" ry="4.5" transform="rotate(288 -5 -2)" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                    <circle cx="0" cy="0" r="1.5" fill="#f59e0b" />
                </g>

                <!-- Olive leaves details along the wreath -->
                <path d="M 62 70 Q 52 64 56 55 Q 65 60 62 70 Z" fill="#d5cca7" opacity="0.8" />
                <path d="M 178 70 Q 188 64 184 55 Q 175 60 178 70 Z" fill="#d5cca7" opacity="0.8" />
                <path d="M 55 160 Q 45 168 50 176 Q 60 170 55 160 Z" fill="#d5cca7" opacity="0.8" />
                <path d="M 185 160 Q 195 168 190 176 Q 180 170 185 160 Z" fill="#d5cca7" opacity="0.8" />
            </svg>

            <!-- Center Monogram inside Wreath -->
            <div class="absolute flex flex-col items-center justify-center">
                <span class="font-display text-4xl sm:text-5xl font-normal tracking-wider text-gold-foil">
                    {{ brideInitials }}<span class="text-xs font-serif italic text-gold-600 align-middle mx-1">&amp;</span>{{ groomInitials }}
                </span>
                <span class="text-[9px] uppercase tracking-[0.25em] font-sans font-semibold text-stone-500 mt-0.5">
                    Colombo, Sri Lanka
                </span>
            </div>
        </div>

        <!-- Holy Scripture Blessing -->
        <div class="max-w-md mx-auto px-4 mt-2">
            <p class="font-serif italic text-sm sm:text-base text-stone-600 leading-relaxed">
                "Therefore what God has joined together, let no one separate."
            </p>
            <p class="text-[11px] uppercase tracking-widest font-sans font-semibold text-gold-700 mt-1">
                Matthew 19:6
            </p>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    brideName: { type: String, default: 'Shenali' },
    groomName: { type: String, default: 'Dilan' },
});

const brideInitials = computed(() => props.brideName ? props.brideName.charAt(0).toUpperCase() : 'S');
const groomInitials = computed(() => props.groomName ? props.groomName.charAt(0).toUpperCase() : 'D');
</script>

