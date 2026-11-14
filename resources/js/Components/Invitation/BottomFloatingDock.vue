<template>
    <div class="fixed bottom-4 sm:bottom-6 left-1/2 -translate-x-1/2 z-40 w-auto">
        <div class="flex items-center gap-4 sm:gap-6 md:gap-7 px-5 sm:px-7 py-2.5 sm:py-3 rounded-full bg-white/95 backdrop-blur-md border border-[#d8b878]/60 shadow-2xl text-stone-700">
            <!-- Home -->
            <a
                href="#hero"
                class="hover:text-[#15253b] transition-all flex items-center gap-1.5 p-1 transform active:scale-95 group"
                title="Home"
            >
                <svg class="w-5 h-5 text-stone-700 group-hover:text-gold-700 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <span class="hidden md:inline font-serif text-sm font-semibold uppercase tracking-wider group-hover:text-[#15253b]">Home</span>
            </a>

            <!-- Heart / Story -->
            <a
                href="#story"
                class="hover:text-[#15253b] transition-all flex items-center gap-1.5 p-1 transform active:scale-95 group"
                title="Our Story"
            >
                <svg class="w-5 h-5 text-stone-700 group-hover:text-gold-700 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
                <span class="hidden md:inline font-serif text-sm font-semibold uppercase tracking-wider group-hover:text-[#15253b]">Story</span>
            </a>

            <!-- Calendar / Events -->
            <a
                href="#events"
                class="hover:text-[#15253b] transition-all flex items-center gap-1.5 p-1 transform active:scale-95 group"
                title="Events"
            >
                <svg class="w-5 h-5 text-stone-700 group-hover:text-gold-700 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <span class="hidden md:inline font-serif text-sm font-semibold uppercase tracking-wider group-hover:text-[#15253b]">Events</span>
            </a>

            <!-- Location / Venue -->
            <a
                href="#venue"
                class="hover:text-[#15253b] transition-all flex items-center gap-1.5 p-1 transform active:scale-95 group"
                title="Venue"
            >
                <svg class="w-5 h-5 text-stone-700 group-hover:text-gold-700 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                <span class="hidden md:inline font-serif text-sm font-semibold uppercase tracking-wider group-hover:text-[#15253b]">Venue</span>
            </a>

            <!-- Gallery -->
            <a
                href="#gallery"
                class="hidden md:flex hover:text-[#15253b] transition-all items-center gap-1.5 p-1 transform active:scale-95 group"
                title="Gallery"
            >
                <svg class="w-5 h-5 text-stone-700 group-hover:text-gold-700 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
                <span class="font-serif text-sm font-semibold uppercase tracking-wider group-hover:text-[#15253b]">Gallery</span>
            </a>

            <!-- Mail / RSVP -->
            <a
                href="#rsvp"
                class="hover:text-[#15253b] transition-all flex items-center gap-1.5 p-1 transform active:scale-95 group bg-[#15253b] text-amber-50 px-3.5 py-1.5 rounded-full shadow-sm hover:bg-[#0d1825]"
                title="RSVP"
            >
                <svg class="w-4 h-4 text-amber-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <span class="font-serif text-sm font-semibold uppercase tracking-wider text-amber-100">RSVP</span>
            </a>
        </div>
    </div>
</template>

