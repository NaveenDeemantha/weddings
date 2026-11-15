<template>
    <!-- Luxury Gold Foil & Watercolor Line-Art Rose Cluster (High-End Letterpress Style) -->
    <div
        class="gold-foil-cluster select-none pointer-events-none group inline-block"
        :class="{ 'shimmer-active': isHovered }"
        @mouseenter="isHovered = true"
        @mouseleave="isHovered = false"
    >
        <svg
            viewBox="0 0 240 240"
            fill="none"
            class="w-full h-full overflow-visible"
            xmlns="http://www.w3.org/2000/svg"
        >
            <defs>
                <!-- Metallic Gold Foil Gradient 1 (Main Highlights) -->
                <linearGradient :id="`gFoil-${uid}`" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#fff2bd" />
                    <stop offset="25%" stop-color="#e8c86d" />
                    <stop offset="50%" stop-color="#c99b2e" />
                    <stop offset="75%" stop-color="#f5dc8a" />
                    <stop offset="100%" stop-color="#9d7318" />
                </linearGradient>

                <!-- Metallic Gold Foil Gradient 2 (Stems & Deeper Accents) -->
                <linearGradient :id="`gDark-${uid}`" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#d8ab43" />
                    <stop offset="50%" stop-color="#9a711c" />
                    <stop offset="100%" stop-color="#6e4f12" />
                </linearGradient>

                <!-- Translucent Blush Watercolor Wash (Handmade Cotton Paper Wash) -->
                <radialGradient :id="`blushWash-${uid}`" cx="45%" cy="40%" r="65%">
                    <stop offset="0%" stop-color="#ffffff" stop-opacity="0.85" />
                    <stop offset="40%" stop-color="#ffd5e5" stop-opacity="0.5" />
                    <stop offset="75%" stop-color="#F678A4" stop-opacity="0.32" />
                    <stop offset="100%" stop-color="#ad2c51" stop-opacity="0.15" />
                </radialGradient>

                <!-- Deeper Burgundy Watercolor Heart -->
                <radialGradient :id="`burgundyWash-${uid}`" cx="40%" cy="35%" r="60%">
                    <stop offset="0%" stop-color="#F678A4" stop-opacity="0.45" />
                    <stop offset="55%" stop-color="#ad2c51" stop-opacity="0.4" />
                    <stop offset="100%" stop-color="#64152c" stop-opacity="0.25" />
                </radialGradient>

                <!-- Sage Green Translucent Leaf Wash -->
                <linearGradient :id="`leafWash-${uid}`" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#b6d5a3" stop-opacity="0.4" />
                    <stop offset="100%" stop-color="#5f834c" stop-opacity="0.3" />
                </linearGradient>

                <!-- Soft Foil Luster Drop Shadow -->
                <filter :id="`goldGlow-${uid}`" x="-20%" y="-20%" width="140%" height="140%">
                    <feDropShadow dx="0" dy="2" stdDeviation="2.5" flood-color="#a88028" flood-opacity="0.25" />
                </filter>
            </defs>

            <!-- ================= 1. WATERCOLOR UNDERLAYS (SOFT ORGANIC WASH) ================= -->
            <g class="watercolor-washes" opacity="0.95">
                <!-- Leaf Washes -->
                <path d="M 45 170 C 30 152, 25 128, 45 112 C 65 128, 59 152, 45 170 Z" :fill="`url(#leafWash-${uid})`" />
                <path d="M 90 140 C 78 125, 74 104, 90 92 C 106 104, 102 125, 90 140 Z" :fill="`url(#leafWash-${uid})`" />
                <path d="M 118 175 C 107 161, 103 141, 118 129 C 133 141, 129 161, 118 175 Z" :fill="`url(#leafWash-${uid})`" />

                <!-- Grand Rose Watercolor Tint (Large Soft Petal Spread) -->
                <circle cx="132" cy="86" r="46" :fill="`url(#blushWash-${uid})`" />
                <circle cx="132" cy="86" r="28" :fill="`url(#burgundyWash-${uid})`" />

                <!-- Secondary Rose Watercolor Tint -->
                <circle cx="180" cy="136" r="32" :fill="`url(#blushWash-${uid})`" />
                <circle cx="74" cy="134" r="26" :fill="`url(#blushWash-${uid})`" />
            </g>

            <!-- ================= 2. GOLD FOIL BOTANICAL STEMS & BRIARS ================= -->
            <g class="stems-gold" :filter="`url(#goldGlow-${uid})`">
                <!-- Master Arching Rose Stem -->
                <path
                    d="M 10 230 C 50 170, 75 130, 130 86"
                    :stroke="`url(#gDark-${uid}) #c99b2e`"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />
                <path
                    d="M 35 235 C 70 190, 120 155, 180 136"
                    :stroke="`url(#gFoil-${uid}) #e8c86d`"
                    stroke-width="1.5"
                    stroke-linecap="round"
                />
                <path
                    d="M 75 160 Q 98 138, 74 134"
                    :stroke="`url(#gDark-${uid}) #c99b2e`"
                    stroke-width="1.3"
                    stroke-linecap="round"
                />
                <!-- Slender Tendrils & Thorns -->
                <path d="M 48 200 Q 55 196, 50 190" :stroke="`url(#gDark-${uid}) #c99b2e`" stroke-width="1.2" stroke-linecap="round" />
                <path d="M 85 162 Q 92 158, 87 152" :stroke="`url(#gDark-${uid}) #c99b2e`" stroke-width="1.2" stroke-linecap="round" />
            </g>

            <!-- ================= 3. GOLD FOIL LEAF FILIGREE (LETTERPRESS LINES) ================= -->
            <g class="leaf-filigree" :filter="`url(#goldGlow-${uid})`">
                <!-- Leaf 1 (Lower Left) -->
                <g transform="translate(45, 170) rotate(-32)">
                    <path
                        d="M 0 0 C -14 -18, -20 -42, 0 -58 C 20 -42, 14 -18, 0 0 Z"
                        :stroke="`url(#gFoil-${uid}) #d8ab43`"
                        stroke-width="1.2"
                        stroke-linecap="round"
                    />
                    <path
                        d="M 0 0 L 0 -54 M 0 -16 L -8 -26 M 0 -30 L -9 -40 M 0 -16 L 8 -26 M 0 -30 L 9 -40"
                        :stroke="`url(#gFoil-${uid}) #f5dc8a`"
                        stroke-width="0.75"
                        stroke-linecap="round"
                    />
                </g>

                <!-- Leaf 2 (Mid Stem) -->
                <g transform="translate(90, 140) rotate(28)">
                    <path
                        d="M 0 0 C -12 -15, -16 -36, 0 -48 C 16 -36, 12 -15, 0 0 Z"
                        :stroke="`url(#gFoil-${uid}) #d8ab43`"
                        stroke-width="1.1"
                        stroke-linecap="round"
                    />
                    <path
                        d="M 0 0 L 0 -44 M 0 -13 L -6 -21 M 0 -25 L -7 -33 M 0 -13 L 6 -21 M 0 -25 L 7 -33"
                        :stroke="`url(#gFoil-${uid}) #f5dc8a`"
                        stroke-width="0.7"
                        stroke-linecap="round"
                    />
                </g>

                <!-- Leaf 3 (Under Focal Bloom) -->
                <g transform="translate(118, 175) rotate(-65)">
                    <path
                        d="M 0 0 C -11 -14, -15 -34, 0 -46 C 15 -34, 11 -14, 0 0 Z"
                        :stroke="`url(#gFoil-${uid}) #d8ab43`"
                        stroke-width="1.1"
                        stroke-linecap="round"
                    />
                    <path d="M 0 0 L 0 -42 M 0 -14 L -6 -22 M 0 -14 L 6 -22" :stroke="`url(#gFoil-${uid}) #f5dc8a`" stroke-width="0.65" stroke-linecap="round" />
                </g>

                <!-- Leaf 4 (Upper Left Sprig) -->
                <g transform="translate(22, 210) rotate(42)">
                    <path
                        d="M 0 0 C -9 -12, -13 -28, 0 -38 C 13 -28, 9 -12, 0 0 Z"
                        :stroke="`url(#gFoil-${uid}) #d8ab43`"
                        stroke-width="1"
                        stroke-linecap="round"
                    />
                </g>
            </g>

            <!-- ================= 4. GOLD FOIL ROSEBUDS ================= -->
            <g transform="translate(195, 75) rotate(32)" :filter="`url(#goldGlow-${uid})`">
                <path d="M 0 -8 C -7 -16, 0 -26, 7 -16 Z" :stroke="`url(#gFoil-${uid}) #d8ab43`" stroke-width="1.1" :fill="`url(#burgundyWash-${uid})`" />
                <path d="M 0 0 C -8 -10, -14 -24, -5 -32 C -3 -20, 0 -12, 0 0 Z" :stroke="`url(#gFoil-${uid}) #d8ab43`" stroke-width="0.9" />
                <path d="M 0 0 C 8 -10, 14 -24, 5 -32 C 3 -20, 0 -12, 0 0 Z" :stroke="`url(#gFoil-${uid}) #d8ab43`" stroke-width="0.9" />
                <circle cx="0" cy="0" r="4" :fill="`url(#gFoil-${uid}) #d8ab43`" />
            </g>

            <g transform="translate(48, 105) rotate(-50)" :filter="`url(#goldGlow-${uid})`">
                <path d="M 0 -6 C -6 -13, 0 -21, 6 -13 Z" :stroke="`url(#gFoil-${uid}) #d8ab43`" stroke-width="1" :fill="`url(#blushWash-${uid})`" />
                <path d="M 0 0 C -6 -8, -10 -19, -3 -26 C -2 -16, 0 -8, 0 0 Z" :stroke="`url(#gFoil-${uid}) #d8ab43`" stroke-width="0.85" />
                <path d="M 0 0 C 6 -8, 10 -19, 3 -26 C 2 -16, 0 -8, 0 0 Z" :stroke="`url(#gFoil-${uid}) #d8ab43`" stroke-width="0.85" />
                <circle cx="0" cy="0" r="3.5" :fill="`url(#gFoil-${uid}) #d8ab43`" />
            </g>

            <!-- ================= 5. GRAND GOLD FOIL LINE-ART ROSE (FOCAL BLOOM) ================= -->
            <!-- Fine letterpress contours with concentric petal whorls and shimmering gold foil -->
            <g
                class="grand-foil-rose"
                transform="translate(132, 86)"
                :filter="`url(#goldGlow-${uid})`"
            >
                <!-- Outer Petal Contour Ring (10 Layered Scalloped Petals) -->
                <path
                    v-for="p in foilOuterPetals"
                    :key="'fo-' + p.id"
                    :d="p.d"
                    :stroke="`url(#gFoil-${uid}) #d8ab43`"
                    stroke-width="1.25"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    :style="{ transform: `rotate(${p.a}deg) scale(${p.s})`, transformOrigin: '0 0' }"
                />

                <!-- Mid Petal Contours (Concentric Spiraling Petal Folds) -->
                <path
                    v-for="p in foilMidPetals"
                    :key="'fm-' + p.id"
                    :d="p.d"
                    :stroke="`url(#gFoil-${uid}) #f5dc8a`"
                    stroke-width="1.1"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    :style="{ transform: `rotate(${p.a}deg)`, transformOrigin: '0 0' }"
                />

                <!-- Inner Rose Heart Contour Swirls -->
                <path
                    v-for="p in foilInnerPetals"
                    :key="'fi-' + p.id"
                    :d="p.d"
                    :stroke="`url(#gFoil-${uid}) #e8c86d`"
                    stroke-width="0.95"
                    stroke-linecap="round"
                    :style="{ transform: `rotate(${p.a}deg)`, transformOrigin: '0 0' }"
                />

                <!-- Innermost Center Whorl & Stippled Gold Stamen Jewels -->
                <path
                    d="M -7 -4 C -9 -11, 4 -14, 8 -6 C 3 -2, -3 -1, -7 -4 Z"
                    :stroke="`url(#gFoil-${uid}) #d8ab43`"
                    stroke-width="1.1"
                    fill="none"
                />
                <path
                    d="M 5 -6 C 11 -4, 11 4, 6 9 C 3 4, 1 0, 5 -6 Z"
                    :stroke="`url(#gFoil-${uid}) #d8ab43`"
                    stroke-width="1"
                    fill="none"
                />
                <path
                    d="M 5 5 C 6 11, -3 12, -6 6 C -2 3, 1 2, 5 5 Z"
                    :stroke="`url(#gFoil-${uid}) #d8ab43`"
                    stroke-width="1"
                    fill="none"
                />
                <path
                    d="M -5 6 C -10 4, -10 -3, -5 -6 C -1 0, 0 3, -5 6 Z"
                    :stroke="`url(#gFoil-${uid}) #d8ab43`"
                    stroke-width="1"
                    fill="none"
                />

                <!-- Center Gold Bead & Radiance Stipples -->
                <circle cx="0" cy="0" r="3.8" :fill="`url(#gFoil-${uid}) #f5dc8a`" />
                <circle cx="0" cy="0" r="2.2" fill="#ffffff" opacity="0.9" />
                <circle cx="-3" cy="-3" r="0.9" :fill="`url(#gFoil-${uid}) #f5dc8a`" />
                <circle cx="3" cy="-3" r="0.9" :fill="`url(#gFoil-${uid}) #f5dc8a`" />
                <circle cx="3" cy="3" r="0.9" :fill="`url(#gFoil-${uid}) #f5dc8a`" />
                <circle cx="-3" cy="3" r="0.9" :fill="`url(#gFoil-${uid}) #f5dc8a`" />
            </g>

            <!-- ================= 6. SECONDARY FOIL ROSE (MEDIUM BLOOM) ================= -->
            <g
                class="medium-foil-rose"
                transform="translate(180, 136) scale(0.92)"
                :filter="`url(#goldGlow-${uid})`"
            >
                <path
                    v-for="p in secFoilPetals"
                    :key="'sf1-' + p.id"
                    :d="p.d"
                    :stroke="`url(#gFoil-${uid}) #d8ab43`"
                    stroke-width="1.1"
                    fill="none"
                    :style="{ transform: `rotate(${p.a}deg)`, transformOrigin: '0 0' }"
                />
                <circle cx="0" cy="0" r="6" :stroke="`url(#gFoil-${uid}) #f5dc8a`" stroke-width="1" fill="none" />
                <circle cx="0" cy="0" r="3" :fill="`url(#gFoil-${uid}) #f5dc8a`" />
            </g>

            <!-- ================= 7. PETITE FOIL ROSE (BABY BLOOM) ================= -->
            <g
                class="baby-foil-rose"
                transform="translate(74, 134) scale(0.76)"
                :filter="`url(#goldGlow-${uid})`"
            >
                <path
                    v-for="p in secFoilPetals"
                    :key="'sf2-' + p.id"
                    :d="p.d"
                    :stroke="`url(#gFoil-${uid}) #d8ab43`"
                    stroke-width="1.1"
                    fill="none"
                    :style="{ transform: `rotate(${p.a + 25}deg)`, transformOrigin: '0 0' }"
                />
                <circle cx="0" cy="0" r="5" :stroke="`url(#gFoil-${uid}) #f5dc8a`" stroke-width="0.9" fill="none" />
                <circle cx="0" cy="0" r="2.6" :fill="`url(#gFoil-${uid}) #f5dc8a`" />
            </g>

            <!-- ================= 8. FLOATING GOLD SPARKLES & SHIMMER ================= -->
            <g class="gold-sparkles">
                <!-- 4-Point Starlight Sparkle 1 -->
                <path
                    d="M 160 38 Q 160 45, 167 45 Q 160 45, 160 52 Q 160 45, 153 45 Q 160 45, 160 38 Z"
                    :fill="`url(#gFoil-${uid}) #f5dc8a`"
                    class="sparkle-1"
                />
                <!-- 4-Point Starlight Sparkle 2 -->
                <path
                    d="M 198 88 Q 198 94, 204 94 Q 198 94, 198 100 Q 198 94, 192 94 Q 198 94, 198 88 Z"
                    :fill="`url(#gFoil-${uid}) #f5dc8a`"
                    class="sparkle-2"
                />
                <!-- Shimmer Dot -->
                <circle cx="42" cy="100" r="2" :fill="`url(#gFoil-${uid}) #f5dc8a`" class="sparkle-3" />
                <circle cx="115" cy="50" r="1.5" :fill="`url(#gFoil-${uid}) #f5dc8a`" class="sparkle-2" />
            </g>
        </svg>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const isHovered = ref(false);
