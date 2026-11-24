<template>
    <div id="venue" class="my-10 sm:my-16 px-4 sm:px-6 scroll-mt-10">
        <!-- Section Title (Enlarged to match Wedding Events) -->
        <div class="text-center mb-8">
            <p class="font-sans text-sm sm:text-base uppercase tracking-[0.3em] font-bold text-gold-700">
                {{ t('venue', 'theSetting') }}
            </p>
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-[#ad2c51] mt-1">
                {{ t('venue', 'weddingVenue') }}
            </h2>
            <FlowerDivider />
        </div>

        <div class="max-w-md lg:max-w-6xl mx-auto space-y-6 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-8 lg:items-stretch">
            <!-- Venue Details Card -->
            <div class="p-6 sm:p-8 rounded-2xl bg-[#faf8f2] border-2 border-[#d8ab43]/50 shadow-sm text-left flex flex-col justify-between hover:border-[#d8ab43] transition-all hover:shadow-[0_18px_40px_-12px_rgba(216,171,67,.25)] duration-500">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-full bg-[#ad2c51] border-2 border-[#d8ab43] flex items-center justify-center text-gold-200 shadow-md shrink-0">
                            <svg class="w-7 h-7 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm font-sans uppercase tracking-[0.25em] font-bold text-gold-700">
                                {{ t('venue', 'ceremonyReception') }}
                            </p>
                            <h3 class="font-serif text-2xl sm:text-3xl font-bold text-[#ad2c51] leading-tight">
                                {{ displayVenuesTitle }}
                            </h3>
                        </div>
                    </div>

                    <p class="text-base sm:text-lg text-stone-900 font-serif font-bold italic mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold-700 fill-none stroke-current shrink-0" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <span>{{ displayAddress }}</span>
                    </p>

                    <p class="text-base sm:text-lg font-serif text-stone-950 font-medium leading-relaxed mb-6 border-l-4 border-gold-500 pl-4 bg-white/60 py-3 rounded-r-xl shadow-xs">
                        {{ dynamicDescription }}
                    </p>
                </div>

                <div class="pt-2">
                    <a
                        :href="venueMapUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full inline-flex items-center justify-center gap-2.5 px-6 py-4 rounded-full bg-[#ad2c51] hover:bg-[#8a2342] text-gold-100 font-serif text-base sm:text-lg uppercase tracking-widest font-bold shadow-md hover:shadow-lg transition-all transform active:scale-95 border border-[#f5dc8a]/30"
                    >
                        <svg class="w-5 h-5 fill-none stroke-current text-gold-200" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>{{ t('venue', 'getDirections') }}</span>
                    </a>
                </div>
            </div>

            <!-- Map View Card -->
            <div class="rounded-2xl border-2 border-[#d8ab43]/50 shadow-sm overflow-hidden bg-white flex flex-col justify-between">
                <!-- Map Header Link -->
                <div class="p-4 bg-white border-b border-stone-100 flex items-center justify-between gap-3">
                    <span class="text-base sm:text-lg font-serif font-bold text-[#ad2c51] leading-snug">
                        {{ displayVenuesTitle }}
                    </span>
                    <a
                        :href="venueMapUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-sm sm:text-base font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1 shrink-0"
                    >
                        <span>{{ t('venue', 'openInMaps') }}</span> ↗
                    </a>
                </div>

                <!-- Interactive Google Map Embed -->
                <div class="relative w-full h-64 lg:h-[26rem] bg-stone-100 flex-1">
                    <iframe
                        class="w-full h-full border-0"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://maps.google.com/maps?q=St.+Sebastian%27s+Church+Moratuwa+Sri+Lanka&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    ></iframe>
                </div>

                <!-- View on Map Button -->
                <div class="p-3 text-center bg-[#faf8f2] border-t border-[#e8c86d]/30">
                    <a
                        :href="venueMapUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 text-sm sm:text-base uppercase tracking-[0.22em] font-serif font-bold text-[#ad2c51] hover:text-gold-700 transition-colors"
                    >
                        <svg class="w-5 h-5 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                            <line x1="8" y1="2" x2="8" y2="18"></line>
                            <line x1="16" y1="6" x2="16" y2="22"></line>
                        </svg>
                        <span>{{ t('venue', 'interactiveNav') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import FlowerDivider from '@/Components/Invitation/FlowerDivider.vue';
import { useLanguage, translateVenueName, translateAddress } from '@/composables/useLanguage';

const { t, isSinhala, formatTimeSinhala } = useLanguage();

const props = defineProps({
    venueName: { type: String, default: "Vinrich Lake Resort" },
    venueAddress: { type: String, default: 'No. 18/3, Duwawatta Road, Piliyandala' },
    venueMapUrl: { type: String, default: "https://maps.google.com/?q=Vinrich+Lake+Resort+Piliyandala" },
    churchName: { type: String, default: "St. Sebastian's Church" },
    churchAddress: { type: String, default: 'Moratuwa, Sri Lanka' },
    churchTime: { type: String, default: '4:00 PM' },
    weddingDate: { type: String, default: '2026-12-29 16:00:00' },
    events: { type: Array, default: () => [] },
});

const massTime = computed(() => {
    return props.churchTime || props.events?.find(e => (e.name || '').toLowerCase().includes('mass'))?.time || props.events?.[0]?.time || '4:00 PM';
});

const receptionTime = computed(() => {
    return props.events?.find(e => (e.name || '').toLowerCase().includes('reception'))?.time || props.events?.[1]?.time || '6:30 PM to 12:00 AM';
});

const churchTitle = computed(() => {
    const rawName = props.churchName || "St. Sebastian's Church";
    return isSinhala.value ? translateVenueName(rawName) : rawName;
});

const receptionTitle = computed(() => {
    const rawName = props.venueName || "Vinrich Lake Resort";
    return isSinhala.value ? translateVenueName(rawName) : rawName;
});

const displayVenuesTitle = computed(() => {
    if (churchTitle.value && receptionTitle.value && !churchTitle.value.includes(receptionTitle.value)) {
        return isSinhala.value ? `${churchTitle.value} සහ ${receptionTitle.value}` : `${churchTitle.value} & ${receptionTitle.value}`;
    }
    return receptionTitle.value || churchTitle.value;
});

const displayAddress = computed(() => {
    if (isSinhala.value) {
        const churchAddrSi = translateAddress(props.churchAddress);
        const venueAddrSi = translateAddress(props.venueAddress);
        if (churchAddrSi && venueAddrSi && churchAddrSi !== venueAddrSi) {
            return `${churchAddrSi} සහ ${venueAddrSi}`;
        }
        return venueAddrSi || churchAddrSi || 'මොරටුව සහ පිළියන්දල, ශ්‍රී ලංකාව';
    }
    if (props.churchAddress && props.venueAddress && props.churchAddress !== props.venueAddress) {
        return `${props.churchAddress} & ${props.venueAddress}`;
    }
    return props.venueAddress || props.churchAddress || 'Moratuwa & Piliyandala, Sri Lanka';
});

const dynamicDescription = computed(() => {
    if (!isSinhala.value) {
        return `We warmly welcome you to ${churchTitle.value} for the Wedding Mass at ${massTime.value}, followed by the Wedding Reception at ${receptionTitle.value} from ${receptionTime.value}.`;
    }
    const massSi = formatTimeSinhala(massTime.value);
    const recSi = formatTimeSinhala(receptionTime.value);
    const churchVenueNameSi = churchTitle.value;
    const churchPhrase = churchVenueNameSi.endsWith('දේවස්ථානය') ? `${churchVenueNameSi.slice(0, -1)}යේදී` : `${churchVenueNameSi} හිදී`;
    return `${churchPhrase} ${massSi} ට පැවැත්වෙන ශුද්ධ වූ මංගල දිව්‍ය පූජාවටත්, ඉන් අනතුරුව ${receptionTitle.value} හිදී ${recSi} පැවැත්වෙන මංගල සාදයටත් ඔබ සැමට සාදරයෙන් ආරාධනා කරමු.`;
});
</script>
