<template>
    <!-- A hand-built blossom cluster: leaves + 3 layered blooms, gently swaying. Use mirrored/rotated by the parent. -->
    <svg viewBox="0 0 220 220" fill="none" class="flower-cluster select-none pointer-events-none" aria-hidden="true">
        <defs>
            <radialGradient id="fc-outer" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#F678A4" />
                <stop offset="100%" stop-color="#fbb1cb" />
            </radialGradient>
            <radialGradient id="fc-inner" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#ad2c51" />
                <stop offset="100%" stop-color="#C8636F" />
            </radialGradient>
            <g id="fc-bloom">
                <g v-for="i in 8" :key="'o' + i" :transform="`rotate(${i * 45})`">
                    <ellipse cx="0" cy="-17" rx="9" ry="17" fill="url(#fc-outer)" stroke="#fff" stroke-opacity=".7" stroke-width=".8" />
                </g>
                <g v-for="i in 6" :key="'i' + i" :transform="`rotate(${i * 60 + 20})`">
                    <ellipse cx="0" cy="-10" rx="6" ry="10.5" fill="url(#fc-inner)" opacity=".9" stroke="#fff" stroke-opacity=".5" stroke-width=".6" />
                </g>
                <circle r="5" fill="#fff4d6" />
                <circle r="2.2" fill="#ad2c51" />
            </g>
        </defs>

        <!-- stems -->
        <path d="M0 220 C 40 160, 70 120, 120 80" stroke="#7d9a6a" stroke-width="2.5" stroke-linecap="round" />
        <path d="M30 220 C 60 180, 110 150, 170 130" stroke="#7d9a6a" stroke-width="2" stroke-linecap="round" />

        <!-- leaves -->
        <g class="leaf-sway">
            <path d="M40 170 C 20 150, 24 125, 48 118 C 56 140, 52 158, 40 170Z" fill="#9db98a" />
            <path d="M80 135 C 66 112, 78 92, 100 92 C 104 112, 96 126, 80 135Z" fill="#8aa877" />
            <path d="M110 170 C 100 150, 112 132, 132 134 C 134 150, 126 164, 110 170Z" fill="#9db98a" />
            <path d="M18 205 C 40 205, 62 192, 70 176 C 50 174, 28 186, 18 205Z" fill="#8aa877" />
        </g>

        <!-- blooms -->
        <g class="bloom-sway-a"><use href="#fc-bloom" transform="translate(120 78) scale(1.35)" /></g>
        <g class="bloom-sway-b"><use href="#fc-bloom" transform="translate(172 128) scale(.95)" /></g>
        <g class="bloom-sway-a"><use href="#fc-bloom" transform="translate(66 128) scale(.8)" /></g>

        <!-- buds -->
        <g fill="#F678A4"><circle cx="150" cy="40" r="5" /><circle cx="188" cy="82" r="4" /><circle cx="40" cy="100" r="4.5" /></g>
    </svg>
</template>

<style scoped>
.flower-cluster { overflow: visible; }
.leaf-sway { transform-box: fill-box; transform-origin: 0% 100%; animation: sway 6s ease-in-out infinite; }
.bloom-sway-a { transform-box: fill-box; transform-origin: center; animation: bloomA 5s ease-in-out infinite; }
.bloom-sway-b { transform-box: fill-box; transform-origin: center; animation: bloomB 6.5s ease-in-out infinite; }
@keyframes sway { 0%,100% { transform: rotate(-2deg); } 50% { transform: rotate(2.5deg); } }
@keyframes bloomA { 0%,100% { transform: rotate(-4deg) scale(1); } 50% { transform: rotate(5deg) scale(1.05); } }
@keyframes bloomB { 0%,100% { transform: rotate(5deg) scale(1.03); } 50% { transform: rotate(-4deg) scale(.98); } }
</style>
