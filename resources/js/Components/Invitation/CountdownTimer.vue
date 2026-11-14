<template>
    <div class="w-full max-w-xl mx-auto my-6 sm:my-8 px-2 sm:px-4">
        <div class="relative bg-[#ffffff] rounded-2xl p-4 sm:p-8 border border-[#d8b878]/60 shadow-sm text-center">
            <!-- Header -->
            <p class="text-sm sm:text-base uppercase tracking-[0.2em] sm:tracking-[0.25em] font-sans font-semibold text-gold-700 mb-1">
                Solemn Celebration In
            </p>
            <h3 class="font-serif text-lg sm:text-2xl text-stone-900 font-normal mb-4 sm:mb-6 leading-tight">
                {{ targetDateFormatted }}
            </h3>

            <!-- Timer Grid with fine serif typography -->
            <div class="grid grid-cols-4 gap-1.5 sm:gap-4">
                <div class="flex flex-col items-center bg-[#faf8f4] rounded-xl py-2.5 px-1 sm:p-4 border border-[#e5dfcd]">
                    <span class="font-serif text-xl sm:text-4xl font-normal text-stone-900 leading-none">
                        {{ timeLeft.days }}
                    </span>
                    <span class="text-[11px] sm:text-base uppercase tracking-wider font-sans font-semibold text-stone-700 mt-1">
                        Days
                    </span>
                </div>

                <div class="flex flex-col items-center bg-[#faf8f4] rounded-xl py-2.5 px-1 sm:p-4 border border-[#e5dfcd]">
                    <span class="font-serif text-xl sm:text-4xl font-normal text-stone-900 leading-none">
                        {{ timeLeft.hours }}
                    </span>
                    <span class="text-[11px] sm:text-base uppercase tracking-wider font-sans font-semibold text-stone-700 mt-1">
                        Hours
                    </span>
                </div>

                <div class="flex flex-col items-center bg-[#faf8f4] rounded-xl py-2.5 px-1 sm:p-4 border border-[#e5dfcd]">
                    <span class="font-serif text-xl sm:text-4xl font-normal text-stone-900 leading-none">
                        {{ timeLeft.minutes }}
                    </span>
                    <span class="text-[11px] sm:text-base uppercase tracking-wider font-sans font-semibold text-stone-700 mt-1">
                        Mins
                    </span>
                </div>

                <div class="flex flex-col items-center bg-[#faf8f4] rounded-xl py-2.5 px-1 sm:p-4 border border-[#e5dfcd]">
                    <span class="font-serif text-xl sm:text-4xl font-normal text-stone-900 leading-none">
                        {{ timeLeft.seconds }}
                    </span>
                    <span class="text-[11px] sm:text-base uppercase tracking-wider font-sans font-semibold text-stone-700 mt-1">
                        Secs
                    </span>
                </div>
            </div>

            <p class="mt-4 sm:mt-5 text-[11px] sm:text-base text-stone-700 font-serif italic px-2">
                "Two lives, two hearts, joined together in friendship, united forever in Christ."
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    weddingDate: { type: String, default: '2026-12-19 15:30:00' },
});

const timeLeft = ref({ days: 0, hours: 0, minutes: 0, seconds: 0 });
let timer = null;

const targetDateFormatted = computed(() => {
    try {
        const d = new Date(props.weddingDate.replace(/-/g, '/'));
        return d.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    } catch (e) {
        return props.weddingDate;
    }
});

const calculateTime = () => {
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
};

onMounted(() => {
    calculateTime();
    timer = setInterval(calculateTime, 1000);
});

onUnmounted(() => {
    if (timer) clearInterval(timer);
});
</script>
