<template>
    <div id="rsvp" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10">
        <!-- Section Header -->
        <div class="text-center mb-6">
            <p class="font-sans text-[9px] uppercase tracking-[0.25em] font-semibold text-gold-700">
                Kindly Reply
            </p>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#15253b] mt-1">
                Will You Join Us?
            </h2>
            <div class="my-2.5 text-gold-600 text-xs">✝</div>

            <p class="font-serif text-xs sm:text-sm text-stone-600 max-w-sm mx-auto leading-relaxed mt-2">
                We joyfully await your presence. Please let us know if you will be celebrating with us.
            </p>
            <p class="font-serif italic text-xs text-stone-900 font-semibold mt-1">
                Kindly respond by 1st December 2026
            </p>
        </div>

        <!-- RSVP Form Card matching screenshot 12 -->
        <div class="max-w-md mx-auto p-5 sm:p-6 rounded-2xl bg-[#faf8f4] border border-[#d8b878]/70 shadow-sm text-left">
            <!-- Confirmed State -->
            <div
                v-if="guestStatus !== 'pending' && !isEditing"
                class="text-center py-4"
            >
                <div class="w-12 h-12 rounded-full bg-[#15253b] text-amber-100 flex items-center justify-center text-xl mx-auto mb-3 shadow">
                    {{ guestStatus === 'attending' ? '✓' : '🕊️' }}
                </div>
                <h3 class="font-serif text-lg font-bold text-[#15253b]">
                    {{ guestStatus === 'attending' ? 'Response Confirmed: Joyfully Accepting' : 'Response Confirmed: Regretfully Declining' }}
                </h3>
                <p class="text-xs text-stone-600 font-serif mt-1 max-w-sm mx-auto">
                    <span v-if="guestStatus === 'attending'">
                        Attending count: <strong>{{ attendingCount }}</strong> guest(s). We look forward to celebrating together in God's grace!
                    </span>
                    <span v-else>
                        We regret you cannot be with us in person, but your warm prayers and blessings will remain in our hearts.
                    </span>
                </p>
                <button
                    type="button"
                    @click="isEditing = true"
                    class="mt-4 text-xs font-serif italic text-gold-700 underline hover:text-gold-900"
                >
                    Change RSVP response
                </button>
            </div>

            <!-- Edit / New Form -->
            <form v-else @submit.prevent="submitRsvp" class="space-y-4">
                <!-- Full Name -->
                <div>
                    <label class="block font-serif font-bold text-xs text-stone-800 mb-1">
                        Full Name / Guest Greeting
                    </label>
                    <input
                        type="text"
                        v-model="guestDisplayName"
                        readonly
                        class="w-full text-xs font-serif font-medium rounded-xl border-stone-200 bg-white py-3 px-3.5 shadow-inner text-stone-800 focus:outline-none"
                    />
                </div>

                <!-- Will you be attending? -->
                <div>
                    <label class="block font-serif font-bold text-xs text-stone-800 mb-1">
                        Will you be attending?
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            type="button"
                            @click="form.status = 'attending'"
                            class="py-3 px-2 rounded-xl border text-center font-serif text-xs font-semibold transition-all transform active:scale-95"
                            :class="form.status === 'attending' ? 'bg-[#15253b] text-amber-50 border-[#15253b] shadow-sm' : 'bg-white text-stone-700 border-stone-200 hover:border-stone-400'"
                        >
                            Joyfully Accept
                        </button>
                        <button
                            type="button"
                            @click="form.status = 'declined'"
                            class="py-3 px-2 rounded-xl border text-center font-serif text-xs font-semibold transition-all transform active:scale-95"
                            :class="form.status === 'declined' ? 'bg-[#15253b] text-amber-50 border-[#15253b] shadow-sm' : 'bg-white text-stone-700 border-stone-200 hover:border-stone-400'"
                        >
                            Regretfully Decline
                        </button>
                    </div>
                </div>

                <!-- Number of Guests -->
                <div v-if="form.status === 'attending'" class="bg-white/70 p-3 rounded-xl border border-stone-200/60">
                    <label class="block font-serif font-bold text-xs text-stone-800 mb-1 text-center">
                        Total Number of Attending Guests
                    </label>
                    <div class="flex items-center justify-center gap-6 py-1">
                        <button
                            type="button"
                            @click="form.attending_count = Math.max(1, form.attending_count - 1)"
                            class="w-10 h-10 rounded-full bg-stone-200/80 hover:bg-stone-300 font-bold text-base text-stone-700 flex items-center justify-center active:scale-90 transition-all shadow-sm"
                        >
                            -
                        </button>
                        <span class="font-serif text-3xl font-bold text-[#15253b] w-14 text-center">
                            {{ form.attending_count }}
                        </span>
                        <button
                            type="button"
                            @click="form.attending_count = Math.min(maxGuests, form.attending_count + 1)"
                            class="w-10 h-10 rounded-full bg-stone-200/80 hover:bg-stone-300 font-bold text-base text-stone-700 flex items-center justify-center active:scale-90 transition-all shadow-sm"
                        >
                            +
                        </button>
                    </div>
                    <p class="text-[10px] text-stone-500 font-serif italic text-center mt-1">
                        Allocated seats for your invitation: {{ maxGuests }}
                    </p>
                </div>

                <!-- Submit Button matching screenshot 12 -->
                <div class="pt-2">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full py-3.5 px-6 rounded-full border border-stone-800 bg-white hover:bg-stone-100 text-[#15253b] text-xs uppercase tracking-[0.2em] font-serif font-bold shadow-md hover:shadow-lg transition-all transform active:scale-95 flex items-center justify-center gap-2 disabled:opacity-50"
                    >
                        <span>✈</span>
                        <span>{{ form.processing ? 'Recording RSVP...' : 'Send RSVP' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
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

