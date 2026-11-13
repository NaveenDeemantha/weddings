<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    settings: { type: Object, required: true },
});

const form = useForm({
    bride_name: props.settings.bride_name || 'Pooja',
    groom_name: props.settings.groom_name || 'Rahul',
    bride_parents: props.settings.bride_parents || 'Mr. & Mrs. Sharma',
    groom_parents: props.settings.groom_parents || 'Mr. & Mrs. Verma',
    wedding_title: props.settings.wedding_title || 'The Wedding Celebration',
    wedding_date: props.settings.wedding_date || '2026-12-18 10:30:00',
    venue_name: props.settings.venue_name || 'The Grand Palace Banquet',
    venue_address: props.settings.venue_address || 'Palace Road, City Center',
    venue_map_url: props.settings.venue_map_url || 'https://maps.google.com',
    our_story: props.settings.our_story || '',
    music_url: props.settings.music_url || '',
    whatsapp_template: props.settings.whatsapp_template || '',
    events: Array.isArray(props.settings.events) ? JSON.parse(JSON.stringify(props.settings.events)) : [],
});

const addEvent = () => {
    form.events.push({
        name: 'New Ceremony',
        date: 'Dec 18, 2026',
        time: '04:00 PM',
        venue: form.venue_name,
        dress_code: 'Festive Ethnic',
        icon: 'ring',
    });
};

const removeEvent = (index) => {
    form.events.splice(index, 1);
};

