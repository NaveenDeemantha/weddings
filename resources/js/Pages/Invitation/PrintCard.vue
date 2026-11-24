<template>
    <Head title="Print Wedding Invitation Card - Buddhima & Shavindi" />

    <div class="min-h-screen bg-stone-100 text-stone-800 font-sans print:bg-white print:p-0">
        <!-- Screen-only Controls Header -->
        <header class="no-print sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-stone-200 px-4 py-3 sm:px-8 shadow-sm">
            <div class="max-w-6xl mx-auto flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <Link
                        :href="backUrl"
                        class="p-2 rounded-full hover:bg-stone-100 text-stone-600 transition-colors cursor-pointer"
                        title="Back"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </Link>
                    <div>
                        <h1 class="font-serif text-lg sm:text-xl font-bold text-[#ad2c51]">
                            Wedding Invitation Print Card
                        </h1>
                        <p class="text-xs text-stone-500">
                            Single-Page Luxury Stationery · Gold Foil Line-Art Rose Theme
                        </p>
                    </div>
                </div>

                <!-- Customization Options Toolbar -->
                <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs font-medium">
                    <!-- Format Toggle -->
                    <div class="inline-flex rounded-lg border border-stone-200 bg-stone-50 p-0.5">
                        <button
                            type="button"
                            @click="cardFormat = '5x7'"
                            class="px-3 py-1.5 rounded-md transition-all cursor-pointer"
                            :class="cardFormat === '5x7' ? 'bg-white shadow text-[#ad2c51] font-semibold' : 'text-stone-600 hover:text-stone-900'"
                        >
                            5" × 7" (A7 Classic)
                        </button>
                        <button
                            type="button"
                            @click="cardFormat = 'a5'"
                            class="px-3 py-1.5 rounded-md transition-all cursor-pointer"
                            :class="cardFormat === 'a5' ? 'bg-white shadow text-[#ad2c51] font-semibold' : 'text-stone-600 hover:text-stone-900'"
                        >
                            A5 Sheet
                        </button>
                    </div>

                    <!-- Paper Color Toggle -->
                    <button
                        type="button"
                        @click="isIvory = !isIvory"
                        class="px-3 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-700 flex items-center gap-1.5 cursor-pointer"
                    >
                        <span class="w-3 h-3 rounded-full border border-stone-300" :style="{ backgroundColor: isIvory ? '#FFFDF9' : '#ffffff' }"></span>
                        <span>{{ isIvory ? 'Warm Ivory' : 'Pure White' }}</span>
                    </button>

                    <!-- QR Code Toggle -->
                    <button
                        type="button"
                        @click="showQr = !showQr"
                        class="px-3 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-700 cursor-pointer"
                        :class="{ 'border-[#ad2c51] text-[#ad2c51] font-semibold': showQr }"
                    >
                        QR Code {{ showQr ? 'ON' : 'OFF' }}
                    </button>

                    <!-- Crop Marks Toggle -->
                    <button
                        type="button"
                        @click="showCropMarks = !showCropMarks"
                        class="px-3 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-700 cursor-pointer"
                        :class="{ 'border-[#ad2c51] text-[#ad2c51] font-semibold': showCropMarks }"
                    >
                        Crop Marks {{ showCropMarks ? 'ON' : 'OFF' }}
                    </button>

                    <!-- Primary Print Button -->
                    <button
                        type="button"
                        @click="triggerPrint"
                        class="px-5 py-2 rounded-full bg-[#ad2c51] hover:bg-[#8e2442] text-white font-semibold shadow-md flex items-center gap-2 cursor-pointer transition-all transform hover:scale-105"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/>
                        </svg>
                        <span>Print / Save PDF (1 Page)</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Screen-only Helper Bar -->
        <div class="no-print max-w-4xl mx-auto mt-4 px-4">
            <div class="bg-amber-50 border border-amber-200 text-amber-900 rounded-xl p-3 text-xs flex flex-wrap items-center justify-between gap-3 shadow-sm">
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-amber-600 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z" />
                    </svg>
                    <div>
                        <strong>Gold Foil Line-Art Rose Design:</strong> Single-page luxury layout framed with our site's signature gold-outlined roses, soft blush watercolor wash, and fine gold stationery border rules.
                    </div>
                </div>

                <!-- Live Guest Name Input -->
                <div class="flex items-center gap-2">
                    <label for="customGuest" class="font-semibold text-stone-700">Guest Line:</label>
                    <input
                        id="customGuest"
                        v-model="guestInput"
                        type="text"
                        placeholder="Leave blank for handwriting dots"
                        class="px-2.5 py-1 text-xs border border-stone-300 rounded-md focus:ring-1 focus:ring-[#ad2c51] focus:border-[#ad2c51] bg-white w-48"
                    />
                </div>
            </div>
        </div>

        <!-- Master Printable Container (STRICTLY ONE PAGE) -->
        <main class="py-8 px-4 flex items-center justify-center print:p-0 print:m-0 print:block">
            
            <section
                class="card-wrapper"
                :class="[
                    cardFormat === '5x7' ? 'card-5x7' : 'card-a5',
                    { 'with-crop-marks': showCropMarks }
                ]"
            >
                <!-- Trimming Crop Marks -->
                <div v-if="showCropMarks" class="crop-mark top-left"></div>
                <div v-if="showCropMarks" class="crop-mark top-right"></div>
                <div v-if="showCropMarks" class="crop-mark bottom-left"></div>
                <div v-if="showCropMarks" class="crop-mark bottom-right"></div>

                <!-- Card Face: High-End Stationery with Gold Outlined Roses & Fine Rectangular Borders -->
                <div
                    class="card-face relative overflow-hidden shadow-2xl print:shadow-none transition-colors"
                    :style="{ backgroundColor: isIvory ? '#FFFDF9' : '#ffffff' }"
                >
                    <!-- ================= CORNER GOLD-OUTLINED ROSES ================= -->
                    <!-- Top-Right Luxury Gold Foil Rose Spray -->
                    <div class="absolute -top-3 -right-3 w-36 h-36 sm:w-44 sm:h-44 pointer-events-none select-none z-[1] -scale-x-100 opacity-95">
                        <CornerFlower cluster="tr" />
                    </div>

                    <!-- Bottom-Left Luxury Gold Foil Rose Spray -->
                    <div class="absolute -bottom-3 -left-3 w-36 h-36 sm:w-44 sm:h-44 pointer-events-none select-none z-[1] -scale-y-100 opacity-95">
                        <CornerFlower cluster="bl" />
                    </div>

                    <!-- Top-Left Subtle Rose Accent -->
                    <div class="absolute -top-4 -left-4 w-24 h-24 sm:w-28 sm:h-28 pointer-events-none select-none z-[1] opacity-75">
                        <CornerFlower cluster="tl" />
                    </div>

                    <!-- Bottom-Right Subtle Rose Accent -->
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 sm:w-28 sm:h-28 pointer-events-none select-none z-[1] rotate-180 opacity-75">
                        <CornerFlower cluster="br" />
                    </div>

                    <!-- ================= FINE STATIONERY GOLD BORDER RULES ================= -->
                    <!-- Outer Fine Gold Line -->
                    <div class="absolute inset-3 sm:inset-4 border border-[#d8ab43]/50 pointer-events-none z-[2]">
                        <!-- Inner Fine Gold Hairline with Corner Notch Accents -->
                        <div class="absolute inset-1 sm:inset-1.5 border border-[#d8ab43]/30"></div>
                        <!-- Delicate Corner Starburst Jewels -->
                        <div class="absolute top-1 left-1 opacity-80 flex items-center justify-center">
                            <svg class="w-2 h-2 text-[#d8ab43] fill-current" viewBox="0 0 24 24"><path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z"/></svg>
                        </div>
                        <div class="absolute top-1 right-1 opacity-80 flex items-center justify-center">
                            <svg class="w-2 h-2 text-[#d8ab43] fill-current" viewBox="0 0 24 24"><path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z"/></svg>
                        </div>
                        <div class="absolute bottom-1 left-1 opacity-80 flex items-center justify-center">
                            <svg class="w-2 h-2 text-[#d8ab43] fill-current" viewBox="0 0 24 24"><path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z"/></svg>
                        </div>
                        <div class="absolute bottom-1 right-1 opacity-80 flex items-center justify-center">
                            <svg class="w-2 h-2 text-[#d8ab43] fill-current" viewBox="0 0 24 24"><path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z"/></svg>
                        </div>
                    </div>

                    <!-- ================= INNER STATIONERY CONTENT ================= -->
                    <div class="relative z-10 w-full h-full flex flex-col justify-between px-7 sm:px-9 py-6 sm:py-7 text-center text-stone-800">
                        
                        <!-- Top Header: Catholic Cross & Holy Scripture (1 Corinthians 13:13) -->
                        <div class="flex flex-col items-center pt-0.5">
                            <div class="w-6 h-6 rounded-full bg-[#ad2c51]/10 border border-[#d8ab43]/70 flex items-center justify-center mb-1 shadow-xs">
                                <svg class="w-3 h-3 fill-[#ad2c51]" viewBox="0 0 24 24">
                                    <path d="M11 2v6H5v4h6v10h4V12h6V8h-6V2h-4z"/>
                                </svg>
                            </div>

                            <p class="font-serif italic text-[10px] sm:text-[11.5px] leading-snug text-stone-700 max-w-sm">
                                “And now these three remain: faith, hope and love.<br />
                                But the greatest of these is love.”
                            </p>
                            <p class="font-display text-[8.5px] sm:text-[9.5px] tracking-[0.2em] font-semibold text-[#ad2c51] uppercase mt-0.5">
                                1 Corinthians 13:13
                            </p>
                        </div>

                        <!-- Parents Section (Rodrigo & Fernando Families) -->
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center gap-2 max-w-md mx-auto w-full pt-1">
                            <div class="text-center font-serif text-[11px] sm:text-[12.5px] leading-tight font-semibold text-stone-900">
                                <p>(Late) Mr. Sumith Rodrigo &amp;</p>
                                <p>Mrs. Banduwathi</p>
                            </div>
                            <div class="flex flex-col items-center justify-center px-1 text-stone-400 font-serif italic text-xs leading-none">
                                <span class="h-3 w-[1px] bg-[#d8ab43]/60"></span>
                                <span class="my-0.5 text-[10.5px] text-[#ad2c51] font-semibold">and</span>
                                <span class="h-3 w-[1px] bg-[#d8ab43]/60"></span>
                            </div>
                            <div class="text-center font-serif text-[11px] sm:text-[12.5px] leading-tight font-semibold text-stone-900">
                                <p>Mr. Lalith Fernando &amp;</p>
                                <p>Mrs. Priska Pieris</p>
                            </div>
                        </div>

                        <!-- Formal Invitation Line -->
                        <div class="pt-0.5">
                            <p class="font-display uppercase tracking-[0.25em] text-[8.5px] sm:text-[10px] font-bold text-[#ad2c51]">
                                Request the pleasure of the company of
                            </p>
                        </div>

                        <!-- Guest Name Line (Dotted or Filled) -->
                        <div class="w-full max-w-md mx-auto">
                            <p class="font-serif text-[10px] sm:text-[12px] text-stone-700 tracking-wider">
                                <span class="font-bold text-stone-900 uppercase">MR. &amp; MRS. / MISS. / FAMILY</span>
                                <span v-if="guestInput.trim()" class="ml-2 font-serif font-bold text-[#ad2c51] underline underline-offset-4 decoration-[#d8ab43] uppercase tracking-wider">
                                    {{ guestInput.trim() }}
                                </span>
                                <span v-else class="text-stone-400 tracking-widest pl-1 select-none">
                                    . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                                </span>
                            </p>
                        </div>

                        <!-- Connecting Subtitle -->
                        <div>
                            <p class="font-display uppercase tracking-[0.2em] text-[8px] sm:text-[9.5px] font-semibold text-stone-600">
                                As we celebrate the marriage of
                            </p>
                        </div>

                        <!-- The Couple's Calligraphy: Buddhima & Shavindi -->
                        <div class="py-0.5">
                            <h2 class="font-serif font-bold text-3xl sm:text-[40px] leading-none text-[#ad2c51] tracking-tight drop-shadow-xs">
                                Buddhima
                            </h2>
                            <div class="flex items-center justify-center gap-3 my-0.5">
                                <span class="h-[1px] w-12 bg-gradient-to-r from-transparent to-[#d8ab43]"></span>
                                <span class="font-script text-2xl sm:text-3xl text-[#d8ab43] -translate-y-0.5">&amp;</span>
                                <span class="h-[1px] w-12 bg-gradient-to-l from-transparent to-[#d8ab43]"></span>
                            </div>
                            <h2 class="font-serif font-bold text-3xl sm:text-[40px] leading-none text-[#ad2c51] tracking-tight drop-shadow-xs">
                                Shavindi
                            </h2>
                        </div>

                        <!-- Date Section: ——— TUESDAY | 29 | DECEMBER 2026 ——— -->
                        <div class="flex items-center justify-center gap-2 sm:gap-3 my-0.5 w-full max-w-md mx-auto text-stone-800 border-y border-[#d8ab43]/40 py-1.5">
                            <span class="h-[1px] w-6 sm:w-10 bg-[#ad2c51]/40"></span>
                            <span class="font-display uppercase tracking-[0.25em] text-[10px] sm:text-[11.5px] font-bold text-stone-800">
                                {{ dateParts.dayOfWeekEn }}
                            </span>
                            <span class="h-6 w-[1.5px] bg-[#d8ab43]"></span>
                            <span class="font-serif text-3xl sm:text-4xl font-bold text-[#ad2c51] leading-none px-1">
                                {{ dateParts.day }}
                            </span>
                            <span class="h-6 w-[1.5px] bg-[#d8ab43]"></span>
                            <span class="font-display uppercase tracking-[0.25em] text-[10px] sm:text-[11.5px] font-bold text-stone-800">
                                {{ dateParts.monthEn }} {{ dateParts.year }}
                            </span>
                            <span class="h-[1px] w-6 sm:w-10 bg-[#ad2c51]/40"></span>
                        </div>

                        <!-- Wedding Mass Ceremony -->
                        <div class="space-y-0.5">
                            <p class="font-display uppercase tracking-[0.22em] text-[10px] sm:text-[11.5px] font-bold text-[#ad2c51]">
                                THE WEDDING MASS
                            </p>
                            <p class="font-serif text-[10.5px] sm:text-[12px] font-semibold text-stone-700 uppercase">
                                AT {{ massTime }}
                            </p>
                            <p class="font-display uppercase tracking-[0.16em] text-[10px] sm:text-[11.5px] font-bold text-stone-900 uppercase">
                                AT {{ churchName }}
                            </p>
                        </div>

                        <!-- Gold Filigree Divider -->
                        <div class="flex items-center justify-center gap-2">
                            <span class="h-[1px] w-8 bg-[#d8ab43]/50"></span>
                            <svg class="w-2.5 h-2.5 text-[#d8ab43] fill-current" viewBox="0 0 24 24"><path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z"/></svg>
                            <span class="h-[1px] w-8 bg-[#d8ab43]/50"></span>
                        </div>

                        <!-- Reception Section -->
                        <div class="space-y-0.5">
                            <p class="font-display uppercase tracking-[0.18em] text-[9px] sm:text-[10.5px] font-bold text-[#ad2c51]">
                                FOLLOWED BY THE RECEPTION
                            </p>
                            <p class="font-serif text-[10.5px] sm:text-[12px] font-bold text-stone-900 uppercase">
                                FROM {{ receptionTime }}
                            </p>
                            <p class="font-display uppercase tracking-[0.16em] text-[9.5px] sm:text-[11px] font-bold text-stone-900 uppercase">
                                AT {{ receptionVenue }}
                            </p>
                            <p v-if="receptionAddress" class="font-serif text-[9.5px] sm:text-[11px] text-stone-600 italic">
                                {{ receptionAddress }}
                            </p>
                        </div>

                        <!-- Closing Sentiment & RSVP / QR Section -->
                        <div class="flex items-end justify-between border-t border-[#d8ab43]/40 pt-2 pb-0.5">
                            <!-- Left: Script Closing & RSVP Phone -->
                            <div class="text-left">
                                <p class="font-script text-xl sm:text-2xl text-[#ad2c51] font-normal">
                                    We look forward to celebrating with you.
                                </p>
                                <p class="font-display text-[9.5px] sm:text-[11px] font-bold text-stone-800 tracking-wider mt-0.5">
                                    RSVP: <span class="font-sans font-semibold text-[#ad2c51]">{{ settings.groom_name || 'Buddhima' }} - {{ rsvpPhone }}</span>
                                </p>
                            </div>

                            <!-- Right: Optional Digital RSVP QR Code -->
                            <div v-if="showQr && qrData" class="flex flex-col items-center shrink-0">
                                <div class="w-12 h-12 p-0.5 bg-white border border-[#d8ab43]/60 rounded-md shadow-xs">
                                    <svg
                                        :viewBox="`0 0 ${qrData.size} ${qrData.size}`"
                                        class="w-full h-full"
                                        shape-rendering="crispEdges"
                                    >
                                        <path :d="qrData.path" fill="#ad2c51" />
                                    </svg>
                                </div>
                                <span class="text-[7.5px] font-display uppercase tracking-widest text-stone-500 mt-0.5">Scan to RSVP</span>
                            </div>
                        </div>

                    </div>
                </div>

            </section>

        </main>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import CornerFlower from '@/Components/Invitation/CornerFlower.vue';
