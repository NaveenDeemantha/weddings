<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    settings: { type: Object, required: true },
});

const form = useForm({
    bride_name: props.settings.bride_name || 'Shenali',
    groom_name: props.settings.groom_name || 'Dilan',
    bride_full_name: props.settings.bride_full_name || 'Shenali Marie Fernando',
    groom_full_name: props.settings.groom_full_name || 'Dilan Jude Perera',
    bride_parents: props.settings.bride_parents || 'Mr. Anthony & Mrs. Nirmala Fernando',
    groom_parents: props.settings.groom_parents || 'Mr. Rohan & Mrs. Dilrukshi Perera',
    wedding_title: props.settings.wedding_title || 'The Nuptial Blessing & Wedding Celebration',
    wedding_date: props.settings.wedding_date || '2026-12-19 15:30:00',
    scripture_verse: props.settings.scripture_verse || 'Therefore what God has joined together, let no one separate. — Matthew 19:6',
    church_name: props.settings.church_name || "St. Mary's Church",
    church_address: props.settings.church_address || 'Nayakakanda, Hendala, Sri Lanka',
    church_time: props.settings.church_time || '03:30 PM',
    venue_name: props.settings.venue_name || 'The Grand Ballroom, Galle Face Hotel',
    venue_address: props.settings.venue_address || '2 Galle Road, Colombo 03, Sri Lanka',
    venue_map_url: props.settings.venue_map_url || 'https://maps.google.com/?q=Galle+Face+Hotel+Colombo',
    our_story: props.settings.our_story || '',
    music_url: props.settings.music_url || '',
    whatsapp_template: props.settings.whatsapp_template || '',
    events: Array.isArray(props.settings.events) ? JSON.parse(JSON.stringify(props.settings.events)) : [],
});

