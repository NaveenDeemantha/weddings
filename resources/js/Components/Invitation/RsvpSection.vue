<template>
    <div id="rsvp" class="w-full max-w-2xl mx-auto my-10 sm:my-14 px-2 sm:px-4 scroll-mt-10">
        <div class="relative bg-[#ffffff] rounded-2xl p-5 sm:p-10 border border-[#d8b878]/60 shadow-lg text-center">
            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <div class="inline-flex items-center gap-1.5 text-gold-700 mb-1.5">
                    <span class="text-gold-500 text-xs">✝</span>
                    <span class="font-sans text-[9px] sm:text-[10px] uppercase tracking-[0.2em] font-semibold">Response Requested</span>
                    <span class="text-gold-500 text-xs">✝</span>
                </div>
                <h2 class="font-serif text-2xl sm:text-4xl font-normal text-stone-900 leading-snug">
                    Répondez S'il Vous Plaît
                </h2>
                <p class="text-stone-500 text-xs sm:text-sm font-serif italic mt-1 px-2">
                    Kindly reply on or before 1st December 2026 to assist us with reception seating
                </p>

                <!-- Guest Greeting Badge -->
                <div class="mt-3.5 p-2.5 sm:p-3 bg-[#faf8f4] rounded-xl border border-[#e5dfcd] inline-block max-w-full">
                    <p class="text-[8px] sm:text-[9px] uppercase tracking-wider font-sans font-semibold text-gold-700">
                        Invitation Extended To:
                    </p>
                    <p class="font-serif text-sm sm:text-lg font-semibold text-stone-800 break-words">
                        {{ guestGreeting || guestName }}
                    </p>
                </div>
            </div>

            <!-- Responded Status Display -->
            <div
                v-if="guestStatus !== 'pending' && !isEditing"
                class="p-5 sm:p-6 rounded-xl border text-center"
                :class="guestStatus === 'attending' ? 'bg-[#f6f9f5] border-[#c2dbbd] text-stone-900' : 'bg-[#faf8f8] border-stone-200 text-stone-800'"
            >
                <h3 class="font-serif text-lg sm:text-xl font-semibold mb-1">
                    {{ guestStatus === 'attending' ? 'Thank You For Your Gracious Confirmation' : 'Thank You For Letting Us Know' }}
                </h3>
                <p class="text-xs sm:text-sm max-w-md mx-auto mb-4 text-stone-600 font-serif leading-relaxed">
                    <span v-if="guestStatus === 'attending'">
                        Your seats have been confirmed for <strong>{{ attendingCount }}</strong> guest(s). We eagerly look forward to having you share in our Holy Matrimony!
                    </span>
                    <span v-else>
                        We regret that you won’t be able to be with us in person. We keep you in our prayers and value your warm blessings.
                    </span>
                </p>

                <button
                    type="button"
                    @click="isEditing = true"
                    class="text-xs font-serif italic text-gold-700 underline hover:text-gold-900 py-1"
                >
                    Wish to change your response? Click here
                </button>
            </div>

            <!-- RSVP Form -->
            <form v-else @submit.prevent="submitRsvp" class="space-y-5 text-left">
                <!-- Response Choice Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <label
                        class="relative flex flex-col p-4 sm:p-5 rounded-xl border-2 cursor-pointer transition-all active:scale-98"
                        :class="form.status === 'attending' ? 'border-[#c5a059] bg-[#faf8f4] shadow-sm' : 'border-stone-200 bg-white hover:border-[#d8b878]'"
                    >
                        <input
                            type="radio"
                            value="attending"
                            v-model="form.status"
                            class="sr-only"
                        />
                        <span class="font-serif font-semibold text-sm sm:text-base text-stone-900">
                            Graciously Accepts
                        </span>
                        <span class="text-[11px] sm:text-xs text-stone-500 mt-0.5 font-serif italic">
                            Joyfully attending with prayers
                        </span>
                    </label>

                    <label
                        class="relative flex flex-col p-4 sm:p-5 rounded-xl border-2 cursor-pointer transition-all active:scale-98"
                        :class="form.status === 'declined' ? 'border-stone-400 bg-stone-50 shadow-sm' : 'border-stone-200 bg-white hover:border-stone-300'"
                    >
                        <input
                            type="radio"
                            value="declined"
                            v-model="form.status"
                            class="sr-only"
                        />
                        <span class="font-serif font-semibold text-sm sm:text-base text-stone-900">
                            Regretfully Declines
                        </span>
                        <span class="text-[11px] sm:text-xs text-stone-500 mt-0.5 font-serif italic">
                            Unable to attend, sending love
                        </span>
                    </label>
                </div>

                <!-- Attending details -->
                <div v-if="form.status === 'attending'" class="space-y-4 p-4 sm:p-5 bg-[#faf8f4] rounded-xl border border-[#e5dfcd]">
                    <!-- Headcount selector with touch friendly targets -->
                    <div>
                        <label class="block text-[9px] sm:text-[10px] uppercase tracking-wider font-sans font-semibold text-stone-600 mb-2">
                            Number of Attending Guests (Reserved up to {{ maxGuests }}):
                        </label>
                        <div class="flex items-center gap-3">
                            <button
                                type="button"
                                @click="form.attending_count = Math.max(1, form.attending_count - 1)"
                                class="w-11 h-11 rounded-xl bg-white border border-[#d8b878] font-bold text-lg text-stone-700 shadow-sm flex items-center justify-center hover:bg-stone-50 active:scale-95"
                            >
                                -
                            </button>
                            <span class="w-12 text-center font-serif text-2xl font-semibold text-stone-900">
                                {{ form.attending_count }}
                            </span>
                            <button
                                type="button"
                                @click="form.attending_count = Math.min(maxGuests, form.attending_count + 1)"
                                class="w-11 h-11 rounded-xl bg-white border border-[#d8b878] font-bold text-lg text-stone-700 shadow-sm flex items-center justify-center hover:bg-stone-50 active:scale-95"
                            >
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Dietary Notes -->
                    <div>
                        <label class="block text-[9px] sm:text-[10px] uppercase tracking-wider font-sans font-semibold text-stone-600 mb-1">
                            Dietary Preference / Allergies (Optional):
                        </label>
                        <input
                            type="text"
                            v-model="form.dietary_notes"
                            placeholder="e.g. Non-Veg (Fish/Chicken), Vegetarian, No Pork/Beef..."
                            class="w-full text-xs rounded-lg border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059] bg-white py-2.5"
                        />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-[#15253b] hover:bg-[#0f1a29] text-amber-50 font-serif text-xs sm:text-sm tracking-wider shadow-md hover:shadow-lg transition-all transform active:scale-95 disabled:opacity-50 text-center"
                    >
                        {{ form.processing ? 'Submitting...' : 'Confirm Response' }}
                    </button>
                    <button
                        v-if="isEditing"
                        type="button"
                        @click="isEditing = false"
                        class="w-full sm:w-auto px-4 py-2 text-xs font-serif text-stone-500 hover:text-stone-800 text-center"
                    >
                        Cancel
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
    guestName: { type: String, default: 'Honored Guest' },
    guestGreeting: { type: String, default: '' },
    guestStatus: { type: String, default: 'pending' },
    attendingCount: { type: Number, default: 1 },
    maxGuests: { type: Number, default: 2 },
    dietaryNotes: { type: String, default: '' },
    isPreview: { type: Boolean, default: false },
});

const isEditing = ref(false);

const form = useForm({
    status: props.guestStatus === 'pending' ? 'attending' : props.guestStatus,
    attending_count: props.attendingCount > 0 ? props.attendingCount : 1,
    dietary_notes: props.dietaryNotes || '',
});

const submitRsvp = () => {
    if (props.isPreview) {
        alert('Preview Mode: RSVP submission simulated successfully.');
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
