<template>
    <div
        v-if="!hasOpened"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-stone-900/80 backdrop-blur-md transition-opacity duration-700"
        :class="{ 'opacity-0 pointer-events-none': isOpening }"
    >
        <!-- Floating ambient gold particles -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-10 left-1/4 w-72 h-72 bg-amber-400/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-10 right-1/4 w-80 h-80 bg-rose-400/20 rounded-full blur-3xl animate-pulse"></div>
        </div>

        <!-- Envelope Card Wrapper -->
        <div
            class="relative w-full max-w-lg transition-all duration-700 transform"
            :class="isOpening ? 'scale-110 translate-y-8 opacity-0' : 'scale-100 translate-y-0 opacity-100'"
        >
            <!-- Envelope Body -->
            <div class="relative bg-gradient-to-br from-amber-50 via-amber-100/80 to-amber-200/90 rounded-2xl shadow-2xl border-2 border-amber-300/80 p-1 overflow-hidden">
                <!-- Golden Floral Corner Ornaments -->
                <div class="absolute top-2 left-2 text-amber-500/60 select-none">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                </div>

                <!-- Envelope Inner Card with Gold Border -->
                <div class="relative bg-white/90 backdrop-blur-sm rounded-xl p-8 sm:p-10 border border-amber-300 text-center shadow-inner flex flex-col items-center">
                    <!-- Auspicious Symbol / Traditional Motif -->
                    <div class="mb-4 inline-flex items-center gap-2 text-amber-700/80">
                        <span class="text-amber-500">✦</span>
                        <span class="font-serif tracking-widest text-xs uppercase font-semibold">Shree Ganeshay Namah</span>
                        <span class="text-amber-500">✦</span>
                    </div>

                    <!-- Envelope Title -->
                    <h3 class="font-script text-3xl sm:text-4xl text-amber-800 font-normal">
                        Wedding Invitation
                    </h3>

                    <!-- Couple Names -->
                    <p class="font-display text-xl sm:text-2xl text-stone-800 tracking-wider font-bold mt-1">
                        {{ brideName }} & {{ groomName }}
                    </p>

                    <!-- Divider -->
                    <div class="my-4 flex items-center justify-center gap-3 w-48">
                        <div class="h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent flex-1"></div>
                        <span class="text-amber-500 text-sm">❦</span>
                        <div class="h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent flex-1"></div>
                    </div>

                    <!-- Personalized Guest Name Badge -->
                    <div class="w-full my-3 p-4 rounded-xl bg-gradient-to-r from-amber-50 via-yellow-50 to-amber-50 border border-amber-300/80 shadow-sm">
                        <p class="text-xs uppercase tracking-widest text-amber-700 font-semibold mb-1">
                            Cordially Invited
                        </p>
                        <h2 class="font-serif text-lg sm:text-2xl font-bold text-stone-900 break-words">
                            {{ guestGreeting || guestName }}
                        </h2>
                        <p v-if="maxGuests > 1" class="text-xs text-amber-800/80 mt-1 font-medium">
                            Reserved for up to {{ maxGuests }} guests
                        </p>
                    </div>

                    <!-- The Royal Wax Seal -->
                    <div class="my-6 relative flex flex-col items-center cursor-pointer group" @click="handleOpen">
                        <!-- Pulsing glow behind wax seal -->
                        <div class="absolute inset-0 rounded-full bg-amber-400/50 blur-lg animate-pulse-glow group-hover:bg-amber-400/80"></div>

                        <!-- 3D Wax Seal Button -->
                        <div
                            class="relative w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gradient-to-br from-amber-600 via-yellow-500 to-amber-700 p-1.5 shadow-2xl transform transition-transform duration-300 group-hover:scale-110 flex items-center justify-center border-2 border-yellow-200"
                        >
                            <!-- Wax Seal Rim Detail -->
                            <div class="w-full h-full rounded-full bg-gradient-to-tr from-amber-700 via-amber-600 to-yellow-600 flex flex-col items-center justify-center text-yellow-100 shadow-inner border border-amber-400/40">
                                <span class="text-2xl sm:text-3xl filter drop-shadow">💍</span>
                                <span class="text-[9px] uppercase tracking-widest font-serif font-bold text-yellow-200 -mt-1">
                                    Open
                                </span>
                            </div>
                        </div>

                        <!-- Tap hint -->
                        <p class="mt-3 text-xs uppercase tracking-wider font-semibold text-amber-800 group-hover:text-amber-950 flex items-center gap-1.5 animate-pulse">
                            <span>👆</span> Tap Wax Seal to Open <span>✨</span>
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="handleOpen"
                        class="w-full sm:w-auto px-8 py-3 rounded-full bg-gradient-to-r from-amber-600 via-yellow-500 to-amber-700 text-white font-medium text-sm shadow-md hover:shadow-lg hover:from-amber-700 hover:to-amber-800 transition-all transform active:scale-95"
                    >
                        Open Dedicated Invitation
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    guestName: { type: String, default: 'Honored Guest' },
    guestGreeting: { type: String, default: '' },
    maxGuests: { type: Number, default: 1 },
    brideName: { type: String, default: 'Pooja' },
    groomName: { type: String, default: 'Rahul' },
});

const emit = defineEmits(['opened']);

const hasOpened = ref(false);
const isOpening = ref(false);

const handleOpen = () => {
    if (isOpening.value) return;
    isOpening.value = true;

    // Small delay to let closing/burst animation play
    setTimeout(() => {
        hasOpened.value = true;
        emit('opened');
    }, 700);
};
</script>