const addEvent = () => {
    form.events.push({
        name: 'New Ceremony / Event',
        date: 'Saturday, 19th December 2026',
        time: '06:00 PM',
        venue: form.venue_name,
        dress_code: 'Formal / Evening Wear',
        tag: 'Celebration',
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
    <Head title="Wedding Settings &amp; Liturgy" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="font-serif text-2xl font-bold leading-tight text-stone-900">
                        Wedding Configuration &amp; Details
                    </h2>
                    <p class="text-xs text-stone-500 mt-0.5">
                        Sri Lankan Catholic Holy Matrimony, church liturgy, Poruwa &amp; reception settings
                    </p>
                </div>
                <div>
                    <button
                        type="button"
                        @click="submit"
                        :disabled="form.processing"
                        class="px-5 py-2.5 rounded-xl bg-[#15253b] hover:bg-[#0f1a29] text-amber-50 font-serif text-xs tracking-wider shadow disabled:opacity-50 transition-all"
                    >
                        {{ form.processing ? 'Saving...' : '💾 Save Settings' }}
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
                                Bride, Groom &amp; Family Information
                            </h3>
                            <p class="text-xs text-stone-500">
                                Appears across the bespoke invitation suite, envelopes, and WhatsApp messages
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Bride's Call Name *</label>
                                <input
                                    type="text"
                                    v-model="form.bride_name"
                                    required
                                    placeholder="e.g. Shenali"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Groom's Call Name *</label>
                                <input
                                    type="text"
                                    v-model="form.groom_name"
                                    required
                                    placeholder="e.g. Dilan"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Bride's Full Formal Name</label>
                                <input
                                    type="text"
                                    v-model="form.bride_full_name"
                                    placeholder="e.g. Shenali Marie Fernando"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Groom's Full Formal Name</label>
                                <input
                                    type="text"
                                    v-model="form.groom_full_name"
                                    placeholder="e.g. Dilan Jude Perera"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Bride's Parents</label>
                                <input
                                    type="text"
                                    v-model="form.bride_parents"
                                    placeholder="e.g. Mr. Anthony &amp; Mrs. Nirmala Fernando"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Groom's Parents</label>
                                <input
                                    type="text"
                                    v-model="form.groom_parents"
                                    placeholder="e.g. Mr. Rohan &amp; Mrs. Dilrukshi Perera"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Scripture Verse / Motto</label>
                                <input
                                    type="text"
                                    v-model="form.scripture_verse"
                                    placeholder="e.g. Therefore what God has joined together, let no one separate. — Matthew 19:6"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Our Journey / Personal Blessing Note</label>
                                <textarea
                                    v-model="form.our_story"
                                    rows="3"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Church & Reception Venues -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-stone-200 shadow-sm space-y-5">
                        <div class="border-b border-stone-100 pb-3">
                            <h3 class="font-serif text-lg font-bold text-stone-900">
                                Church Nuptial Mass &amp; Reception Venues
                            </h3>
                            <p class="text-xs text-stone-500">
                                Locations, service times, and directions
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Wedding Date &amp; Time (YYYY-MM-DD HH:MM:SS) *</label>
                                <input
                                    type="text"
                                    v-model="form.wedding_date"
                                    required
                                    placeholder="2026-12-19 15:30:00"
                                    class="w-full font-mono text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>

                            <!-- Church Info -->
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Church Name</label>
                                <input
                                    type="text"
                                    v-model="form.church_name"
                                    placeholder="e.g. St. Mary's Church"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Church Service Time</label>
                                <input
                                    type="text"
                                    v-model="form.church_time"
                                    placeholder="03:30 PM (Guests seated by 03:00 PM)"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Church Full Address</label>
                                <input
                                    type="text"
                                    v-model="form.church_address"
                                    placeholder="Nayakakanda, Hendala, Sri Lanka"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>

                            <!-- Reception Info -->
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Reception Venue Name *</label>
                                <input
                                    type="text"
                                    v-model="form.venue_name"
                                    required
                                    placeholder="e.g. The Grand Ballroom, Galle Face Hotel"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Reception Google Maps URL *</label>
                                <input
                                    type="url"
                                    v-model="form.venue_map_url"
                                    required
                                    placeholder="https://maps.google.com/?q=..."
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Reception Full Address *</label>
                                <input
                                    type="text"
                                    v-model="form.venue_address"
                                    required
                                    placeholder="2 Galle Road, Colombo 03, Sri Lanka"
                                    class="w-full text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Ceremonies & Itinerary Schedule -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-stone-200 shadow-sm space-y-5">
                        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-stone-900">
                                    Liturgy &amp; Order of Events
                                </h3>
                                <p class="text-xs text-stone-500">
                                    Nuptial Mass, Poruwa, Cocktails, Dinner &amp; Dancing
                                </p>
                            </div>
                            <button
                                type="button"
                                @click="addEvent"
                                class="px-3 py-1.5 rounded-lg bg-[#faf8f4] text-stone-800 border border-[#d8b878] text-xs font-semibold hover:bg-stone-100"
                            >
                                + Add Event
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div
                                v-for="(ev, idx) in form.events"
                                :key="idx"
                                class="p-4 rounded-xl border border-stone-200 bg-stone-50/50 space-y-3 relative"
                            >
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs text-gold-800">
                                        Event #{{ idx + 1 }}
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
                                        <label class="block font-semibold text-stone-600 mb-1">Event Name</label>
                                        <input
                                            type="text"
                                            v-model="ev.name"
                                            required
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-[#c5a059] focus:ring-[#c5a059]"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Date</label>
                                        <input
                                            type="text"
                                            v-model="ev.date"
                                            required
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-[#c5a059] focus:ring-[#c5a059]"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Time</label>
                                        <input
                                            type="text"
                                            v-model="ev.time"
                                            required
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-[#c5a059] focus:ring-[#c5a059]"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Venue Location</label>
                                        <input
                                            type="text"
                                            v-model="ev.venue"
                                            required
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-[#c5a059] focus:ring-[#c5a059]"
                                        />
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block font-semibold text-stone-600 mb-1">Suggested Attire / Dress Code</label>
                                        <input
                                            type="text"
                                            v-model="ev.dress_code"
                                            placeholder="e.g. Formal Church Attire / Sri Lankan National / Black Tie"
                                            class="w-full text-xs rounded-xl border-stone-200 bg-white focus:border-[#c5a059] focus:ring-[#c5a059]"
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
                                WhatsApp Message Template
                            </h3>
                            <p class="text-xs text-stone-500">
                                Sent via the one-click WhatsApp button on the guest list
                            </p>
                        </div>

                        <div class="text-xs text-stone-600 bg-amber-50/50 p-3 rounded-xl border border-amber-200/80">
                            <strong>Placeholders:</strong>
                            <code class="mx-1 px-1.5 py-0.5 bg-white rounded border border-stone-300">:greeting</code>,
                            <code class="mx-1 px-1.5 py-0.5 bg-white rounded border border-stone-300">:bride</code>,
                            <code class="mx-1 px-1.5 py-0.5 bg-white rounded border border-stone-300">:groom</code>,
                            <code class="mx-1 px-1.5 py-0.5 bg-white rounded border border-stone-300">:link</code>
                        </div>

                        <div>
                            <textarea
                                v-model="form.whatsapp_template"
                                rows="6"
                                required
                                class="w-full font-mono text-xs rounded-xl border-stone-200 focus:border-[#c5a059] focus:ring-[#c5a059]"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="flex items-center justify-end">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-8 py-3 rounded-xl bg-[#15253b] hover:bg-[#0f1a29] text-amber-50 font-serif text-sm tracking-wider shadow disabled:opacity-50 transition-all active:scale-95"
                        >
                            {{ form.processing ? 'Saving...' : 'Save All Wedding Settings' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
