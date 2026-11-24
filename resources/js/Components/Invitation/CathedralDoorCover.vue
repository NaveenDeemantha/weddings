<template>
    <div
        v-if="!hasFinishedIntro"
        data-no-burst
        class="fixed inset-0 z-50 overflow-hidden select-none transition-all duration-1000 ease-in-out flex flex-col items-center justify-between bg-[#cbb8a3]"
        :class="{ 'opacity-0 scale-105 pointer-events-none': isFadingOut }"
        @mousemove="onMouseMove"
    >
        <!-- ================= SKIP / ENTER BUTTON (TOP RIGHT) ================= -->
        <button
            v-if="isOpening && !isFadingOut"
            type="button"
            @click.stop="skipIntro"
            class="fixed top-4 right-16 sm:right-20 z-[70] inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-black/60 hover:bg-black/85 text-white/95 hover:text-white font-sans text-xs tracking-wider uppercase font-semibold backdrop-blur-md border border-white/30 shadow-2xl transition-all transform active:scale-95 cursor-pointer"
            :aria-label="isEndingTransition ? 'Enter invitation' : 'Skip video'"
            :title="isEndingTransition ? 'Enter Invitation' : 'Skip Video'"
        >
            <span>{{ isEndingTransition ? 'Enter' : 'Skip' }}</span>
            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                <path d="M5.5 4.5l8 6.5-8 6.5V4.5zM15.5 4.5h2v13h-2v-13z" />
            </svg>
        </button>

        <!-- ================= FULLSCREEN CATHEDRAL FACADE ARCHITECTURAL BACKGROUND ================= -->
        <!-- Authentic French Limestone Cathedral Facade Surround (User Provided Asset) -->
        <div
            class="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none transition-all duration-1000 ease-out"
            :class="{ 'filter blur-md scale-105 brightness-75': isEndingTransition }"
        >
            <!-- Ambient blurred stone texture to seamlessly fill ultra-wide displays -->
            <div
                class="absolute inset-0 bg-cover bg-center filter blur-xl scale-110 opacity-70"
                style="background-image: url('/images/invitation/cathedral_facade_surround.jpg');"
            ></div>

            <!-- Crisp Full Cathedral Facade Image (Centered, majestic) -->
            <img
                src="/images/invitation/cathedral_facade_surround.jpg"
                alt="Cathedral Facade Surroundings"
                class="w-full h-full object-cover object-center select-none"
            />

            <!-- Soft ambient twilight vignette -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-black/35 pointer-events-none"></div>
        </div>

        <!-- ================= MAIN CATHEDRAL PORTAL STAGE ================= -->
        <!-- Center Stage: The Grand Cathedral Entrance & Double Doors (Directly filling mobile screens) -->
        <main
            class="relative z-10 w-full h-full flex items-center justify-center p-0 sm:p-4 transition-all duration-1000 ease-out"
            :class="{ 'filter blur-md scale-105 brightness-75': isEndingTransition }"
            :style="mouseParallaxStyle"
        >
            <!-- The Cathedral Portal Structure (Direct mobile edge-to-edge layout, majestic on desktop) -->
            <div
                class="relative cathedral-portal-frame group overflow-hidden"
                @mouseenter="isHovered = true"
                @mouseleave="isHovered = false"
                @click="openChapelDoors"
                title="Push or Click the Cathedral Doors to Open"
            >
                <!-- ================= THE DOORWAY APERTURE ================= -->
                <!-- Contains the Video Player directly behind the 3D Doors -->
                <div class="relative w-full h-full overflow-hidden shadow-2xl bg-black">
                    
                    <!-- ================= THE VIDEO LAYER (PLAYED WHEN DOOR IS OPENED) ================= -->
                    <video
                        ref="doorVideoRef"
                        src="/videos/walkdown.mp4"
                        class="absolute inset-0 w-full h-full object-cover z-0 pointer-events-auto cursor-pointer transition-all duration-1000 ease-out"
                        :class="{ 'filter blur-sm scale-105': isEndingTransition }"
                        playsinline
                        muted
                        preload="auto"
                        @click.stop="skipIntro"
                        @ended="onVideoEnded"
                        title="Click or tap to skip video"
                    ></video>

                    <!-- ================= 3D DOUBLE DOORS VIEWPORT ================= -->
                    <div class="absolute inset-0 z-10 flex [perspective:1400px] pointer-events-auto">
                        
                        <!-- ================= LEFT CATHEDRAL DOOR LEAF ================= -->
                        <div
                            class="relative w-1/2 h-full [transform-origin:left_center] [transform-style:preserve-3d] transition-transform duration-[1850ms] ease-[cubic-bezier(0.22,1,0.36,1)] bg-[#dfd6c6]"
                            :class="[
                                isOpening ? 'door-left-open' : (isHovered ? 'door-left-ajar' : '')
                            ]"
                        >
                            <img
                                src="/images/invitation/door_left.jpg"
                                alt="Cathedral Left Door"
                                class="w-full h-full object-cover object-left select-none pointer-events-none"
                                draggable="false"
                            />
                            <!-- Dynamic 3D depth shadow on door swing -->
                            <div
                                class="absolute inset-y-0 right-0 w-8 bg-gradient-to-l from-black/50 to-transparent pointer-events-none transition-opacity duration-1000"
                                :class="isOpening ? 'opacity-100' : 'opacity-0'"
                            ></div>
                        </div>

                        <!-- ================= RIGHT CATHEDRAL DOOR LEAF ================= -->
                        <div
                            class="relative w-1/2 h-full [transform-origin:right_center] [transform-style:preserve-3d] transition-transform duration-[1850ms] ease-[cubic-bezier(0.22,1,0.36,1)] bg-[#dfd6c6]"
                            :class="[
                                isOpening ? 'door-right-open' : (isHovered ? 'door-right-ajar' : '')
                            ]"
                        >
                            <img
                                src="/images/invitation/door_right.jpg"
                                alt="Cathedral Right Door"
                                class="w-full h-full object-cover object-right select-none pointer-events-none"
                                draggable="false"
                            />
                            <!-- Dynamic 3D depth shadow on door swing -->
                            <div
                                class="absolute inset-y-0 left-0 w-8 bg-gradient-to-r from-black/50 to-transparent pointer-events-none transition-opacity duration-1000"
                                :class="isOpening ? 'opacity-100' : 'opacity-0'"
                            ></div>
                        </div>

                    </div>

                    <!-- ================= TYPOGRAPHY & INTERACTIVE ACTION OVERLAY ================= -->
                    <div
                        class="absolute inset-0 z-20 flex flex-col items-center justify-between pt-[17%] pb-[29%] px-6 text-center pointer-events-none transition-all duration-700 select-none"
                        :class="{ 'opacity-0 scale-95': isOpening }"
                    >
                        <!-- Top Section: Latin Cross & Holy Matrimony -->
                        <div class="flex flex-col items-center">
                            <div class="my-1 flex items-center justify-center">
                                <svg class="w-5 h-6 text-[#f5dc8a] fill-current drop-shadow-[0_0_10px_rgba(212,175,55,0.85)]" viewBox="0 0 24 24">
                                    <path d="M10 2h4v6h6v4h-6v10h-4V12H4V8h6V2z" />
                                </svg>
                            </div>
                            <p class="font-display tracking-[0.4em] text-[9.5px] sm:text-[11px] uppercase font-semibold text-[#f5dc8a] drop-shadow-md">
                                Holy Matrimony
                            </p>
                        </div>

                        <!-- Middle Section: Lightly Blurred & See-Through Glass Container on Door -->
                        <div class="flex flex-col items-center -mt-1 sm:-mt-2 w-full">
                            <!-- Translucent Frosted Glass Plaque (See-Through Wood Texture Beneath with Soft Diffused Blur) -->
                            <div class="w-full max-w-[340px] sm:max-w-[400px] md:max-w-[440px] px-5 sm:px-7 py-3.5 sm:py-4.5 rounded-3xl bg-black/35 sm:bg-black/40 backdrop-blur-md border border-[#f5dc8a]/35 shadow-[0_12px_40px_rgba(0,0,0,0.45)] ring-1 ring-white/10 text-center transition-transform hover:scale-[1.01]">
                                
                                <!-- The Wedding Of -->
                                <div class="flex items-center justify-center gap-2 mb-1">
                                    <span class="w-6 sm:w-10 h-px bg-gradient-to-r from-transparent via-[#f5dc8a]/80 to-transparent"></span>
                                    <p class="font-display tracking-[0.35em] text-[9px] sm:text-[10.5px] uppercase text-[#f5dc8a] font-bold drop-shadow-xs">
                                        The Wedding Of
                                    </p>
                                    <span class="w-6 sm:w-10 h-px bg-gradient-to-l from-transparent via-[#f5dc8a]/80 to-transparent"></span>
                                </div>

                                <!-- 1. PRIMARY HERO: Couple Bride & Groom Names (Enlarged) -->
                                <h1 class="font-serif text-[30px] sm:text-[42px] md:text-[48px] leading-tight font-bold text-white tracking-wide my-1 drop-shadow-[0_2px_14px_rgba(0,0,0,0.85)]">
                                    <span class="inline-block">{{ groomName }}</span>
                                    <span class="font-script text-[36px] sm:text-[48px] md:text-[54px] text-[#f5dc8a] font-normal mx-1.5 align-baseline drop-shadow-[0_0_12px_rgba(245,220,138,0.6)]">&amp;</span>
                                    <span class="inline-block">{{ brideName }}</span>
                                </h1>

                                <!-- Date -->
                                <p class="font-serif italic text-xs sm:text-sm text-[#f8f6f0]/90 tracking-wide mb-2.5 drop-shadow-xs">
                                    {{ weddingDateText }}
                                </p>

                                <!-- 2. SECONDARY DEDICATION: Invited People / Family Title -->
                                <div class="pt-2 border-t border-[#f5dc8a]/25">
                                    <p class="font-display tracking-[0.28em] text-[8.5px] sm:text-[9.5px] uppercase text-[#f5dc8a]/90 font-semibold mb-0.5">
                                        Cordially Inviting
                                    </p>
                                    <h2 class="font-serif font-bold text-sm sm:text-base md:text-lg text-white/95 uppercase tracking-[0.06em] leading-snug drop-shadow-sm">
                                        {{ guestGreeting || guestName || 'Respected Guest & Beloved Family' }}
                                    </h2>
                                </div>
                            </div>

                            <!-- Prominent Interactive Open Button with Golden Glow -->
                            <div class="mt-3.5 sm:mt-4 pointer-events-auto">
                                <button
                                    type="button"
                                    @click.stop="openChapelDoors"
                                    class="group relative inline-flex items-center gap-2.5 px-6 sm:px-8 py-2.5 sm:py-3 rounded-full bg-white/95 hover:bg-white border-2 border-[#2a3442]/80 text-[#1a2536] font-serif text-[10.5px] sm:text-[12px] tracking-[0.22em] font-bold uppercase shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 active:scale-95 cursor-pointer"
                                    aria-label="Push doors to open the Catholic wedding invitation"
                                >
                                    <!-- Animated Church Icon -->
                                    <svg class="w-4 h-4 stroke-current fill-none group-hover:scale-110 transition-transform" viewBox="0 0 24 24" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v4m-2-2h4M12 6L4 12v9h16v-9l-8-6z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 21v-5a2 2 0 014 0v5" />
                                    </svg>
                                    <span>Push to Open Doors</span>
                                    <span class="text-[#c4a35a] group-hover:translate-x-1 transition-transform">→</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ================= INTERACTIVE KNOCKER HINT RIPPLE ================= -->
                    <div
                        v-if="!isOpening"
                        class="absolute bottom-[24%] left-1/2 -translate-x-1/2 pointer-events-none z-30 flex flex-col items-center"
                    >
                        <div class="w-12 h-12 rounded-full border border-[#c4a35a]/60 knocker-hint-pulse flex items-center justify-center">
                            <span class="text-[10px] text-[#8a724d] font-serif bg-white/80 px-2 py-0.5 rounded-full shadow-xs">
                                Knock
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <!-- ================= VIDEO END TRANSITION: BLUR & BRIDE & GROOM NAMES ================= -->
        <div
            v-if="isEndingTransition"
            class="fixed inset-0 z-40 flex flex-col items-center justify-center p-6 text-center select-none cursor-pointer transition-all duration-1000 ease-out"
            :class="[
                showOutroNames
                    ? 'opacity-100 backdrop-blur-md sm:backdrop-blur-lg bg-stone-950/70'
                    : 'opacity-0 backdrop-blur-none bg-stone-950/0 pointer-events-none'
            ]"
            @click="skipIntro"
            title="Click anywhere to proceed to invitation"
        >
            <!-- Atmospheric Dark Vignette -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/75 via-black/40 to-black/80 pointer-events-none"></div>

            <div
                class="relative z-10 max-w-xl mx-auto flex flex-col items-center justify-center transition-all duration-1000 transform"
                :class="[
                    showOutroNames
                        ? 'opacity-100 translate-y-0 scale-100'
                        : 'opacity-0 translate-y-6 scale-95'
                ]"
            >
                <!-- Golden Cross with Soft Sacred Glow -->
                <div class="mb-3 sm:mb-4 flex items-center justify-center">
                    <svg class="w-6 h-7 text-[#f5dc8a] fill-current drop-shadow-[0_0_12px_rgba(245,220,138,0.8)]" viewBox="0 0 24 24">
                        <path d="M10 2h4v6h6v4h-6v10h-4V12H4V8h6V2z" />
                    </svg>
                </div>

                <!-- The Wedding Of -->
                <p class="font-display tracking-[0.45em] text-[11px] sm:text-[13px] uppercase font-semibold text-[#f5dc8a] drop-shadow-md">
                    The Wedding Of
                </p>

                <!-- Groom & Bride Names -->
                <h2 class="font-serif text-3xl sm:text-5xl md:text-6xl text-white font-normal tracking-wide drop-shadow-[0_4px_30px_rgba(0,0,0,0.9)] leading-tight my-3 sm:my-4">
                    <span class="inline-block">{{ groomName }}</span>
                    <span class="font-script text-4xl sm:text-6xl md:text-7xl text-[#f5dc8a] mx-2 sm:mx-3 inline-block align-baseline drop-shadow-[0_0_15px_rgba(245,220,138,0.6)]">&amp;</span>
                    <span class="inline-block">{{ brideName }}</span>
                </h2>

                <!-- Elegant Floral / Golden Ribbon Divider -->
                <div class="flex items-center justify-center gap-3 my-2 sm:my-3 opacity-90">
                    <span class="w-12 sm:w-20 h-px bg-gradient-to-r from-transparent via-[#f5dc8a] to-transparent"></span>
                    <svg class="w-3.5 h-3.5 text-[#f5dc8a] fill-current" viewBox="0 0 24 24">
                        <path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z" />
                    </svg>
                    <span class="w-12 sm:w-20 h-px bg-gradient-to-l from-transparent via-[#f5dc8a] to-transparent"></span>
                </div>

                <!-- Date & Church Venue -->
                <p class="font-serif italic text-sm sm:text-lg text-[#f8f6f0] tracking-wider drop-shadow-md">
                    {{ weddingDateText }}
                </p>
                <p class="font-display text-[10.5px] sm:text-xs text-[#f5dc8a]/85 tracking-[0.28em] uppercase mt-2 drop-shadow-sm">
                    {{ churchName }}
                </p>

                <!-- Posh Invitee Card in Transition -->
                <div class="mt-4 px-6 py-2.5 rounded-2xl bg-white/15 backdrop-blur-md border border-[#f5dc8a]/70 shadow-[0_8px_30px_rgba(0,0,0,0.5)] max-w-md text-center">
                    <p class="font-display tracking-[0.35em] text-[9.5px] sm:text-[11px] uppercase text-[#f5dc8a] font-bold">
                        Cordially Inviting
                    </p>
                    <p class="font-serif text-lg sm:text-2xl font-bold text-white tracking-wider uppercase drop-shadow-md mt-0.5">
                        {{ guestGreeting || guestName || 'Respected Guest & Beloved Family' }}
                    </p>
                </div>

                <!-- Subtle Enter Indicator -->
                <div class="mt-6 sm:mt-7 inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-[#f8f6f0] text-[10px] sm:text-[11px] tracking-[0.25em] uppercase font-sans shadow-lg">
                    <span>Entering Invitation</span>
                    <svg class="w-3 h-3 text-[#f5dc8a] fill-current animate-pulse" viewBox="0 0 24 24">
                        <path d="M12 2L13.8 8.2L20 10L13.8 11.8L12 18L10.2 11.8L4 10L10.2 8.2L12 2Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onBeforeUnmount } from 'vue';

