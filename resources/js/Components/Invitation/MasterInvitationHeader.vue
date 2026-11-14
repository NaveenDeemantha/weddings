<template>
    <div id="hero" class="relative px-5 sm:px-8 lg:px-12 pt-10 lg:pt-16 pb-12 lg:pb-20">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <!-- Couple portrait -->
            <div class="order-2 lg:order-1 flex justify-center">
                <div class="relative w-full max-w-sm lg:max-w-md">
                    <div class="rounded-t-[200px] rounded-b-3xl border-2 border-[#c5a059] bg-gradient-to-b from-[#fffdf8] to-[#f5ecd9] shadow-xl px-6 pt-14 pb-6 flex justify-center">
                        <img
                            src="/images/wedding/couple_portrait.jpg"
                            :alt="`${groomName} & ${brideName}`"
                            class="w-60 lg:w-72 h-auto object-contain select-none pointer-events-none"
                        />
                    </div>
                </div>
            </div>

            <!-- Invitation wording -->
            <div class="order-1 lg:order-2 text-center">
                <div class="text-[#a7823b] text-3xl">✝</div>
                <p class="mt-3 font-display text-sm sm:text-base tracking-[0.35em] text-[#8c6d37] font-semibold">
                    HOLY MATRIMONY
                </p>
                <p class="mt-2 font-serif italic text-lg sm:text-xl text-stone-800">
                    Together with their families
                </p>

                <h1 class="mt-5 font-serif font-semibold text-[#15253b] leading-tight text-5xl sm:text-6xl lg:text-7xl">
                    {{ groomName }}
                    <span class="block font-script text-[#a7823b] font-normal text-4xl sm:text-5xl my-1">&amp;</span>
                    {{ brideName }}
                </h1>

                <div class="mt-7 grid grid-cols-2 gap-4 max-w-md mx-auto text-center">
                    <div class="border-r border-[#c5a059]/50 pr-4">
                        <p class="font-display text-xs sm:text-sm tracking-[0.2em] text-[#8c6d37] font-semibold">SON OF</p>
                        <p class="mt-1 font-serif text-lg sm:text-xl font-semibold text-stone-900">{{ groomParents }}</p>
                    </div>
                    <div class="pl-4">
                        <p class="font-display text-xs sm:text-sm tracking-[0.2em] text-[#8c6d37] font-semibold">DAUGHTER OF</p>
                        <p class="mt-1 font-serif text-lg sm:text-xl font-semibold text-stone-900">{{ brideParents }}</p>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-center gap-4 sm:gap-6">
                    <span class="font-display text-sm sm:text-base tracking-[0.25em] text-[#15253b] font-semibold border-y border-[#c5a059] py-2 px-3">DECEMBER</span>
                    <span class="font-serif text-6xl sm:text-7xl font-bold text-[#15253b] leading-none">12</span>
                    <span class="font-display text-sm sm:text-base tracking-[0.25em] text-[#15253b] font-semibold border-y border-[#c5a059] py-2 px-3">2026</span>
                </div>
                <p class="mt-3 font-display text-xs sm:text-sm tracking-[0.3em] text-stone-700">SATURDAY · 9:00 AM</p>

                <p class="mt-8 font-serif italic text-xl sm:text-2xl text-stone-800 max-w-md mx-auto leading-relaxed">
                    “Therefore what God has joined together, let no one separate.”
                </p>
                <p class="mt-1 font-display text-xs tracking-[0.3em] text-[#8c6d37] font-semibold">MATTHEW 19:6</p>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
    brideParents: { type: String, default: 'Mr. & Mrs. Perera' },
    groomParents: { type: String, default: 'Mr. & Mrs. Fernando' },
});
</script>
