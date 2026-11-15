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
const colors = ['#ffffff', '#ffe4ee', '#F678A4', '#fbb1cb', '#C8636F'];

const spawn = (x, y, count = 12) => {
    const fresh = Array.from({ length: count }, () => {
        const a = Math.random() * Math.PI * 2;
        const d = 60 + Math.random() * 130;
        return { id: ++id, x, y, dx: Math.cos(a) * d, dy: Math.sin(a) * d + 50, rot: Math.random() * 500 - 250, s: 8 + Math.random() * 9, color: colors[Math.floor(Math.random() * colors.length)] };
    });
    bursts.value.push(...fresh);
    setTimeout(() => { bursts.value = bursts.value.filter((b) => !fresh.includes(b)); }, 1500);
};

const onClick = (e) => {
    if (e.target.closest && e.target.closest('[data-no-burst]')) return;
    spawn(e.clientX, e.clientY, 9);
};
const onCustom = (e) => spawn(e.detail.x, e.detail.y, e.detail.count || 24);

onMounted(() => {
    window.addEventListener('click', onClick);
    window.addEventListener('bloom-burst', onCustom);
});
onUnmounted(() => {
    window.removeEventListener('click', onClick);
    window.removeEventListener('bloom-burst', onCustom);
});
</script>

<style scoped>
.cb-petal { border-radius: 50% 50% 46% 46% / 88% 88% 14% 14%; animation: cb 1.4s cubic-bezier(.2,.7,.3,1) forwards; }
@keyframes cb {
    0% { transform: translate(-50%, -50%) scale(.4) rotate(0); opacity: 1; }
    100% { transform: translate(calc(-50% + var(--dx)), calc(-50% + var(--dy))) scale(1) rotate(var(--rot)); opacity: 0; }
}
</style>