const uid = 'foil-' + Math.random().toString(36).substring(2, 8);

// ================= GOLD FOIL LETTERPRESS LINE GEOMETRY =================
// Outer Broad Scalloped Cup Petals
const outerFoilPath = 'M 0 0 C -18 -10, -28 -28, -12 -42 C 0 -48, 14 -46, 24 -36 C 30 -22, 18 -8, 0 0 Z';
const foilOuterPetals = [
    { id: 1, a: 0,   d: outerFoilPath, s: 1.05 },
    { id: 2, a: 40,  d: outerFoilPath, s: 0.98 },
    { id: 3, a: 80,  d: outerFoilPath, s: 1.02 },
    { id: 4, a: 120, d: outerFoilPath, s: 0.96 },
    { id: 5, a: 160, d: outerFoilPath, s: 1.04 },
    { id: 6, a: 200, d: outerFoilPath, s: 1.0 },
    { id: 7, a: 240, d: outerFoilPath, s: 1.02 },
    { id: 8, a: 280, d: outerFoilPath, s: 0.97 },
    { id: 9, a: 320, d: outerFoilPath, s: 1.03 },
];

// Mid-tier Petal Whorls
const midFoilPath = 'M 0 0 C -14 -8, -20 -22, -8 -32 C 2 -36, 12 -34, 18 -26 C 22 -16, 14 -6, 0 0 Z';
const foilMidPetals = [
    { id: 1, a: 20,  d: midFoilPath },
    { id: 2, a: 65,  d: midFoilPath },
    { id: 3, a: 110, d: midFoilPath },
    { id: 4, a: 155, d: midFoilPath },
    { id: 5, a: 200, d: midFoilPath },
    { id: 6, a: 245, d: midFoilPath },
    { id: 7, a: 290, d: midFoilPath },
    { id: 8, a: 335, d: midFoilPath },
];

