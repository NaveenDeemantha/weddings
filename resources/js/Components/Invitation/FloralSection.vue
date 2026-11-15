<template>
    <div class="relative overflow-hidden">
        <FlowerCluster v-if="side !== 'right'" class="floral-corner absolute bottom-0 left-0 w-28 sm:w-44 lg:w-60 opacity-40 sm:opacity-70" style="--tx:-14px" />
        <FlowerCluster v-if="side !== 'left'" class="floral-corner absolute bottom-0 right-0 w-28 sm:w-44 lg:w-60 -scale-x-100 opacity-40 sm:opacity-70" />
        <FlowerCluster v-if="top" class="floral-corner absolute top-0 right-0 w-24 sm:w-36 lg:w-48 rotate-180 opacity-35 sm:opacity-60" />
        <div class="relative z-[1]"><slot /></div>
    </div>
</template>

<script setup>
import FlowerCluster from '@/Components/Invitation/FlowerCluster.vue';
defineProps({
    side: { type: String, default: 'both' },
    top: { type: Boolean, default: false },
});
</script>
