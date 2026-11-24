<template>
    <nav
        aria-label="Invitation Navigation"
        class="fixed bottom-4 sm:bottom-6 left-1/2 -translate-x-1/2 z-40 w-auto select-none"
    >
        <div class="flex items-center gap-1.5 sm:gap-2.5 md:gap-4 px-3 sm:px-4 py-2 rounded-full bg-white/95 backdrop-blur-md border border-[#d8ab43]/50 shadow-2xl text-stone-700 transition-all duration-300">
            <!-- Home -->
            <a
                href="#hero"
                @click="scrollToSection($event, 'hero')"
                :class="[
                    'transition-all duration-300 flex items-center gap-1.5 rounded-full transform active:scale-95 group',
                    activeSection === 'hero'
                        ? 'bg-[#ad2c51] text-gold-100 ring-2 ring-[#d8ab43]/80 border border-[#f5dc8a]/35 shadow-md px-3 sm:px-3.5 py-1.5 scale-105'
                        : 'text-stone-700 hover:text-[#ad2c51] hover:bg-stone-100/70 p-2 sm:px-3 sm:py-1.5'
                ]"
                title="Home"
            >
                <svg
                    class="w-4 h-4 sm:w-5 sm:h-5 shrink-0 transition-colors"
                    :class="activeSection === 'hero' ? 'text-gold-200' : 'text-stone-700 group-hover:text-[#ad2c51]'"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <span
                    :class="[
                        'font-serif text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-300',
                        activeSection === 'hero'
                            ? 'inline-block text-gold-100'
                            : 'hidden md:inline text-stone-700 group-hover:text-[#ad2c51]'
                    ]"
                >{{ t('nav', 'home') }}</span>
            </a>

            <!-- Events -->
            <a
                href="#events"
                @click="scrollToSection($event, 'events')"
                :class="[
                    'transition-all duration-300 flex items-center gap-1.5 rounded-full transform active:scale-95 group',
                    activeSection === 'events'
                        ? 'bg-[#ad2c51] text-gold-100 ring-2 ring-[#d8ab43]/80 border border-[#f5dc8a]/35 shadow-md px-3 sm:px-3.5 py-1.5 scale-105'
                        : 'text-stone-700 hover:text-[#ad2c51] hover:bg-stone-100/70 p-2 sm:px-3 sm:py-1.5'
                ]"
                title="Events"
            >
                <svg
                    class="w-4 h-4 sm:w-5 sm:h-5 shrink-0 transition-colors"
                    :class="activeSection === 'events' ? 'text-gold-200' : 'text-stone-700 group-hover:text-[#ad2c51]'"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <span
                    :class="[
                        'font-serif text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-300',
                        activeSection === 'events'
                            ? 'inline-block text-gold-100'
                            : 'hidden md:inline text-stone-700 group-hover:text-[#ad2c51]'
                    ]"
                >{{ t('nav', 'events') }}</span>
            </a>

            <!-- Venue -->
            <a
                href="#venue"
                @click="scrollToSection($event, 'venue')"
                :class="[
                    'transition-all duration-300 flex items-center gap-1.5 rounded-full transform active:scale-95 group',
                    activeSection === 'venue'
                        ? 'bg-[#ad2c51] text-gold-100 ring-2 ring-[#d8ab43]/80 border border-[#f5dc8a]/35 shadow-md px-3 sm:px-3.5 py-1.5 scale-105'
                        : 'text-stone-700 hover:text-[#ad2c51] hover:bg-stone-100/70 p-2 sm:px-3 sm:py-1.5'
                ]"
                title="Venue"
            >
                <svg
                    class="w-4 h-4 sm:w-5 sm:h-5 shrink-0 transition-colors"
                    :class="activeSection === 'venue' ? 'text-gold-200' : 'text-stone-700 group-hover:text-[#ad2c51]'"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                <span
                    :class="[
                        'font-serif text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-300',
                        activeSection === 'venue'
                            ? 'inline-block text-gold-100'
                            : 'hidden md:inline text-stone-700 group-hover:text-[#ad2c51]'
                    ]"
                >{{ t('nav', 'venue') }}</span>
            </a>

            <!-- RSVP -->
            <a
                href="#rsvp"
                @click="scrollToSection($event, 'rsvp')"
                :class="[
                    'transition-all duration-300 flex items-center gap-1.5 rounded-full transform active:scale-95 group',
                    activeSection === 'rsvp'
                        ? 'bg-[#ad2c51] text-gold-100 ring-2 ring-[#d8ab43]/80 border border-[#f5dc8a]/35 shadow-md px-3 sm:px-3.5 py-1.5 scale-105'
                        : 'bg-[#ad2c51]/10 text-[#ad2c51] border border-[#ad2c51]/25 hover:bg-[#ad2c51]/20 p-2 sm:px-3 sm:py-1.5'
                ]"
                title="RSVP"
            >
                <svg
                    class="w-4 h-4 sm:w-5 sm:h-5 shrink-0 transition-colors"
                    :class="activeSection === 'rsvp' ? 'text-gold-200' : 'text-[#ad2c51]'"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <span
                    :class="[
                        'font-serif text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-300',
                        activeSection === 'rsvp'
                            ? 'inline-block text-gold-100'
                            : 'hidden sm:inline text-[#ad2c51]'
                    ]"
                >{{ t('nav', 'rsvp') }}</span>
            </a>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useLanguage } from '@/composables/useLanguage';

const { t, isSinhala } = useLanguage();

const activeSection = ref('hero');
const sectionIds = ['rsvp', 'venue', 'events', 'hero'];

const updateActiveSection = () => {
    const scrollY = window.scrollY || window.pageYOffset || 0;
    const windowHeight = window.innerHeight || 800;
    const docHeight = document.documentElement.scrollHeight || document.body.scrollHeight;

    // Bottom check: if scrolled near the bottom of page, highlight 'rsvp'
    if (scrollY + windowHeight >= docHeight - 120) {
        activeSection.value = 'rsvp';
        return;
    }

    // Top check: if scrolled less than 200px, highlight 'hero'
    if (scrollY < 200) {
        activeSection.value = 'hero';
        return;
    }

    // Viewport sweet spot trigger point (40% down from top of viewport)
    const viewportTrigger = scrollY + windowHeight * 0.4;

    for (const id of sectionIds) {
        const el = document.getElementById(id);
        if (el) {
            const rect = el.getBoundingClientRect();
            const top = rect.top + scrollY;
            if (viewportTrigger >= top - 60) {
                activeSection.value = id;
                return;
            }
        }
    }

    activeSection.value = 'hero';
};

const scrollToSection = (e, id) => {
    e.preventDefault();
    const el = document.getElementById(id);
    if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        activeSection.value = id;
        try {
            history.replaceState(null, '', `#${id}`);
        } catch (_) {}
    }
};

let ticking = false;
const handleScroll = () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            updateActiveSection();
            ticking = false;
        });
        ticking = true;
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll, { passive: true });
    window.addEventListener('resize', handleScroll, { passive: true });
    // Initial check after DOM mounts
    setTimeout(updateActiveSection, 150);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    window.removeEventListener('resize', handleScroll);
});
</script>
