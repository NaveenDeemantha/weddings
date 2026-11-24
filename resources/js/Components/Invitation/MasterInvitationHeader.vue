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
            <p class="mt-2 font-display text-xs sm:text-sm tracking-[0.35em] text-[#ad2c51] font-bold">
                {{ t('header', 'holyMatrimony') }}
            </p>
            <p class="mt-1 font-serif italic text-lg sm:text-xl font-medium text-stone-900">
                {{ isSinhala ? 'දෙවියන් වහන්සේ ඉදිරියේ ප්‍රේමය සහ විශ්වාසය එක්තැන් කරමින්' : 'Together with their families' }}
            </p>

            <!-- 2. Couple's Names (Primary Focus) -->
            <h1 class="mt-3 sm:mt-4 font-serif font-bold text-[#ad2c51] leading-none text-5xl sm:text-6xl md:text-7xl lg:text-[5.2rem] tracking-wide drop-shadow-xs">
                {{ isSinhala ? t('header', 'groomName') : groomName }}
                <span class="block font-serif text-[#ad2c51] font-bold text-3xl sm:text-4xl my-1 sm:my-1.5" v-if="isSinhala">සහ</span>
                <span class="block font-script text-[#ad2c51] font-normal text-4xl sm:text-5xl lg:text-6xl my-1 sm:my-1.5" v-else>&amp;</span>
                {{ isSinhala ? t('header', 'brideName') : brideName }}
            </h1>

            <!-- 3. Couple Portrait Medallion -->
            <div class="relative w-64 h-64 sm:w-76 sm:h-76 lg:w-84 lg:h-84 flex items-center justify-center mx-auto my-3 sm:my-4">
                <!-- Gold outline floral blooms set to the BACK -->
                <FlowerCluster class="absolute -bottom-6 -left-8 w-28 sm:w-36 lg:w-44 opacity-75 pointer-events-none z-0" />
                <FlowerCluster class="absolute -top-6 -right-8 w-28 sm:w-36 lg:w-44 rotate-180 opacity-75 pointer-events-none z-0" />

                <!-- Rotating ring of golden sunburst petals behind the medallion (Hardware accelerated) -->
                <div class="absolute inset-0 ring-spin pointer-events-none z-0 [will-change:transform] [transform:translateZ(0)]">
                    <span
                        v-for="i in 18"
                        :key="i"
                        class="absolute left-1/2 top-1/2 block w-4 h-7 sm:w-5 sm:h-9 rounded-[50%_50%_46%_46%/88%_88%_14%_14%]"
                        :style="{
                            background: i % 3 === 0 ? 'linear-gradient(to top,#d8ab43,#f5dc8a)' : (i % 3 === 1 ? 'linear-gradient(to top,#e8c86d,#fff4d4)' : 'linear-gradient(to top,#f5dc8a,#fff)'),
                            border: '1px solid rgba(245,220,138,0.7)',
                            transform: `rotate(${i * 20}deg) translateY(calc(-1 * var(--r)))`,
                            transformOrigin: '0 0',
                            marginLeft: '-0.5rem'
                        }"
                    ></span>
                </div>

                <!-- Photo medallion in FRONT (Enlarged inner circle + closer zoom so couple is clearly visible) -->
                <div class="relative z-10 w-[78%] h-[78%] rounded-full overflow-hidden border-4 sm:border-[5px] border-white shadow-[0_16px_40px_rgba(216,171,67,.38)] ring-4 ring-[#d8ab43] bg-stone-100">
                    <img
                        src="/images/wedding/couple_portrait.jpg"
                        :alt="`${groomName} & ${brideName}`"
                        class="w-full h-full object-cover object-[center_20%] scale-135 contrast-[1.03] brightness-[1.02] select-none pointer-events-none transition-transform duration-500 hover:scale-140"
                    />
                    <!-- Subtle warm inner vignette to make the couple pop with depth -->
                    <div class="absolute inset-0 rounded-full shadow-[inset_0_0_18px_rgba(0,0,0,0.15)] pointer-events-none"></div>
                </div>
            </div>

            <!-- 4. Posh Invitee Presentation (Enlarged, Bold & High Visibility) -->
            <div class="my-3 sm:my-5 max-w-xl mx-auto text-center px-4">
                <div class="flex items-center justify-center gap-3 mb-2">
                    <span class="w-10 sm:w-16 h-[1.5px] bg-gradient-to-r from-transparent via-[#d8ab43] to-transparent"></span>
                    <p class="font-display text-xs sm:text-sm uppercase tracking-[0.35em] text-[#ad2c51] font-bold">
                        {{ t('header', 'cordiallyInviting') }}
                    </p>
                    <span class="w-10 sm:w-16 h-[1.5px] bg-gradient-to-l from-transparent via-[#d8ab43] to-transparent"></span>
                </div>
                <!-- Guest Name (Always Visible) -->
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-[2.6rem] text-stone-950 font-bold tracking-wide leading-tight drop-shadow-xs">
                    {{ isSinhala && (!guestName || guestName === 'Mr & Mrs Silva') ? 'ගරුකටයුතු අමුත්තන් සහ හිතවත් පවුලේ සැම' : (guestName || 'Respected Guest & Beloved Family') }}
                </h2>
                <!-- Custom Greeting / Salutation (shown as subtitle if set) -->
                <p v-if="guestGreeting && guestGreeting !== guestName" class="font-serif italic text-base sm:text-lg text-[#7A5B22] font-semibold mt-1">
                    {{ guestGreeting }}
                </p>
                <p class="font-serif italic text-sm sm:text-base text-stone-700 font-medium mt-1.5">
                    {{ t('header', 'requestBlessings') }}
                </p>
            </div>

            <!-- 5. Parents Section (Enlarged Bold Typography) -->
            <div class="mt-5 sm:mt-6 grid grid-cols-2 gap-4 sm:gap-6 max-w-lg mx-auto w-full text-center">
                <div class="border-r border-[#ad2c51]/30 pr-3 sm:pr-4">
                    <p class="font-display text-xs sm:text-sm tracking-[0.25em] text-[#ad2c51] font-bold uppercase">{{ t('header', 'sonOf') }}</p>
                    <p class="mt-1 font-serif text-lg sm:text-xl lg:text-2xl font-bold text-stone-950 leading-snug">{{ isSinhala ? t('header', 'groomParents') : displayGroomParents }}</p>
                </div>
                <div class="pl-3 sm:pl-4">
                    <p class="font-display text-xs sm:text-sm tracking-[0.25em] text-[#ad2c51] font-bold uppercase">{{ t('header', 'daughterOf') }}</p>
                    <p class="mt-1 font-serif text-lg sm:text-xl lg:text-2xl font-bold text-stone-950 leading-snug">{{ isSinhala ? t('header', 'brideParents') : brideParents }}</p>
                </div>
            </div>

            <!-- 6. Date & Time (High-Visibility Ribbons & Bold Numerals) -->
            <div class="mt-6 sm:mt-7 flex items-center justify-center gap-3 sm:gap-5">
                <span class="font-display text-sm sm:text-base tracking-[0.28em] text-[#ad2c51] font-bold border-y-2 border-[#ad2c51]/60 py-2 px-3 sm:px-4">
                    {{ isSinhala ? parsedDate.monthSi : parsedDate.monthEn }}
                </span>
                <span class="font-serif text-6xl sm:text-7xl font-bold text-[#ad2c51] leading-none">
                    {{ parsedDate.day }}
                </span>
                <span class="font-display text-sm sm:text-base tracking-[0.28em] text-[#ad2c51] font-bold border-y-2 border-[#ad2c51]/60 py-2 px-3 sm:px-4">
                    {{ parsedDate.year }}
                </span>
            </div>
            <p class="mt-2.5 font-display text-xs sm:text-sm tracking-[0.32em] text-stone-900 font-bold uppercase">
                {{ displayMassTime }}
            </p>

            <!-- 7. Scripture Verse (Larger, High Legibility) -->
            <p class="mt-6 sm:mt-7 font-serif italic text-lg sm:text-xl lg:text-[1.35rem] font-medium text-stone-900 max-w-xl mx-auto leading-relaxed px-2">
                {{ t('header', 'scriptureVerse') }}
            </p>
            <p class="mt-2 font-display text-xs sm:text-sm tracking-[0.35em] text-[#ad2c51] font-bold uppercase">{{ t('header', 'scriptureCitation') }}</p>

            <!-- Subtle Scroll Cue at the bottom of the hero -->
            <a
                href="#countdown"
                class="mt-8 inline-flex flex-col items-center justify-center gap-1.5 text-[#ad2c51] hover:text-[#8a2342] transition-colors group cursor-pointer select-none"
                title="Scroll down to explore"
            >
                <span class="font-display text-[10px] sm:text-[11px] uppercase tracking-[0.32em] font-bold">{{ t('header', 'scrollToExplore') }}</span>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#ad2c51] animate-bounce fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import FlowerCluster from '@/Components/Invitation/FlowerCluster.vue';
