<template>
    <div id="wishes" class="my-10 sm:my-14 px-4 sm:px-6 scroll-mt-10">
        <div class="text-center mb-6">
            <div class="inline-flex items-center gap-2 text-gold-700 mb-1.5">
                <span class="text-gold-500 text-xs">✝</span>
                <span class="font-sans text-[9px] sm:text-[10px] uppercase tracking-[0.25em] font-semibold">Guestbook</span>
                <span class="text-gold-500 text-xs">✝</span>
            </div>
            <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-[#15253b]">
                Blessings &amp; Prayers
            </h2>
            <p class="text-stone-500 text-xs font-serif italic mt-1 max-w-sm mx-auto">
                Leave your heartfelt wishes and prayers for {{ groomName }} &amp; {{ brideName }}
            </p>
        </div>

        <div class="max-w-md mx-auto">
            <!-- Leave a Wish Form -->
            <form @submit.prevent="submitWish" class="mb-8 bg-[#faf8f4] p-4 sm:p-5 rounded-2xl border border-[#e5dfcd] text-left">
                <div class="space-y-3">
                    <div>
                        <label class="block text-[9px] sm:text-[10px] uppercase tracking-widest font-sans font-semibold text-stone-600 mb-1">
                            Your Name:
                        </label>
                        <input
                            type="text"
                            v-model="form.guest_name"
                            required
                            placeholder="Enter your name..."
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059] bg-white py-2.5 px-3"
                        />
                    </div>
                    <div>
                        <label class="block text-[9px] sm:text-[10px] uppercase tracking-widest font-sans font-semibold text-stone-600 mb-1">
                            Your Blessing or Message:
                        </label>
                        <textarea
                            v-model="form.message"
                            required
                            rows="3"
                            placeholder="May the Lord abundantly bless your marriage with endless love, peace, and health..."
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059] bg-white p-3"
                        ></textarea>
                    </div>
                </div>

                <div class="mt-3.5 flex items-center justify-end">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-full bg-[#15253b] hover:bg-[#0f1a29] text-amber-50 font-serif text-xs uppercase tracking-widest transition-all transform active:scale-95 disabled:opacity-50 shadow"
                    >
                        {{ form.processing ? 'Submitting...' : 'Send Blessings' }}
                    </button>
                </div>
            </form>

            <!-- Wishes List -->
            <div class="space-y-3">
                <div
                    v-for="wish in wishes"
                    :key="wish.id"
                    class="p-4 rounded-xl bg-[#faf8f4] border border-stone-200/80 shadow-sm flex items-start gap-3 hover:border-gold-300 transition-colors"
                >
                    <div class="w-9 h-9 rounded-full bg-white border border-[#d8b878] text-gold-800 flex items-center justify-center font-serif font-bold text-xs shrink-0 shadow-sm">
                        {{ wish.guest_name ? wish.guest_name.charAt(0).toUpperCase() : '✝' }}
                    </div>
                    <div class="flex-1 text-left">
                        <div class="flex items-center justify-between gap-2">
                            <h4 class="font-serif font-semibold text-stone-900 text-xs sm:text-sm">
                                {{ wish.guest_name }}
                            </h4>
                            <span class="text-[9px] text-stone-400">
                                {{ formatDate(wish.created_at) }}
                            </span>
                        </div>
                        <p class="text-xs font-serif italic text-stone-600 mt-1 leading-relaxed">
                            "{{ wish.message }}"
                        </p>
                    </div>
                </div>

                <div v-if="wishes.length === 0" class="text-center py-6 text-stone-400 text-xs italic font-serif">
                    Be the first to share your prayers and blessings.
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
    brideName: { type: String, default: 'Shavindi' },
    groomName: { type: String, default: 'Buddhima' },
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
