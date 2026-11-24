<template>
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-30 select-none" aria-hidden="true">
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
            <svg v-if="p.shape === 0" viewBox="0 0 24 24" class="w-full h-full">
                <path d="M12 2 C8 4 4 9 5 15 C5.5 19 9 22 12 22 C15 22 18.5 19 19 15 C20 9 16 4 12 2 Z" :fill="p.color" />
                <path d="M12 5 C11.8 10 11.8 15 12 19" stroke="rgba(255,255,255,0.45)" stroke-width="0.8" stroke-linecap="round" fill="none" />
            </svg>

            <!-- Petal Shape 2: Curved Breezy Petal -->
            <svg v-else-if="p.shape === 1" viewBox="0 0 24 24" class="w-full h-full">
                <path d="M12 2 C6 5 4 12 7 17 C9.5 21 14 22 17 19 C20 16 20 10 17 6 C15.5 4 13.5 2.5 12 2 Z" :fill="p.color" />
                <path d="M12 4 C11 9 12 14 15 18" stroke="rgba(255,255,255,0.4)" stroke-width="0.75" stroke-linecap="round" fill="none" />
            </svg>

            <!-- Petal Shape 3: Slender Araliya / Blossom Petal -->
            <svg v-else viewBox="0 0 24 24" class="w-full h-full">
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
    // Responsive count: ~14 on mobile to prevent GPU lag, ~22 on desktop
    const isMobile = typeof window !== 'undefined' && window.innerWidth < 768;
    const count = isMobile ? 14 : 22;

    petals.value = Array.from({ length: count }, (_, i) => ({
        id: i,
        shape: i % 3,
        left: Math.random() * 94 + 3,
        duration: Math.random() * 6 + 11, // 11s to 17s fall duration for gentle drift
        delay: -(Math.random() * 15), // Negative delay so petals are already falling across the screen
        size: Math.random() * 6 + 11, // Delicate size: 11px to 17px
        opacity: Math.random() * 0.35 + 0.55,
        color: petalPalette[i % petalPalette.length],
        animType: i % 3,
    }));
});
</script>

<style scoped>
.petal {
    contain: layout paint;
    will-change: transform;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    backface-visibility: hidden;
    transform: translateZ(0);
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
        transform: translate3d(0, -30px, 0) rotate(0deg);
    }
    25% {
        transform: translate3d(28px, 28vh, 0) rotate(80deg);
    }
    50% {
        transform: translate3d(-20px, 55vh, 0) rotate(160deg);
    }
    75% {
        transform: translate3d(24px, 82vh, 0) rotate(250deg);
    }
    100% {
        transform: translate3d(-10px, 108vh, 0) rotate(360deg);
    }
}

@keyframes drift-sway-2 {
    0% {
        transform: translate3d(0, -30px, 0) rotate(20deg);
    }
    25% {
        transform: translate3d(-25px, 26vh, 0) rotate(95deg);
    }
    50% {
        transform: translate3d(30px, 52vh, 0) rotate(180deg);
    }
    75% {
        transform: translate3d(-18px, 78vh, 0) rotate(270deg);
    }
    100% {
        transform: translate3d(15px, 108vh, 0) rotate(390deg);
    }
}

@keyframes drift-sway-3 {
    0% {
        transform: translate3d(0, -30px, 0) rotate(-15deg);
    }
    30% {
        transform: translate3d(22px, 32vh, 0) rotate(70deg);
    }
    60% {
        transform: translate3d(-28px, 62vh, 0) rotate(190deg);
    }
    85% {
        transform: translate3d(18px, 88vh, 0) rotate(290deg);
    }
    100% {
        transform: translate3d(-5px, 108vh, 0) rotate(380deg);
    }
}
</style>
