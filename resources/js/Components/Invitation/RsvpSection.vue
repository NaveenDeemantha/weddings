<template>
    <div id="rsvp" class="w-full max-w-2xl mx-auto my-12 px-4 scroll-mt-10">
        <div class="relative bg-white rounded-3xl p-6 sm:p-10 border-2 border-amber-300 shadow-xl overflow-hidden">
            <!-- Decorative Top Border Foil Accent -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-500 via-yellow-400 to-amber-600"></div>

            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100/80 text-amber-900 text-xs font-serif uppercase tracking-widest font-semibold mb-2">
                    <span>💌</span> Kindly Respond
                </div>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900">
                    RSVP to the Wedding
                </h2>
                <p class="text-stone-600 text-sm mt-1">
                    Please let us know if you can join us for this blessed occasion
                </p>

                <!-- Current Guest Greeting -->
                <div class="mt-4 p-3 bg-amber-50/70 rounded-xl border border-amber-200/80 inline-block">
                    <p class="text-xs text-amber-800 font-semibold uppercase tracking-wider">
                        Invitation For:
                    </p>
                    <p class="font-serif text-base sm:text-lg font-bold text-stone-800">
                        {{ guestGreeting || guestName }}
                    </p>
                </div>
            </div>

            <!-- If already responded and not editing -->
            <div
                v-if="guestStatus !== 'pending' && !isEditing"
                class="p-6 rounded-2xl text-center border"
                :class="guestStatus === 'attending' ? 'bg-emerald-50/80 border-emerald-300 text-emerald-950' : 'bg-stone-50 border-stone-200 text-stone-800'"
            >
                <div class="text-3xl mb-2">
                    {{ guestStatus === 'attending' ? '🎉' : '🕊️' }}
                </div>
                <h3 class="font-serif text-xl font-bold mb-1">
                    {{ guestStatus === 'attending' ? 'Thank You for Confirming!' : 'We Will Miss You!' }}
                </h3>
                <p class="text-sm max-w-md mx-auto mb-4">
                    <span v-if="guestStatus === 'attending'">
                        Your presence has been confirmed for <strong>{{ attendingCount }}</strong> guest(s). We look forward to celebrating together!
                    </span>
                    <span v-else>
                        We regret that you won’t be able to join us in person, but your warm wishes will remain in our hearts.
                    </span>
                </p>

                <button
                    type="button"
                    @click="isEditing = true"
                    class="text-xs font-semibold text-amber-700 underline hover:text-amber-900"
                >
                    Need to change your response? Click here
                </button>
            </div>

            <!-- RSVP Form -->
            <form v-else @submit.prevent="submitRsvp" class="space-y-6">
                <!-- Attendance Choice Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label
                        class="relative flex flex-col items-center p-5 rounded-2xl border-2 cursor-pointer transition-all text-center"
                        :class="form.status === 'attending' ? 'border-amber-500 bg-amber-50/80 shadow-md' : 'border-stone-200 bg-white hover:border-amber-300'"
                    >
                        <input
                            type="radio"
                            value="attending"
                            v-model="form.status"
                            class="sr-only"
                        />
                        <span class="text-3xl mb-1">✨</span>
                        <span class="font-serif font-bold text-base text-stone-900">
                            Joyfully Accept
                        </span>
                        <span class="text-xs text-stone-500 mt-1">
                            Can't wait to celebrate with you!
                        </span>
                    </label>

                    <label
                        class="relative flex flex-col items-center p-5 rounded-2xl border-2 cursor-pointer transition-all text-center"
                        :class="form.status === 'declined' ? 'border-rose-400 bg-rose-50/60 shadow-md' : 'border-stone-200 bg-white hover:border-stone-300'"
                    >
                        <input
                            type="radio"
                            value="declined"
                            v-model="form.status"
                            class="sr-only"
                        />
                        <span class="text-3xl mb-1">🕊️</span>
                        <span class="font-serif font-bold text-base text-stone-900">
                            Regretfully Decline
                        </span>
                        <span class="text-xs text-stone-500 mt-1">
                            Sending love from afar
                        </span>
                    </label>
                </div>

                <!-- If Attending: Headcount & Dietary Needs -->
                <div v-if="form.status === 'attending'" class="space-y-5 p-5 bg-amber-50/50 rounded-2xl border border-amber-200">
                    <!-- Headcount selector -->
                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-stone-700 mb-2">
                            Number of Guests Attending (Up to {{ maxGuests }}):
                        </label>
                        <div class="flex items-center gap-2">
                            <button
                                type="button"
                                @click="form.attending_count = Math.max(1, form.attending_count - 1)"
                                class="w-10 h-10 rounded-xl bg-white border border-amber-300 font-bold text-lg text-amber-800 shadow-sm flex items-center justify-center hover:bg-amber-100"
                            >
                                -
                            </button>
                            <span class="w-16 text-center font-display text-2xl font-bold text-amber-900">
                                {{ form.attending_count }}
                            </span>
                            <button
                                type="button"
                                @click="form.attending_count = Math.min(maxGuests, form.attending_count + 1)"
                                class="w-10 h-10 rounded-xl bg-white border border-amber-300 font-bold text-lg text-amber-800 shadow-sm flex items-center justify-center hover:bg-amber-100"
                            >
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Dietary Restrictions -->
                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-stone-700 mb-1">
                            Dietary Preferences or Notes (Optional):
                        </label>
                        <input
                            type="text"
                            v-model="form.dietary_notes"
                            placeholder="e.g. Vegetarian, Jain food, No onion/garlic, Vegan..."
                            class="w-full text-sm rounded-xl border-amber-200 focus:border-amber-500 focus:ring-amber-500 bg-white"
                        />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-center gap-3">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-gradient-to-r from-amber-600 via-yellow-500 to-amber-700 text-white font-medium text-sm shadow-md hover:shadow-lg transition-all transform active:scale-95 disabled:opacity-50"
                    >
                        {{ form.processing ? 'Submitting...' : 'Confirm RSVP' }}
                    </button>
                    <button
                        v-if="isEditing"
                        type="button"
                        @click="isEditing = false"
                        class="px-5 py-3 rounded-full text-xs font-semibold text-stone-600 hover:text-stone-900"
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
        alert('Preview Mode: RSVP submission simulated successfully!');
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

