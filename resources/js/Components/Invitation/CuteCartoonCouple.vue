<template>
    <div class="relative py-4 flex flex-col items-center justify-center select-none">
        <!-- Floating hearts animation container -->
        <div class="absolute inset-0 pointer-events-none flex justify-center items-center overflow-hidden">
            <span
                v-for="h in hearts"
                :key="h.id"
                class="absolute text-rose-500 animate-float-gentle text-lg transition-all"
                :style="{
                    left: h.left + '%',
                    bottom: h.bottom + '%',
                    opacity: h.opacity,
                    transform: `scale(${h.scale})`,
                    animationDuration: h.duration + 's',
                }"
            >
                {{ h.icon }}
            </span>
        </div>

        <!-- Decorative Floral Mandala Arch Backdrop -->
        <div class="relative flex items-center justify-center">
            <!-- Subtle Gold Glow Behind Couple -->
            <div class="absolute w-72 h-72 md:w-80 md:h-80 rounded-full bg-gradient-to-tr from-amber-200/50 via-yellow-100/40 to-amber-300/30 blur-2xl -z-10 animate-pulse-glow"></div>

            <!-- Couple Figures SVG Container -->
            <div class="relative flex items-end justify-center gap-2 sm:gap-6 cursor-pointer" @click="burstHearts">
                <!-- Groom (Rahul) -->
                <div class="flex flex-col items-center groom-character transition-transform duration-300 hover:scale-105">
                    <svg
                        class="w-36 h-48 sm:w-44 sm:h-56 drop-shadow-md"
                        viewBox="0 0 160 210"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <!-- Turban / Safa with Gold Kalgi -->
                        <g class="groom-safa">
                            <path d="M45 65 C45 35 60 15 85 15 C110 15 125 35 125 65 C125 70 120 75 115 75 L55 75 C50 75 45 70 45 65 Z" fill="#991B1B" />
                            <path d="M48 50 C55 40 75 32 88 32 C105 32 120 42 124 55" stroke="#F59E0B" stroke-width="4" stroke-linecap="round" />
                            <path d="M50 63 C65 52 95 50 120 62" stroke="#FBBF24" stroke-width="3" stroke-linecap="round" />
                            <!-- Royal Kalgi (Golden Brooch & Feather) -->
                            <path d="M85 8 L85 24 M80 14 L85 8 L90 14" stroke="#D97706" stroke-width="3" stroke-linecap="round" />
                            <circle cx="85" cy="24" r="4.5" fill="#F59E0B" stroke="#78350F" stroke-width="1.5" />
                            <circle cx="85" cy="24" r="2" fill="#DC2626" />
                            <!-- Turban Tail hanging to shoulder -->
                            <path d="M118 65 Q130 95 126 125 Q123 130 119 125 Q121 95 115 72" fill="#7F1D1D" />
                        </g>

                        <!-- Groom Face -->
                        <g class="groom-head">
                            <!-- Ears -->
                            <circle cx="48" cy="78" r="7" fill="#FBD6B5" />
                            <circle cx="122" cy="78" r="7" fill="#FBD6B5" />
                            <!-- Face -->
                            <ellipse cx="85" cy="80" rx="35" ry="32" fill="#FCE7D2" />
                            <!-- Rosy Cheeks -->
                            <circle cx="62" cy="88" r="5" fill="#F87171" opacity="0.45" />
                            <circle cx="108" cy="88" r="5" fill="#F87171" opacity="0.45" />
                            <!-- Cartoon Eyes (Blinking Animation) -->
                            <g class="groom-eyes">
                                <circle cx="68" cy="77" r="4.5" fill="#1F2937" />
                                <circle cx="102" cy="77" r="4.5" fill="#1F2937" />
                                <!-- Eye twinkle -->
                                <circle cx="69.5" cy="75.5" r="1.5" fill="#FFFFFF" />
                                <circle cx="103.5" cy="75.5" r="1.5" fill="#FFFFFF" />
                            </g>
                            <!-- Eyebrows -->
                            <path d="M62 70 Q68 67 74 71" stroke="#374151" stroke-width="2" stroke-linecap="round" />
                            <path d="M96 71 Q102 67 108 70" stroke="#374151" stroke-width="2" stroke-linecap="round" />
                            <!-- Cute Smile -->
                            <path d="M78 92 Q85 99 92 92" stroke="#991B1B" stroke-width="2.5" stroke-linecap="round" />
                        </g>

                        <!-- Royal Sherwani Body -->
                        <g class="groom-body">
                            <!-- Ivory Sherwani Coat -->
                            <path d="M52 110 C46 125 40 165 42 205 L128 205 C130 165 124 125 118 110 C110 102 96 102 85 104 C74 102 60 102 52 110 Z" fill="#FFFBEB" stroke="#D97706" stroke-width="1.5" />
                            <!-- Gold Button Placket & Collar -->
                            <path d="M85 104 L85 205" stroke="#D97706" stroke-width="2.5" stroke-dasharray="2 6" />
                            <path d="M72 108 Q85 114 98 108" stroke="#B45309" stroke-width="3" stroke-linecap="round" />
                            <!-- Pearl Mala (Necklace) -->
                            <path d="M64 114 Q85 140 106 114" stroke="#FDE68A" stroke-width="3.5" stroke-linecap="round" stroke-dasharray="1 5" />
                            <circle cx="85" cy="132" r="3.5" fill="#10B981" stroke="#D97706" stroke-width="1" />
                            <!-- Royal Red Stole (Dupatta) -->
                            <path d="M52 110 C50 135 48 175 46 205 L58 205 C59 175 62 135 62 112 Z" fill="#991B1B" />
                            <path d="M46 205 L58 205" stroke="#F59E0B" stroke-width="3" />
                            <!-- Folded Hands in Namaste -->
                            <path d="M75 142 C78 136 92 136 95 142 L90 156 L80 156 Z" fill="#FCE7D2" stroke="#D97706" stroke-width="1" />
                        </g>
                    </svg>
                    <span class="mt-1 font-serif text-sm font-semibold text-stone-700 tracking-wider">
                        {{ groomName }}
                    </span>
                </div>

                <!-- Heart Icon in Center with Love Sparkles -->
                <div class="flex flex-col items-center justify-center mb-16 sm:mb-20">
                    <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-gradient-to-tr from-amber-400 to-rose-400 flex items-center justify-center text-white shadow-lg animate-bounce">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-script text-amber-700 font-bold text-lg -mt-1">&</span>
                </div>

                <!-- Bride (Pooja) -->
                <div class="flex flex-col items-center bride-character transition-transform duration-300 hover:scale-105">
                    <svg
                        class="w-36 h-48 sm:w-44 sm:h-56 drop-shadow-md"
                        viewBox="0 0 160 210"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <!-- Bridal Hair & Dupatta Veil -->
                        <g class="bride-veil">
                            <path d="M38 70 C35 30 55 18 80 18 C105 18 125 30 122 70 C132 105 130 165 128 205 L32 205 C30 165 28 105 38 70 Z" fill="#991B1B" />
                            <!-- Gold Embroidered Dupatta Border -->
                            <path d="M38 70 C35 30 55 18 80 18 C105 18 125 30 122 70" stroke="#F59E0B" stroke-width="4.5" stroke-linecap="round" />
                            <path d="M42 66 C40 34 58 23 80 23 C102 23 120 34 118 66" stroke="#FEF08A" stroke-width="1.5" stroke-dasharray="2 3" />
                            <path d="M32 205 L128 205" stroke="#F59E0B" stroke-width="4" />
                        </g>

                        <!-- Bride Face & Hair -->
                        <g class="bride-head">
                            <!-- Dark Hair Framing -->
                            <path d="M52 64 C60 48 100 48 108 64 C112 76 112 88 110 94 C104 68 56 68 50 94 C48 88 48 76 52 64 Z" fill="#1F2937" />
                            <!-- Face -->
                            <ellipse cx="80" cy="82" rx="31" ry="29" fill="#FCE7D2" />
                            <!-- Maang Tikka (Forehead Jewelry) -->
                            <path d="M80 48 L80 66" stroke="#D97706" stroke-width="2" />
                            <circle cx="80" cy="68" r="3.5" fill="#F59E0B" stroke="#991B1B" stroke-width="1" />
                            <circle cx="80" cy="68" r="1.5" fill="#DC2626" />
                            <!-- Round Red Bindi -->
                            <circle cx="80" cy="74" r="1.8" fill="#B91C1C" />
                            <!-- Rosy Cheeks -->
                            <circle cx="59" cy="89" r="5" fill="#F87171" opacity="0.5" />
                            <circle cx="101" cy="89" r="5" fill="#F87171" opacity="0.5" />
                            <!-- Cartoon Eyes with Eyelashes -->
                            <g class="bride-eyes">
                                <circle cx="64" cy="79" r="4.5" fill="#1F2937" />
                                <circle cx="96" cy="79" r="4.5" fill="#1F2937" />
                                <!-- Twinkle in Eyes -->
                                <circle cx="65.5" cy="77.5" r="1.5" fill="#FFFFFF" />
                                <circle cx="97.5" cy="77.5" r="1.5" fill="#FFFFFF" />
                                <!-- Cute Eyelashes -->
                                <path d="M59 75 L62 77" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M101 75 L98 77" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" />
                            </g>
                            <!-- Gentle Smile with Red Lips -->
                            <path d="M74 93 Q80 99 86 93" stroke="#DC2626" stroke-width="2.5" stroke-linecap="round" />
                            <!-- Gold Jhumka Earrings -->
                            <path d="M47 85 L47 92 M44 92 L50 92 L47 96 Z" fill="#F59E0B" stroke="#B45309" stroke-width="0.8" />
                            <path d="M113 85 L113 92 M110 92 L116 92 L113 96 Z" fill="#F59E0B" stroke="#B45309" stroke-width="0.8" />
                        </g>

                        <!-- Bridal Lehenga & Jewelry -->
                        <g class="bride-body">
                            <!-- Choli / Blouse -->
                            <path d="M50 110 C45 125 42 155 40 205 L120 205 C118 155 115 125 110 110 C102 104 90 104 80 106 C70 104 58 104 50 110 Z" fill="#B91C1C" />
                            <!-- Heavy Gold Choker Necklace -->
                            <path d="M60 108 Q80 126 100 108" stroke="#F59E0B" stroke-width="4.5" stroke-linecap="round" stroke-dasharray="2 3" />
                            <circle cx="80" cy="120" r="3" fill="#10B981" stroke="#F59E0B" stroke-width="1" />
                            <!-- Gold Bangles (Chooda) -->
                            <rect x="42" y="145" width="8" height="14" rx="2" fill="#DC2626" stroke="#F59E0B" stroke-width="1.5" />
                            <rect x="110" y="145" width="8" height="14" rx="2" fill="#DC2626" stroke="#F59E0B" stroke-width="1.5" />
                            <!-- Gold Motifs on Lehenga -->
                            <circle cx="68" cy="155" r="3" fill="#FDE68A" />
                            <circle cx="92" cy="155" r="3" fill="#FDE68A" />
                            <circle cx="80" cy="175" r="3.5" fill="#FDE68A" />
                            <circle cx="60" cy="190" r="3" fill="#FDE68A" />
                            <circle cx="100" cy="190" r="3" fill="#FDE68A" />
                            <!-- Gold Hemline -->
                            <path d="M40 203 L120 203" stroke="#F59E0B" stroke-width="3" />
                        </g>
                    </svg>
                    <span class="mt-1 font-serif text-sm font-semibold text-stone-700 tracking-wider">
                        {{ brideName }}
                    </span>
                </div>
            </div>
        </div>

        <p class="mt-3 text-xs text-amber-700/80 font-medium tracking-wide flex items-center gap-1.5 animate-pulse">
            <span>✨</span> Tap couple to shower love <span>✨</span>
        </p>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    brideName: { type: String, default: 'Pooja' },
    groomName: { type: String, default: 'Rahul' },
});

