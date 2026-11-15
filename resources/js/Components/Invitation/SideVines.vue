<template>
    <div class="pointer-events-none fixed inset-y-0 left-0 right-0 z-0 hidden md:block overflow-hidden" aria-hidden="true">
        <div class="vine vine-left" :style="vineStyle"></div>
        <div class="vine vine-right" :style="vineStyle"></div>
    </div>
</template>

<script setup>
const bloom = (cx, cy, s, c1, c2) => {
    let g = `<g transform="translate(${cx} ${cy}) scale(${s})">`;
    for (let i = 0; i < 8; i++) g += `<ellipse cx="0" cy="-10" rx="5.5" ry="10" fill="${c1}" stroke="white" stroke-width=".6" transform="rotate(${i * 45})"/>`;
    for (let i = 0; i < 6; i++) g += `<ellipse cx="0" cy="-6" rx="3.6" ry="6" fill="${c2}" opacity=".92" transform="rotate(${i * 60 + 20})"/>`;
    return g + `<circle r="3" fill="#fff4d6"/><circle r="1.3" fill="#ad2c51"/></g>`;
};
const leaf = (x, y, r, c = '#9db98a') => `<path d="M0 0C-9-12-5-26 6-30 12-18 8-6 0 0Z" fill="${c}" transform="translate(${x} ${y}) rotate(${r})"/>`;

const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="140" height="460" viewBox="0 0 140 460" fill="none">
<path d="M40 0C90 60 20 110 60 170S95 260 55 320 85 410 45 460" stroke="#7d9a6a" stroke-width="2.4" stroke-linecap="round"/>
${leaf(62, 40, 60)}${leaf(34, 90, -70, '#8aa877')}${leaf(66, 200, 50)}${leaf(52, 280, -60, '#8aa877')}${leaf(70, 370, 70)}${leaf(40, 430, -50, '#8aa877')}
${bloom(66, 70, 1.25, '#F678A4', '#ad2c51')}
${bloom(38, 150, .8, '#fbb1cb', '#C8636F')}
${bloom(78, 235, 1.1, '#F678A4', '#C8636F')}
${bloom(46, 330, .9, '#fbb1cb', '#ad2c51')}
${bloom(76, 420, 1.0, '#F678A4', '#ad2c51')}
<circle cx="92" cy="130" r="4" fill="#F678A4"/><circle cx="22" cy="205" r="3.5" fill="#C8636F"/><circle cx="98" cy="300" r="4" fill="#fbb1cb"/><circle cx="24" cy="395" r="3.5" fill="#F678A4"/>
</svg>`;

const vineStyle = { backgroundImage: `url("data:image/svg+xml;utf8,${encodeURIComponent(svg)}")` };
</script>

<style scoped>
.vine { position: absolute; top: 0; bottom: 0; width: 110px; background-repeat: repeat-y; background-size: 110px 361px; opacity: .9; animation: vineSway 7s ease-in-out infinite alternate, vineDrift 40s linear infinite; transform-origin: top center; }
.vine-left { left: -20px; }
.vine-right { right: -20px; transform: scaleX(-1); animation-delay: -3s; }
@media (min-width: 1280px) { .vine { width: 140px; background-size: 140px 460px; } }
@media (min-width: 1536px) { .vine { width: 230px; background-size: 230px 755px; } .vine-left { left: 0; } .vine-right { right: 0; } }
@keyframes vineSway { from { filter: hue-rotate(0deg); margin-left: -4px; } to { filter: hue-rotate(0deg); margin-left: 6px; } }
@keyframes vineDrift { from { background-position-y: 0; } to { background-position-y: 460px; } }
</style>