// Inner Spirals
const innerFoilPath = 'M 0 0 C -10 -6, -14 -16, -5 -22 C 2 -25, 8 -24, 13 -18 C 15 -11, 10 -4, 0 0 Z';
const foilInnerPetals = [
    { id: 1, a: 10,  d: innerFoilPath },
    { id: 2, a: 55,  d: innerFoilPath },
    { id: 3, a: 100, d: innerFoilPath },
    { id: 4, a: 145, d: innerFoilPath },
    { id: 5, a: 190, d: innerFoilPath },
    { id: 6, a: 235, d: innerFoilPath },
    { id: 7, a: 280, d: innerFoilPath },
    { id: 8, a: 325, d: innerFoilPath },
];

// Secondary Petals
const secFoilPath = 'M 0 0 C -14 -8, -18 -24, -6 -32 C 4 -36, 14 -32, 18 -22 C 20 -12, 12 -6, 0 0 Z';
const secFoilPetals = [
    { id: 1, a: 0,   d: secFoilPath },
    { id: 2, a: 60,  d: secFoilPath },
    { id: 3, a: 120, d: secFoilPath },
    { id: 4, a: 180, d: secFoilPath },
    { id: 5, a: 240, d: secFoilPath },
    { id: 6, a: 300, d: secFoilPath },
];
</script>

