<template>
    <div id="countdown" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10 text-center">
        <!-- Header -->
        <div class="max-w-3xl mx-auto mb-6 text-center">
            <p class="font-sans text-xs sm:text-sm uppercase tracking-[0.3em] font-semibold text-gold-700">
                The Big Day Awaits
            </p>
            <h2 class="font-serif text-2xl sm:text-4xl font-semibold text-[#ad2c51] mt-1">
                Counting Down
            </h2>
            <FlowerDivider />
        </div>

        <!-- 4 Rounded Squircle Countdown Cards -->
        <div class="grid grid-cols-4 gap-2.5 sm:gap-4 md:gap-6 max-w-md sm:max-w-xl lg:max-w-2xl mx-auto">
            <div
                v-for="u in units"
                :key="u.label"
                class="p-3 sm:p-5 rounded-2xl sm:rounded-3xl bg-gradient-to-b from-white to-[#faf6ec] border border-[#d8ab43]/50 shadow-sm flex flex-col items-center hover:-translate-y-1.5 hover:shadow-lg hover:border-[#d8ab43] transition-all duration-300"
            >
                <span class="font-serif text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-[#ad2c51] leading-none tabular-nums">
                    {{ String(timeLeft[u.key]).padStart(2, '0') }}
                </span>
                <span class="font-display text-[9.5px] sm:text-xs tracking-[0.2em] font-semibold text-stone-700 mt-2 sm:mt-3 uppercase">
                    {{ u.label }}
                </span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import FlowerDivider from '@/Components/Invitation/FlowerDivider.vue';

const props = defineProps({
    weddingDate: {
        type: String,
        default: '2026-12-29 16:00:00',
    },
});

const units = [
    { key: 'days', label: 'Days' },
    { key: 'hours', label: 'Hours' },
    { key: 'minutes', label: 'Minutes' },
    { key: 'seconds', label: 'Seconds' },
];

const timeLeft = ref({ days: 0, hours: 0, minutes: 0, seconds: 0 });
let timer = null;

const calculateTime = () => {
    try {
        const target = new Date(props.weddingDate.replace(/-/g, '/')).getTime();
        const now = new Date().getTime();
        const diff = target - now;

        if (diff <= 0) {
            timeLeft.value = { days: 0, hours: 0, minutes: 0, seconds: 0 };
            return;
        }

        timeLeft.value = {
            days: Math.floor(diff / (1000 * 60 * 60 * 24)),
            hours: Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
            minutes: Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)),
            seconds: Math.floor((diff % (1000 * 60)) / 1000),
        };
    } catch (e) {
        timeLeft.value = { days: 0, hours: 0, minutes: 0, seconds: 0 };
    }
};

onMounted(() => {
    calculateTime();
    timer = setInterval(calculateTime, 1000);
});

onUnmounted(() => {
    if (timer) clearInterval(timer);
});
</script>
