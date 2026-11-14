<template>
    <div id="gallery" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10">
        <!-- Save the Date Top Banner Pill (Matching Screenshot 10) -->
        <div class="max-w-md lg:max-w-xl mx-auto mb-8">
            <a
                :href="calendarLink"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center justify-between p-3.5 sm:p-4 rounded-2xl bg-[#faf8f4] border border-[#d8b878]/70 shadow-sm hover:border-[#c5a059] transition-all group"
            >
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#15253b] text-amber-200 flex items-center justify-center text-sm shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                        📅
                    </div>
                    <div>
                        <h4 class="font-serif font-bold text-sm uppercase tracking-wider text-[#15253b] group-hover:text-gold-700 transition-colors">
                            Save the Date
                        </h4>
                        <p class="text-sm sm:text-[11px] text-stone-700 font-serif italic">
                            Add the wedding to your calendar ↗
                        </p>
                    </div>
                </div>
                <span class="text-sm text-gold-700 font-serif font-semibold pr-1 group-hover:translate-x-1 transition-transform">
                    Add
                </span>
            </a>
        </div>

        <!-- Section Title -->
        <div class="text-center mb-6">
            <p class="font-sans text-sm uppercase tracking-[0.25em] font-semibold text-gold-700">
                Captured Moments
            </p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#15253b] mt-1">
                Our Gallery
            </h2>
            <div class="my-2.5 text-gold-600 text-sm">✝</div>
        </div>

        <!-- Real Photo Album Grid (Matching Screenshot 10 Exactly) -->
        <div class="max-w-md lg:max-w-4xl mx-auto grid grid-cols-2 gap-3 sm:gap-4">
            <!-- Left Column: Tall Couple Photo at Cathedral Arch -->
            <div class="rounded-2xl border border-[#d8b878]/60 bg-white p-1.5 shadow-md overflow-hidden group hover:border-[#c5a059] transition-all">
                <div class="w-full h-64 sm:h-72 lg:h-[26rem] rounded-xl overflow-hidden bg-stone-100">
                    <img
                        src="/images/wedding/gallery_couple.jpg"
                        :alt="`${groomName} & ${brideName}`"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    />
                </div>
                <p class="text-sm font-serif italic text-stone-700 text-center py-1.5">
                    "Two hearts, one blessed covenant"
                </p>
            </div>

            <!-- Right Column: Stacked Bride & Groom Photos -->
            <div class="flex flex-col gap-3 sm:gap-4">
                <!-- Top: Bride Portrait with Veil -->
                <div class="rounded-2xl border border-[#d8b878]/60 bg-white p-1.5 shadow-md overflow-hidden group hover:border-[#c5a059] transition-all">
                    <div class="w-full h-28 sm:h-32 lg:h-48 rounded-xl overflow-hidden bg-stone-100">
                        <img
                            src="/images/wedding/gallery_bride.jpg"
                            :alt="brideName"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        />
                    </div>
                    <p class="text-sm font-serif italic text-stone-700 text-center py-1">
                        {{ brideName }} · The Bride
                    </p>
                </div>

                <!-- Bottom: Groom Portrait in Tuxedo -->
                <div class="rounded-2xl border border-[#d8b878]/60 bg-white p-1.5 shadow-md overflow-hidden group hover:border-[#c5a059] transition-all">
                    <div class="w-full h-28 sm:h-32 lg:h-48 rounded-xl overflow-hidden bg-stone-100">
                        <img
                            src="/images/wedding/gallery_groom.jpg"
                            :alt="groomName"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        />
                    </div>
                    <p class="text-sm font-serif italic text-stone-700 text-center py-1">
                        {{ groomName }} · The Groom
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    weddingDate: { type: String, default: '2026-12-12 09:00:00' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
});

const calendarLink = computed(() => {
    try {
        const title = encodeURIComponent(`The Wedding of ${props.groomName} & ${props.brideName}`);
        const details = encodeURIComponent(`Holy Matrimony of ${props.groomName} & ${props.brideName} at St. Mary's Church, Negombo, Sri Lanka.`);
        const location = encodeURIComponent("St. Mary's Church, Grand Street, Negombo, Sri Lanka");
        return `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${title}&details=${details}&location=${location}`;
    } catch {
        return '#';
    }
});
</script>
