<template>
    <button
        type="button"
        class="flower-divider group mx-auto my-3 flex items-center justify-center gap-3 cursor-pointer outline-none"
        :class="{ popped }"
        aria-label="Bloom"
        @click="pop($event)"
    >
        <span class="h-px w-10 sm:w-16 bg-gradient-to-r from-transparent via-[#d8ab43] to-[#c99b2e]"></span>
        
        <svg viewBox="0 0 130 42" class="w-28 h-9 sm:w-32 sm:h-10 overflow-visible">
            <defs>
                <linearGradient :id="`fdG-${uid}`" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#fff2bd" />
                    <stop offset="40%" stop-color="#e8c86d" />
                    <stop offset="70%" stop-color="#c99b2e" />
                    <stop offset="100%" stop-color="#9d7318" />
                </linearGradient>
                <radialGradient :id="`fdWash-${uid}`" cx="50%" cy="40%" r="60%">
                    <stop offset="0%" stop-color="#fff8e7" stop-opacity="0.6" />
                    <stop offset="100%" stop-color="#f5dc8a" stop-opacity="0.25" />
                </radialGradient>
            </defs>

            <!-- Center Bloom: Gold Foil Rose -->
            <g class="bl bl-m" transform="translate(65, 21)">
                <!-- Soft Watercolor Backing -->
                <circle cx="0" cy="0" r="14" :fill="`url(#fdWash-${uid})`" />
                <!-- 8 Gold Foil Outer Petals -->
                <g v-for="i in 8" :key="'fd-o-'+i" :transform="`rotate(${i * 45})`">
                    <path d="M 0 0 C -5 -3, -7 -9, -3 -13 C 1 -15, 5 -14, 7 -10 C 8 -6, 5 -2, 0 0 Z" :stroke="`url(#fdG-${uid}) #d8ab43`" stroke-width="0.85" fill="none" />
                </g>
                <!-- 6 Gold Foil Inner Swirls -->
                <g v-for="i in 6" :key="'fd-i-'+i" :transform="`rotate(${i * 60 + 20})`">
                    <path d="M 0 0 C -3 -2, -5 -6, -2 -8 C 1 -9, 3 -8, 4 -6 C 5 -4, 3 -1, 0 0 Z" :stroke="`url(#fdG-${uid}) #f5dc8a`" stroke-width="0.75" fill="none" />
                </g>
                <circle r="2.8" :fill="`url(#fdG-${uid}) #f5dc8a`" />
                <circle r="1.4" fill="#ffffff" />
            </g>

            <!-- Left Bud Bloom -->
            <g class="bl bl-s l" transform="translate(26, 21)">
                <circle cx="0" cy="0" r="9" :fill="`url(#fdWash-${uid})`" opacity="0.8" />
                <g v-for="i in 5" :key="'fd-l-'+i" :transform="`rotate(${i * 72})`">
                    <path d="M 0 0 C -4 -2, -5 -6, -2 -9 C 1 -10, 4 -9, 5 -6 C 6 -4, 4 -1, 0 0 Z" :stroke="`url(#fdG-${uid}) #d8ab43`" stroke-width="0.75" fill="none" />
                </g>
                <circle r="2.2" :fill="`url(#fdG-${uid}) #f5dc8a`" />
            </g>

            <!-- Right Bud Bloom -->
            <g class="bl bl-s r" transform="translate(104, 21)">
                <circle cx="0" cy="0" r="9" :fill="`url(#fdWash-${uid})`" opacity="0.8" />
                <g v-for="i in 5" :key="'fd-r-'+i" :transform="`rotate(${i * 72 + 36})`">
                    <path d="M 0 0 C -4 -2, -5 -6, -2 -9 C 1 -10, 4 -9, 5 -6 C 6 -4, 4 -1, 0 0 Z" :stroke="`url(#fdG-${uid}) #d8ab43`" stroke-width="0.75" fill="none" />
                </g>
                <circle r="2.2" :fill="`url(#fdG-${uid}) #f5dc8a`" />
            </g>

            <!-- Connecting Gold Foil Vines & Tendrils -->
            <path d="M 36 22 Q 48 29, 53 22 M 77 22 Q 82 29, 94 22" :stroke="`url(#fdG-${uid}) #c99b2e`" stroke-width="1.2" fill="none" stroke-linecap="round" />
            <circle cx="48" cy="27" r="1.2" :fill="`url(#fdG-${uid}) #f5dc8a`" />
            <circle cx="82" cy="27" r="1.2" :fill="`url(#fdG-${uid}) #f5dc8a`" />
        </svg>

        <span class="h-px w-10 sm:w-16 bg-gradient-to-l from-transparent via-[#d8ab43] to-[#c99b2e]"></span>
    </button>
</template>

<script setup>
import { ref } from 'vue';

const popped = ref(false);
const uid = 'fd-' + Math.random().toString(36).substring(2, 7);

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
@keyframes breathe { 0%,100% { transform: scale(1) rotate(0); } 50% { transform: scale(1.08) rotate(4deg); } }
@keyframes spinpop { 0% { transform: scale(1) rotate(0); } 50% { transform: scale(1.6) rotate(180deg); } 100% { transform: scale(1) rotate(360deg); } }
</style>
