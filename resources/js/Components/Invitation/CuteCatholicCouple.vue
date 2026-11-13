<template>
    <div class="relative py-4 flex flex-col items-center justify-center select-none text-center">
        <!-- Floating Love Hearts Container -->
        <div class="absolute inset-0 pointer-events-none flex justify-center items-center overflow-hidden">
            <span
                v-for="h in hearts"
                :key="h.id"
                class="absolute transition-all select-none"
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

        <!-- Decorative Floral Arch Aura -->
        <div class="relative flex items-center justify-center">
            <!-- Subtle Gold Halo Glow -->
            <div class="absolute w-64 h-64 sm:w-80 sm:h-80 rounded-full bg-gradient-to-tr from-amber-100/50 via-yellow-50/40 to-amber-200/40 blur-2xl -z-10 animate-pulse-subtle"></div>

            <!-- Couple Figures (Interactive Tap) -->
            <div
                class="relative flex items-end justify-center gap-3 sm:gap-6 cursor-pointer transform active:scale-95 transition-transform duration-200"
                @click="showerHearts"
                title="Tap to shower love!"
            >
                <!-- Catholic Groom in Tuxedo -->
                <div class="flex flex-col items-center groom-figure">
                    <svg
                        class="w-32 h-44 sm:w-40 sm:h-52 drop-shadow-md"
                        viewBox="0 0 160 210"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <!-- Groom Hair -->
                        <path d="M52 65 C48 35 68 20 85 20 C105 20 122 32 118 65 C116 70 114 74 112 74 C110 52 98 42 85 42 C72 42 60 52 58 74 C56 74 54 70 52 65 Z" fill="#292524" />
                        <path d="M58 45 C65 30 85 25 102 30" stroke="#44403c" stroke-width="2.5" stroke-linecap="round" />

                        <!-- Groom Head & Ears -->
                        <circle cx="48" cy="74" r="6" fill="#FCE7D2" />
                        <circle cx="122" cy="74" r="6" fill="#FCE7D2" />
                        <ellipse cx="85" cy="76" rx="34" ry="32" fill="#FCE7D2" />

                        <!-- Rosy Cheeks -->
                        <circle cx="63" cy="85" r="5" fill="#fca5a5" opacity="0.45" />
                        <circle cx="107" cy="85" r="5" fill="#fca5a5" opacity="0.45" />

                        <!-- Eyes with Twinkle -->
                        <g class="groom-eyes">
                            <circle cx="68" cy="74" r="4" fill="#1c1917" />
                            <circle cx="102" cy="74" r="4" fill="#1c1917" />
                            <circle cx="69.5" cy="72.5" r="1.3" fill="#ffffff" />
                            <circle cx="103.5" cy="72.5" r="1.3" fill="#ffffff" />
                        </g>

                        <!-- Eyebrows -->
                        <path d="M62 67 Q68 64 74 68" stroke="#292524" stroke-width="2" stroke-linecap="round" />
                        <path d="M96 68 Q102 64 108 67" stroke="#292524" stroke-width="2" stroke-linecap="round" />

                        <!-- Warm Gentleman Smile -->
                        <path d="M78 88 Q85 95 92 88" stroke="#b91c1c" stroke-width="2.2" stroke-linecap="round" />

                        <!-- Tuxedo Body -->
                        <!-- White Shirt & Collar -->
                        <path d="M68 106 L85 130 L102 106 Z" fill="#ffffff" />
                        <path d="M70 106 L85 118 L100 106" stroke="#e5e5e5" stroke-width="1.5" />

                        <!-- Black Bowtie -->
                        <path d="M78 114 L85 118 L78 122 Z M92 114 L85 118 L92 122 Z" fill="#0f172a" />
                        <circle cx="85" cy="118" r="2" fill="#334155" />

                        <!-- Tailored Black Tuxedo Jacket -->
                        <path d="M52 108 C46 125 40 165 42 205 L128 205 C130 165 124 125 118 108 C110 102 96 102 85 104 C74 102 60 102 52 108 Z" fill="#15253b" />
                        
                        <!-- Satin Lapels -->
                        <path d="M52 108 L72 165 L85 165 L65 106 Z" fill="#0f172a" stroke="#d8b878" stroke-width="0.5" />
                        <path d="M118 108 L98 165 L85 165 L105 106 Z" fill="#0f172a" stroke="#d8b878" stroke-width="0.5" />

                        <!-- White Rose Boutonnière on Lapel -->
                        <g transform="translate(63, 122)">
                            <circle cx="0" cy="0" r="3.5" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                            <circle cx="0" cy="0" r="1.5" fill="#fef08a" />
                            <path d="M0 3.5 Q2 7 1 9" stroke="#15803d" stroke-width="1.2" stroke-linecap="round" />
                        </g>

                        <!-- White Pocket Square -->
                        <polygon points="100,126 105,121 110,126" fill="#ffffff" />
                    </svg>
                    <span class="mt-1 font-serif text-xs font-semibold text-stone-700 tracking-wider">
                        {{ groomName }}
                    </span>
                </div>

                <!-- Center Cross & Golden Rings Emblem -->
                <div class="flex flex-col items-center justify-center mb-16 sm:mb-20">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-[#15253b] border border-[#d8b878] flex items-center justify-center text-amber-200 shadow-md">
                        <span class="text-sm">✝</span>
                    </div>
                    <span class="text-[10px] font-script text-gold-700 font-bold text-lg -mt-0.5">&amp;</span>
                </div>

                <!-- Catholic Bride in White Gown & Veil -->
                <div class="flex flex-col items-center bride-figure">
                    <svg
                        class="w-32 h-44 sm:w-40 sm:h-52 drop-shadow-md"
                        viewBox="0 0 160 210"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <!-- Flowing Cathedral Bridal Veil -->
                        <g class="veil-layer">
                            <path d="M42 62 C32 25 55 12 80 12 C105 12 128 25 118 62 C132 100 134 165 132 205 L28 205 C26 165 28 100 42 62 Z" fill="#ffffff" fill-opacity="0.85" stroke="#d8b878" stroke-width="0.75" />
                            <path d="M38 70 C36 120 34 170 32 205" stroke="#e5dfcd" stroke-width="1" stroke-dasharray="2 4" />
                            <path d="M122 70 C124 120 126 170 128 205" stroke="#e5dfcd" stroke-width="1" stroke-dasharray="2 4" />
                        </g>

                        <!-- Sparkling Bridal Tiara -->
                        <g transform="translate(80, 48)">
                            <path d="M-22 10 Q0 -4 22 10" stroke="#d8b878" stroke-width="2" fill="none" stroke-linecap="round" />
                            <circle cx="0" cy="-2" r="2.5" fill="#fef08a" stroke="#c5a059" stroke-width="0.8" />
                            <circle cx="-12" cy="3" r="2" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                            <circle cx="12" cy="3" r="2" fill="#ffffff" stroke="#c5a059" stroke-width="0.8" />
                        </g>

                        <!-- Bride Hair -->
                        <path d="M50 64 C58 46 102 46 110 64 C114 74 114 84 112 90 C106 66 54 66 48 90 C46 84 46 74 50 64 Z" fill="#292524" />

                        <!-- Bride Head & Face -->
                        <ellipse cx="80" cy="78" rx="31" ry="29" fill="#FCE7D2" />

                        <!-- Rosy Cheeks -->
                        <circle cx="59" cy="86" r="5" fill="#fca5a5" opacity="0.5" />
                        <circle cx="101" cy="86" r="5" fill="#fca5a5" opacity="0.5" />

                        <!-- Pretty Eyes with Lashes -->
                        <g class="bride-eyes">
                            <circle cx="64" cy="76" r="4" fill="#1c1917" />
                            <circle cx="96" cy="76" r="4" fill="#1c1917" />
                            <circle cx="65.5" cy="74.5" r="1.3" fill="#ffffff" />
                            <circle cx="97.5" cy="74.5" r="1.3" fill="#ffffff" />
                            <!-- Lashes -->
                            <path d="M59 72 L62 74" stroke="#1c1917" stroke-width="1.3" stroke-linecap="round" />
                            <path d="M101 72 L98 74" stroke="#1c1917" stroke-width="1.3" stroke-linecap="round" />
                        </g>

                        <!-- Radiant Red/Pink Smile -->
                        <path d="M74 90 Q80 97 86 90" stroke="#e11d48" stroke-width="2.2" stroke-linecap="round" />

                        <!-- Pearl Drop Earrings -->
                        <circle cx="48" cy="82" r="2.5" fill="#ffffff" stroke="#d8b878" stroke-width="0.75" />
                        <circle cx="112" cy="82" r="2.5" fill="#ffffff" stroke="#d8b878" stroke-width="0.75" />

                        <!-- White Lace Bridal Gown -->
                        <path d="M52 108 C46 122 42 155 38 205 L122 205 C118 155 114 122 108 108 C98 103 90 104 80 106 C70 104 62 103 52 108 Z" fill="#ffffff" stroke="#e5dfcd" stroke-width="1" />
                        <!-- Sweetheart Neckline -->
                        <path d="M62 106 Q80 118 98 106" stroke="#d8b878" stroke-width="1.2" fill="none" />

                        <!-- Pearl Necklace -->
                        <path d="M64 102 Q80 114 96 102" stroke="#d8b878" stroke-width="2" stroke-linecap="round" stroke-dasharray="1 4" />

                        <!-- Bridal Bouquet (White Roses & Araliya) -->
                        <g transform="translate(80, 150)">
                            <!-- Leaves -->
                            <ellipse cx="-8" cy="-2" rx="4" ry="7" transform="rotate(-30 -8 -2)" fill="#16a34a" />
                            <ellipse cx="8" cy="-2" rx="4" ry="7" transform="rotate(30 8 -2)" fill="#16a34a" />
                            <ellipse cx="0" cy="8" rx="3.5" ry="6" fill="#15803d" />
                            <!-- White Roses / Flowers -->
                            <circle cx="0" cy="-4" r="5" fill="#ffffff" stroke="#d8b878" stroke-width="1" />
                            <circle cx="-6" cy="2" r="4.5" fill="#ffffff" stroke="#d8b878" stroke-width="1" />
                            <circle cx="6" cy="2" r="4.5" fill="#ffffff" stroke="#d8b878" stroke-width="1" />
                            <circle cx="0" cy="0" r="2" fill="#fef08a" />
                            <!-- Ribbon -->
                            <path d="M0 6 L-3 15 M0 6 L3 15" stroke="#d8b878" stroke-width="1.5" stroke-linecap="round" />
                        </g>
                    </svg>
                    <span class="mt-1 font-serif text-xs font-semibold text-stone-700 tracking-wider">
                        {{ brideName }}
                    </span>
                </div>
            </div>
        </div>

        <p class="mt-2 text-[10px] text-stone-500 font-sans uppercase tracking-[0.2em] flex items-center justify-center gap-1.5">
            <span>✨</span> Tap couple to shower blessings <span>✨</span>
        </p>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
});

