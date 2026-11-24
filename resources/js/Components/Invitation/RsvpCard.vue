<template>
    <div id="rsvp" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10">
        <!-- Section Header -->
        <div class="text-center mb-6">
            <p class="font-sans text-sm uppercase tracking-[0.25em] font-semibold text-gold-700">
                {{ t('rsvp', 'kindlyReply') }}
            </p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#ad2c51] mt-1">
                {{ t('rsvp', 'willYouJoin') }}
            </h2>
            <FlowerDivider />

            <p class="font-serif text-sm sm:text-base text-stone-700 max-w-sm mx-auto leading-relaxed mt-2">
                {{ t('rsvp', 'subtitle') }}
            </p>
            <p class="font-serif italic text-sm text-stone-900 font-semibold mt-1">
                {{ t('rsvp', 'respondBy') }}
            </p>
        </div>

        <!-- RSVP Form Card matching screenshot 12 -->
        <div class="max-w-md lg:max-w-xl mx-auto p-5 sm:p-8 rounded-2xl bg-[#faf8f2] border border-[#d8ab43]/50 shadow-sm text-left">
            <!-- Confirmed State -->
            <div
                v-if="guestStatus !== 'pending' && !isEditing"
                class="text-center py-4"
            >
                <div class="w-12 h-12 rounded-full bg-[#ad2c51] text-gold-100 flex items-center justify-center mx-auto mb-3 shadow">
                    <!-- Checkmark Icon for Attending -->
                    <svg v-if="guestStatus === 'attending'" class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    <!-- Dove / Peace Icon for Declining -->
                    <svg v-else class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 19l7-7 3 3-7 7-3-3z" />
                        <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z" />
                        <path d="M2 2l7.586 7.586" />
                        <circle cx="11" cy="11" r="2" />
                    </svg>
                </div>
                <h3 class="font-serif text-lg font-bold text-[#ad2c51]">
                    {{ guestStatus === 'attending' ? t('rsvp', 'confirmedAttending') : t('rsvp', 'confirmedDeclined') }}
                </h3>
                <p class="font-serif font-bold text-base sm:text-lg text-[#15253b] uppercase tracking-wider mt-1">
                    {{ isSinhala && (!guestName || guestName === 'Mr & Mrs Silva') ? 'ගරුකටයුතු අමුත්තන් සහ හිතවත් පවුලේ සැම' : guestName }}
                </p>
                <p v-if="guestGreeting && guestGreeting !== guestName" class="text-xs text-[#7A5B22] italic font-serif mt-0.5">
                    "{{ guestGreeting }}"
                </p>
                <p class="text-sm text-stone-700 font-serif mt-1 max-w-sm mx-auto">
                    {{ guestStatus === 'attending' ? t('rsvp', 'attendingMessage') : t('rsvp', 'declinedMessage') }}
                </p>
                <button
                    type="button"
                    @click="isEditing = true"
                    class="mt-4 text-sm font-serif italic text-gold-700 underline hover:text-gold-900 cursor-pointer"
                >
                    {{ t('rsvp', 'changeResponse') }}
                </button>
            </div>

            <!-- Edit / New Form -->
            <form v-else @submit.prevent="submitRsvp" class="space-y-4">
                <!-- Posh Invitee Presentation -->
                <div class="py-2 px-4 text-center">
                    <p class="font-display text-[9.5px] uppercase tracking-[0.25em] font-medium text-[#ad2c51]">
                        {{ t('rsvp', 'reservedFor') }}
                    </p>
                    <h3 class="font-serif text-lg sm:text-xl font-medium text-[#15253b] tracking-wide mt-0.5">
                        {{ isSinhala && (!guestName || guestName === 'Mr & Mrs Silva') ? 'ගරුකටයුතු අමුත්තන් සහ හිතවත් පවුලේ සැම' : guestName }}
                    </h3>
                    <p v-if="guestGreeting && guestGreeting !== guestName" class="text-xs text-[#7A5B22] italic font-serif mt-0.5">
                        "{{ guestGreeting }}"
                    </p>
                    <p v-if="maxGuests" class="font-serif italic text-xs text-stone-500 mt-0.5">
                        {{ t('rsvp', 'reservedForCount', maxGuests) }}
                    </p>
                </div>

                <!-- Will you be attending? -->
                <div>
                    <label class="block font-serif font-bold text-sm text-stone-800 mb-1">
                        {{ t('rsvp', 'willYouAttend') }}
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            type="button"
                            @click="form.status = 'attending'; burstAt($event, 36)"
                            class="py-3 px-2 rounded-xl border text-center font-serif text-sm font-semibold transition-all transform active:scale-95 cursor-pointer"
                            :class="form.status === 'attending' ? 'bg-[#ad2c51] text-gold-50 border-[#ad2c51] shadow-sm' : 'bg-white text-stone-700 border-stone-200 hover:border-stone-400'"
                        >
                            {{ t('rsvp', 'joyfullyAccept') }}
                        </button>
                        <button
                            type="button"
                            @click="form.status = 'declined'"
                            class="py-3 px-2 rounded-xl border text-center font-serif text-sm font-semibold transition-all transform active:scale-95 cursor-pointer"
                            :class="form.status === 'declined' ? 'bg-[#ad2c51] text-gold-50 border-[#ad2c51] shadow-sm' : 'bg-white text-stone-700 border-stone-200 hover:border-stone-400'"
                        >
                            {{ t('rsvp', 'regretfullyDecline') }}
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-3">
                    <button
                        type="submit" @click="burstAt($event, 48)"
                        :disabled="form.processing"
                        class="w-full py-3.5 px-6 rounded-full border border-stone-800 bg-white hover:bg-stone-100 text-[#ad2c51] text-sm uppercase tracking-[0.2em] font-serif font-bold shadow-md hover:shadow-lg transition-all transform active:scale-95 flex items-center justify-center gap-2.5 disabled:opacity-50 cursor-pointer"
                    >
                        <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        <span>{{ form.processing ? t('rsvp', 'recording') : t('rsvp', 'sendRsvp') }}</span>
                    </button>
                </div>
            </form>

            <!-- RSVP Contact Number Block (Call & WhatsApp) -->
            <div v-if="rsvpPhone" class="mt-6 pt-5 border-t border-[#d8ab43]/30 text-center">
                <p class="font-serif text-xs sm:text-sm text-stone-600 mb-2">
                    {{ t('rsvp', 'contactInquiries') }}
                </p>
                <div class="inline-flex items-center justify-center gap-2.5 flex-wrap">
                    <a
                        :href="`tel:${cleanPhone}`"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-[#ad2c51]/30 hover:border-[#ad2c51] text-[#ad2c51] font-sans text-xs sm:text-sm font-bold shadow-xs hover:shadow transition-all transform active:scale-95"
                    >
                        <svg class="w-4 h-4 fill-none stroke-current text-[#ad2c51]" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <span>{{ rsvpPhone }}</span>
                    </a>
                    <a
                        :href="`https://wa.me/${whatsappDigits}?text=${encodeURIComponent('Hello Buddhima & Shavindi, regarding the wedding invitation:')}`"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-[#25D366]/10 hover:bg-[#25D366]/20 border border-[#25D366]/30 text-[#128C7E] font-sans text-xs sm:text-sm font-semibold transition-all transform active:scale-95"
                        title="Chat on WhatsApp"
                    >
                        <svg class="w-4 h-4 fill-current text-[#25D366]" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.311.045-.698.059-2.378-.637-1.748-.725-2.883-2.511-2.97-2.628-.087-.116-.708-.941-.708-1.792s.448-1.272.607-1.446c.159-.175.347-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.044c.101-.116.433-.506.549-.68.116-.174.232-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
                        </svg>
                        <span>WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import FlowerDivider from '@/Components/Invitation/FlowerDivider.vue';
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useLanguage } from '@/composables/useLanguage';

const { t, isSinhala } = useLanguage();

const props = defineProps({
    guestSlug: { type: String, default: '' },
    guestName: { type: String, default: 'Mr & Mrs Silva' },
    guestGreeting: { type: String, default: 'Mr & Mrs Silva' },
    guestStatus: { type: String, default: 'pending' },
    attendingCount: { type: Number, default: 1 },
    maxGuests: { type: Number, default: 2 },
    isPreview: { type: Boolean, default: false },
    rsvpPhone: { type: String, default: '+94 718626389' },
});

const cleanPhone = computed(() => (props.rsvpPhone || '+94 718626389').replace(/\s+/g, ''));
const whatsappDigits = computed(() => (props.rsvpPhone || '+94 718626389').replace(/[^0-9]/g, ''));

const isEditing = ref(false);
const burstAt = (e, count = 30) => window.dispatchEvent(new CustomEvent('bloom-burst', { detail: { x: e.clientX, y: e.clientY, count } }));
const guestDisplayName = ref(props.guestName);

const form = useForm({
    status: props.guestStatus === 'pending' ? 'attending' : props.guestStatus,
    attending_count: props.attendingCount > 0 ? props.attendingCount : 1,
});

const submitRsvp = () => {
    if (props.isPreview) {
        alert('Preview Mode: RSVP submission recorded!');
        isEditing.value = false;
        return;
    }

    form.post(route('invitation.rsvp', props.guestSlug), {
        preserveScroll: true,
        onSuccess: () => {
            isEditing.value = false;
        },
    });
};
</script>

