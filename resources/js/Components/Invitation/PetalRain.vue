<template>
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-10">
        <div
            v-for="p in petals"
            :key="p.id"
            class="petal absolute"
            :style="{ left: p.left + '%', top: '-30px', animationDuration: p.duration + 's', animationDelay: p.delay + 's', opacity: p.opacity }"
        >
            <svg :style="{ width: p.size + 'px', height: p.size + 'px' }" viewBox="0 0 24 24" class="drop-shadow-sm">
                <path d="M12 2C7 6 5 11 6 16c1 4 11 4 12 0 1-5-1-10-6-14z" :fill="p.color" />
                <path d="M12 6c-1 3-1 7 0 11" stroke="#fff" stroke-opacity=".5" stroke-width=".8" fill="none" />
            </svg>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const petals = ref([]);
const colors = ['#F678A4', '#ffffff', '#C8636F', '#fbb1cb', '#ffffff', '#ffd9e6'];

onMounted(() => {
    petals.value = Array.from({ length: 22 }, (_, i) => ({
        id: i,
        left: Math.random() * 96 + 2,
        duration: Math.random() * 8 + 11,
        delay: Math.random() * 10,
        size: Math.random() * 12 + 14,
        opacity: Math.random() * 0.35 + 0.5,
        color: colors[i % colors.length],
    }));
});
</script>

<style scoped>
.petal { animation-name: drift; animation-iteration-count: infinite; animation-timing-function: linear; }
@keyframes drift {
    0%   { transform: translate(0, -20px) rotate(0deg); }
    25%  { transform: translate(40px, 28vh) rotate(110deg); }
    50%  { transform: translate(-30px, 55vh) rotate(220deg); }
    75%  { transform: translate(35px, 82vh) rotate(300deg); }
    100% { transform: translate(-10px, 108vh) rotate(380deg); }
}
</style>
