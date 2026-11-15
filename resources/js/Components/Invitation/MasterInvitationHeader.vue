<template>
    <div id="hero" class="relative px-5 sm:px-8 lg:px-12 pt-28 sm:pt-32 lg:pt-20 pb-12 lg:pb-24 overflow-hidden">
        <FlowerCluster class="absolute top-0 left-0 w-36 sm:w-52 lg:w-72 -scale-y-100 opacity-95" />
        <FlowerCluster class="absolute top-0 right-0 w-36 sm:w-52 lg:w-72 rotate-180 opacity-95" />
        <FlowerCluster class="hidden lg:block absolute bottom-0 left-0 w-60 opacity-90" />
        <FlowerCluster class="hidden lg:block absolute bottom-0 right-0 w-60 -scale-x-100 opacity-90" />
        <div class="relative z-[1] max-w-6xl mx-auto grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <!-- Couple portrait -->
            <div class="order-2 lg:order-1 flex justify-center">
                <div class="relative w-72 h-72 sm:w-80 sm:h-80 lg:w-[26rem] lg:h-[26rem]">
                    <!-- slowly rotating ring of petals -->
                    <div class="absolute inset-0 ring-spin">
                        <span
                            v-for="i in 18"
                            :key="i"
                            class="absolute left-1/2 top-1/2 block w-5 h-8 sm:w-6 sm:h-10 rounded-[50%_50%_46%_46%/88%_88%_14%_14%]"
                            :style="{ background: i % 3 === 0 ? 'linear-gradient(to top,#ad2c51,#C8636F)' : (i % 3 === 1 ? 'linear-gradient(to top,#F678A4,#ffd0e1)' : 'linear-gradient(to top,#fbb1cb,#fff)'), border: '1px solid rgba(245,220,138,0.7)', boxShadow: '0 0 6px rgba(216,171,67,0.25)', transform: `rotate(${i * 20}deg) translateY(calc(-1 * var(--r)))`, transformOrigin: '0 0', marginLeft: '-0.6rem' }"
                        ></span>
                    </div>
                    <!-- photo medallion -->
                    <div class="absolute inset-[17%] rounded-full overflow-hidden border-[5px] border-white shadow-[0_18px_50px_rgba(173,44,81,.35)] ring-2 ring-[#F678A4]" style="background: linear-gradient(160deg,#fff,#ffe4ee 55%,#fbb1cb);">
                        <img
                            src="/images/wedding/couple_portrait.jpg"
                            :alt="`${groomName} & ${brideName}`"
                            class="w-full h-full object-cover object-top mix-blend-multiply scale-110 select-none pointer-events-none"
                        />
                    </div>
                    <!-- blooms hugging the medallion -->
                    <FlowerCluster class="absolute -bottom-6 -left-8 w-32 sm:w-40 lg:w-48" />
                    <FlowerCluster class="absolute -top-6 -right-8 w-32 sm:w-40 lg:w-48 rotate-180" />
                </div>
            </div>

            <!-- Invitation wording -->
            <div class="order-1 lg:order-2 text-center">
                <div class="text-[#ad2c51] text-3xl">✝</div>
                <p class="mt-3 font-display text-sm sm:text-base tracking-[0.35em] text-[#ad2c51] font-semibold">
                    HOLY MATRIMONY
                </p>
                <p class="mt-2 font-serif italic text-lg sm:text-xl text-stone-800">
                    Together with their families
                </p>

                <h1 class="mt-5 font-serif font-semibold text-[#ad2c51] leading-tight text-5xl sm:text-6xl lg:text-7xl">
                    {{ groomName }}
                    <span class="block font-script text-[#ad2c51] font-normal text-4xl sm:text-5xl my-1">&amp;</span>
                    {{ brideName }}
                </h1>

                <div class="mt-7 grid grid-cols-2 gap-4 max-w-md mx-auto text-center">
                    <div class="border-r border-[#C8636F]/50 pr-4">
                        <p class="font-display text-xs sm:text-sm tracking-[0.2em] text-[#ad2c51] font-semibold">SON OF</p>
                        <p class="mt-1 font-serif text-lg sm:text-xl font-semibold text-stone-900">{{ groomParents }}</p>
                    </div>
                    <div class="pl-4">
                        <p class="font-display text-xs sm:text-sm tracking-[0.2em] text-[#ad2c51] font-semibold">DAUGHTER OF</p>
                        <p class="mt-1 font-serif text-lg sm:text-xl font-semibold text-stone-900">{{ brideParents }}</p>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-center gap-4 sm:gap-6">
                    <span class="font-display text-sm sm:text-base tracking-[0.25em] text-[#ad2c51] font-semibold border-y border-[#C8636F] py-2 px-3">DECEMBER</span>
                    <span class="font-serif text-6xl sm:text-7xl font-bold text-[#ad2c51] leading-none">29</span>
                    <span class="font-display text-sm sm:text-base tracking-[0.25em] text-[#ad2c51] font-semibold border-y border-[#C8636F] py-2 px-3">2026</span>
                </div>
                <p class="mt-3 font-display text-xs sm:text-sm tracking-[0.3em] text-stone-700">TUESDAY · 9:00 AM</p>

                <p class="mt-8 font-serif italic text-xl sm:text-2xl text-stone-800 max-w-md mx-auto leading-relaxed">
                    “Therefore what God has joined together, let no one separate.”
                </p>
                <p class="mt-1 font-display text-xs tracking-[0.3em] text-[#ad2c51] font-semibold">MATTHEW 19:6</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import FlowerCluster from '@/Components/Invitation/FlowerCluster.vue';
defineProps({
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
    brideParents: { type: String, default: 'Mr. & Mrs. Perera' },
    groomParents: { type: String, default: 'Mr. & Mrs. Fernando' },
});
</script>

<style scoped>
.ring-spin { --r: 8rem; animation: spin 70s linear infinite; }
@media (min-width: 640px) { .ring-spin { --r: 8.9rem; } }
@media (min-width: 1024px) { .ring-spin { --r: 11.5rem; } }
@keyframes spin { to { transform: rotate(360deg); } }
</style>


