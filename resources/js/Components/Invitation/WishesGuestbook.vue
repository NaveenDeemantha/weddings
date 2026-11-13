<template>
    <div id="wishes" class="w-full max-w-3xl mx-auto my-12 px-4 scroll-mt-10">
        <div class="relative bg-gradient-to-b from-amber-50/70 via-white to-amber-50/70 rounded-3xl p-6 sm:p-10 border border-amber-300 shadow-lg">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100/80 text-amber-900 text-xs font-serif uppercase tracking-widest font-semibold mb-2">
                    <span>✨</span> Blessings & Messages
                </div>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900">
                    Wishes for the Couple
                </h2>
                <p class="text-stone-600 text-sm mt-1">
                    Leave your sweet thoughts and blessings for {{ brideName }} & {{ groomName }}
                </p>
            </div>

            <!-- Leave a Wish Form -->
            <form @submit.prevent="submitWish" class="mb-10 bg-white p-5 sm:p-6 rounded-2xl border border-amber-200/90 shadow-sm">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-stone-700 mb-1">
                            Your Name:
                        </label>
                        <input
                            type="text"
                            v-model="form.guest_name"
                            required
                            placeholder="Enter your name..."
                            class="w-full text-sm rounded-xl border-amber-200 focus:border-amber-500 focus:ring-amber-500 bg-amber-50/20"
                        />
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-stone-700 mb-1">
                            Your Heartfelt Message:
                        </label>
                        <textarea
                            v-model="form.message"
                            required
                            rows="3"
                            placeholder="May your married life be filled with laughter, endless love, and joy..."
                            class="w-full text-sm rounded-xl border-amber-200 focus:border-amber-500 focus:ring-amber-500 bg-amber-50/20"
                        ></textarea>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-full bg-gradient-to-r from-amber-600 to-yellow-500 text-white font-medium text-xs shadow hover:shadow-md transition-all active:scale-95 disabled:opacity-50"
                    >
                        {{ form.processing ? 'Posting...' : '💖 Send Blessings' }}
                    </button>
                </div>
            </form>

            <!-- Wishes List -->
            <div class="space-y-4">
                <div
                    v-for="wish in wishes"
                    :key="wish.id"
                    class="p-4 sm:p-5 rounded-2xl bg-white/90 border border-amber-200/70 shadow-sm flex items-start gap-3.5 hover:border-amber-300 transition-colors"
                >
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-rose-400 to-amber-300 text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm">
                        {{ wish.guest_name ? wish.guest_name.charAt(0).toUpperCase() : '♥' }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between gap-2">
                            <h4 class="font-serif font-bold text-stone-800 text-sm">
                                {{ wish.guest_name }}
                            </h4>
                            <span class="text-[10px] text-stone-400">
                                {{ formatDate(wish.created_at) }}
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-stone-600 mt-1 leading-relaxed">
                            {{ wish.message }}
                        </p>
                    </div>
                </div>

                <div v-if="wishes.length === 0" class="text-center py-6 text-stone-400 text-xs italic">
                    Be the first to shower the couple with your blessings!
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    wishes: { type: Array, default: () => [] },
    guestSlug: { type: String, default: '' },
    guestName: { type: String, default: '' },
    brideName: { type: String, default: 'Pooja' },
    groomName: { type: String, default: 'Rahul' },
    isPreview: { type: Boolean, default: false },
});

const form = useForm({
    guest_name: props.guestName || '',
    message: '',
});

const formatDate = (dateStr) => {
    if (!dateStr) return 'Just now';
    try {
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    } catch {
        return '';
    }
};

const submitWish = () => {
    if (props.isPreview) {
        alert('Preview Mode: Message added to preview!');
        props.wishes.unshift({
            id: Date.now(),
            guest_name: form.guest_name,
            message: form.message,
            created_at: new Date().toISOString(),
        });
        form.reset('message');
        return;
    }

    form.post(route('invitation.wish', props.guestSlug), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('message');
        },
    });
};
</script>