import { generateQrSvgPath } from '@/Utils/qrcode.js';
import { parseDateParts } from '@/composables/useLanguage';

const props = defineProps({
    settings: { type: Object, required: true },
    guest: { type: Object, default: null },
    invitationUrl: { type: String, default: '' },
    backUrl: { type: String, default: '/preview' },
});

const dateParts = computed(() => parseDateParts(props.settings?.wedding_date));

const massEvent = computed(() => {
    return props.settings?.events?.find(e => (e.name || '').toLowerCase().includes('mass') || (e.name || '').toLowerCase().includes('church')) || props.settings?.events?.[0];
});

const receptionEvent = computed(() => {
    return props.settings?.events?.find(e => (e.name || '').toLowerCase().includes('reception')) || props.settings?.events?.[1];
});

const massTime = computed(() => {
    return props.settings?.church_time || massEvent.value?.time || '4:00 PM';
});

const churchName = computed(() => {
    return props.settings?.church_name || massEvent.value?.venue || "ST. SEBASTIAN'S CHURCH, MORATUWA";
});

const receptionTime = computed(() => {
    return receptionEvent.value?.time || '6:30 PM TO 12:00 AM';
});

const receptionVenue = computed(() => {
    return props.settings?.venue_name || receptionEvent.value?.venue || 'VINRICH LAKE RESORT';
});

