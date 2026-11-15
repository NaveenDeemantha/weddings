<template>
    <!-- Luxury Gold Foil & Watercolor Corner Floral (Print & Screen) -->
    <svg viewBox="0 0 160 160" fill="none" class="w-full h-full select-none overflow-visible" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient :id="`cfG-${uid}`" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#fff2bd" />
                <stop offset="30%" stop-color="#e8c86d" />
                <stop offset="70%" stop-color="#c99b2e" />
                <stop offset="100%" stop-color="#9d7318" />
            </linearGradient>

            <radialGradient :id="`cfWash-${uid}`" cx="45%" cy="40%" r="65%">
                <stop offset="0%" stop-color="#ffffff" stop-opacity="0.85" />
                <stop offset="45%" stop-color="#fff8e7" stop-opacity="0.5" />
                <stop offset="80%" stop-color="#f5dc8a" stop-opacity="0.25" />
                <stop offset="100%" stop-color="#d8ab43" stop-opacity="0.15" />
            </radialGradient>

            <linearGradient :id="`cfLWash-${uid}`" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#b6d5a3" stop-opacity="0.4" />
                <stop offset="100%" stop-color="#5f834c" stop-opacity="0.3" />
            </linearGradient>

            <filter :id="`cfGlow-${uid}`" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="0" dy="1.5" stdDeviation="2" flood-color="#a88028" flood-opacity="0.25" />
            </filter>
        </defs>

        <!-- Watercolor Washes -->
        <g opacity="0.95">
            <path d="M 65 40 C 52 28, 48 10, 65 0 C 82 10, 78 28, 65 40 Z" :fill="`url(#cfLWash-${uid})`" />
            <path d="M 40 65 C 28 52, 10 48, 0 65 C 10 82, 28 78, 40 65 Z" :fill="`url(#cfLWash-${uid})`" />
            <circle cx="36" cy="36" r="32" :fill="`url(#cfWash-${uid})`" />
            <circle cx="84" cy="70" r="18" :fill="`url(#cfWash-${uid})`" />
            <circle cx="70" cy="84" r="18" :fill="`url(#cfWash-${uid})`" />
        </g>

        <!-- Gold Foil Arcing Stems -->
        <g :filter="`url(#cfGlow-${uid})`">
            <path d="M 0 0 Q 55 18, 92 72" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.8" stroke-linecap="round" />
            <path d="M 0 0 Q 18 55, 72 92" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.8" stroke-linecap="round" />

            <!-- Gold Foil Leaf Filigree -->
            <g transform="translate(65, 40) rotate(-32)">
                <path d="M 0 0 C -10 -14, -14 -32, 0 -44 C 14 -32, 10 -14, 0 0 Z" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.1" stroke-linecap="round" />
                <path d="M 0 0 L 0 -40 M 0 -12 L -5 -20 M 0 -22 L -6 -28 M 0 -12 L 5 -20 M 0 -22 L 6 -28" :stroke="`url(#cfG-${uid}) #f5dc8a`" stroke-width="0.65" stroke-linecap="round" />
            </g>
            <g transform="translate(40, 65) rotate(32)">
                <path d="M 0 0 C -10 -14, -14 -32, 0 -44 C 14 -32, 10 -14, 0 0 Z" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.1" stroke-linecap="round" />
                <path d="M 0 0 L 0 -40 M 0 -12 L -5 -20 M 0 -22 L -6 -28 M 0 -12 L 5 -20 M 0 -22 L 6 -28" :stroke="`url(#cfG-${uid}) #f5dc8a`" stroke-width="0.65" stroke-linecap="round" />
            </g>

            <!-- Rosebuds -->
            <g transform="translate(118, 46) rotate(35)">
                <path d="M 0 -4 C -5 -10, 0 -16, 5 -10 Z" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1" />
                <circle cx="0" cy="0" r="3" :fill="`url(#cfG-${uid}) #d8ab43`" />
            </g>
            <g transform="translate(46, 118) rotate(-35)">
                <path d="M 0 -4 C -5 -10, 0 -16, 5 -10 Z" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1" />
                <circle cx="0" cy="0" r="3" :fill="`url(#cfG-${uid}) #d8ab43`" />
            </g>

            <!-- Secondary Cupped Roses -->
            <g transform="translate(84, 70) scale(0.68)">
                <path v-for="p in secPetals" :key="'csp1-' + p.id" :d="p.d" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.1" fill="none" :style="{ transform: `rotate(${p.a}deg)`, transformOrigin: '0 0' }" />
                <circle cx="0" cy="0" r="4.5" :fill="`url(#cfG-${uid}) #f5dc8a`" />
            </g>
            <g transform="translate(70, 84) scale(0.68)">
                <path v-for="p in secPetals" :key="'csp2-' + p.id" :d="p.d" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.1" fill="none" :style="{ transform: `rotate(${p.a + 30}deg)`, transformOrigin: '0 0' }" />
                <circle cx="0" cy="0" r="4.5" :fill="`url(#cfG-${uid}) #f5dc8a`" />
            </g>

            <!-- Main Focal Gold Foil Rose (Corner Bloom) -->
            <g transform="translate(36, 36) scale(0.95)">
                <!-- Outer Petals -->
                <path v-for="p in mainOuterPetals" :key="'cfo1-' + p.id" :d="p.d" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.25" fill="none" :style="{ transform: `rotate(${p.a}deg) scale(${p.s})`, transformOrigin: '0 0' }" />
                <!-- Mid Petals -->
                <path v-for="p in mainMidPetals" :key="'cfm1-' + p.id" :d="p.d" :stroke="`url(#cfG-${uid}) #f5dc8a`" stroke-width="1.0" fill="none" :style="{ transform: `rotate(${p.a}deg)`, transformOrigin: '0 0' }" />
                <!-- Inner Spiral -->
                <path d="M -6 -3 C -8 -9, 3 -11, 7 -5 C 2 -2, -2 -1, -6 -3 Z" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.1" fill="none" />
                <path d="M 4 -5 C 9 -3, 9 3, 5 7 C 2 3, 1 0, 4 -5 Z" :stroke="`url(#cfG-${uid}) #d8ab43`" stroke-width="1.1" fill="none" />
                <circle cx="0" cy="0" r="3.2" :fill="`url(#cfG-${uid}) #f5dc8a`" />
                <circle cx="0" cy="0" r="1.8" fill="#ffffff" opacity="0.9" />
            </g>

            <!-- Sparkle Accents -->
            <path d="M 108 28 Q 108 33, 113 33 Q 108 33, 108 38 Q 108 33, 103 33 Q 108 33, 108 28 Z" :fill="`url(#cfG-${uid}) #f5dc8a`" />
            <circle cx="30" cy="100" r="1.6" :fill="`url(#cfG-${uid}) #f5dc8a`" />
        </g>
    </svg>