const props = defineProps({
    guestName: { type: String, default: 'Mr & Mrs Silva' },
    guestGreeting: { type: String, default: '' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
    churchName: { type: String, default: "St. Sebastian's Church, Moratuwa" },
    churchAddress: { type: String, default: 'Moratuwa, Sri Lanka' },
    weddingDate: { type: String, default: '2026-12-29 16:00:00' },
});

const emit = defineEmits(['opened']);

const doorVideoRef = ref(null);
const isOpening = ref(false);
const isHovered = ref(false);
const isFadingOut = ref(false);
const hasFinishedIntro = ref(false);
const isPlayingMusic = ref(false);

const isEndingTransition = ref(false);
const showOutroNames = ref(false);
const hasTriggeredEnded = ref(false);
let activeTimers = [];

const clearAllTimers = () => {
    activeTimers.forEach((timer) => clearTimeout(timer));
    activeTimers = [];
};

onBeforeUnmount(() => {
    clearAllTimers();
});

const weddingDateText = computed(() => {
    return 'Tuesday, 29th December 2026';
});

// Interactive subtle mouse parallax across the facade
const mouseX = ref(0);
const mouseY = ref(0);

const onMouseMove = (e) => {
    if (isOpening.value || isEndingTransition.value) return;
    mouseX.value = (e.clientX / window.innerWidth - 0.5) * 10;
    mouseY.value = (e.clientY / window.innerHeight - 0.5) * 6;
};

const mouseParallaxStyle = computed(() => {
    if (isOpening.value || isEndingTransition.value) return {};
    return {
        transform: `translate(${mouseX.value}px, ${mouseY.value}px)`,
        transition: 'transform 0.25s ease-out',
    };
});

// Sound toggle
const toggleSound = () => {
    isPlayingMusic.value = !isPlayingMusic.value;
    emit('opened');
};

// Grand Catholic Door Opening Sequence
const openChapelDoors = () => {
    if (isOpening.value) return;

    // 1. Immediately emit 'opened' so the background music auto-plays on user interaction
    emit('opened');
    isPlayingMusic.value = true;

    // 2. Start the door opening sequence
    isOpening.value = true;

    // 3. Play the walkdown video provided by the user (muted inbuilt audio, playing app background music)
    if (doorVideoRef.value) {
        doorVideoRef.value.currentTime = 0;
        doorVideoRef.value.muted = true;
        doorVideoRef.value.volume = 0;
        const playPromise = doorVideoRef.value.play();
        if (playPromise !== undefined) {
            playPromise.catch((err) => {
                console.warn('Video auto-playback fallback:', err);
                // Fallback timeout in case video can't play on older browsers
                const timer = setTimeout(() => {
                    onVideoEnded();
                }, 10500);
                activeTimers.push(timer);
            });
        }
    } else {
        const timer = setTimeout(() => {
            onVideoEnded();
        }, 10500);
        activeTimers.push(timer);
    }
};

// When the full video finishes playing, smoothly blur the page, reveal Bride & Groom names, and transition smoothly to the invitation
const onVideoEnded = () => {
    if (hasTriggeredEnded.value || isFadingOut.value || hasFinishedIntro.value) return;
    hasTriggeredEnded.value = true;

    // 1. Hold and pause video at its final frame
    if (doorVideoRef.value) {
        try {
            doorVideoRef.value.pause();
        } catch (e) {}
    }

    // 2. Initiate blur on the page & facade
    isEndingTransition.value = true;

    // 3. Fade in Bride & Groom names overlay with gentle upward glide
    const timer1 = setTimeout(() => {
        showOutroNames.value = true;
    }, 150);
    activeTimers.push(timer1);

    // 4. Hold names for ~2.8 seconds, then smoothly transition into the main invitation page
    const timer2 = setTimeout(() => {
        isFadingOut.value = true;
        const timer3 = setTimeout(() => {
            hasFinishedIntro.value = true;
        }, 1100);
        activeTimers.push(timer3);
    }, 3200);
    activeTimers.push(timer2);
};

// Skip directly into the invitation (or click during outro to advance immediately)
const skipIntro = () => {
    emit('opened');
    clearAllTimers();
    if (doorVideoRef.value) {
        try {
            doorVideoRef.value.pause();
        } catch (e) {}
    }
    isFadingOut.value = true;
    const timer = setTimeout(() => {
        hasFinishedIntro.value = true;
    }, 600);
    activeTimers.push(timer);
};
</script>

<style scoped>
/* ================= RESPONSIVE CATHEDRAL PORTAL FRAME ================= */
/* Mobile First: The door fills mobile screens directly edge-to-edge */
.cathedral-portal-frame {
    width: 100vw;
    height: 100vh;
    max-width: 100%;
    max-height: 100%;
    cursor: pointer;
    transition: transform 0.4s ease;
}

@media (min-width: 640px) {
    .cathedral-portal-frame {
        width: 440px;
        height: 918px;
        max-width: 92vw;
        max-height: 94vh;
        border-radius: 200px 200px 0 0;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45);
    }
}

/* ================= TACTILE HOVER / AJAR STATE ================= */
/* Subtle unlatching feedback when the user hovers over the doors */
.door-left-ajar {
    transform: rotateY(-3.5deg) !important;
}

.door-right-ajar {
    transform: rotateY(3.5deg) !important;
}

/* ================= 3D DOOR SWING ANIMATIONS ================= */
.door-left-open {
    transform: rotateY(-112deg) !important;
}

.door-right-open {
    transform: rotateY(112deg) !important;
}

/* Knocker Hint Pulse */
.knocker-hint-pulse {
    animation: ringPing 2.4s cubic-bezier(0, 0, 0.2, 1) infinite;
}

@keyframes ringPing {
    0% {
        transform: scale(0.85);
        opacity: 0.9;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}
</style>