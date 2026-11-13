<template>
    <div class="w-full max-w-xl mx-auto my-8 px-4">
        <div class="relative bg-gradient-to-b from-amber-50/90 to-yellow-50/80 rounded-2xl p-6 sm:p-8 border border-amber-300 shadow-md text-center">
            <!-- Decorative Header -->
            <p class="text-xs uppercase tracking-widest font-semibold text-amber-700 mb-1">
                Counting Down To The Big Day
            </p>
            <h3 class="font-serif text-xl sm:text-2xl text-stone-800 font-bold mb-6">
                {{ targetDateFormatted }}
            </h3>

            <!-- Timer Grid -->
            <div class="grid grid-cols-4 gap-2 sm:gap-4">
                <div class="flex flex-col items-center bg-white/95 rounded-xl p-3 sm:p-4 shadow-sm border border-amber-200">
                    <span class="font-display text-2xl sm:text-4xl font-extrabold text-amber-700">
                        {{ timeLeft.days }}
                    </span>
                    <span class="text-[10px] sm:text-xs uppercase tracking-wider font-medium text-stone-500 mt-1">
                        Days
                    </span>
                </div>

                <div class="flex flex-col items-center bg-white/95 rounded-xl p-3 sm:p-4 shadow-sm border border-amber-200">
                    <span class="font-display text-2xl sm:text-4xl font-extrabold text-amber-700">
                        {{ timeLeft.hours }}
                    </span>
                    <span class="text-[10px] sm:text-xs uppercase tracking-wider font-medium text-stone-500 mt-1">
                        Hours
                    </span>
                </div>

                <div class="flex flex-col items-center bg-white/95 rounded-xl p-3 sm:p-4 shadow-sm border border-amber-200">
                    <span class="font-display text-2xl sm:text-4xl font-extrabold text-amber-700">
                        {{ timeLeft.minutes }}
                    </span>
                    <span class="text-[10px] sm:text-xs uppercase tracking-wider font-medium text-stone-500 mt-1">
                        Mins
                    </span>
                </div>

                <div class="flex flex-col items-center bg-white/95 rounded-xl p-3 sm:p-4 shadow-sm border border-amber-200">
                    <span class="font-display text-2xl sm:text-4xl font-extrabold text-amber-700">
                        {{ timeLeft.seconds }}
                    </span>
                    <span class="text-[10px] sm:text-xs uppercase tracking-wider font-medium text-stone-500 mt-1">
                        Secs
                    </span>
                </div>
            </div>

            <!-- Auspicious Quote -->
            <p class="mt-5 text-xs text-stone-600 font-serif italic">
                "Together is a beautiful place to be."
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    weddingDate: { type: String, default: '2026-12-18 10:30:00' },
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

