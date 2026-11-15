<script setup>
import { Link } from '@inertiajs/vue3';
import FlowerCluster from '@/Components/Invitation/FlowerCluster.vue';
import FlowerDivider from '@/Components/Invitation/FlowerDivider.vue';
import PetalRain from '@/Components/Invitation/PetalRain.vue';
import ClickBurst from '@/Components/Invitation/ClickBurst.vue';
</script>

<template>
    <div
        class="auth-theme relative flex min-h-screen flex-col items-center justify-center overflow-hidden px-4 py-10"
        style="background: radial-gradient(ellipse at 50% 30%, #C8636F 0%, #ad2c51 55%, #6e1a34 100%);"
    >
        <div class="pointer-events-none absolute inset-0" style="background: radial-gradient(circle at 15% 15%, rgba(246,120,164,.45), transparent 45%), radial-gradient(circle at 88% 88%, rgba(246,120,164,.35), transparent 45%);"></div>

        <!-- Corner flowers -->
        <FlowerCluster class="pointer-events-none absolute bottom-0 left-0 w-36 sm:w-64 lg:w-80 -translate-x-3 translate-y-5" />
        <FlowerCluster class="pointer-events-none absolute bottom-0 right-0 w-36 sm:w-64 lg:w-80 translate-x-3 translate-y-5 -scale-x-100" />
        <FlowerCluster class="pointer-events-none absolute top-0 left-0 w-28 sm:w-52 lg:w-64 -translate-x-4 -translate-y-5 -scale-y-100" />
        <FlowerCluster class="pointer-events-none absolute top-0 right-0 w-28 sm:w-52 lg:w-64 translate-x-4 -translate-y-5 rotate-180" />

        <PetalRain />
        <ClickBurst />

        <div class="relative z-20 w-full max-w-md enter-up">
            <!-- Heading -->
            <div class="mb-6 text-center text-white">
                <Link href="/" class="inline-block">
                    <p class="font-display text-xs sm:text-sm font-semibold tracking-[0.4em] text-pink-100">HOST PORTAL</p>
                    <h1 class="mt-2 font-serif text-4xl sm:text-5xl font-semibold leading-tight drop-shadow-[0_4px_18px_rgba(110,26,52,.55)]">
                        Buddhima <span class="font-script font-normal text-pink-200 text-3xl sm:text-4xl">&amp;</span> Shavindi
                    </h1>
                </Link>
                <p class="mt-2 font-serif italic text-lg text-pink-50">Manage guests, invitations and RSVPs</p>
            </div>

            <!-- Card -->
            <div class="rounded-3xl border-2 border-[#d8ab43]/70 bg-white/95 px-6 py-7 sm:px-9 sm:py-9 shadow-[0_30px_80px_rgba(30,20,15,.55)] backdrop-blur">
                <FlowerDivider />
                <div class="mt-4">
                    <slot />
                </div>
            </div>

            <p class="mt-5 text-center font-display text-xs tracking-[0.3em] text-amber-100/90">WITH LOVE &amp; BLESSINGS</p>
        </div>
    </div>
</template>

<style>
.auth-theme label { color: #8c6d37; font-weight: 600; }
.auth-theme input[type='email'],
.auth-theme input[type='text'],
.auth-theme input[type='password'] {
    border-radius: 0.9rem; border: 1.5px solid #e8c86d; background: #faf8f2; padding: 0.75rem 1rem; color: #1c1917;
    transition: box-shadow .2s, border-color .2s;
}
.auth-theme input[type='email']:focus,
.auth-theme input[type='text']:focus,
.auth-theme input[type='password']:focus { border-color: #8c6d37; box-shadow: 0 0 0 4px rgba(216,171,67,.3); outline: none; }
.auth-theme input[type='checkbox'] { color: #8c6d37; border-color: #b88f32; border-radius: 0.35rem; }
.auth-theme input[type='checkbox']:focus { --tw-ring-color: #d8ab43; }
.auth-theme a:not(:first-child) { color: #8c6d37; }
.auth-theme .enter-up { animation: authUp .9s ease-out both; }
@keyframes authUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: none; } }
</style>
