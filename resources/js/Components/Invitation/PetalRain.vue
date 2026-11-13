<template>
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-10">
        <div
            v-for="petal in petals"
            :key="petal.id"
            class="petal absolute select-none"
            :style="{
                left: petal.left + '%',
                top: '-30px',
                animationDuration: petal.duration + 's',
                animationDelay: petal.delay + 's',
                transform: `scale(${petal.scale}) rotate(${petal.rotation}deg)`,
                opacity: petal.opacity,
            }"
        >
            <!-- Marigold / Gold leaf petal SVG -->
            <svg
                v-if="petal.type === 'marigold'"
                class="w-5 h-5 text-amber-500 drop-shadow-sm"
                viewBox="0 0 24 24"
                fill="currentColor"
            >
                <path d="M12 2C8 6 6 10 6 14a6 6 0 0 0 12 0c0-4-2-8-6-12z" />
            </svg>
            <!-- Golden sparkle -->
            <svg
                v-else-if="petal.type === 'sparkle'"
                class="w-4 h-4 text-yellow-400 drop-shadow-sm"
                viewBox="0 0 24 24"
                fill="currentColor"
            >
                <path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z" />
            </svg>
            <!-- Rose petal -->
            <svg
                v-else
                class="w-5 h-5 text-rose-400 drop-shadow-sm"
                viewBox="0 0 24 24"
                fill="currentColor"
            >
                <path d="M12 3c-3 4-5 7-5 10a5 5 0 0 0 10 0c0-3-2-6-5-10z" />
            </svg>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const petals = ref([]);

onMounted(() => {
    const types = ['marigold', 'sparkle', 'rose', 'marigold'];
    const generated = [];
    for (let i = 0; i < 22; i++) {
        generated.push({
            id: i,
            left: Math.random() * 96 + 2,
            duration: Math.random() * 8 + 8, // 8-16s
            delay: Math.random() * 8,
            scale: Math.random() * 0.5 + 0.6, // 0.6 - 1.1
            rotation: Math.random() * 360,
            opacity: Math.random() * 0.4 + 0.35,
            type: types[i % types.length],
        });
    }
    petals.value = generated;
});
</script>

<style scoped>
.petal {
    animation-name: fallDown;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@keyframes fallDown {
    0% {
        transform: translateY(-20px) rotate(0deg) translateX(0);
    }
    30% {
        transform: translateY(30vh) rotate(90deg) translateX(25px);
    }
    60% {
        transform: translateY(65vh) rotate(200deg) translateX(-20px);
    }
    100% {
        transform: translateY(105vh) rotate(360deg) translateX(30px);
    }
}
</style>