import { useLanguage } from '@/composables/useLanguage';

const { t, isSinhala, parseDateParts, formatTimeSinhala } = useLanguage();

const props = defineProps({
    guestName: { type: String, default: 'Mr & Mrs Silva' },
    guestGreeting: { type: String, default: '' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
    brideParents: { type: String, default: 'Mr. Lalith Fernando & Mrs. Priska Pieris' },
    groomParents: { type: String, default: '(Late) Mr. Sumith Rodrigo & Mrs. Banduwathi' },
    weddingDate: { type: String, default: '2026-12-29 16:00:00' },
    churchTime: { type: String, default: '4:00 PM' },
    events: { type: Array, default: () => [] },
});

const parsedDate = computed(() => parseDateParts(props.weddingDate));

const displayGroomParents = computed(() => {
    if (isSinhala.value) {
        return t('header', 'groomParents');
    }
    const raw = props.groomParents || t('header', 'groomParents');
    if (raw && !raw.toLowerCase().includes('late')) {
        return `(Late) ${raw}`;
    }
    return raw;
});

const displayMassTime = computed(() => {
    const massEvent = props.events?.find(e => (e.name || '').toLowerCase().includes('mass')) || props.events?.[0];
    const rawTime = props.churchTime || massEvent?.time || '4:00 PM';
    if (!isSinhala.value) {
        return `${parsedDate.value.dayOfWeekEn} · ${rawTime}`;
    }
    return `${parsedDate.value.dayOfWeekSi} · ${formatTimeSinhala(rawTime)}`;
});
</script>

<style scoped>
.ring-spin { --r: 6.4rem; animation: spin 70s linear infinite; }
@media (min-width: 640px) { .ring-spin { --r: 7.6rem; } }
@media (min-width: 1024px) { .ring-spin { --r: 8.4rem; } }
@keyframes spin { to { transform: rotate(360deg); } }
</style>


