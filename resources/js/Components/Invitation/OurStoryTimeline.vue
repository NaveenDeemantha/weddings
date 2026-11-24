<template>
    <div id="story" class="relative my-10 sm:my-16 scroll-mt-10 px-5 sm:px-8 lg:px-12">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-10 lg:gap-16 items-start">
            <!-- Left: invitation wording -->
            <div class="text-center lg:text-left lg:sticky lg:top-10">
                <p class="font-display text-sm sm:text-base tracking-[0.35em] font-semibold text-gold-600">OUR STORY</p>
                <h2 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-semibold text-[#ad2c51] mt-2 leading-tight">Two Hearts,<br class="hidden lg:block" /> One Faith</h2>
                <div class="lg:[&>button]:mx-0"><FlowerDivider /></div>

                <p class="font-serif text-xl sm:text-2xl text-stone-800 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    We are delighted to invite you to the church as we exchange our vows before God and the people we love. Your presence and your prayers will make our special day even more memorable.
                </p>

                <p class="mt-7 font-serif italic text-2xl sm:text-3xl font-semibold text-[#ad2c51]">Tuesday, 29th December 2026</p>
                <p class="mt-2 font-serif italic text-lg sm:text-xl text-stone-700 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Together with their families request the honour of your presence at the Wedding Mass and at the celebration of their marriage.
                </p>

                <div class="mt-7 inline-block py-4 px-8 rounded-2xl bg-[#faf8f2] border-2 border-[#d8ab43]/50 shadow-md hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                    <h4 class="font-serif font-bold text-lg sm:text-xl tracking-wider text-[#ad2c51] uppercase">St. Sebastian's Church</h4>
                    <p class="font-display text-sm tracking-[0.25em] font-semibold text-gold-600 mt-1">MORATUWA, SRI LANKA</p>
                </div>
            </div>

            <!-- Right: journey timeline -->
            <div>
                <p class="text-center lg:text-left font-display text-sm sm:text-base tracking-[0.35em] font-semibold text-gold-600 mb-6">A JOURNEY TOGETHER</p>
                <div class="relative border-l-2 border-[#d8ab43]/50 ml-14 sm:ml-16 pl-6 sm:pl-8 space-y-5">
                    <div
                        v-for="m in milestones"
                        :key="m.year"
                        class="milestone relative p-5 rounded-2xl bg-[#faf8f2] border shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-[#ad2c51]"
                        :class="m.last ? 'border-[#ad2c51] bg-white shadow-md' : 'border-[#d8ab43]/40'"
                    >
                        <span class="absolute -left-[4.9rem] sm:-left-[5.4rem] top-4 font-serif italic font-bold text-xl text-[#ad2c51] w-14 text-right">{{ m.year }}</span>
                        <span class="absolute -left-[2.2rem] sm:-left-[2.65rem] top-5 w-5 h-5 rounded-full border-2 border-white shadow bg-[#ad2c51] flex items-center justify-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                        </span>
                        <h4 class="font-display font-bold text-base tracking-[0.15em] text-[#ad2c51] uppercase">{{ m.title }}</h4>
                        <p class="font-serif text-lg sm:text-xl text-stone-800 mt-1 leading-relaxed">{{ m.text }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Countdown -->
        <div class="max-w-3xl mx-auto mt-16 sm:mt-20 text-center">
            <p class="font-display text-sm sm:text-base tracking-[0.35em] font-semibold text-gold-600">THE BIG DAY AWAITS</p>
            <h3 class="font-serif text-4xl sm:text-5xl font-semibold text-[#ad2c51] mt-2">Counting Down</h3>
            <FlowerDivider />

            <div class="grid grid-cols-4 gap-3 sm:gap-5 max-w-xl lg:max-w-3xl mx-auto mt-6">
                <div
                    v-for="u in units"
                    :key="u.label"
                    class="count-card p-3 sm:p-5 lg:p-7 rounded-3xl bg-gradient-to-b from-white to-[#faf6ec] border-2 border-[#d8ab43]/50 shadow-md flex flex-col items-center hover:-translate-y-2 hover:shadow-xl transition-all duration-300"
                >
                    <span class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-[#ad2c51] leading-none tabular-nums">{{ String(timeLeft[u.key]).padStart(2, '0') }}</span>
                    <span class="font-display text-xs sm:text-sm tracking-[0.2em] font-semibold text-stone-700 mt-3 uppercase">{{ u.label }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import FlowerDivider from '@/Components/Invitation/FlowerDivider.vue';

const props = defineProps({
    weddingDate: { type: String, default: '2026-12-29 09:00:00' },
});

const milestones = [
    { year: '2019', title: 'The Beginning', text: 'Two paths crossed on an ordinary day, and somehow nothing felt ordinary after that.' },
    { year: '2021', title: 'Growing Together', text: 'Through seasons of laughter and quiet moments alike, a friendship blossomed into something deeper.' },
    { year: '2023', title: 'The Promise', text: 'Under a sky full of stars, one question changed everything, and the answer was yes.' },
    { year: '2025', title: 'Building a Home', text: 'Side by side, we turned shared dreams into plans and plans into a life we cherish.' },
    { year: '2026', title: 'Forever Begins', text: 'Now, surrounded by the people we love, we are ready for our most beautiful chapter yet: becoming husband and wife.', last: true },
];

const units = [
    { key: 'days', label: 'Days' },
    { key: 'hours', label: 'Hours' },
    { key: 'minutes', label: 'Minutes' },
    { key: 'seconds', label: 'Seconds' },
];

const timeLeft = ref({ days: 0, hours: 0, minutes: 0, seconds: 0 });
let timer = null;

const calculateTime = () => {
    const target = new Date(props.weddingDate.replace(/-/g, '/')).getTime();
    const diff = target - new Date().getTime();

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
};

onMounted(() => {
    calculateTime();
    timer = setInterval(calculateTime, 1000);
});

onUnmounted(() => {
    if (timer) clearInterval(timer);
});
</script>
