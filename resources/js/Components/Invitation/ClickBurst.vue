<template>
    <span
        v-for="b in bursts"
        :key="b.id"
        class="cb-petal pointer-events-none fixed z-[80]"
        :style="{ left: b.x + 'px', top: b.y + 'px', '--dx': b.dx + 'px', '--dy': b.dy + 'px', '--rot': b.rot + 'deg', background: b.color, width: b.s + 'px', height: b.s * 1.4 + 'px' }"
    ></span>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const bursts = ref([]);
let id = 0;
let lastSpawn = 0;
const colors = ['#ffffff', '#fffef7', '#f5dc8a', '#e8c86d', '#fff9e6'];

const spawn = (x, y, count = 8) => {
    const now = Date.now();
    if (now - lastSpawn < 180) return; // Throttle fast clicks to protect low-end mobile devices
    lastSpawn = now;

    // Cap total particles on screen to at most 18
    if (bursts.value.length > 18) {
        bursts.value = bursts.value.slice(-9);
    }

    const actualCount = Math.min(count, 8);
    const fresh = Array.from({ length: actualCount }, () => {
        const a = Math.random() * Math.PI * 2;
        const d = 50 + Math.random() * 90;
        return {
            id: ++id,
            x,
            y,
            dx: Math.cos(a) * d,
            dy: Math.sin(a) * d + 40,
            rot: Math.random() * 400 - 200,
            s: 7 + Math.random() * 7,
            color: colors[Math.floor(Math.random() * colors.length)],
        };
    });

    bursts.value.push(...fresh);
    setTimeout(() => {
        bursts.value = bursts.value.filter((b) => !fresh.includes(b));
    }, 1100);
};

const onClick = (e) => {
    if (e.target.closest && e.target.closest('[data-no-burst]')) return;
    spawn(e.clientX, e.clientY, 6);
};

const onCustom = (e) => spawn(e.detail.x, e.detail.y, e.detail.count || 12);

onMounted(() => {
    window.addEventListener('click', onClick, { passive: true });
    window.addEventListener('bloom-burst', onCustom, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('click', onClick);
    window.removeEventListener('bloom-burst', onCustom);
});
</script>

<style scoped>
.cb-petal {
    border-radius: 50% 50% 46% 46% / 88% 88% 14% 14%;
    animation: cb 1.1s cubic-bezier(.2,.7,.3,1) forwards;
    contain: layout paint;
    will-change: transform, opacity;
    backface-visibility: hidden;
    transform: translateZ(0);
}
@keyframes cb {
    0% { transform: translate(-50%, -50%) scale(.4) rotate(0); opacity: 1; }
    100% { transform: translate(calc(-50% + var(--dx)), calc(-50% + var(--dy))) scale(1) rotate(var(--rot)); opacity: 0; }
}
</style>
