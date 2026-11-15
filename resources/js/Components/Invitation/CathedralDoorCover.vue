<template>
    <div
        v-if="!hasFinishedIntro"
        data-no-burst class="fixed inset-0 z-50 overflow-hidden select-none transition-opacity duration-700"
        :class="{ 'opacity-0 pointer-events-none': isFadingOut }"
        style="background: radial-gradient(ellipse at 50% 40%, #C8636F 0%, #ad2c51 55%, #6e1a34 100%);"
        @mousemove="onMove"
        @click="burst($event)"
    >
        <!-- soft light pools -->
        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 20% 15%, rgba(246,120,164,.45), transparent 45%), radial-gradient(circle at 85% 85%, rgba(246,120,164,.35), transparent 45%);"></div>

        <!-- Corner flowers with mouse parallax -->
        <div class="absolute bottom-0 left-0 pointer-events-none" :style="par(-26)">
            <FlowerCluster class="w-28 sm:w-80 lg:w-[26rem] -translate-x-3 translate-y-6 sm:-translate-x-4 sm:translate-y-4" />
        </div>
        <div class="absolute bottom-0 right-0 pointer-events-none" :style="par(26)">
            <FlowerCluster class="w-28 sm:w-80 lg:w-[26rem] translate-x-3 translate-y-6 sm:translate-x-4 sm:translate-y-4 -scale-x-100" />
        </div>
        <div class="absolute top-0 left-0 pointer-events-none" :style="par(-18)">
            <FlowerCluster class="w-24 sm:w-64 lg:w-80 -translate-x-5 -translate-y-6 sm:-translate-x-4 sm:-translate-y-4 -scale-y-100" />
        </div>
        <div class="absolute top-0 right-0 pointer-events-none" :style="par(18)">
            <FlowerCluster class="w-24 sm:w-64 lg:w-80 translate-x-5 -translate-y-6 sm:translate-x-4 sm:-translate-y-4 rotate-180" />
        </div>

        <!-- Ambient floating petals -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <span
                v-for="i in 22"
                :key="i"
                class="amb-petal"
                :style="{ left: ((i * 4.7) % 100) + '%', animationDuration: (9 + (i % 6) * 1.6) + 's', animationDelay: (-(i % 9) * 1.3) + 's', width: (10 + (i % 4) * 4) + 'px', height: (14 + (i % 4) * 5) + 'px', opacity: .55 + (i % 3) * .15 }"
            ></span>
        </div>

        <!-- Main stage -->
        <div class="relative z-10 h-full flex flex-col items-center justify-between px-4 pt-28 pb-32 sm:pt-8 sm:pb-8 text-center text-white" :class="{ 'stage-out': isEntering }">
            <!-- Top: names -->
            <div class="enter-up">
                <p class="font-display text-xs sm:text-sm tracking-[0.4em] text-pink-100 font-semibold">THE WEDDING OF</p>
                <h1 class="mt-2 font-serif font-semibold leading-none text-[2.6rem] sm:text-6xl lg:text-7xl drop-shadow-[0_4px_18px_rgba(110,26,52,.55)]">
                    {{ groomName }}
                    <span class="font-script font-normal text-pink-200 text-4xl sm:text-5xl lg:text-6xl mx-1 sm:mx-2 align-middle">&amp;</span>
                    {{ brideName }}
                </h1>
                <p class="mt-3 font-serif italic text-lg sm:text-xl text-pink-50">
                    Dear <span class="font-semibold not-italic text-white">{{ guestGreeting || guestName || 'Respected Guest' }}</span>, you are invited
                </p>
            </div>

            <!-- Middle: the interactive bloom -->
            <div class="relative flex items-center justify-center" :style="{ width: size + 'px', height: size + 'px' }">
                <button
                    type="button"
                    @click.stop="bloom($event)"
                    class="relative block cursor-pointer outline-none"
                    :style="{ width: size + 'px', height: size + 'px' }"
                    aria-label="Tap the flower to open the invitation"
                >
                    <div class="absolute left-0 top-0 origin-top-left" :style="{ width: '560px', height: '560px', transform: `scale(${k})` }">
                        <div class="bloom-float absolute inset-0" :class="{ 'bloom-zoom': isEntering }">
                            <!-- glow -->
                            <div class="absolute inset-[18%] rounded-full blur-3xl transition-opacity duration-1000" :class="bloomed ? 'opacity-90' : 'opacity-40'" style="background: radial-gradient(circle, #ffe4ee, #F678A4 60%, transparent 75%);"></div>

                            <!-- petals -->
                            <div
                                v-for="p in petals"
                                :key="p.id"
                                class="absolute"
                                :style="{
                                    left: '50%', top: '50%',
                                    width: p.w + 'px', height: p.h + 'px',
                                    marginLeft: (-p.w / 2) + 'px', marginTop: (-p.h) + 'px',
                                    transformOrigin: '50% 100%',
                                    transform: bloomed ? `rotate(${p.a}deg) scale(1)` : `rotate(${p.a * 0.1}deg) scale(.42)`,
                                    transition: `transform 1.7s cubic-bezier(.2,.9,.25,1.15) ${p.delay}s`,
                                    zIndex: p.z,
                                }"
                            >
                                <div class="w-full h-full" :style="{ background: p.bg, borderRadius: '50% 50% 46% 46% / 88% 88% 14% 14%', boxShadow: 'inset 0 -14px 24px rgba(173,44,81,.25), 0 2px 10px rgba(110,26,52,.25)', border: '1px solid rgba(255,255,255,.55)' }"></div>
                            </div>

                            <!-- centre -->
                            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full z-[60] transition-transform duration-1000" :class="bloomed ? 'scale-100' : 'scale-75'" style="width:70px;height:70px;background: radial-gradient(circle at 35% 35%, #fff6d8, #f7d27a 55%, #c8636f);box-shadow:0 0 24px rgba(255,235,170,.9);"></div>
                            <div v-for="n in 9" :key="'s' + n" class="absolute left-1/2 top-1/2 rounded-full z-[61] transition-all duration-1000" :style="{ width: '7px', height: '7px', background: '#ad2c51', transform: `translate(-50%,-50%) rotate(${n * 40}deg) translateY(${bloomed ? -40 : -8}px)` }"></div>
                        </div>
                    </div>

                    <!-- tap hint ring -->
                    <span v-if="!bloomed" class="pointer-events-none absolute inset-[30%] rounded-full border-2 border-white/80 hint-ring"></span>
                </button>
            </div>

            <!-- Bottom: prompt / details + enter -->
            <div class="min-h-[7.5rem] sm:min-h-[9rem] flex flex-col items-center justify-start">
                <p v-if="!bloomed" class="font-display text-sm sm:text-base tracking-[0.35em] text-white font-semibold animate-pulse">TAP THE FLOWER TO BLOOM</p>
                <div v-else class="reveal-in-up flex flex-col items-center">
                    <p class="font-serif text-2xl sm:text-3xl italic font-medium">Tuesday, 29th December 2026</p>
                    <p class="mt-1 font-display text-xs sm:text-sm tracking-[0.3em] text-pink-100">ST. MARY'S CHURCH · MORATUWA</p>
                    <button
                        type="button"
                        @click.stop="enter"
                        class="mt-5 px-10 sm:px-12 py-3.5 sm:py-4 rounded-full bg-white text-[#ad2c51] font-display text-sm sm:text-base tracking-[0.25em] font-bold shadow-[0_10px_40px_rgba(110,26,52,.5)] hover:scale-105 active:scale-95 transition-transform cursor-pointer"
                    >
                        ENTER INVITATION
                    </button>
                </div>
            </div>
        </div>

        <!-- Click bursts -->
        <span
            v-for="b in bursts"
            :key="b.id"
            class="burst-petal pointer-events-none fixed z-[70]"
            :style="{ left: b.x + 'px', top: b.y + 'px', '--dx': b.dx + 'px', '--dy': b.dy + 'px', '--rot': b.rot + 'deg', background: b.color, width: b.s + 'px', height: b.s * 1.4 + 'px' }"
        ></span>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import FlowerCluster from '@/Components/Invitation/FlowerCluster.vue';

defineProps({
    guestName: { type: String, default: 'Respected Guest' },
    guestGreeting: { type: String, default: '' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
});

const emit = defineEmits(['opened']);

const bloomed = ref(false);
const isEntering = ref(false);
const isFadingOut = ref(false);
const hasFinishedIntro = ref(false);

// Bloom geometry (designed on a 560px canvas, scaled to fit)
const rings = [
    { n: 12, w: 150, h: 250, off: 0,  bg: 'linear-gradient(to top, #F678A4, #ffe4ee 70%, #ffffff)', z: 1, d: 0 },
    { n: 10, w: 130, h: 205, off: 18, bg: 'linear-gradient(to top, #C8636F, #F678A4 60%, #ffc8dc)', z: 2, d: .12 },
    { n: 8,  w: 112, h: 160, off: 0,  bg: 'linear-gradient(to top, #ad2c51, #C8636F 65%, #F678A4)', z: 3, d: .24 },
    { n: 6,  w: 90,  h: 112, off: 30, bg: 'linear-gradient(to top, #8a2342, #ad2c51 70%, #C8636F)', z: 4, d: .36 },
];
const petals = rings.flatMap((r, ri) =>
    Array.from({ length: r.n }, (_, i) => ({
        id: `${ri}-${i}`, w: r.w, h: r.h, a: (360 / r.n) * i + r.off, bg: r.bg, z: r.z, delay: r.d + i * 0.025,
    })),
);

// Responsive size
const size = ref(420);
const k = computed(() => size.value / 560);
const resize = () => {
    size.value = Math.max(240, Math.min(window.innerWidth * 0.92, window.innerHeight * 0.36, 560));
};

// Mouse parallax
const mx = ref(0), my = ref(0);
const onMove = (e) => {
    mx.value = e.clientX / window.innerWidth - 0.5;
    my.value = e.clientY / window.innerHeight - 0.5;
};
const par = (f) => ({ transform: `translate(${mx.value * f}px, ${my.value * f}px)`, transition: 'transform .25s ease-out' });

// Petal bursts on every click/tap
const bursts = ref([]);
let bid = 0;
const colors = ['#ffffff', '#ffe4ee', '#F678A4', '#fbb1cb', '#ffffff'];
const burst = (e, count = 14) => {
    const fresh = Array.from({ length: count }, () => {
        const ang = Math.random() * Math.PI * 2;
        const dist = 80 + Math.random() * 160;
        return {
            id: ++bid, x: e.clientX, y: e.clientY,
            dx: Math.cos(ang) * dist, dy: Math.sin(ang) * dist + 60,
            rot: Math.random() * 540 - 270, s: 9 + Math.random() * 9,
            color: colors[Math.floor(Math.random() * colors.length)],
        };
    });
    bursts.value.push(...fresh);
    setTimeout(() => { bursts.value = bursts.value.filter((b) => !fresh.includes(b)); }, 1600);
};

const bloom = (e) => {
    if (bloomed.value) return;
    bloomed.value = true;
    burst(e, 34);
    emit('opened');
};

const enter = () => {
    emit('opened');
    isEntering.value = true;
    setTimeout(() => { isFadingOut.value = true; }, 900);
    setTimeout(() => { hasFinishedIntro.value = true; }, 1600);
};

onMounted(() => { resize(); window.addEventListener('resize', resize); });
onUnmounted(() => window.removeEventListener('resize', resize));
</script>

<style scoped>
.enter-up { animation: fadeUp 1s ease-out both; }
.reveal-in-up { animation: fadeUp .9s ease-out .6s both; }
@keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: none; } }

