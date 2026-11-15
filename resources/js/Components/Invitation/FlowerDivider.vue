<template>
    <button
        type="button"
        class="flower-divider group mx-auto my-3 flex items-center justify-center gap-3 cursor-pointer outline-none"
        :class="{ popped }"
        aria-label="Bloom"
        @click="pop($event)"
    >
        <span class="h-px w-10 sm:w-16 bg-gradient-to-r from-transparent to-[#C8636F]"></span>
        <svg viewBox="0 0 120 40" class="w-24 h-8 sm:w-28 sm:h-9 overflow-visible">
            <g class="bl bl-s l"><g transform="translate(22 21)"><g v-for="i in 5" :key="'a'+i" :transform="`rotate(${i * 72})`"><ellipse cx="0" cy="-6" rx="3.4" ry="6" fill="#F678A4" stroke="#fff" stroke-width=".5" /></g><circle r="2.2" fill="#fff4d6" /></g></g>
            <g class="bl bl-m"><g transform="translate(60 20)"><g v-for="i in 8" :key="'b'+i" :transform="`rotate(${i * 45})`"><ellipse cx="0" cy="-9" rx="4.8" ry="9" fill="#F678A4" stroke="#fff" stroke-width=".6" /></g><g v-for="i in 6" :key="'c'+i" :transform="`rotate(${i * 60 + 20})`"><ellipse cx="0" cy="-5.5" rx="3.3" ry="5.5" fill="#ad2c51" opacity=".92" /></g><circle r="2.8" fill="#fff4d6" /></g></g>
            <g class="bl bl-s r"><g transform="translate(98 21)"><g v-for="i in 5" :key="'d'+i" :transform="`rotate(${i * 72 + 36})`"><ellipse cx="0" cy="-6" rx="3.4" ry="6" fill="#C8636F" stroke="#fff" stroke-width=".5" /></g><circle r="2.2" fill="#fff4d6" /></g></g>
            <path d="M32 24 Q44 34 52 26 M68 26 Q76 34 88 24" stroke="#8aa877" stroke-width="1.6" fill="none" stroke-linecap="round" />
        </svg>
        <span class="h-px w-10 sm:w-16 bg-gradient-to-l from-transparent to-[#C8636F]"></span>
    </button>
</template>

<script setup>
import { ref } from 'vue';

const popped = ref(false);
const pop = (e) => {
    popped.value = true;
    window.dispatchEvent(new CustomEvent('bloom-burst', { detail: { x: e.clientX, y: e.clientY, count: 18 } }));
    setTimeout(() => (popped.value = false), 900);
};
</script>

<style scoped>
.bl { transform-box: fill-box; transform-origin: center; animation: breathe 4s ease-in-out infinite; }
.bl-s.r { animation-delay: -2s; }
.flower-divider:hover .bl-m { transform: rotate(40deg) scale(1.2); transition: transform .6s; }
.popped .bl-m { animation: spinpop .9s ease-out; }
.popped .bl-s { animation: spinpop .9s ease-out .1s; }
@keyframes breathe { 0%,100% { transform: scale(1) rotate(0); } 50% { transform: scale(1.08) rotate(6deg); } }
@keyframes spinpop { 0% { transform: scale(1) rotate(0); } 50% { transform: scale(1.7) rotate(180deg); } 100% { transform: scale(1) rotate(360deg); } }
</style>
