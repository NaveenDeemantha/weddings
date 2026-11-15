<template>
    <div id="gallery" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10">
        <!-- Save the Date -->
        <div class="max-w-md lg:max-w-xl mx-auto mb-8">
            <a
                :href="calendarLink"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center justify-between p-3.5 sm:p-4 rounded-2xl bg-[#fff7fa] border border-[#F678A4]/70 shadow-sm hover:border-[#C8636F] hover:-translate-y-1 hover:shadow-lg transition-all duration-300 group"
            >
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#ad2c51] text-gold-200 flex items-center justify-center text-sm shrink-0 shadow-sm group-hover:rotate-[360deg] transition-transform duration-700">📅</div>
                    <div>
                        <h4 class="font-serif font-bold text-sm uppercase tracking-wider text-[#ad2c51]">Save the Date</h4>
                        <p class="text-sm text-stone-700 font-serif italic">Add the wedding to your calendar ↗</p>
                    </div>
                </div>
                <span class="text-sm text-gold-700 font-serif font-semibold pr-1 group-hover:translate-x-1 transition-transform">Add</span>
            </a>
        </div>

        <!-- Section Title -->
        <div class="text-center mb-6">
            <p class="font-sans text-sm uppercase tracking-[0.25em] font-semibold text-gold-700">Captured Moments</p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#ad2c51] mt-1">Our Gallery</h2>
            <FlowerDivider />
            <p class="text-sm text-stone-600 font-serif italic">Tap a photo to see it bloom</p>
        </div>

        <!-- Photo grid -->
        <div class="max-w-md lg:max-w-4xl mx-auto grid grid-cols-2 gap-3 sm:gap-4">
            <div class="photo-card rounded-2xl border border-[#F678A4]/60 bg-white p-1.5 shadow-md overflow-hidden group hover:border-[#C8636F] transition-all cursor-zoom-in" @click="openPhoto($event)">
                <div class="w-full h-64 sm:h-72 lg:h-[26rem] rounded-xl overflow-hidden bg-pink-50">
                    <img src="/images/wedding/gallery_couple.jpg" :alt="`${groomName} & ${brideName}`" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                </div>
                <p class="text-sm font-serif italic text-stone-700 text-center py-1.5">"Two hearts, one blessed covenant"</p>
            </div>

            <div class="flex flex-col gap-3 sm:gap-4">
                <div class="photo-card rounded-2xl border border-[#F678A4]/60 bg-white p-1.5 shadow-md overflow-hidden group hover:border-[#C8636F] transition-all cursor-zoom-in" @click="openPhoto($event)">
                    <div class="w-full h-28 sm:h-32 lg:h-48 rounded-xl overflow-hidden bg-pink-50">
                        <img src="/images/wedding/gallery_bride.jpg" :alt="brideName" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    </div>
                    <p class="text-sm font-serif italic text-stone-700 text-center py-1">{{ brideName }} · The Bride</p>
                </div>
                <div class="photo-card rounded-2xl border border-[#F678A4]/60 bg-white p-1.5 shadow-md overflow-hidden group hover:border-[#C8636F] transition-all cursor-zoom-in" @click="openPhoto($event)">
                    <div class="w-full h-28 sm:h-32 lg:h-48 rounded-xl overflow-hidden bg-pink-50">
                        <img src="/images/wedding/gallery_groom.jpg" :alt="groomName" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    </div>
                    <p class="text-sm font-serif italic text-stone-700 text-center py-1">{{ groomName }} · The Groom</p>
                </div>
            </div>
        </div>

        <!-- Lightbox -->
        <Teleport to="body">
            <div v-if="photo" class="fixed inset-0 z-[90] flex items-center justify-center p-6 bg-[#4a1428]/90 backdrop-blur-sm cursor-zoom-out" data-no-burst @click="photo = null">
                <div class="relative text-center">
                    <img :src="photo" class="lightbox-in max-h-[78vh] max-w-[88vw] rounded-3xl border-4 border-white shadow-2xl" />
                    <p class="text-pink-100 font-display tracking-[0.3em] text-xs mt-4">TAP ANYWHERE TO CLOSE</p>
                </div>
            </div>
        </Teleport>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import FlowerDivider from '@/Components/Invitation/FlowerDivider.vue';

const props = defineProps({
    weddingDate: { type: String, default: '2026-12-29 09:00:00' },
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
});

const photo = ref(null);
const openPhoto = (e) => {
    const img = e.currentTarget.querySelector('img');
    if (img) {
        photo.value = img.src;
        window.dispatchEvent(new CustomEvent('bloom-burst', { detail: { x: e.clientX, y: e.clientY, count: 20 } }));
    }
};

const calendarLink = computed(() => {
    try {
        const title = encodeURIComponent(`The Wedding of ${props.groomName} & ${props.brideName}`);
        const details = encodeURIComponent(`Holy Matrimony of ${props.groomName} & ${props.brideName} at St. Mary's Church, Moratuwa, Sri Lanka.`);
        const location = encodeURIComponent("St. Mary's Church, Moratuwa, Sri Lanka");
        return `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${title}&details=${details}&location=${location}`;
    } catch {
        return '#';
    }
});
</script>

<style scoped>
.lightbox-in { animation: lbIn .5s cubic-bezier(.2,.9,.3,1.2) both; }
@keyframes lbIn { from { opacity: 0; transform: scale(.6) rotate(-4deg); } to { opacity: 1; transform: none; } }
.photo-card { transition: transform .4s, box-shadow .4s; }
.photo-card:hover { transform: translateY(-6px) rotate(-.6deg); box-shadow: 0 20px 40px -12px rgba(173,44,81,.35); }
</style>