const submit = () => {
    form.post(route('settings.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Wedding Settings &amp; Schedule" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="font-serif text-2xl font-bold leading-tight text-stone-900">
                        Wedding Details &amp; Configuration
                    </h2>
                    <p class="text-xs text-stone-500 mt-0.5">
                        Customize couple names, venue, dates, ceremonies, and WhatsApp message templates
                    </p>
                </div>
                <div>
                    <button
                        type="button"
                        @click="submit"
                        :disabled="form.processing"
                        class="px-5 py-2.5 rounded-xl bg-amber-600 text-white font-medium text-xs shadow hover:bg-amber-700 disabled:opacity-50 transition-all"
                    >
                        {{ form.processing ? 'Saving...' : '💾 Save All Changes' }}
                    </button>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 space-y-8">
                <form @submit.prevent="submit" class="space-y-8">
                    <!-- Couple & Family Details -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-stone-200 shadow-sm space-y-5">
                        <div class="border-b border-stone-100 pb-3">
                            <h3 class="font-serif text-lg font-bold text-stone-900">
                                Couple &amp; Family Information
                            </h3>
                            <p class="text-xs text-stone-500">
                                Appears prominently across the invitation card, countdown, and WhatsApp greetings
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Bride's Name *</label>
                                <input
                                    type="text"
                                    v-model="form.bride_name"
                                    required
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Groom's Name *</label>
                                <input
                                    type="text"
                                    v-model="form.groom_name"
                                    required
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Bride's Parents</label>
                                <input
                                    type="text"
                                    v-model="form.bride_parents"
                                    placeholder="e.g. Mr. &amp; Mrs. Sharma"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Groom's Parents</label>
                                <input
                                    type="text"
                                    v-model="form.groom_parents"
                                    placeholder="e.g. Mr. &amp; Mrs. Verma"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Wedding Main Title</label>
                                <input
                                    type="text"
                                    v-model="form.wedding_title"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Our Story / Family Blessing Note</label>
                                <textarea
                                    v-model="form.our_story"
                                    rows="3"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Date, Time & Venue -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-stone-200 shadow-sm space-y-5">
                        <div class="border-b border-stone-100 pb-3">
                            <h3 class="font-serif text-lg font-bold text-stone-900">
                                Wedding Date &amp; Venue Location
                            </h3>
                            <p class="text-xs text-stone-500">
                                Drives the live countdown timer and Google Maps direction button
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Wedding Date &amp; Time (YYYY-MM-DD HH:MM:SS) *</label>
                                <input
                                    type="text"
                                    v-model="form.wedding_date"
                                    required
                                    placeholder="2026-12-18 10:30:00"
                                    class="w-full font-mono text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Venue Name *</label>
                                <input
                                    type="text"
                                    v-model="form.venue_name"
                                    required
                                    placeholder="e.g. The Grand Palace Banquet &amp; Lawns"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Google Maps Link *</label>
                                <input
                                    type="url"
                                    v-model="form.venue_map_url"
                                    required
                                    placeholder="https://maps.google.com/?q=..."
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Full Venue Address *</label>
                                <input
                                    type="text"
                                    v-model="form.venue_address"
                                    required
                                    placeholder="Palace Road, Near Heritage Club, City Center"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Background Music Audio URL (.mp3)</label>
                                <input
                                    type="url"
                                    v-model="form.music_url"
                                    placeholder="https://.../wedding-audio.mp3"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                                />
                                <p class="text-[10px] text-stone-400 mt-1">Leave as default or provide direct link to your preferred romantic flute/shehnai/music.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Ceremonies & Itinerary Schedule -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-stone-200 shadow-sm space-y-5">
                        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-stone-900">
                                    Wedding Program &amp; Ceremonies
                                </h3>
                                <p class="text-xs text-stone-500">
                                    Haldi, Mehendi, Sangeet, Muhurtham, Reception, etc.
                                </p>
                            </div>
                            <button
                                type="button"
                                @click="addEvent"
                                class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-800 border border-amber-300 text-xs font-semibold hover:bg-amber-100"
                            >
                                + Add Ceremony
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div
                                v-for="(ev, idx) in form.events"
                                :key="idx"
                                class="p-4 rounded-xl border border-stone-200 bg-stone-50/50 space-y-3 relative group"
                            >
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs text-amber-800">
                                        Ceremony #{{ idx + 1 }}
                                    </span>
                                    <button
                                        type="button"
                                        @click="removeEvent(idx)"
                                        class="text-rose-500 hover:text-rose-700 text-xs font-semibold"
                                    >
                                        Remove
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Ceremony Name</label>
                                        <input
                                            type="text"
                                            v-model="ev.name"
                                            required
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-amber-500 focus:ring-amber-500"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Date</label>
                                        <input
                                            type="text"
                                            v-model="ev.date"
                                            required
                                            placeholder="Dec 17, 2026"
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-amber-500 focus:ring-amber-500"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Time</label>
                                        <input
                                            type="text"
                                            v-model="ev.time"
                                            required
                                            placeholder="03:30 PM Onwards"
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-amber-500 focus:ring-amber-500"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Venue / Hall</label>
                                        <input
                                            type="text"
                                            v-model="ev.venue"
                                            required
                                            placeholder="Poolside Lawn"
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-amber-500 focus:ring-amber-500"
                                        />
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block font-semibold text-stone-600 mb-1">Suggested Attire / Dress Code</label>
                                        <input
                                            type="text"
                                            v-model="ev.dress_code"
                                            placeholder="Sunshine Yellow &amp; Floral Festive"
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-amber-500 focus:ring-amber-500"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Message Template -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-stone-200 shadow-sm space-y-4">
                        <div class="border-b border-stone-100 pb-3">
                            <h3 class="font-serif text-lg font-bold text-stone-900">
                                WhatsApp Invitation Message Template
                            </h3>
                            <p class="text-xs text-stone-500">
                                Used by the one-click "Send via WhatsApp" button on the guest list.
                            </p>
                        </div>

                        <div class="text-xs text-stone-600 bg-amber-50 p-3 rounded-xl border border-amber-200">
                            <strong>Dynamic Placeholders:</strong>
                            <code class="mx-1 px-1.5 py-0.5 bg-white rounded border border-amber-300">:greeting</code> (Guest's custom salutation or name),
                            <code class="mx-1 px-1.5 py-0.5 bg-white rounded border border-amber-300">:bride</code> (Bride name),
                            <code class="mx-1 px-1.5 py-0.5 bg-white rounded border border-amber-300">:groom</code> (Groom name),
                            <code class="mx-1 px-1.5 py-0.5 bg-white rounded border border-amber-300">:link</code> (Unique invitation URL).
                        </div>

                        <div>
                            <textarea
                                v-model="form.whatsapp_template"
                                rows="6"
                                required
                                class="w-full font-mono text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="flex items-center justify-end">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-8 py-3 rounded-xl bg-amber-600 text-white font-semibold text-sm shadow-md hover:bg-amber-700 disabled:opacity-50 transition-all active:scale-95"
                        >
                            {{ form.processing ? 'Saving...' : 'Save All Wedding Settings' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

