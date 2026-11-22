<template>
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-30 select-none">
        <div
            v-for="p in petals"
            :key="p.id"
            class="petal absolute"
            :class="`drift-${p.animType}`"
            :style="{
                left: p.left + '%',
                top: '-25px',
                width: p.size + 'px',
                height: p.size + 'px',
                animationDuration: p.duration + 's',
                animationDelay: p.delay + 's',
                opacity: p.opacity,
            }"
        >
            <!-- Petal Shape 1: Classic Curved Rose Petal -->
            <svg v-if="p.shape === 0" viewBox="0 0 24 24" class="w-full h-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.12)]">
                <path d="M12 2 C8 4 4 9 5 15 C5.5 19 9 22 12 22 C15 22 18.5 19 19 15 C20 9 16 4 12 2 Z" :fill="p.color" />
                <path d="M12 5 C11.8 10 11.8 15 12 19" stroke="rgba(255,255,255,0.45)" stroke-width="0.8" stroke-linecap="round" fill="none" />
            </svg>

            <!-- Petal Shape 2: Curved Breezy Petal -->
            <svg v-else-if="p.shape === 1" viewBox="0 0 24 24" class="w-full h-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.12)]">
                <path d="M12 2 C6 5 4 12 7 17 C9.5 21 14 22 17 19 C20 16 20 10 17 6 C15.5 4 13.5 2.5 12 2 Z" :fill="p.color" />
                <path d="M12 4 C11 9 12 14 15 18" stroke="rgba(255,255,255,0.4)" stroke-width="0.75" stroke-linecap="round" fill="none" />
            </svg>

            <!-- Petal Shape 3: Slender Araliya / Blossom Petal -->
            <svg v-else viewBox="0 0 24 24" class="w-full h-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.12)]">
                <path d="M12 2 C9 5 7 10 8 16 C8.5 19.5 10.5 22 12 22 C13.5 22 15.5 19.5 16 16 C17 10 15 5 12 2 Z" :fill="p.color" />
                <path d="M12 5 L12 18" stroke="rgba(255,255,255,0.5)" stroke-width="0.75" stroke-linecap="round" fill="none" />
            </svg>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const petals = ref([]);

// Wedding palette: blush rose, warm petal pink, gold foil accent, deep rose & pearl ivory
const petalPalette = [
    '#ffb8c6', // Soft blush pink
    '#fecdd3', // Pastel rose
    '#fda4af', // Warm rose
    '#f5dc8a', // Champagne gold
    '#e8c86d', // Warm gold
    '#ad2c51', // Burgundy rose accent
    '#c8636f', // Deep blush
    '#fff7ed', // Ivory pearl
    '#ffccd5', // Petal pink
];

onMounted(() => {
    // Generate ~34 small, delicate petals
    petals.value = Array.from({ length: 34 }, (_, i) => ({
        id: i,
        shape: i % 3,
        left: Math.random() * 96 + 2,
        duration: Math.random() * 6 + 10, // 10s to 16s fall duration for gentle drift
        delay: -(Math.random() * 14), // Negative delay so petals are already falling across the screen on load
        size: Math.random() * 7 + 10, // Small delicate size: 10px to 17px
        opacity: Math.random() * 0.35 + 0.55, // 0.55 to 0.9 opacity for crisp visibility
        color: petalPalette[i % petalPalette.length],
        animType: i % 3,
    }));
});
</script>

<style scoped>
.petal {
    will-change: transform, opacity;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

.drift-0 {
    animation-name: drift-sway-1;
}

.drift-1 {
    animation-name: drift-sway-2;
}

.drift-2 {
    animation-name: drift-sway-3;
}

@keyframes drift-sway-1 {
    0% {
        transform: translate3d(0, -30px, 0) rotate(0deg) rotateX(0deg) rotateY(0deg);
    }
    25% {
        transform: translate3d(35px, 28vh, 0) rotate(80deg) rotateX(45deg) rotateY(60deg);
    }
    50% {
        transform: translate3d(-25px, 55vh, 0) rotate(160deg) rotateX(75deg) rotateY(120deg);
    }
    75% {
        transform: translate3d(30px, 82vh, 0) rotate(250deg) rotateX(35deg) rotateY(180deg);
    }
    100% {
        transform: translate3d(-10px, 108vh, 0) rotate(360deg) rotateX(90deg) rotateY(270deg);
    }
}

@keyframes drift-sway-2 {
    0% {
        transform: translate3d(0, -30px, 0) rotate(20deg) rotateX(30deg) rotateY(0deg);
    }
    25% {
        transform: translate3d(-30px, 26vh, 0) rotate(95deg) rotateX(60deg) rotateY(70deg);
    }
    50% {
        transform: translate3d(35px, 52vh, 0) rotate(180deg) rotateX(40deg) rotateY(140deg);
    }
    75% {
        transform: translate3d(-20px, 78vh, 0) rotate(270deg) rotateX(80deg) rotateY(210deg);
    }
    100% {
        transform: translate3d(15px, 108vh, 0) rotate(390deg) rotateX(45deg) rotateY(300deg);
    }
}

@keyframes drift-sway-3 {
    0% {
        transform: translate3d(0, -30px, 0) rotate(-15deg) rotateX(0deg) rotateY(30deg);
    }
    30% {
        transform: translate3d(25px, 32vh, 0) rotate(70deg) rotateX(50deg) rotateY(90deg);
    }
    60% {
        transform: translate3d(-35px, 62vh, 0) rotate(190deg) rotateX(35deg) rotateY(160deg);
    }
    85% {
        transform: translate3d(20px, 88vh, 0) rotate(290deg) rotateX(65deg) rotateY(230deg);
    }
    100% {
        transform: translate3d(-5px, 108vh, 0) rotate(380deg) rotateX(80deg) rotateY(320deg);
    }
}
</style>