const hearts = ref([
    { id: 1, left: 45, bottom: 45, opacity: 0.8, scale: 0.9, duration: 4, icon: '🤍' },
    { id: 2, left: 52, bottom: 60, opacity: 0.9, scale: 1.1, duration: 5, icon: '✨' },
    { id: 3, left: 48, bottom: 75, opacity: 0.7, scale: 0.8, duration: 4.5, icon: '🕊️' },
]);

const showerHearts = () => {
    const icons = ['🤍', '✨', '🕊️', '💍', '🌸', '💐'];
    for (let i = 0; i < 7; i++) {
        const id = Date.now() + i;
        hearts.value.push({
            id,
            left: Math.random() * 34 + 33,
            bottom: Math.random() * 20 + 35,
            opacity: 1,
            scale: Math.random() * 0.5 + 0.8,
            duration: Math.random() * 2 + 2.5,
            icon: icons[Math.floor(Math.random() * icons.length)],
        });

        setTimeout(() => {
            hearts.value = hearts.value.filter(h => h.id !== id);
        }, 3000);
    }
};
</script>

<style scoped>
.groom-figure {
    animation: swayGently 4s ease-in-out infinite alternate;
}
.bride-figure {
    animation: swayGently 4.2s ease-in-out infinite alternate-reverse;
}

@keyframes swayGently {
    0% {
        transform: translateY(0px) rotate(-0.8deg);
    }
    100% {
        transform: translateY(-4px) rotate(0.8deg);
    }
}
</style>

