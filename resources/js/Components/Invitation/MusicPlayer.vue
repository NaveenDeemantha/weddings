<template>
    <div class="fixed bottom-6 right-6 z-40">
        <button
            type="button"
            @click="togglePlay"
            class="group relative flex items-center gap-2 px-3 py-2.5 rounded-full bg-white/95 backdrop-blur-md shadow-xl border-2 border-amber-300 hover:border-amber-400 transition-all transform hover:scale-105 active:scale-95"
            :title="isPlaying ? 'Pause Background Music' : 'Play Wedding Music'"
        >
            <!-- Animated Soundwaves / Disc Icon -->
            <div
                class="w-8 h-8 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-400 flex items-center justify-center text-white shadow-sm"
                :class="{ 'animate-spin-slow': isPlaying }"
            >
                <svg v-if="!isPlaying" class="w-4 h-4 ml-0.5 fill-current" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <svg v-else class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                </svg>
            </div>

            <!-- Equalizer Bars Animation when Playing -->
            <div v-if="isPlaying" class="flex items-end gap-0.5 h-4 px-1">
                <span class="w-1 bg-amber-600 rounded-full animate-bounce h-2"></span>
                <span class="w-1 bg-amber-600 rounded-full animate-bounce h-4" style="animation-delay: 0.15s"></span>
                <span class="w-1 bg-amber-600 rounded-full animate-bounce h-3" style="animation-delay: 0.3s"></span>
            </div>
            <span v-else class="text-xs font-serif font-medium text-stone-700 pr-1">
                Music
            </span>

            <audio
                ref="audioRef"
                :src="musicUrl"
                loop
                preload="auto"
                @ended="isPlaying = false"
                @pause="isPlaying = false"
                @play="isPlaying = true"
            ></audio>
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    musicUrl: {
        type: String,
        default: 'https://assets.mixkit.co/music/preview/mixkit-serene-view-443.mp3',
    },
});

const isPlaying = ref(false);
const audioRef = ref(null);

const togglePlay = () => {
    if (!audioRef.value) return;

    if (isPlaying.value) {
        audioRef.value.pause();
    } else {
        audioRef.value.play().then(() => {
            isPlaying.value = true;
        }).catch((err) => {
            console.warn('Audio playback prevented by browser:', err);
        });
    }
};

const playDirectly = () => {
    if (audioRef.value && !isPlaying.value) {
        audioRef.value.play().then(() => {
            isPlaying.value = true;
        }).catch(() => {});
    }
};

defineExpose({
    playDirectly,
    togglePlay,
});
</script>