.bloom-float { animation: bob 6s ease-in-out infinite; }
@keyframes bob { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-8px) rotate(1.5deg); } }
.bloom-zoom { animation: none; transform: scale(5); opacity: 0; transition: transform 1.3s ease-in, opacity 1.1s ease-in; }
.stage-out > :not(:nth-child(2)) { opacity: 0; transition: opacity .5s; }

.hint-ring { animation: ping 1.8s cubic-bezier(0,0,.2,1) infinite; }
@keyframes ping { 0% { transform: scale(.8); opacity: .9; } 100% { transform: scale(1.7); opacity: 0; } }

.amb-petal {
    position: absolute; top: -30px; border-radius: 50% 50% 46% 46% / 88% 88% 14% 14%;
    background: linear-gradient(to top, #F678A4, #fff); animation: fall linear infinite;
}
@keyframes fall {
    0% { transform: translate(0, -30px) rotate(0deg); }
    50% { transform: translate(40px, 55vh) rotate(200deg); }
    100% { transform: translate(-20px, 108vh) rotate(400deg); }
}

.burst-petal {
    border-radius: 50% 50% 46% 46% / 88% 88% 14% 14%;
    animation: burst 1.5s cubic-bezier(.2,.7,.3,1) forwards;
}
@keyframes burst {
    0% { transform: translate(-50%, -50%) rotate(0deg) scale(.4); opacity: 1; }
    100% { transform: translate(calc(-50% + var(--dx)), calc(-50% + var(--dy))) rotate(var(--rot)) scale(1); opacity: 0; }
}
</style>
