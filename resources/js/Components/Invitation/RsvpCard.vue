<template>
    <div id="rsvp" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10">
        <!-- Section Header -->
        <div class="text-center mb-6">
            <p class="font-sans text-sm uppercase tracking-[0.25em] font-semibold text-gold-700">
                Kindly Reply
            </p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#ad2c51] mt-1">
                Will You Join Us?
            </h2>
            <FlowerDivider />

            <p class="font-serif text-sm sm:text-base text-stone-700 max-w-sm mx-auto leading-relaxed mt-2">
                We joyfully await your presence. Please let us know if you will be celebrating with us.
            </p>
            <p class="font-serif italic text-sm text-stone-900 font-semibold mt-1">
                Kindly respond by 1st December 2026
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
                    {{ guestStatus === 'attending' ? 'Response Confirmed: Joyfully Accepting' : 'Response Confirmed: Regretfully Declining' }}
                </h3>
                <p class="text-sm text-stone-700 font-serif mt-1 max-w-sm mx-auto">
                    <span v-if="guestStatus === 'attending'">
                        We are truly honored that you will be joining us. We look forward to celebrating together in God's grace!
                    </span>
                    <span v-else>
                        We regret you cannot be with us in person, but your warm prayers and blessings will remain in our hearts.
                    </span>
                </p>
                <button
                    type="button"
                    @click="isEditing = true"
                    class="mt-4 text-sm font-serif italic text-gold-700 underline hover:text-gold-900"
                >
                    Change RSVP response
                </button>
            </div>

            <!-- Edit / New Form -->
            <form v-else @submit.prevent="submitRsvp" class="space-y-4">
                <!-- Full Name -->
                <div>
                    <label class="block font-serif font-bold text-sm text-stone-800 mb-1">
                        Full Name / Guest Greeting
                    </label>
                    <input
                        type="text"
                        v-model="guestDisplayName"
                        readonly
                        class="w-full text-sm font-serif font-medium rounded-xl border-stone-200 bg-white py-3 px-3.5 shadow-inner text-stone-800 focus:outline-none"
                    />
                </div>

                <!-- Will you be attending? -->
                <div>
                    <label class="block font-serif font-bold text-sm text-stone-800 mb-1">
                        Will you be attending?
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            type="button"
                            @click="form.status = 'attending'; burstAt($event, 36)"
                            class="py-3 px-2 rounded-xl border text-center font-serif text-sm font-semibold transition-all transform active:scale-95"
                            :class="form.status === 'attending' ? 'bg-[#ad2c51] text-gold-50 border-[#ad2c51] shadow-sm' : 'bg-white text-stone-700 border-stone-200 hover:border-stone-400'"
                        >
                            Joyfully Accept
                        </button>
                        <button
                            type="button"
                            @click="form.status = 'declined'"
                            class="py-3 px-2 rounded-xl border text-center font-serif text-sm font-semibold transition-all transform active:scale-95"
                            :class="form.status === 'declined' ? 'bg-[#ad2c51] text-gold-50 border-[#ad2c51] shadow-sm' : 'bg-white text-stone-700 border-stone-200 hover:border-stone-400'"
                        >
                            Regretfully Decline
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-3">
                    <button
                        type="submit" @click="burstAt($event, 48)"
                        :disabled="form.processing"
                        class="w-full py-3.5 px-6 rounded-full border border-stone-800 bg-white hover:bg-stone-100 text-[#ad2c51] text-sm uppercase tracking-[0.2em] font-serif font-bold shadow-md hover:shadow-lg transition-all transform active:scale-95 flex items-center justify-center gap-2.5 disabled:opacity-50"
                    >
                        <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        <span>{{ form.processing ? 'Recording RSVP...' : 'Send RSVP' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import FlowerDivider from '@/Components/Invitation/FlowerDivider.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    guestSlug: { type: String, default: '' },
    guestName: { type: String, default: 'Mr & Mrs Silva' },
    guestGreeting: { type: String, default: 'Mr & Mrs Silva' },
    guestStatus: { type: String, default: 'pending' },
    attendingCount: { type: Number, default: 1 },
    maxGuests: { type: Number, default: 2 },
    isPreview: { type: Boolean, default: false },
});

const isEditing = ref(false);
const burstAt = (e, count = 30) => window.dispatchEvent(new CustomEvent('bloom-burst', { detail: { x: e.clientX, y: e.clientY, count } }));
const guestDisplayName = ref(props.guestGreeting || props.guestName);

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

