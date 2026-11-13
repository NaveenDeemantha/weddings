<template>
    <div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-40">
        <button
            type="button"
            @click="togglePlay"
            class="group relative flex items-center gap-1.5 sm:gap-2 px-2.5 py-2 sm:px-3 sm:py-2.5 rounded-full bg-white/95 backdrop-blur-md shadow-lg border border-[#d8b878] hover:border-[#c5a059] transition-all transform hover:scale-105 active:scale-95"
            :title="isPlaying ? 'Pause Background Music' : 'Play Wedding Music'"
        >
            <!-- Animated Disc Icon -->
            <div
                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-[#15253b] text-amber-100 flex items-center justify-center text-xs shadow-sm"
                :class="{ 'animate-spin-slow': isPlaying }"
            >
                <svg v-if="!isPlaying" class="w-3.5 h-3.5 ml-0.5 fill-current" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <svg v-else class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                    <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                </svg>
            </div>

            <!-- Equalizer Bars Animation when Playing -->
            <div v-if="isPlaying" class="flex items-end gap-0.5 h-3 px-0.5">
                <span class="w-0.5 bg-gold-600 rounded-full animate-bounce h-2"></span>
                <span class="w-0.5 bg-gold-600 rounded-full animate-bounce h-3" style="animation-delay: 0.15s"></span>
                <span class="w-0.5 bg-gold-600 rounded-full animate-bounce h-2" style="animation-delay: 0.3s"></span>
            </div>
            <span v-else class="text-[11px] font-serif font-medium text-stone-700 pr-1 hidden sm:inline">
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
