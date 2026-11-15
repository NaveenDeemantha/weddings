<template>
    <div class="pointer-events-none fixed inset-y-0 left-0 right-0 z-0 hidden md:block overflow-hidden" aria-hidden="true">
        <div class="vine vine-left" :style="vineStyle"></div>
        <div class="vine vine-right" :style="vineStyle"></div>
    </div>
</template>

<script setup>
const foilBloom = (cx, cy, s) => {
    let g = `<g transform="translate(${cx} ${cy}) scale(${s})">`;
    // Soft blush wash
    g += `<circle cx="0" cy="0" r="14" fill="#ffd5e5" opacity="0.45" />`;
    // Gold foil outer petals
    for (let i = 0; i < 8; i++) {
        g += `<path d="M0 0C-5-3-7-9-3-13C1-15 5-14 7-10C8-6 5-2 0 0Z" stroke="#e8c86d" stroke-width="0.9" fill="none" transform="rotate(${i * 45})"/>`;
    }
    // Gold foil inner petals
    for (let i = 0; i < 6; i++) {
        g += `<path d="M0 0C-3-2-5-6-2-8C1-9 3-8 4-6C5-4 3-1 0 0Z" stroke="#f5dc8a" stroke-width="0.8" fill="none" transform="rotate(${i * 60 + 20})"/>`;
    }
    // Gold core
    g += `<circle r="3.2" fill="#e8c86d"/><circle r="1.5" fill="#ffffff"/></g>`;
    return g;
};

const foilLeaf = (x, y, r) => `
    <g transform="translate(${x} ${y}) rotate(${r})">
        <path d="M0 0C-8-11-12-25 0-35C12-25 8-11 0 0Z" fill="#7d9d68" opacity="0.35"/>
        <path d="M0 0C-8-11-12-25 0-35C12-25 8-11 0 0Z" stroke="#d8ab43" stroke-width="1.1" fill="none"/>
        <path d="M0 0L0-32M0-10L-5-18M0-10L5-18" stroke="#f5dc8a" stroke-width="0.65" stroke-linecap="round"/>
    </g>
`;

const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="140" height="460" viewBox="0 0 140 460" fill="none">
    <!-- Master Gold Foil Vine Spine -->
    <path d="M40 0C90 60 20 110 60 170S95 260 55 320 85 410 45 460" stroke="#d8ab43" stroke-width="1.8" stroke-linecap="round"/>
    <path d="M42 0C92 60 22 110 62 170S97 260 57 320 87 410 47 460" stroke="#f5dc8a" stroke-width="0.8" opacity="0.6" stroke-linecap="round"/>
    
    <!-- Gold Foil Leaves with Filigree -->
    ${foilLeaf(62, 40, 60)}
    ${foilLeaf(34, 90, -70)}
    ${foilLeaf(66, 200, 50)}
    ${foilLeaf(52, 280, -60)}
    ${foilLeaf(70, 370, 70)}
    ${foilLeaf(40, 430, -50)}

    <!-- Gold Foil Roses with Blush Underlay -->
    ${foilBloom(66, 70, 1.2)}
    ${foilBloom(38, 150, 0.85)}
    ${foilBloom(78, 235, 1.1)}
    ${foilBloom(46, 330, 0.9)}
    ${foilBloom(76, 420, 1.0)}

    <!-- Floating Gold Sparkles -->
    <circle cx="92" cy="130" r="2.5" fill="#f5dc8a" opacity="0.8"/>
    <circle cx="22" cy="205" r="2" fill="#e8c86d" opacity="0.75"/>
    <circle cx="98" cy="300" r="2.5" fill="#f5dc8a" opacity="0.8"/>
    <circle cx="24" cy="395" r="2" fill="#e8c86d" opacity="0.75"/>
</svg>`;

const vineStyle = { backgroundImage: `url("data:image/svg+xml;utf8,${encodeURIComponent(svg)}")` };
</script>

<style scoped>
.vine {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 110px;
    background-repeat: repeat-y;
    background-size: 110px 361px;
    opacity: 0.85;
    animation: vineSway 7s ease-in-out infinite alternate, vineDrift 45s linear infinite;
    transform-origin: top center;
}
.vine-left { left: -16px; }
.vine-right { right: -16px; transform: scaleX(-1); animation-delay: -3s; }
@media (min-width: 1280px) { .vine { width: 140px; background-size: 140px 460px; } }
@media (min-width: 1536px) { .vine { width: 220px; background-size: 220px 722px; } .vine-left { left: 0; } .vine-right { right: 0; } }
@keyframes vineSway { from { margin-left: -3px; } to { margin-left: 5px; } }
@keyframes vineDrift { from { background-position-y: 0; } to { background-position-y: 460px; } }
</style>
