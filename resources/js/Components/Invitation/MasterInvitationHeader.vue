<template>
    <div id="hero" class="relative px-4 sm:px-8 lg:px-12 pt-3 sm:pt-4 lg:pt-6 pb-8 sm:pb-12 overflow-hidden text-center">
        <!-- Background floral accents set to the back -->
        <FlowerCluster class="absolute top-0 left-0 w-28 sm:w-44 lg:w-60 -scale-y-100 opacity-40 pointer-events-none z-0" />
        <FlowerCluster class="absolute top-0 right-0 w-28 sm:w-44 lg:w-60 rotate-180 opacity-40 pointer-events-none z-0" />
        <FlowerCluster class="hidden lg:block absolute bottom-0 left-0 w-48 opacity-30 pointer-events-none z-0" />
        <FlowerCluster class="hidden lg:block absolute bottom-0 right-0 w-48 -scale-x-100 opacity-30 pointer-events-none z-0" />

        <div class="relative z-10 max-w-3xl mx-auto flex flex-col items-center">
            <!-- 1. Sacred Header: Latin Cross & Holy Matrimony -->
            <div class="flex justify-center text-[#ad2c51]">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 fill-current drop-shadow-xs" viewBox="0 0 24 24">
                    <path d="M10 2h4v6h6v4h-6v10h-4V12H4V8h6V2z" />
                </svg>
            </div>
            <p class="mt-2 font-display text-xs sm:text-sm tracking-[0.35em] text-[#ad2c51] font-semibold">
                HOLY MATRIMONY
            </p>
            <p class="mt-1 font-serif italic text-base sm:text-lg text-stone-800">
                Together with their families
            </p>

            <!-- 2. Couple's Names -->
            <h1 class="mt-3 font-serif font-semibold text-[#ad2c51] leading-tight text-4xl sm:text-5xl lg:text-6xl">
                {{ groomName }}
                <span class="block font-script text-[#ad2c51] font-normal text-3xl sm:text-4xl my-0.5">&amp;</span>
                {{ brideName }}
            </h1>

            <!-- 3. Couple Portrait Medallion -->
            <div class="relative w-60 h-60 sm:w-72 sm:h-72 lg:w-80 lg:h-80 flex items-center justify-center mx-auto my-4 sm:my-5">
                <!-- Gold outline floral blooms set to the BACK -->
                <FlowerCluster class="absolute -bottom-6 -left-8 w-28 sm:w-36 lg:w-44 opacity-75 pointer-events-none z-0" />
                <FlowerCluster class="absolute -top-6 -right-8 w-28 sm:w-36 lg:w-44 rotate-180 opacity-75 pointer-events-none z-0" />

                <!-- Rotating ring of golden sunburst petals behind the medallion -->
                <div class="absolute inset-0 ring-spin pointer-events-none z-0">
                    <span
                        v-for="i in 18"
                        :key="i"
                        class="absolute left-1/2 top-1/2 block w-4 h-7 sm:w-5 sm:h-9 rounded-[50%_50%_46%_46%/88%_88%_14%_14%]"
                        :style="{
                            background: i % 3 === 0 ? 'linear-gradient(to top,#d8ab43,#f5dc8a)' : (i % 3 === 1 ? 'linear-gradient(to top,#e8c86d,#fff4d4)' : 'linear-gradient(to top,#f5dc8a,#fff)'),
                            border: '1px solid rgba(245,220,138,0.7)',
                            boxShadow: '0 0 6px rgba(216,171,67,0.25)',
                            transform: `rotate(${i * 20}deg) translateY(calc(-1 * var(--r)))`,
                            transformOrigin: '0 0',
                            marginLeft: '-0.5rem'
                        }"
                    ></span>
                </div>

                <!-- Photo medallion in FRONT -->
                <div class="relative z-10 w-[66%] h-[66%] rounded-full overflow-hidden border-[5px] border-white shadow-[0_15px_40px_rgba(216,171,67,.35)] ring-4 ring-[#d8ab43] bg-stone-100">
                    <img
                        src="/images/wedding/couple_portrait.jpg"
                        :alt="`${groomName} & ${brideName}`"
                        class="w-full h-full object-cover object-[center_28%] scale-105 select-none pointer-events-none"
                    />
                </div>
            </div>

            <!-- 4. Posh Invitee Presentation (Matching luxury stationery theme, refined typography, no outlines) -->
            <div class="my-3 sm:my-5 max-w-lg mx-auto text-center px-4">
                <div class="flex items-center justify-center gap-3 mb-1.5">
                    <span class="w-8 sm:w-14 h-px bg-gradient-to-r from-transparent via-[#d8ab43]/70 to-transparent"></span>
                    <p class="font-display text-[10px] sm:text-[11px] uppercase tracking-[0.32em] text-[#ad2c51] font-semibold">
                        Cordially Inviting
                    </p>
                    <span class="w-8 sm:w-14 h-px bg-gradient-to-l from-transparent via-[#d8ab43]/70 to-transparent"></span>
                </div>
                <h2 class="font-serif text-2xl sm:text-3xl text-stone-900 font-normal tracking-wide">
                    {{ guestGreeting || guestName || 'Respected Guest & Beloved Family' }}
                </h2>
                <p class="font-serif italic text-xs sm:text-sm text-stone-600 mt-1">
                    Request the honour of your presence and blessings
                </p>
            </div>

            <!-- 5. Parents Section -->
            <div class="mt-4 sm:mt-5 grid grid-cols-2 gap-4 max-w-md mx-auto w-full text-center">
                <div class="border-r border-[#C8636F]/50 pr-4">
                    <p class="font-display text-xs sm:text-sm tracking-[0.2em] text-[#ad2c51] font-semibold">SON OF</p>
                    <p class="mt-1 font-serif text-base sm:text-lg font-semibold text-stone-900">{{ groomParents }}</p>
                </div>
                <div class="pl-4">
                    <p class="font-display text-xs sm:text-sm tracking-[0.2em] text-[#ad2c51] font-semibold">DAUGHTER OF</p>
                    <p class="mt-1 font-serif text-base sm:text-lg font-semibold text-stone-900">{{ brideParents }}</p>
                </div>
            </div>

            <!-- 6. Date & Time -->
            <div class="mt-5 sm:mt-6 flex items-center justify-center gap-3 sm:gap-5">
                <span class="font-display text-xs sm:text-sm tracking-[0.25em] text-[#ad2c51] font-semibold border-y border-[#C8636F] py-1.5 px-2.5">DECEMBER</span>
                <span class="font-serif text-5xl sm:text-6xl font-bold text-[#ad2c51] leading-none">29</span>
                <span class="font-display text-xs sm:text-sm tracking-[0.25em] text-[#ad2c51] font-semibold border-y border-[#C8636F] py-1.5 px-2.5">2026</span>
            </div>
            <p class="mt-2 font-display text-[11px] sm:text-xs tracking-[0.3em] text-stone-700 font-medium">TUESDAY · 4:00 PM</p>

            <!-- 7. Scripture Verse -->
            <p class="mt-5 sm:mt-6 font-serif italic text-base sm:text-lg text-stone-800 max-w-lg mx-auto leading-relaxed px-2">
                “And now these three remain: faith, hope and love. But the greatest of these is love.”
            </p>
            <p class="mt-1 font-display text-[10.5px] sm:text-xs tracking-[0.3em] text-[#ad2c51] font-semibold">1 CORINTHIANS 13:13</p>
        </div>
    </div>
</template>

<script setup>
import FlowerCluster from '@/Components/Invitation/FlowerCluster.vue';
defineProps({
    guestName: { type: String, default: 'Mr & Mrs Silva' },
    guestGreeting: { type: String, default: '' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
    brideParents: { type: String, default: 'Mr. & Mrs. Perera' },
    groomParents: { type: String, default: 'Mr. & Mrs. Fernando' },
});
</script>

<style scoped>
.ring-spin { --r: 7.2rem; animation: spin 70s linear infinite; }
@media (min-width: 640px) { .ring-spin { --r: 8.8rem; } }
@media (min-width: 1024px) { .ring-spin { --r: 9.8rem; } }
@keyframes spin { to { transform: rotate(360deg); } }
</style>


