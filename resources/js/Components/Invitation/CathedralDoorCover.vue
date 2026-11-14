<template>
    <div
        v-if="!hasFinishedIntro"
        class="fixed inset-0 z-50 overflow-y-auto bg-[#0e1622] transition-opacity duration-700"
        :class="{ 'opacity-0 pointer-events-none': isFadingOut }"
    >
        <!-- Cathedral nave background (blurred so the low-res photo stays elegant on large screens) -->
        <div class="fixed inset-0">
            <div
                class="absolute -inset-6 bg-cover bg-center blur-md scale-110"
                style="background-image: url('/images/wedding/cathedral_aisle_clean.jpg');"
            ></div>
            <div class="absolute inset-0 bg-gradient-to-b from-[#0e1622]/70 via-[#0e1622]/45 to-[#0e1622]/85"></div>
        </div>

        <!-- Petals -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden">
            <div
                v-for="i in 18"
                :key="i"
                class="absolute w-2.5 h-2.5 bg-white/80 rounded-full animate-fall"
                :style="{ left: (i * 5.4) + '%', animationDuration: (6 + (i % 4)) + 's', animationDelay: ((i % 7) * 0.5) + 's' }"
            ></div>
        </div>

        <div class="relative min-h-full flex items-center justify-center px-4 py-8">
            <!-- Arched invitation panel -->
            <div
                class="relative w-full max-w-[440px] lg:max-w-[520px] bg-[#fbf7ee] rounded-t-[220px] rounded-b-3xl border-[3px] border-[#c5a059] shadow-[0_30px_80px_rgba(0,0,0,0.6)] transition-all duration-1000 ease-in-out"
                :class="isOpening ? 'scale-110 opacity-0' : 'scale-100 opacity-100'"
            >
                <!-- inner gold hairline -->
                <div class="absolute inset-2.5 rounded-t-[208px] rounded-b-2xl border border-[#c5a059]/60 pointer-events-none"></div>

                <div class="relative px-8 sm:px-12 pt-24 sm:pt-28 pb-12 text-center">
                    <p class="font-display text-sm sm:text-base tracking-[0.35em] text-[#8c6d37] font-semibold">THE WEDDING OF</p>
                    <div class="my-3 text-[#a7823b] text-2xl">✝</div>

                    <h1 class="font-serif text-[#15253b] font-semibold leading-tight text-4xl sm:text-5xl lg:text-6xl">
                        {{ groomName }}
                        <span class="block font-script text-[#a7823b] font-normal text-4xl sm:text-5xl my-1">&amp;</span>
                        {{ brideName }}
                    </h1>

                    <p class="mt-5 font-serif text-xl sm:text-2xl text-stone-800 font-medium italic">Saturday, 12th December 2026</p>
                    <p class="mt-1 font-display text-xs sm:text-sm tracking-[0.25em] text-stone-700">ST. MARY'S CHURCH · NEGOMBO</p>

                    <div class="mx-auto my-7 h-px w-24 bg-gradient-to-r from-transparent via-[#c5a059] to-transparent"></div>

                    <p class="font-display text-xs sm:text-sm tracking-[0.3em] text-[#8c6d37] font-semibold">WITH LOVE, TO</p>
                    <p class="mt-2 font-serif text-2xl sm:text-3xl font-semibold text-[#15253b] leading-snug break-words">
                        {{ guestGreeting || guestName || 'Respected Guest' }}
                    </p>

                    <button
                        type="button"
                        @click="openInvitation"
                        class="mt-8 inline-flex items-center justify-center gap-3 px-10 py-4 rounded-full bg-[#15253b] hover:bg-[#0d1825] text-[#f8ecc9] font-display text-sm sm:text-base tracking-[0.25em] font-semibold shadow-xl border border-[#c5a059] transition-all active:scale-95 cursor-pointer"
                    >
                        OPEN INVITATION
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
    guestName: { type: String, default: 'Respected Guest' },
    guestGreeting: { type: String, default: '' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
});

const emit = defineEmits(['opened']);

const isOpening = ref(false);
const isFadingOut = ref(false);
const hasFinishedIntro = ref(false);

const openInvitation = () => {
    isOpening.value = true;
    emit('opened');
    setTimeout(() => { isFadingOut.value = true; }, 700);
    setTimeout(() => { hasFinishedIntro.value = true; }, 1400);
};
</script>

<style scoped>
@keyframes fall {
    0% { transform: translateY(-20px); opacity: 0; }
    15% { opacity: .85; }
    100% { transform: translateY(105vh) translateX(30px); opacity: 0; }
}
.animate-fall { animation-name: fall; animation-timing-function: linear; animation-iteration-count: infinite; }
</style>