const hearts = ref([
    { id: 1, left: 45, bottom: 40, opacity: 0.8, scale: 0.9, duration: 4, icon: '💖' },
    { id: 2, left: 52, bottom: 55, opacity: 0.9, scale: 1.1, duration: 5, icon: '✨' },
    { id: 3, left: 48, bottom: 70, opacity: 0.7, scale: 0.8, duration: 4.5, icon: '💕' },
]);

const burstHearts = () => {
    const emojis = ['💖', '💕', '✨', '🌸', '💐', '💍'];
    for (let i = 0; i < 7; i++) {
        const id = Date.now() + i;
        hearts.value.push({
            id,
            left: Math.random() * 30 + 35,
            bottom: Math.random() * 20 + 30,
            opacity: 1,
            scale: Math.random() * 0.6 + 0.8,
            duration: Math.random() * 2 + 2.5,
            icon: emojis[Math.floor(Math.random() * emojis.length)],
        });

        setTimeout(() => {
            hearts.value = hearts.value.filter(h => h.id !== id);
        }, 3000);
    }
};
</script>

<style scoped>
.groom-character {
    animation: gentleSway 4s ease-in-out infinite alternate;
}
.bride-character {
    animation: gentleSway 4.2s ease-in-out infinite alternate-reverse;
}

@keyframes gentleSway {
    0% {
        transform: translateY(0px) rotate(-1deg);
    }
    100% {
        transform: translateY(-4px) rotate(1.2deg);
    }
}
</style>

