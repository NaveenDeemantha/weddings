<template>
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-10">
        <div
            v-for="petal in petals"
            :key="petal.id"
            class="petal absolute select-none"
            :style="{
                left: petal.left + '%',
                top: '-30px',
                animationDuration: petal.duration + 's',
                animationDelay: petal.delay + 's',
                transform: `scale(${petal.scale}) rotate(${petal.rotation}deg)`,
                opacity: petal.opacity,
            }"
        >
            <!-- White Araliya / Temple Flower petal -->
            <svg
                v-if="petal.type === 'araliya'"
                class="w-6 h-6 drop-shadow-sm"
                viewBox="0 0 24 24"
                fill="none"
            >
                <path
                    d="M12 2C8 6 6 11 6 15a6 6 0 0 0 12 0c0-4-2-9-6-13z"
                    fill="#ffffff"
                    stroke="#e5dfcd"
                    stroke-width="0.5"
                />
                <!-- Subtle warm yellow glow at petal base -->
                <circle cx="12" cy="17" r="3.5" fill="#fef08a" opacity="0.85" />
            </svg>
            <!-- Delicate white jasmine bloom -->
            <svg
                v-else
                class="w-4 h-4 drop-shadow-sm text-amber-100"
                viewBox="0 0 24 24"
                fill="currentColor"
            >
                <path d="M12 4C9 8 8 11 8 14a4 4 0 0 0 8 0c0-3-1-6-4-10z" />
            </svg>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const petals = ref([]);

onMounted(() => {
    const generated = [];
    for (let i = 0; i < 18; i++) {
        generated.push({
            id: i,
            left: Math.random() * 94 + 3,
            duration: Math.random() * 8 + 10, // 10-18s gentle floating
            delay: Math.random() * 8,
            scale: Math.random() * 0.4 + 0.65,
            rotation: Math.random() * 360,
            opacity: Math.random() * 0.35 + 0.3,
            type: i % 2 === 0 ? 'araliya' : 'jasmine',
        });
    }
    petals.value = generated;
});
</script>

<style scoped>
.petal {
    animation-name: gentleDrift;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@keyframes gentleDrift {
    0% {
        transform: translateY(-20px) rotate(0deg) translateX(0);
    }
    35% {
        transform: translateY(35vh) rotate(80deg) translateX(20px);
    }
    70% {
        transform: translateY(70vh) rotate(190deg) translateX(-15px);
    }
    100% {
        transform: translateY(105vh) rotate(320deg) translateX(25px);
    }
}
</style>
