<template>
    <div class="fixed top-4 right-4 sm:top-6 sm:right-6 z-[60]">
        <button
            type="button"
            @click.stop="toggleMute"
            class="group relative flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2.5 rounded-full bg-white/95 backdrop-blur-md shadow-xl border-2 transition-all transform hover:scale-105 active:scale-95 cursor-pointer"
            :class="isPlaying && !isMuted ? 'border-[#F678A4] hover:border-[#ad2c51]' : 'border-stone-300 hover:border-[#F678A4] opacity-95'"
            :title="isPlaying && !isMuted ? 'Click to Mute Music' : 'Click to Play Music'"
            aria-label="Toggle Background Music"
        >
            <!-- Animated Icon Disc -->
            <div
                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs shadow-sm transition-all duration-300"
                :class="isPlaying && !isMuted ? 'bg-[#ad2c51] text-white animate-spin-slow shadow-pink-200' : 'bg-stone-100 text-stone-600'"
            >
                <!-- Unmuted / Playing Speaker Icon -->
                <svg
                    v-if="isPlaying && !isMuted"
                    class="w-4 h-4 fill-current"
                    viewBox="0 0 24 24"
                >
                    <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                </svg>

                <!-- Muted / Paused Speaker Icon with Slash -->
                <svg
                    v-else
                    class="w-4 h-4 fill-current text-stone-500"
                    viewBox="0 0 24 24"
                >
                    <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>
                </svg>
            </div>

            <!-- Equalizer Bars when playing, or Text Badge -->
            <div v-if="isPlaying && !isMuted" class="flex items-center gap-1.5 h-3.5 px-0.5">
                <div class="flex items-end gap-0.5 h-3">
                    <span class="w-0.5 bg-[#ad2c51] rounded-full animate-bounce h-2"></span>
                    <span class="w-0.5 bg-[#F678A4] rounded-full animate-bounce h-3" style="animation-delay: 0.15s"></span>
                    <span class="w-0.5 bg-[#ad2c51] rounded-full animate-bounce h-2.5" style="animation-delay: 0.3s"></span>
                </div>
                <span class="text-[11px] font-serif font-bold text-[#ad2c51] uppercase tracking-wider">
                    Mute
                </span>
            </div>

            <div v-else class="flex items-center gap-1">
                <span class="text-[11px] font-serif font-bold text-stone-600 uppercase tracking-wider pr-0.5">
                    Unmute
                </span>
            </div>

            <audio
                ref="audioRef"
                :src="effectiveMusicUrl"
                loop
                preload="auto"
                playsinline
                @ended="isPlaying = false"
                @pause="isPlaying = false"
                @play="isPlaying = true"
                @error="onAudioError"
            ></audio>
        </button>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    musicUrl: {
        type: String,
        default: '/music/wedding.mp3',
    },
});

const isPlaying = ref(false);
const isMuted = ref(false);
const isUserMuted = ref(false);
const audioRef = ref(null);

const effectiveMusicUrl = computed(() => {
    const url = props.musicUrl?.trim();
    if (url && !url.includes('mixkit.co')) {
        return url;
    }
    return '/music/wedding.mp3';
});

const onAudioError = (e) => {
    console.warn('Audio error encountered:', e);
    // If external URL failed, fallback to local track
    if (audioRef.value && audioRef.value.src !== window.location.origin + '/music/wedding.mp3') {
        audioRef.value.src = '/music/wedding.mp3';
        if (!isUserMuted.value) {
            audioRef.value.play().catch(() => {});
        }
    }
};

const attemptPlay = () => {
    if (!audioRef.value || isUserMuted.value) return;

    audioRef.value.play().then(() => {
        isPlaying.value = true;
        isMuted.value = false;
    }).catch((err) => {
        // Autoplay policy prevented playback until user interaction
        isPlaying.value = false;
    });
};

const toggleMute = () => {
    if (!audioRef.value) return;

    if (isPlaying.value && !isMuted.value) {
        // User wants to mute
        audioRef.value.pause();
        isPlaying.value = false;
        isMuted.value = true;
        isUserMuted.value = true;
    } else {
        // User wants to unmute / play
        isUserMuted.value = false;
        isMuted.value = false;
        audioRef.value.play().then(() => {
            isPlaying.value = true;
        }).catch((err) => {
            console.warn('Playback prevented:', err);
        });
    }
};

const playDirectly = () => {
    if (isUserMuted.value) return;
    attemptPlay();
};

const onFirstInteraction = () => {
    if (!isPlaying.value && !isUserMuted.value) {
        attemptPlay();
    }
    cleanupListeners();
};

const cleanupListeners = () => {
    window.removeEventListener('pointerdown', onFirstInteraction);
    window.removeEventListener('click', onFirstInteraction);
    window.removeEventListener('touchstart', onFirstInteraction);
    window.removeEventListener('scroll', onFirstInteraction);
    window.removeEventListener('keydown', onFirstInteraction);
};

onMounted(() => {
    // 1. Try immediate autoplay on site load
    attemptPlay();

    // 2. Add fallback listeners for first touch/click/scroll anywhere
    window.addEventListener('pointerdown', onFirstInteraction, { passive: true });
    window.addEventListener('click', onFirstInteraction, { passive: true });
    window.addEventListener('touchstart', onFirstInteraction, { passive: true });
    window.addEventListener('scroll', onFirstInteraction, { passive: true });
    window.addEventListener('keydown', onFirstInteraction, { passive: true });
});

onUnmounted(() => {
    cleanupListeners();
});

defineExpose({
    playDirectly,
    togglePlay: toggleMute,
    toggleMute,
});
</script>

<style scoped>
@keyframes spinSlow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
.animate-spin-slow {
    animation: spinSlow 8s linear infinite;
}
</style>

<style scoped>
@keyframes spinSlow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
.animate-spin-slow {
    animation: spinSlow 8s linear infinite;
}
</style>