<style scoped>
/* ================= GOLD FOIL METALLIC ANIMATION SUITE ================= */

/* Grand Foil Rose Gentle Organic Breathing */
.grand-foil-rose {
    transform-box: fill-box;
    transform-origin: center;
    animation: foilBreathe 7s ease-in-out infinite;
}

@keyframes foilBreathe {
    0%, 100% {
        transform: translate(132px, 86px) scale(1) rotate(0deg);
    }
    50% {
        transform: translate(132px, 84px) scale(1.035) rotate(2deg);
    }
}

/* Secondary Blooms Counter-Sway */
.medium-foil-rose {
    transform-box: fill-box;
    transform-origin: center;
    animation: foilSwayMed 8s ease-in-out infinite;
}

@keyframes foilSwayMed {
    0%, 100% {
        transform: translate(180px, 136px) scale(0.92) rotate(0deg);
    }
    50% {
        transform: translate(181px, 134px) scale(0.95) rotate(-2.5deg);
    }
}

.baby-foil-rose {
    transform-box: fill-box;
    transform-origin: center;
    animation: foilSwayBaby 6.5s ease-in-out infinite;
}

@keyframes foilSwayBaby {
    0%, 100% {
        transform: translate(74px, 134px) scale(0.76) rotate(0deg);
    }
    50% {
        transform: translate(73px, 132px) scale(0.79) rotate(3deg);
    }
}

/* Stems & Leaves Gentle Breeze */
.stems-gold, .leaf-filigree {
    transform-box: fill-box;
    transform-origin: 0% 100%;
    animation: goldLeafSway 8s ease-in-out infinite alternate;
}

@keyframes goldLeafSway {
    from { transform: rotate(-1.5deg); }
    to { transform: rotate(1.5deg); }
}

/* Gold Sparkles Twinkle */
.sparkle-1 {
    animation: sparkleTwinkle 3.5s ease-in-out infinite;
}
.sparkle-2 {
    animation: sparkleTwinkle 4.2s ease-in-out infinite 1.2s;
}
.sparkle-3 {
    animation: sparkleTwinkle 3s ease-in-out infinite 0.7s;
}

@keyframes sparkleTwinkle {
    0%, 100% { transform: scale(0.7); opacity: 0.35; }
    50% { transform: scale(1.2); opacity: 1; filter: drop-shadow(0 0 4px #ffe699); }
}

/* Interactive Shimmer Luster on Hover */
.gold-foil-cluster:hover .grand-foil-rose {
    animation-duration: 3.5s;
    filter: drop-shadow(0 0 10px rgba(232, 200, 109, 0.65));
}
</style>