const receptionAddress = computed(() => {
    return props.settings?.venue_address || 'No. 18/3, Duwawatta Road, Piliyandala';
});

const rsvpPhone = computed(() => {
    return props.settings?.rsvp_phone || '0718626389';
});

const cardFormat = ref('5x7'); // '5x7' or 'a5'
const isIvory = ref(true);
const showQr = ref(true);
const showCropMarks = ref(false);
const guestInput = ref(props.guest?.name || '');

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
        return null;
    }
});

const triggerPrint = () => {
    window.print();
};
</script>

<style scoped>
/* Screen Proportions */
.card-wrapper {
    position: relative;
    box-sizing: border-box;
    margin: 0 auto;
}

/* 5" x 7" Classic Wedding Stationery Proportions */
.card-5x7 {
    width: 380px;
    height: 552px; /* 1 : 1.45 luxury card ratio */
}

@media (min-width: 640px) {
    .card-5x7 {
        width: 440px;
        height: 638px;
    }
}

/* A5 Stationery Proportions (148mm x 210mm) */
.card-a5 {
    width: 390px;
    height: 566px;
}

@media (min-width: 640px) {
    .card-a5 {
        width: 460px;
        height: 668px;
    }
}

.card-face {
    width: 100%;
    height: 100%;
    border-radius: 8px;
    border: 1px solid rgba(216, 171, 67, 0.45);
}

/* Trimming Crop Marks */
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

/* ================= STRICT SINGLE PAGE PRINT CSS ================= */
@media print {
    .no-print {
        display: none !important;
    }

    body, html {
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
        height: 100% !important;
        overflow: hidden !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    @page {
        size: auto;
        margin: 0;
    }

    .card-wrapper {
        margin: 0 auto !important;
        page-break-inside: avoid !important;
        page-break-after: avoid !important;
        break-inside: avoid !important;
        break-after: avoid !important;
    }

    .card-5x7 {
        width: 5in !important;
        height: 7.25in !important;
    }

    .card-a5 {
        width: 148mm !important;
        height: 215mm !important;
    }

    .card-face {
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
    }
}
</style>
