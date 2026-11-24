<template>
    <div class="fixed top-4 left-4 z-[60]">
        <div
            class="flex items-center p-1 rounded-full bg-white/95 hover:bg-white text-stone-800 shadow-md border border-[#d8ab43]/60 backdrop-blur-md transition-all select-none"
            role="group"
            aria-label="Language selection"
        >
            <!-- Language Icon -->
            <div class="pl-2 pr-1 text-gold-700 hidden xs:flex items-center">
                <svg class="w-3.5 h-3.5 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
            </div>

            <!-- English Option -->
            <button
                type="button"
                @click="setLanguage('en')"
                :class="[
                    'px-2.5 py-1 rounded-full font-serif text-[11px] sm:text-xs font-bold uppercase tracking-wider transition-all cursor-pointer',
                    !isSinhala
                        ? 'bg-[#ad2c51] text-gold-100 shadow-sm ring-1 ring-[#d8ab43]/70'
                        : 'text-stone-600 hover:text-[#ad2c51]'
                ]"
                title="Switch to English"
                aria-label="English language"
            >
                EN
            </button>

            <!-- Sinhala Option -->
            <button
                type="button"
                @click="setLanguage('si')"
                :class="[
                    'px-2.5 py-1 rounded-full font-serif text-[11px] sm:text-xs font-bold tracking-normal transition-all cursor-pointer',
                    isSinhala
                        ? 'bg-[#ad2c51] text-gold-100 shadow-sm ring-1 ring-[#d8ab43]/70'
                        : 'text-stone-600 hover:text-[#ad2c51]'
                ]"
                title="සිංහල භාෂාවට මාරු වන්න"
                aria-label="Sinhala language"
            >
                සිංහල
            </button>
        </div>
    </div>
</template>

<script setup>
import { useLanguage } from '@/composables/useLanguage';

const { isSinhala, setLanguage } = useLanguage();
</script>
