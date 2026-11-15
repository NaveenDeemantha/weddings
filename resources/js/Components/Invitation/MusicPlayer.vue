<template>
    <div class="fixed top-4 right-4 z-[60]">
        <button
            type="button"
            @click.stop="toggleMute"
            class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/90 hover:bg-white text-stone-800 shadow-md border border-stone-200/80 backdrop-blur-md flex items-center justify-center transition-all transform hover:scale-105 active:scale-95 cursor-pointer"
            :title="isPlaying && !isMuted ? 'Mute' : 'Unmute'"
            aria-label="Toggle Background Music"
        >
            <!-- Unmuted / Playing Speaker Icon -->
            <svg
                v-if="isPlaying && !isMuted"
                class="w-5 h-5 fill-current text-[#ad2c51]"
                viewBox="0 0 24 24"
            >
                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
            </svg>

            <!-- Muted / Paused Speaker Icon with Slash -->
            <svg
                v-else
                class="w-5 h-5 fill-current text-stone-600"
                viewBox="0 0 24 24"
            >
                <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>
            </svg>

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
