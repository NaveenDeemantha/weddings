<template>
    <div
        v-if="!hasFinishedIntro"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden bg-stone-900/90 backdrop-blur-sm transition-opacity duration-700 select-none p-3 sm:p-6"
        :class="{ 'opacity-0 pointer-events-none': isFadingOut }"
        style="perspective: 1400px;"
    >
        <!-- The Revealed Cathedral Altar (Underneath the doors) -->
        <div class="absolute inset-0 flex flex-col items-center justify-between p-6 bg-gradient-to-b from-[#151f2e] via-[#223147] to-[#0e1622] text-center overflow-hidden">
            <!-- Ambient Cathedral Lighting Rays -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-amber-200/15 via-transparent to-transparent pointer-events-none"></div>

            <!-- Vaulted Cathedral Ceiling & Stained Glass Rose Window Illustration -->
            <div class="relative w-full max-w-md mx-auto flex flex-col items-center pt-8 sm:pt-14">
                <!-- Stained Glass Rose Window SVG -->
                <svg class="w-44 h-44 sm:w-56 sm:h-56 text-amber-200/90 drop-shadow-2xl animate-pulse-subtle" viewBox="0 0 200 200" fill="none">
                    <circle cx="100" cy="100" r="95" fill="#1e2c40" stroke="#d8b878" stroke-width="2" />
                    <circle cx="100" cy="100" r="82" stroke="#c5a059" stroke-width="1.5" stroke-dasharray="4 4" />
                    <circle cx="100" cy="100" r="50" fill="#2d4059" stroke="#d8b878" stroke-width="1.5" />
                    <line x1="100" y1="18" x2="100" y2="182" stroke="#c5a059" stroke-width="1.5" />
                    <line x1="18" y1="100" x2="182" y2="100" stroke="#c5a059" stroke-width="1.5" />
                    <line x1="42" y1="42" x2="158" y2="158" stroke="#c5a059" stroke-width="1.5" />
                    <line x1="158" y1="42" x2="42" y2="158" stroke="#c5a059" stroke-width="1.5" />
                    <circle cx="100" cy="100" r="22" fill="#d8b878" />
                    <line x1="100" y1="86" x2="100" y2="114" stroke="#15253b" stroke-width="3.5" stroke-linecap="round" />
                    <line x1="88" y1="96" x2="112" y2="96" stroke="#15253b" stroke-width="3" stroke-linecap="round" />
                </svg>

                <p class="font-serif italic text-sm sm:text-base text-amber-100/90 mt-5 tracking-wide">
                    Welcome to the Holy Matrimony
                </p>
                <p class="font-serif text-2xl sm:text-3xl text-amber-50 mt-1 uppercase tracking-widest">
                    {{ groomName }} &amp; {{ brideName }}
                </p>
                <p class="font-serif italic text-xs text-stone-300 mt-1.5">
                    St. Mary's Church, Negombo, Sri Lanka
                </p>
            </div>

            <!-- Falling Petals in the Altar Sunbeams -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div
                    v-for="i in 20"
                    :key="i"
                    class="absolute w-2.5 h-2.5 bg-white/70 rounded-full blur-[0.5px] animate-fall"
                    :style="{
                        left: (i * 4.8) + '%',
                        animationDuration: (3.5 + (i % 4)) + 's',
                        animationDelay: ((i % 6) * 0.3) + 's',
                    }"
                ></div>
            </div>

            <!-- Skip / Enter Button -->
            <div class="relative z-20 w-full flex justify-end pb-4 sm:pb-6 pr-2 sm:pr-6">
                <button
                    type="button"
                    @click="finishIntro"
                    class="px-5 py-2 rounded-full bg-stone-900/80 hover:bg-stone-900 text-amber-100 text-[10px] uppercase tracking-[0.25em] font-sans font-semibold border border-amber-300/40 shadow-lg hover:border-amber-300 transition-all transform active:scale-95"
                >
                    Enter Invitation ↗
                </button>
            </div>
        </div>

        <!-- The Grand Gothic Cathedral Double Doors Portal (Matching Screenshot 1) -->
        <div class="relative w-full max-w-[370px] sm:max-w-[420px] h-[92vh] max-h-[820px] rounded-t-[160px] sm:rounded-t-[190px] rounded-b-2xl border-4 border-[#c5a059]/80 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.8)] overflow-hidden bg-[#faf6ee] pointer-events-auto">
            <!-- 3D Double Doors -->
            <div class="absolute inset-0 flex items-stretch overflow-hidden">
                <!-- Left Door Leaf -->
                <div
                    class="w-1/2 h-full bg-gradient-to-r from-[#ebe2d1] via-[#f7f2e7] to-[#ede4d4] border-r border-[#8c6d37]/70 shadow-inner relative transition-transform duration-1000 origin-left flex flex-col justify-between p-3 sm:p-4"
                    :style="{
                        transform: isDoorsOpen ? 'rotateY(-85deg)' : 'rotateY(0deg)',
                    }"
                >
                    <!-- Molded Arch Border -->
                    <div class="absolute inset-2.5 sm:inset-3 rounded-t-[140px] sm:rounded-t-[170px] rounded-b-lg border-2 border-[#c5a059]/60 pointer-events-none"></div>

                    <!-- Top Gothic Tracery Arch in Gold -->
                    <div class="relative mt-2 flex justify-end pr-1">
                        <svg class="w-16 sm:w-20 h-20 sm:h-24 text-gold-600/50" viewBox="0 0 100 120" fill="none">
                            <path d="M 95 120 V 50 C 95 25 70 5 10 5" stroke="#c5a059" stroke-width="2" />
                            <path d="M 85 120 V 55 C 85 35 65 18 20 18" stroke="#d8b878" stroke-width="1.2" />
                        </svg>
                    </div>

                    <!-- Lower Section: Antique Bronze Ring Knocker -->
                    <div class="relative mt-auto mb-6 flex justify-end pr-2 sm:pr-3">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#3d2f1f] border-2 border-[#d8b878] shadow-md flex items-center justify-center">
                            <div class="w-5 h-6 sm:w-5 sm:h-7 border-2 border-[#d8b878] rounded-full mt-1.5"></div>
                        </div>
                    </div>

                    <!-- Bottom Quatrefoil Relief Panel -->
                    <div class="relative mb-3 flex justify-end pr-1.5 sm:pr-2.5">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl border-2 border-[#c5a059]/70 bg-[#f4ebe0] flex items-center justify-center text-gold-700 text-sm sm:text-base font-serif shadow-inner">
                            𑁍
                        </div>
                    </div>
                </div>

                <!-- Right Door Leaf -->
                <div
                    class="w-1/2 h-full bg-gradient-to-l from-[#ebe2d1] via-[#f7f2e7] to-[#ede4d4] border-l border-[#8c6d37]/70 shadow-inner relative transition-transform duration-1000 origin-right flex flex-col justify-between p-3 sm:p-4"
                    :style="{
                        transform: isDoorsOpen ? 'rotateY(85deg)' : 'rotateY(0deg)',
                    }"
                >
                    <!-- Molded Arch Border -->
                    <div class="absolute inset-2.5 sm:inset-3 rounded-t-[140px] sm:rounded-t-[170px] rounded-b-lg border-2 border-[#c5a059]/60 pointer-events-none"></div>

                    <!-- Top Gothic Tracery Arch in Gold -->
                    <div class="relative mt-2 flex justify-start pl-1">
                        <svg class="w-16 sm:w-20 h-20 sm:h-24 text-gold-600/50" viewBox="0 0 100 120" fill="none">
                            <path d="M 5 120 V 50 C 5 25 30 5 90 5" stroke="#c5a059" stroke-width="2" />
                            <path d="M 15 120 V 55 C 15 35 35 18 80 18" stroke="#d8b878" stroke-width="1.2" />
                        </svg>
                    </div>

                    <!-- Lower Section: Antique Bronze Ring Knocker -->
                    <div class="relative mt-auto mb-6 flex justify-start pl-2 sm:pl-3">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#3d2f1f] border-2 border-[#d8b878] shadow-md flex items-center justify-center">
                            <div class="w-5 h-6 sm:w-5 sm:h-7 border-2 border-[#d8b878] rounded-full mt-1.5"></div>
                        </div>
                    </div>

                    <!-- Bottom Quatrefoil Relief Panel -->
                    <div class="relative mb-3 flex justify-start pl-1.5 sm:pl-2.5">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl border-2 border-[#c5a059]/70 bg-[#f4ebe0] flex items-center justify-center text-gold-700 text-sm sm:text-base font-serif shadow-inner">
                            𑁍
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Foreground Invitation Content (Located in Clear Upper Half - No Overlaps) -->
            <div
                v-if="!isDoorsOpen"
                class="absolute inset-x-0 top-0 pt-7 sm:pt-9 px-4 flex flex-col items-center text-center z-20 pointer-events-none"
            >
                <!-- 1. The Wedding Of -->
                <p class="font-sans text-[9px] sm:text-[10px] uppercase tracking-[0.28em] font-semibold text-gold-800">
                    The Wedding of
                </p>

                <!-- 2. Latin Cross -->
                <div class="my-1 text-gold-700 text-xs">✝</div>

                <!-- 3. Couple Names (Strictly bounded, no side clipping) -->
                <h1 class="font-serif text-2xl sm:text-3xl text-[#15253b] tracking-normal font-normal leading-snug px-2 max-w-[300px] mx-auto">
                    {{ groomName }} <span class="font-script text-2xl sm:text-3xl text-gold-700 italic font-normal">&amp;</span> {{ brideName }}
                </h1>

                <!-- 4. Date Line -->
                <p class="font-serif italic text-xs text-stone-600 mt-1">
                    Saturday, 12th December 2026
                </p>

                <!-- 5. OPEN INVITATION Button -->
                <div class="my-4 pointer-events-auto">
                    <button
                        type="button"
                        @click="handleOpen"
                        class="group px-6 py-2.5 rounded-full border border-[#15253b] bg-white hover:bg-stone-50 text-[#15253b] text-[11px] sm:text-xs uppercase tracking-[0.2em] font-serif font-bold shadow-md hover:shadow-xl transition-all transform hover:scale-105 active:scale-95 flex items-center gap-2"
                    >
                        <span class="text-xs">⛪</span>
                        <span>Open Invitation</span>
                    </button>
                </div>

                <!-- 6. Dear Guest Salutation (Clearly above the knockers, zero clash) -->
                <div class="pointer-events-auto">
                    <p class="text-[9px] uppercase tracking-[0.25em] font-sans font-semibold text-stone-500 mb-0.5">
                        Dear
                    </p>
                    <h2 class="font-serif text-sm sm:text-base font-bold tracking-wider text-[#15253b] uppercase leading-snug px-2 max-w-[260px] mx-auto">
                        {{ guestGreeting || guestName }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    guestName: { type: String, default: 'Mr & Mrs Silva' },
    guestGreeting: { type: String, default: 'MR & MRS SILVA' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
});

const emit = defineEmits(['opened']);

const isDoorsOpen = ref(false);
const hasFinishedIntro = ref(false);
const isFadingOut = ref(false);

const handleOpen = () => {
    if (isDoorsOpen.value) return;
    isDoorsOpen.value = true;
    emit('opened');

    try {
        sessionStorage.setItem('wedding_door_opened', 'true');
    } catch {
        // Ignore storage errors
    }

    // Transition smoothly to the card after 2.6 seconds
    setTimeout(() => {
        finishIntro();
    }, 2600);
};

const finishIntro = () => {
    if (isFadingOut.value) return;
    isFadingOut.value = true;
    setTimeout(() => {
        hasFinishedIntro.value = true;
    }, 600);
};

onMounted(() => {
    // If the guest is navigating directly to a section anchor, don't trap them on the doors
    if (window.location.hash && window.location.hash.length > 1) {
        hasFinishedIntro.value = true;
    }
});
</script>

<style scoped>
@keyframes fall {
    0% { transform: translateY(-20px) rotate(0deg); opacity: 0; }
    20% { opacity: 0.9; }
    100% { transform: translateY(105vh) rotate(360deg); opacity: 0; }
}

.animate-fall {
    animation-name: fall;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}
</style>
