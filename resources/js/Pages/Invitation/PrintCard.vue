<template>
    <Head title="Print Wedding Invitation Card - Buddhima & Shavindi" />

    <div class="min-h-screen bg-stone-100 text-stone-800 font-sans print:bg-white print:p-0">
        <!-- Screen-only Controls Header -->
        <header class="no-print sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-stone-200 px-4 py-3 sm:px-8 shadow-sm">
            <div class="max-w-6xl mx-auto flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <Link
                        :href="backUrl"
                        class="p-2 rounded-full hover:bg-stone-100 text-stone-600 transition-colors"
                        title="Back"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </Link>
                    <div>
                        <h1 class="font-serif text-lg sm:text-xl font-bold text-[#ad2c51]">
                            Printable Wedding Card
                        </h1>
                        <p class="text-xs text-stone-500">
                            Bespoke Luxury Stationery · 300 DPI Vector Print Layout
                        </p>
                    </div>
                </div>

                <!-- Customization Options -->
                <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs font-medium">
                    <!-- Format Toggle -->
                    <div class="inline-flex rounded-lg border border-stone-200 bg-stone-50 p-0.5">
                        <button
                            type="button"
                            @click="cardFormat = '5x7'"
                            class="px-2.5 py-1.5 rounded-md transition-all"
                            :class="cardFormat === '5x7' ? 'bg-white shadow text-[#ad2c51] font-semibold' : 'text-stone-600 hover:text-stone-900'"
                        >
                            5" × 7" (A7)
                        </button>
                        <button
                            type="button"
                            @click="cardFormat = 'a5'"
                            class="px-2.5 py-1.5 rounded-md transition-all"
                            :class="cardFormat === 'a5' ? 'bg-white shadow text-[#ad2c51] font-semibold' : 'text-stone-600 hover:text-stone-900'"
                        >
                            A5 Sheet
                        </button>
                    </div>

                    <!-- Side Toggle -->
                    <div class="inline-flex rounded-lg border border-stone-200 bg-stone-50 p-0.5">
                        <button
                            type="button"
                            @click="viewSide = 'both'"
                            class="px-2 py-1.5 rounded-md transition-all"
                            :class="viewSide === 'both' ? 'bg-white shadow text-[#ad2c51] font-semibold' : 'text-stone-600'"
                        >
                            Both Sides
                        </button>
                        <button
                            type="button"
                            @click="viewSide = 'front'"
                            class="px-2 py-1.5 rounded-md transition-all"
                            :class="viewSide === 'front' ? 'bg-white shadow text-[#ad2c51] font-semibold' : 'text-stone-600'"
                        >
                            Front Only
                        </button>
                        <button
                            type="button"
                            @click="viewSide = 'back'"
                            class="px-2 py-1.5 rounded-md transition-all"
                            :class="viewSide === 'back' ? 'bg-white shadow text-[#ad2c51] font-semibold' : 'text-stone-600'"
                        >
                            Back Only
                        </button>
                    </div>

                    <!-- Paper Color Mode -->
                    <button
                        type="button"
                        @click="showIvoryBg = !showIvoryBg"
                        class="px-3 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-700 flex items-center gap-1.5"
                    >
                        <span class="w-3 h-3 rounded-full border border-stone-300" :style="{ backgroundColor: showIvoryBg ? '#FFFDF9' : '#ffffff' }"></span>
                        <span>{{ showIvoryBg ? 'Ivory Card' : 'Pure White' }}</span>
                    </button>

                    <!-- Crop Marks Toggle -->
                    <button
                        type="button"
                        @click="showCropMarks = !showCropMarks"
                        class="px-3 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-700"
                        :class="{ 'border-[#ad2c51] text-[#ad2c51] font-semibold': showCropMarks }"
                    >
                        Crop Marks {{ showCropMarks ? 'ON' : 'OFF' }}
                    </button>

                    <!-- Primary Print Button -->
                    <button
                        type="button"
                        @click="triggerPrint"
                        class="px-4 py-2 rounded-full bg-[#ad2c51] hover:bg-[#8e2442] text-white font-semibold shadow-md flex items-center gap-2 cursor-pointer transition-all transform hover:scale-105"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/>
                        </svg>
                        <span>Print / Save PDF</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Print Tip Banner on Screen -->
        <div class="no-print max-w-4xl mx-auto mt-4 px-4">
            <div class="bg-amber-50 border border-amber-200 text-amber-900 rounded-xl p-3 text-xs flex items-start gap-2.5">
                <span class="text-base">💡</span>
                <div>
                    <strong>Printing Tip for Best Results:</strong> In the browser print dialog, choose <strong>Destination: Save as PDF</strong> (or your cardstock printer), set <strong>Margins: None</strong>, and ensure <strong>"Background graphics"</strong> is checked for crisp rose gold borders and floral colors.
                </div>
            </div>
        </div>

        <!-- Master Printable Container -->
        <main class="py-6 px-4 flex flex-col lg:flex-row items-center justify-center gap-8 lg:gap-12 print:p-0 print:m-0 print:gap-0 print:block">
            
            <!-- ================= FRONT SIDE (THE INVITATION) ================= -->
            <section
                v-if="viewSide === 'both' || viewSide === 'front'"
                class="card-wrapper print:page-break-after"
                :class="[
                    cardFormat === '5x7' ? 'card-5x7' : 'card-a5',
                    { 'with-crop-marks': showCropMarks }
                ]"
            >
                <!-- Crop Marks (for print trimming) -->
                <div v-if="showCropMarks" class="crop-mark top-left"></div>
                <div v-if="showCropMarks" class="crop-mark top-right"></div>
                <div v-if="showCropMarks" class="crop-mark bottom-left"></div>
                <div v-if="showCropMarks" class="crop-mark bottom-right"></div>

                <div
                    class="card-face relative overflow-hidden shadow-2xl print:shadow-none transition-colors"
                    :style="{ backgroundColor: showIvoryBg ? '#FFFDF9' : '#ffffff' }"
                >
                    <!-- Ornate Floral Corner Clusters (SVG Vector) -->
                    <div class="absolute -top-3 -left-3 w-28 h-28 pointer-events-none select-none opacity-90">
                        <CornerFlower cluster="tl" />
                    </div>
                    <div class="absolute -top-3 -right-3 w-28 h-28 pointer-events-none select-none opacity-90 -scale-x-100">
                        <CornerFlower cluster="tr" />
                    </div>
                    <div class="absolute -bottom-3 -left-3 w-28 h-28 pointer-events-none select-none opacity-90 -scale-y-100">
                        <CornerFlower cluster="bl" />
                    </div>
                    <div class="absolute -bottom-3 -right-3 w-28 h-28 pointer-events-none select-none opacity-90 rotate-180">
                        <CornerFlower cluster="br" />
                    </div>

                    <!-- Master Arch Framing (Double Line: Deep Burgundy Outer + Gold Foil Inner) -->
                    <div class="absolute inset-4 sm:inset-5 rounded-t-[100px] rounded-b-2xl border-2 border-[#ad2c51] pointer-events-none">
                        <div class="absolute inset-1.5 rounded-t-[94px] rounded-b-xl border border-[#d8ab43] opacity-85"></div>
                    </div>

                    <!-- Inner Invitation Content -->
                    <div class="relative z-10 h-full flex flex-col items-center justify-between px-8 py-8 sm:py-10 text-center">
                        
                        <!-- Top Crest: Catholic Cross & Rose Radiance -->
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-[#ad2c51]/10 flex items-center justify-center mb-1">
                                <svg class="w-4 h-4 fill-[#ad2c51]" viewBox="0 0 24 24">
                                    <path d="M11 2v6H5v4h6v10h4V12h6V8h-6V2h-4z"/>
                                </svg>
                            </div>
                            <p class="font-display text-[9px] sm:text-[10px] tracking-[0.35em] text-[#ad2c51] font-semibold uppercase">
                                The Wedding Of
                            </p>
                        </div>

                        <!-- Parents Blessing Invitation -->
                        <div class="space-y-1 max-w-sm">
                            <p class="font-serif italic text-stone-600 text-xs sm:text-sm">
                                Together with their parents
                            </p>
                            <p class="font-serif text-stone-800 text-xs sm:text-sm font-semibold tracking-wide">
                                {{ settings.bride_parents || 'Mr. & Mrs. Perera' }}
                                <span class="font-normal italic text-stone-500 text-xs mx-1">&amp;</span>
                                {{ settings.groom_parents || 'Mr. & Mrs. Fernando' }}
                            </p>
                            <p class="font-serif text-[11px] sm:text-xs text-stone-600 italic leading-relaxed pt-1">
                                request the honour of your presence at the Nuptial Mass<br class="hidden sm:inline" />
                                uniting their children in the Sacrament of Holy Matrimony
                            </p>
                        </div>

                        <!-- Bride & Groom Couple Names -->
                        <div class="py-1">
                            <h2 class="font-serif font-bold text-3xl sm:text-4xl lg:text-[42px] leading-tight text-[#ad2c51] tracking-tight">
                                {{ settings.groom_name || 'Buddhima' }}
                            </h2>
                            <div class="flex items-center justify-center gap-3 my-0.5">
                                <span class="h-[1px] w-10 bg-gradient-to-r from-transparent to-[#C8636F]"></span>
                                <span class="font-script text-2xl sm:text-3xl text-[#F678A4] -translate-y-1">&amp;</span>
                                <span class="h-[1px] w-10 bg-gradient-to-l from-transparent to-[#C8636F]"></span>
                            </div>
                            <h2 class="font-serif font-bold text-3xl sm:text-4xl lg:text-[42px] leading-tight text-[#ad2c51] tracking-tight">
                                {{ settings.bride_name || 'Shavindi' }}
                            </h2>
                        </div>

                        <!-- Date & Ceremony Details -->
                        <div class="space-y-1 border-t border-b border-[#C8636F]/30 py-2.5 w-full max-w-xs">
                            <p class="font-serif italic text-stone-700 text-xs sm:text-sm">
                                Tuesday, the Twenty-Ninth of December
                            </p>
                            <p class="font-display text-[10px] sm:text-[11px] font-bold text-[#ad2c51] tracking-[0.25em] uppercase">
                                Two Thousand Twenty-Six
                            </p>
                            <p class="font-serif text-xs text-stone-600">
                                at Nine o'clock in the morning
                            </p>
                        </div>

                        <!-- Venue -->
                        <div>
                            <p class="font-serif font-bold text-sm sm:text-base text-stone-900 tracking-wide uppercase">
                                St. Mary's Church
                            </p>
                            <p class="font-serif italic text-xs text-stone-600">
                                Moratuwa, Sri Lanka
                            </p>
                        </div>

                        <!-- Scripture / Blessing Footer -->
                        <div class="pt-1">
                            <p class="font-serif italic text-[10px] sm:text-[11px] text-[#ad2c51]/80 max-w-xs leading-normal">
                                “Therefore what God has joined together, let no one separate.”
                            </p>
                            <p class="font-sans text-[8px] sm:text-[9px] tracking-widest uppercase text-stone-400 mt-0.5">
                                Matthew 19:6
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Screen Label -->
                <p class="no-print text-center text-xs text-stone-500 mt-2 font-medium">Front Side (Invitation)</p>
            </section>

            <!-- ================= BACK SIDE (DETAILS & PROGRAMME) ================= -->
            <section
                v-if="viewSide === 'both' || viewSide === 'back'"
                class="card-wrapper"
                :class="[
                    cardFormat === '5x7' ? 'card-5x7' : 'card-a5',
                    { 'with-crop-marks': showCropMarks }
                ]"
            >
                <!-- Crop Marks -->
                <div v-if="showCropMarks" class="crop-mark top-left"></div>
                <div v-if="showCropMarks" class="crop-mark top-right"></div>
                <div v-if="showCropMarks" class="crop-mark bottom-left"></div>
                <div v-if="showCropMarks" class="crop-mark bottom-right"></div>

                <div
                    class="card-face relative overflow-hidden shadow-2xl print:shadow-none transition-colors"
                    :style="{ backgroundColor: showIvoryBg ? '#FFFDF9' : '#ffffff' }"
                >
                    <!-- Corner Floral Accents -->
                    <div class="absolute -top-3 -left-3 w-24 h-24 pointer-events-none select-none opacity-80">
                        <CornerFlower cluster="tl" />
                    </div>
                    <div class="absolute -top-3 -right-3 w-24 h-24 pointer-events-none select-none opacity-80 -scale-x-100">
                        <CornerFlower cluster="tr" />
                    </div>
                    <div class="absolute -bottom-3 -left-3 w-24 h-24 pointer-events-none select-none opacity-80 -scale-y-100">
                        <CornerFlower cluster="bl" />
                    </div>
                    <div class="absolute -bottom-3 -right-3 w-24 h-24 pointer-events-none select-none opacity-80 rotate-180">
                        <CornerFlower cluster="br" />
                    </div>

                    <!-- Arch Framing -->
                    <div class="absolute inset-4 sm:inset-5 rounded-t-[100px] rounded-b-2xl border-2 border-[#ad2c51] pointer-events-none">
                        <div class="absolute inset-1.5 rounded-t-[94px] rounded-b-xl border border-[#d8ab43] opacity-85"></div>
                    </div>

                    <!-- Inner Details Content -->
                    <div class="relative z-10 h-full flex flex-col items-center justify-between px-7 py-8 sm:py-9 text-center">
                        
                        <!-- Top Header -->
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-serif text-[#F678A4]">❦</span>
                            <h3 class="font-display text-[10px] sm:text-[11px] tracking-[0.3em] text-[#ad2c51] font-bold uppercase mt-0.5">
                                Celebration Programme
                            </h3>
                            <p class="font-serif italic text-xs text-stone-500">
                                Tuesday, 29th December 2026
                            </p>
                        </div>

                        <!-- Schedule Timeline -->
                        <div class="w-full max-w-xs space-y-2.5 my-1 text-left">
                            
                            <!-- 1. Registration -->
                            <div class="flex items-start gap-3 bg-white/70 border border-[#F678A4]/30 rounded-xl p-2.5">
                                <div class="w-7 h-7 rounded-lg bg-[#ad2c51] text-white flex items-center justify-center shrink-0 text-xs shadow-sm">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-sans font-bold text-xs text-[#ad2c51]">08:30 AM</span>
                                        <span class="text-[10px] uppercase font-semibold tracking-wider text-stone-700">· Registration</span>
                                    </div>
                                    <p class="font-serif text-[11px] text-stone-500 leading-tight">
                                        St. Mary's Church, Moratuwa
                                    </p>
                                </div>
                            </div>

                            <!-- 2. Nuptial Mass -->
                            <div class="flex items-start gap-3 bg-white/70 border border-[#F678A4]/30 rounded-xl p-2.5">
                                <div class="w-7 h-7 rounded-lg bg-[#ad2c51] text-white flex items-center justify-center shrink-0 text-xs shadow-sm">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l-5.5 9h11L12 2zm0 3.84L13.93 9h-3.87L12 5.84zM4 13v8h16v-8H4zm14 6H6v-4h12v4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-sans font-bold text-xs text-[#ad2c51]">09:00 AM</span>
                                        <span class="text-[10px] uppercase font-semibold tracking-wider text-stone-700">· Nuptial Mass</span>
                                    </div>
                                    <p class="font-serif text-[11px] text-stone-500 leading-tight">
                                        Holy Sacrament & Exchange of Vows
                                    </p>
                                </div>
                            </div>

                            <!-- 3. Reception & Poruwa -->
                            <div class="flex items-start gap-3 bg-white/70 border border-[#F678A4]/30 rounded-xl p-2.5">
                                <div class="w-7 h-7 rounded-lg bg-[#ad2c51] text-white flex items-center justify-center shrink-0 text-xs shadow-sm">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-sans font-bold text-xs text-[#ad2c51]">12:00 PM</span>
                                        <span class="text-[10px] uppercase font-semibold tracking-wider text-stone-700">· Poruwa &amp; Reception</span>
                                    </div>
                                    <p class="font-serif text-[11px] text-stone-500 leading-tight">
                                        The Grand Ballroom · Lunch &amp; Festivities
                                    </p>
                                </div>
                            </div>

                        </div>

                        <!-- Dress Code Pill -->
                        <div class="px-3 py-1 rounded-full bg-[#ad2c51]/10 text-[#ad2c51] text-[10px] font-medium tracking-wide">
                            <strong>Dress Code:</strong> Formal Church Attire / Elegant Evening Wear
                        </div>

                        <!-- RSVP Section & Interactive QR Code -->
                        <div class="w-full max-w-xs border-t border-[#C8636F]/30 pt-2 flex items-center justify-between gap-3 text-left">
                            <div class="flex-1">
                                <p class="font-display text-[9px] font-bold text-[#ad2c51] tracking-wider uppercase">
                                    Kindly RSVP
                                </p>
                                <p class="font-serif text-[11px] text-stone-700 font-semibold">
                                    By 1st December 2026
                                </p>
                                <p class="font-serif text-[10px] text-stone-500 leading-tight mt-0.5">
                                    Scan QR to confirm attendance &amp; view digital card
                                </p>
                            </div>

                            <!-- Crisp Vector QR Code -->
                            <div class="w-16 h-16 sm:w-18 sm:h-18 p-1 bg-white border border-[#C8636F]/40 rounded-lg shadow-sm shrink-0 flex items-center justify-center">
                                <svg
                                    v-if="qrData"
                                    :viewBox="`0 0 ${qrData.size} ${qrData.size}`"
                                    class="w-full h-full"
                                    shape-rendering="crispEdges"
                                >
                                    <path :d="qrData.path" fill="#ad2c51" />
                                </svg>
                                <div v-else class="text-[9px] text-stone-400">QR Code</div>
                            </div>
                        </div>

                        <!-- Bottom Couple Blessings -->
                        <p class="font-serif italic text-stone-500 text-[10px] pt-1">
                            With love, blessings &amp; gratitude · Buddhima &amp; Shavindi
                        </p>

                    </div>
                </div>

                <!-- Screen Label -->
                <p class="no-print text-center text-xs text-stone-500 mt-2 font-medium">Back Side (Details &amp; QR)</p>
            </section>

        </main>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import CornerFlower from '@/Components/Invitation/CornerFlower.vue';
import { generateQrSvgPath } from '@/Utils/qrcode.js';

const props = defineProps({
    settings: { type: Object, required: true },
    guest: { type: Object, default: null },
    invitationUrl: { type: String, default: '' },
    backUrl: { type: String, default: '/preview' },
});

const cardFormat = ref('5x7'); // '5x7' or 'a5'
const viewSide = ref('both'); // 'both', 'front', 'back'
const showIvoryBg = ref(true);
const showCropMarks = ref(false);

const fullUrl = computed(() => {
    if (props.invitationUrl) return props.invitationUrl;
    if (typeof window !== 'undefined') {
        return window.location.origin + (props.guest?.slug ? `/invite/${props.guest.slug}` : '/preview');
    }
    return 'http://localhost:8000/preview';
});

const qrData = computed(() => {
    try {
        return generateQrSvgPath(fullUrl.value, 0);
    } catch (e) {
        console.warn('QR code generation failed:', e);
        return null;
    }
});

const triggerPrint = () => {
    window.print();
};
</script>

<style scoped>
/* Screen Dimensions */
.card-wrapper {
    position: relative;
    box-sizing: border-box;
}

/* 5" x 7" Classic Wedding Stationery Proportions */
.card-5x7 {
    width: 360px;
    height: 504px; /* 1:1.4 aspect ratio */
}

@media (min-width: 640px) {
    .card-5x7 {
        width: 390px;
        height: 546px;
    }
}

/* A5 Stationery Proportions (148mm x 210mm) */
.card-a5 {
    width: 370px;
    height: 523px; /* 1:1.414 aspect ratio */
}

@media (min-width: 640px) {
    .card-a5 {
        width: 410px;
        height: 580px;
    }
}

.card-face {
    width: 100%;
    height: 100%;
    border-radius: 16px;
    border: 1px solid rgba(246, 120, 164, 0.4);
}

/* Crop Marks Styling */
.crop-mark {
    position: absolute;
    width: 14px;
    height: 14px;
    pointer-events: none;
    z-index: 20;
}
.crop-mark.top-left {
    top: -10px;
    left: -10px;
    border-right: 1px solid #78716c;
    border-bottom: 1px solid #78716c;
}
.crop-mark.top-right {
    top: -10px;
    right: -10px;
    border-left: 1px solid #78716c;
    border-bottom: 1px solid #78716c;
}
.crop-mark.bottom-left {
    bottom: -10px;
    left: -10px;
    border-right: 1px solid #78716c;
    border-top: 1px solid #78716c;
}
.crop-mark.bottom-right {
    bottom: -10px;
    right: -10px;
    border-left: 1px solid #78716c;
    border-top: 1px solid #78716c;
}

/* ================= PRINT MEDIA QUERIES ================= */
@media print {
    .no-print {
        display: none !important;
    }

    body, html {
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    @page {
        size: auto;
        margin: 10mm;
    }

    .card-wrapper {
        margin: 0 auto !important;
        page-break-inside: avoid !important;
    }

    .card-5x7 {
        width: 5in !important;
        height: 7in !important;
    }

    .card-a5 {
        width: 148mm !important;
        height: 210mm !important;
    }

    .card-face {
        box-shadow: none !important;
        border: 1px solid rgba(173, 44, 81, 0.25) !important;
        border-radius: 12px !important;
    }

    .print\:page-break-after {
        page-break-after: always !important;
        break-after: page !important;
    }
}
</style>
