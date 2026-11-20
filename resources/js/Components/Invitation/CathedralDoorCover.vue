<template>
    <div
        v-if="!hasFinishedIntro"
        data-no-burst
        class="fixed inset-0 z-50 overflow-hidden select-none transition-opacity duration-1000 flex flex-col items-center justify-between bg-[#cbb8a3]"
        :class="{ 'opacity-0 pointer-events-none': isFadingOut }"
        @mousemove="onMouseMove"
    >
        <!-- ================= SKIP VIDEO BUTTON (TOP RIGHT) ================= -->
        <button
            v-if="isOpening && !isFadingOut"
            type="button"
            @click.stop="skipIntro"
            class="fixed top-4 right-16 sm:right-20 z-[70] inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-black/60 hover:bg-black/85 text-white/95 hover:text-white font-sans text-xs tracking-wider uppercase font-semibold backdrop-blur-md border border-white/30 shadow-2xl transition-all transform active:scale-95 cursor-pointer"
            aria-label="Skip video"
            title="Skip Video"
        >
            <span>Skip</span>
            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                <path d="M5.5 4.5l8 6.5-8 6.5V4.5zM15.5 4.5h2v13h-2v-13z" />
            </svg>
        </button>

        <!-- ================= FULLSCREEN CATHEDRAL FACADE ARCHITECTURAL BACKGROUND ================= -->
        <!-- Authentic French Limestone Cathedral Facade Surround (User Provided Asset) -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
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
            class="relative z-10 w-full h-full flex items-center justify-center p-0 sm:p-4 transition-transform duration-1000 ease-out"
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
                        class="absolute inset-0 w-full h-full object-cover z-0 pointer-events-auto cursor-pointer"
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
                        <!-- Top Section: THE WEDDING OF + Delicate Cross -->
                        <div class="flex flex-col items-center">
                            <p class="font-serif tracking-[0.45em] text-[10px] sm:text-[11.5px] uppercase font-semibold text-[#8a724d] drop-shadow-xs">
                                The Wedding Of
                            </p>
                            
                            <!-- Delicate Gold Cross with Starlight Glow -->
                            <div class="my-1.5 flex items-center justify-center">
                                <span class="text-[#c4a35a] text-sm sm:text-base leading-none drop-shadow-[0_0_8px_rgba(212,175,55,0.7)]">✝</span>
                            </div>
                        </div>

                        <!-- Middle Section: Couple's Names, Date & Interactive Open Button -->
                        <div class="flex flex-col items-center -mt-1 sm:-mt-2">
                            <!-- Buddhima & Shavindi -->
                            <h1 class="font-serif text-[26px] sm:text-[34px] md:text-[38px] leading-tight font-normal text-[#16253d] tracking-normal drop-shadow-xs">
                                {{ groomName }}
                                <span class="font-script text-[32px] sm:text-[42px] text-[#ad2c51] mx-1 align-baseline">&amp;</span>
                                {{ brideName }}
                            </h1>

                            <!-- Date -->
                            <p class="font-serif italic text-xs sm:text-sm text-[#3d3733] mt-1 tracking-wide">
                                {{ weddingDateText }}
                            </p>

                            <!-- Prominent Interactive Open Button with Golden Glow -->
                            <div class="mt-4 sm:mt-5 pointer-events-auto">
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

                        <!-- Bottom Section: DEAR [GUEST NAME] -->
                        <div class="flex flex-col items-center pt-2">
                            <p class="font-serif tracking-[0.4em] text-[9.5px] sm:text-[11px] uppercase text-[#8a724d] font-semibold">
                                Dear
                            </p>
                            <p class="font-serif font-bold text-sm sm:text-base md:text-lg text-[#16253d] uppercase tracking-[0.12em] mt-1 max-w-[290px] drop-shadow-xs">
                                {{ guestGreeting || guestName || 'Mr & Mrs Silva' }}
                            </p>
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
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

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

const weddingDateText = computed(() => {
    return 'Tuesday, 29th December 2026';
});

// Interactive subtle mouse parallax across the facade
const mouseX = ref(0);
const mouseY = ref(0);

const onMouseMove = (e) => {
    if (isOpening.value) return;
    mouseX.value = (e.clientX / window.innerWidth - 0.5) * 10;
    mouseY.value = (e.clientY / window.innerHeight - 0.5) * 6;
};

const mouseParallaxStyle = computed(() => {
    if (isOpening.value) return {};
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
                setTimeout(() => {
                    onVideoEnded();
                }, 10500);
            });
        }
    } else {
        setTimeout(() => {
            onVideoEnded();
        }, 10500);
    }
};

// When the full video finishes playing, smoothly reveal the master invitation in a luxurious transition
const onVideoEnded = () => {
    // Hold the final view momentarily, then smoothly dissolve into the master invitation card
    setTimeout(() => {
        isFadingOut.value = true;
        setTimeout(() => {
            hasFinishedIntro.value = true;
        }, 1200);
    }, 600);
};

// Skip directly into the invitation
const skipIntro = () => {
    emit('opened');
    if (doorVideoRef.value) {
        doorVideoRef.value.pause();
    }
    isFadingOut.value = true;
    setTimeout(() => {
        hasFinishedIntro.value = true;
    }, 400);
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