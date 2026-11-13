<template>
    <div id="venue" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10">
        <!-- Section Title -->
        <div class="text-center mb-6">
            <p class="font-sans text-[9px] uppercase tracking-[0.25em] font-semibold text-gold-700">
                The Setting
            </p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#15253b] mt-1">
                Wedding Venue
            </h2>
            <div class="my-2.5 text-gold-600 text-xs">✝</div>
        </div>

        <div class="max-w-md mx-auto space-y-4">
            <!-- Venue Details Card -->
            <div class="p-5 sm:p-6 rounded-2xl bg-[#faf8f4] border border-[#d8b878]/70 shadow-sm text-left flex flex-col justify-between hover:border-[#c5a059] transition-all">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-11 h-11 rounded-full bg-[#15253b] border-2 border-[#d8b878] flex items-center justify-center text-amber-200 text-lg shadow-sm shrink-0">
                            📍
                        </div>
                        <div>
                            <p class="text-[9px] font-sans uppercase tracking-[0.25em] font-semibold text-gold-700">
                                Ceremony Venue
                            </p>
                            <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#15253b]">
                                {{ venueName }}
                            </h3>
                        </div>
                    </div>

                    <p class="text-xs sm:text-sm text-stone-700 font-serif italic mb-3">
                        {{ venueAddress }}
                    </p>

                    <p class="text-xs font-serif text-stone-600 leading-relaxed mb-4 border-l-2 border-gold-500 pl-3">
                        Built in 1874, St. Mary's Church Grand Street is one of the most venerated Catholic landmarks in Sri Lanka, renowned for its inspiring neoclassical nave and ceiling frescoes.
                    </p>

                    <!-- Etiquette & Guest Amenities -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-xs font-serif text-stone-700 bg-white/70 p-2.5 rounded-xl border border-stone-200/60">
                            <span>👗</span>
                            <span><strong>Dress Code:</strong> Formal Nuptial Attire / Saree &amp; Lounge Suit</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-serif text-stone-700 bg-white/70 p-2.5 rounded-xl border border-stone-200/60">
                            <span>🚗</span>
                            <span><strong>Parking:</strong> Church premises parking available on Grand Street</span>
                        </div>
                    </div>
                </div>

                <div class="pt-1">
                    <a
                        :href="venueMapUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-[#15253b] hover:bg-[#0f1a29] text-amber-50 font-serif text-xs uppercase tracking-widest font-semibold shadow transition-all transform active:scale-95"
                    >
                        <span>📍</span>
                        <span>Get Driving Directions ↗</span>
                    </a>
                </div>
            </div>

            <!-- Map View Card -->
            <div class="rounded-2xl border border-[#d8b878]/70 shadow-sm overflow-hidden bg-white">
                <!-- Map Header Link -->
                <div class="p-3 bg-white border-b border-stone-100 flex items-center justify-between">
                    <span class="text-xs font-serif font-bold text-[#15253b]">
                        St. Mary's Church Grand Street Negombo
                    </span>
                    <a
                        :href="venueMapUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1"
                    >
                        <span>Open in Maps</span> ↗
                    </a>
                </div>

                <!-- Interactive Google Map Embed -->
                <div class="relative w-full h-56 bg-stone-100">
                    <iframe
                        class="w-full h-full border-0"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://maps.google.com/maps?q=St.+Mary's+Church+Grand+Street+Negombo+Sri+Lanka&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    ></iframe>
                </div>

                <!-- View on Map Button -->
                <div class="p-2.5 text-center bg-[#faf8f4] border-t border-[#e5dfcd]">
                    <a
                        :href="venueMapUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-1.5 text-[10px] uppercase tracking-[0.2em] font-serif font-bold text-[#15253b] hover:text-gold-700 transition-colors"
                    >
                        <span>📍</span>
                        <span>Interactive Navigation</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    venueName: { type: String, default: "St. Mary's Church" },
    venueAddress: { type: String, default: 'Negombo, Sri Lanka' },
    venueMapUrl: { type: String, default: "https://maps.google.com/?q=St.+Mary%27s+Church+Grand+Street+Negombo" },
});
</script>

