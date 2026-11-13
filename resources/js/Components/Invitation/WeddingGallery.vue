<template>
    <div id="gallery" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10">
        <!-- Save the Date Top Banner Pill -->
        <div class="max-w-md mx-auto mb-8">
            <a
                :href="calendarLink"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center justify-between p-3.5 sm:p-4 rounded-2xl bg-[#faf8f4] border border-[#d8b878]/70 shadow-sm hover:border-[#c5a059] transition-all group"
            >
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#15253b] text-amber-200 flex items-center justify-center text-base shrink-0 group-hover:scale-105 transition-transform">
                        📅
                    </div>
                    <div>
                        <h4 class="font-serif font-bold text-xs uppercase tracking-wider text-[#15253b] group-hover:text-gold-700 transition-colors">
                            Save the Date
                        </h4>
                        <p class="text-[10px] sm:text-[11px] text-stone-500 font-serif italic">
                            Add the wedding to your calendar ↗
                        </p>
                    </div>
                </div>
                <span class="text-xs text-gold-700 font-serif font-semibold pr-1 group-hover:translate-x-1 transition-transform">
                    Add
                </span>
            </a>
        </div>

        <!-- Section Title -->
        <div class="text-center mb-6">
            <p class="font-sans text-[9px] uppercase tracking-[0.25em] font-semibold text-gold-700">
                Captured Moments
            </p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#15253b] mt-1">
                Our Gallery
            </h2>
            <div class="my-2.5 text-gold-600 text-xs">✝</div>
        </div>

        <!-- Real 2-Column Photo Album Grid matching screenshot 10 -->
        <div class="max-w-md mx-auto grid grid-cols-2 gap-3 sm:gap-4">
            <!-- Photo 1: Cathedral Steps -->
            <div class="rounded-2xl border border-[#d8b878]/60 bg-[#faf8f4] p-2 sm:p-2.5 shadow-sm flex flex-col justify-between group overflow-hidden hover:border-[#c5a059] transition-all">
                <div class="w-full h-40 sm:h-48 rounded-xl bg-gradient-to-b from-stone-100 to-amber-50/50 flex flex-col items-center justify-center text-center p-3 border border-stone-200/60 group-hover:scale-[1.02] transition-transform">
                    <span class="text-3xl mb-1.5 group-hover:scale-110 transition-transform">⛪</span>
                    <span class="font-serif text-xs font-semibold text-stone-800">Cathedral Steps</span>
                    <span class="text-[9px] text-stone-400 font-sans uppercase tracking-wider mt-0.5">St. Mary's</span>
                </div>
                <p class="text-[10px] font-serif italic text-stone-500 text-center mt-1.5">
                    "Walking in faith"
                </p>
            </div>

            <!-- Photo 2: The Radiant Bride -->
            <div class="rounded-2xl border border-[#d8b878]/60 bg-[#faf8f4] p-2 sm:p-2.5 shadow-sm flex flex-col justify-between group overflow-hidden hover:border-[#c5a059] transition-all">
                <div class="w-full h-40 sm:h-48 rounded-xl bg-gradient-to-b from-stone-100 to-amber-50/50 flex flex-col items-center justify-center text-center p-3 border border-stone-200/60 group-hover:scale-[1.02] transition-transform">
                    <span class="text-3xl mb-1.5 group-hover:scale-110 transition-transform">👰</span>
                    <span class="font-serif text-xs font-semibold text-stone-800">The Radiant Bride</span>
                    <span class="text-[9px] text-stone-400 font-sans uppercase tracking-wider mt-0.5">Cathedral Veil</span>
                </div>
                <p class="text-[10px] font-serif italic text-stone-500 text-center mt-1.5">
                    "Grace &amp; Joy"
                </p>
            </div>

            <!-- Photo 3: The Groom -->
            <div class="rounded-2xl border border-[#d8b878]/60 bg-[#faf8f4] p-2 sm:p-2.5 shadow-sm flex flex-col justify-between group overflow-hidden hover:border-[#c5a059] transition-all">
                <div class="w-full h-40 sm:h-48 rounded-xl bg-gradient-to-b from-stone-100 to-amber-50/50 flex flex-col items-center justify-center text-center p-3 border border-stone-200/60 group-hover:scale-[1.02] transition-transform">
                    <span class="text-3xl mb-1.5 group-hover:scale-110 transition-transform">🤵</span>
                    <span class="font-serif text-xs font-semibold text-stone-800">The Groom</span>
                    <span class="text-[9px] text-stone-400 font-sans uppercase tracking-wider mt-0.5">Black-Tie Tuxedo</span>
                </div>
                <p class="text-[10px] font-serif italic text-stone-500 text-center mt-1.5">
                    "Ready for forever"
                </p>
            </div>

            <!-- Photo 4: Blessed Rings -->
            <div class="rounded-2xl border border-[#d8b878]/60 bg-[#faf8f4] p-2 sm:p-2.5 shadow-sm flex flex-col justify-between group overflow-hidden hover:border-[#c5a059] transition-all">
                <div class="w-full h-40 sm:h-48 rounded-xl bg-gradient-to-b from-stone-100 to-amber-50/50 flex flex-col items-center justify-center text-center p-3 border border-stone-200/60 group-hover:scale-[1.02] transition-transform">
                    <span class="text-3xl mb-1.5 group-hover:scale-110 transition-transform">💍</span>
                    <span class="font-serif text-xs font-semibold text-stone-800">Blessed Rings</span>
                    <span class="text-[9px] text-stone-400 font-sans uppercase tracking-wider mt-0.5">Sacred Vows</span>
                </div>
                <p class="text-[10px] font-serif italic text-stone-500 text-center mt-1.5">
                    "United in Christ"
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    weddingDate: { type: String, default: '2026-12-12 09:00:00' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
});

const calendarLink = computed(() => {
    try {
        const title = encodeURIComponent(`The Wedding of ${props.groomName} & ${props.brideName}`);
        const details = encodeURIComponent(`Holy Matrimony of ${props.groomName} & ${props.brideName} at St. Mary's Church, Negombo, Sri Lanka.`);
        const location = encodeURIComponent("St. Mary's Church, Grand Street, Negombo, Sri Lanka");
        return `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${title}&details=${details}&location=${location}`;
    } catch {
        return '#';
    }
});
</script>
