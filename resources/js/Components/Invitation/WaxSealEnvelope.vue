<template>
    <div
        v-if="!hasOpened"
        class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-stone-900/85 backdrop-blur-md transition-opacity duration-700 overflow-y-auto"
        :class="{ 'opacity-0 pointer-events-none': isOpening }"
    >
        <!-- Ambient lighting -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-24 left-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 right-1/4 w-96 h-96 bg-stone-500/10 rounded-full blur-3xl"></div>
        </div>

        <!-- The Physical Envelope Container -->
        <div
            class="relative w-full max-w-lg my-auto transition-all duration-700 transform"
            :class="isOpening ? 'scale-105 translate-y-12 opacity-0' : 'scale-100 translate-y-0 opacity-100'"
        >
            <!-- Heavy Linen Envelope Outer Card -->
            <div class="relative bg-[#f7f5ef] rounded-2xl shadow-2xl border border-stone-300/80 p-1.5 sm:p-2 overflow-hidden card-deckled">
                <!-- Inner Parchment Layer with Fine Gold Inset Rule -->
                <div class="relative bg-[#ffffff] rounded-xl p-5 sm:p-10 border border-[#d8b878]/60 text-center flex flex-col items-center">
                    <!-- Subtle Cross / Sacred Symbol -->
                    <div class="mb-2 text-gold-700 font-serif text-sm tracking-widest flex items-center gap-1.5">
                        <span class="text-gold-500 text-xs">✝</span>
                        <span class="uppercase tracking-[0.2em] text-[9px] sm:text-[10px] font-sans font-semibold text-stone-500">Holy Matrimony</span>
                        <span class="text-gold-500 text-xs">✝</span>
                    </div>

                    <!-- Invitation Header -->
                    <h3 class="font-script text-2xl sm:text-4xl text-stone-800 font-normal">
                        Wedding Invitation
                    </h3>

                    <!-- Couple Names in Editorial Typography -->
                    <p class="font-display text-lg sm:text-2xl text-stone-900 tracking-wider sm:tracking-widest font-normal mt-0.5 uppercase">
                        {{ brideName }} &amp; {{ groomName }}
                    </p>

                    <p class="text-[10px] sm:text-[11px] font-serif italic text-stone-500 mt-0.5">
                        Colombo, Sri Lanka
                    </p>

                    <!-- Thin Gold Leaf Divider -->
                    <div class="my-3 sm:my-4 flex items-center justify-center gap-2 w-36 sm:w-48">
                        <div class="h-px bg-gradient-to-r from-transparent via-gold-400 to-transparent flex-1"></div>
                        <span class="text-gold-600 text-xs">❦</span>
                        <div class="h-px bg-gradient-to-r from-transparent via-gold-400 to-transparent flex-1"></div>
                    </div>

                    <!-- Dedicated Personalized Name Tag -->
                    <div class="w-full my-2 sm:my-3 p-3.5 sm:p-5 rounded-xl bg-[#faf8f4] border border-[#e5dfcd] shadow-inner text-center">
                        <p class="text-[9px] sm:text-[10px] uppercase tracking-[0.2em] font-sans font-semibold text-gold-700 mb-1">
                            Cordially Invited
                        </p>
                        <h2 class="font-serif text-lg sm:text-2xl font-semibold text-stone-900 leading-snug break-words">
                            {{ guestGreeting || guestName }}
                        </h2>
                        <p v-if="maxGuests > 1" class="text-[11px] sm:text-xs font-serif text-stone-500 mt-1 italic">
                            Reserved for up to {{ maxGuests }} guests
                        </p>
                    </div>

                    <!-- Realistic 3D Antique Gold Wax Seal Stamp -->
                    <div class="my-4 sm:my-6 relative flex flex-col items-center cursor-pointer group active:scale-95" @click="handleOpen">
                        <!-- Glow pulse behind wax seal -->
                        <div class="absolute inset-0 rounded-full bg-gold-400/30 blur-md group-hover:bg-gold-400/60 transition-colors"></div>

                        <!-- 3D Wax Seal with Monogram -->
                        <div
                            class="relative w-18 h-18 sm:w-22 sm:h-22 rounded-full bg-gradient-to-br from-[#c5a059] via-[#b68f44] to-[#8a682b] p-1 shadow-xl transform transition-transform duration-300 group-hover:scale-105 flex items-center justify-center border border-amber-200/50"
                        >
                            <!-- Wax Stamp Rim Detail -->
                            <div class="w-full h-full rounded-full bg-gradient-to-tr from-[#9d7830] via-[#be984c] to-[#d4b062] flex flex-col items-center justify-center text-amber-50 shadow-inner border border-yellow-200/40">
                                <span class="font-display text-lg sm:text-2xl font-normal tracking-wider text-amber-100">
                                    {{ brideInitials }}&amp;{{ groomInitials }}
                                </span>
                                <span class="text-[8px] uppercase tracking-[0.15em] font-sans font-bold text-amber-200/90 -mt-0.5">
                                    Break Seal
                                </span>
                            </div>
                        </div>

                        <!-- Tap hint -->
                        <p class="mt-2.5 text-[10px] sm:text-[11px] uppercase tracking-widest font-sans font-semibold text-stone-600 group-hover:text-stone-900 flex items-center gap-1 animate-pulse">
                            <span>👆 Tap wax seal to open</span>
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="handleOpen"
                        class="w-full sm:w-auto px-7 py-3 rounded-full bg-[#15253b] hover:bg-[#0f1a29] text-amber-50 font-serif text-xs sm:text-sm tracking-wider shadow-md hover:shadow-lg transition-all transform active:scale-95"
                    >
                        Open Personal Invitation
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    guestName: { type: String, default: 'Honored Guest' },
    guestGreeting: { type: String, default: '' },
    maxGuests: { type: Number, default: 1 },
    brideName: { type: String, default: 'Shenali' },
    groomName: { type: String, default: 'Dilan' },
});

const emit = defineEmits(['opened']);

const hasOpened = ref(false);
const isOpening = ref(false);

const brideInitials = computed(() => props.brideName ? props.brideName.charAt(0).toUpperCase() : 'S');
const groomInitials = computed(() => props.groomName ? props.groomName.charAt(0).toUpperCase() : 'D');

const handleOpen = () => {
    if (isOpening.value) return;
    isOpening.value = true;

    setTimeout(() => {
        hasOpened.value = true;
        emit('opened');
    }, 700);
};
</script>