</template>

<script setup>
const props = defineProps({
    cluster: { type: String, default: 'tl' },
});

const uid = 'foil-c-' + props.cluster + '-' + Math.random().toString(36).substring(2, 7);

const outerFoilPath = 'M 0 0 C -16 -9, -25 -25, -10 -38 C 0 -43, 12 -41, 21 -32 C 26 -20, 16 -7, 0 0 Z';
const mainOuterPetals = [
    { id: 1, a: 0,   d: outerFoilPath, s: 1.0 },
    { id: 2, a: 45,  d: outerFoilPath, s: 0.97 },
    { id: 3, a: 90,  d: outerFoilPath, s: 1.02 },
    { id: 4, a: 135, d: outerFoilPath, s: 0.96 },
    { id: 5, a: 180, d: outerFoilPath, s: 1.0 },
    { id: 6, a: 225, d: outerFoilPath, s: 0.98 },
    { id: 7, a: 270, d: outerFoilPath, s: 1.02 },
    { id: 8, a: 315, d: outerFoilPath, s: 0.96 },
];

const midFoilPath = 'M 0 0 C -12 -7, -18 -19, -7 -28 C 2 -31, 10 -29, 16 -23 C 19 -14, 12 -5, 0 0 Z';
const mainMidPetals = [
    { id: 1, a: 22,  d: midFoilPath },
    { id: 2, a: 67,  d: midFoilPath },
    { id: 3, a: 112, d: midFoilPath },
    { id: 4, a: 157, d: midFoilPath },
    { id: 5, a: 202, d: midFoilPath },
    { id: 6, a: 247, d: midFoilPath },
    { id: 7, a: 292, d: midFoilPath },
    { id: 8, a: 337, d: midFoilPath },
];

const secFoilPath = 'M 0 0 C -12 -7, -16 -21, -5 -28 C 4 -32, 12 -28, 16 -19 C 18 -10, 10 -5, 0 0 Z';
const secPetals = [
    { id: 1, a: 0,   d: secFoilPath },
    { id: 2, a: 60,  d: secFoilPath },
    { id: 3, a: 120, d: secFoilPath },
    { id: 4, a: 180, d: secFoilPath },
    { id: 5, a: 240, d: secFoilPath },
    { id: 6, a: 300, d: secFoilPath },
];
</script>
