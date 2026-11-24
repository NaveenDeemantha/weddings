<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps({
    settings: { type: Object, required: true },
});

const form = useForm({
    bride_name: props.settings.bride_name || 'Shavindi',
    groom_name: props.settings.groom_name || 'Buddhima',
    bride_full_name: props.settings.bride_full_name || 'Shavindi',
    groom_full_name: props.settings.groom_full_name || 'Buddhima',
    bride_parents: props.settings.bride_parents || 'Mr. & Mrs. Perera',
    groom_parents: props.settings.groom_parents || 'Mr. & Mrs. Fernando',
    wedding_title: props.settings.wedding_title || 'Holy Matrimony - Buddhima & Shavindi',
    wedding_date: props.settings.wedding_date || '2026-12-29 09:00:00',
    scripture_verse: props.settings.scripture_verse || 'Therefore what God has joined together, let no one separate. — Matthew 19:6',
    church_name: props.settings.church_name || "St. Mary's Church",
    church_address: props.settings.church_address || 'Moratuwa, Sri Lanka',
    church_time: props.settings.church_time || '09:00 AM',
    venue_name: props.settings.venue_name || "St. Mary's Church",
    venue_address: props.settings.venue_address || 'Moratuwa, Sri Lanka',
    venue_map_url: props.settings.venue_map_url || 'https://maps.google.com/?q=St.+Mary%27s+Church+Moratuwa+Sri+Lanka',
    rsvp_phone: props.settings.rsvp_phone || '+94 718626389',
    our_story: props.settings.our_story || '',
    music_url: props.settings.music_url || '',
    whatsapp_template: props.settings.whatsapp_template || '',
    events: Array.isArray(props.settings.events) ? JSON.parse(JSON.stringify(props.settings.events)) : [],
});

const addEvent = () => {
    form.events.push({
        name: 'New Ceremony / Event',
        date: 'Tuesday, 29th December 2026',
        time: '06:00 PM',
        venue: form.venue_name,
        dress_code: 'Formal / Evening Wear',
        tag: 'Celebration',
    });
};

const removeEvent = (index) => {
    form.events.splice(index, 1);
};

// Keep Mass / Church time & venue in sync with church inputs
watch(() => form.church_time, (newTime) => {
    if (!newTime || !form.events?.length) return;
    const massEvent = form.events.find(e => (e.name || '').toLowerCase().includes('mass') || (e.name || '').toLowerCase().includes('church')) || form.events[0];
    if (massEvent) {
        massEvent.time = newTime;
    }
});

watch(() => form.church_name, (newName) => {
    if (!newName || !form.events?.length) return;
    const massEvent = form.events.find(e => (e.name || '').toLowerCase().includes('mass') || (e.name || '').toLowerCase().includes('church')) || form.events[0];
    if (massEvent) {
        massEvent.venue = newName;
    }
});

watch(() => form.venue_name, (newName) => {
    if (!newName || !form.events?.length) return;
    const recEvent = form.events.find(e => (e.name || '').toLowerCase().includes('reception'));
    if (recEvent) {
        recEvent.venue = newName;
    }
});

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
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-[#c5a059]"></span>
                        <span class="text-[11px] font-semibold uppercase tracking-widest text-stone-500">Suite Configuration</span>
                    </div>
                    <h2 class="font-serif text-2xl font-bold leading-tight text-stone-900 mt-1">
                        Wedding Configuration &amp; Ceremonies
                    </h2>
                    <p class="text-xs text-stone-500 mt-0.5">
                        Manage couple profiles, church liturgy schedule, reception venues, and WhatsApp messaging
                    </p>
                </div>
                <div>
                    <button
                        type="button"
                        @click="submit"
                        :disabled="form.processing"
                        class="px-5 py-2.5 rounded-xl bg-[#15253b] hover:bg-[#0f1b2b] text-white text-xs font-semibold shadow-2xs disabled:opacity-50 transition-colors flex items-center gap-2"
                    >
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        <span>{{ form.processing ? 'Saving...' : 'Save Settings' }}</span>
                    </button>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 space-y-7">
                <form @submit.prevent="submit" class="space-y-7">
                    <!-- Couple & Family Details -->
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#EDE8E1] shadow-[0_2px_12px_rgba(0,0,0,0.02)] space-y-5">
                        <div class="border-b border-[#F0EDE6] pb-4 flex items-center justify-between">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-stone-900">
                                    Bride, Groom &amp; Family Information
                                </h3>
                                <p class="text-xs text-stone-500 mt-0.5">
                                    Appears on the invitations, envelopes, door reveal banner, and WhatsApp messages
                                </p>
                            </div>
                            <span class="text-[10px] font-semibold uppercase tracking-widest text-[#7A5B22] bg-[#FAF7F0] border border-[#E8DFCB] px-2.5 py-1 rounded-full">
                                Profile
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Bride's Call Name *</label>
                                <input
                                    type="text"
                                    v-model="form.bride_name"
                                    required
                                    placeholder="e.g. Shavindi"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Groom's Call Name *</label>
                                <input
                                    type="text"
                                    v-model="form.groom_name"
                                    required
                                    placeholder="e.g. Buddhima"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Bride's Full Formal Name</label>
                                <input
                                    type="text"
                                    v-model="form.bride_full_name"
                                    placeholder="e.g. Shavindi Fernando"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Groom's Full Formal Name</label>
                                <input
                                    type="text"
                                    v-model="form.groom_full_name"
                                    placeholder="e.g. Buddhima Rodrigo"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Bride's Parents</label>
                                <input
                                    type="text"
                                    v-model="form.bride_parents"
                                    placeholder="e.g. Mr. &amp; Mrs. Perera"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Groom's Parents</label>
                                <input
                                    type="text"
                                    v-model="form.groom_parents"
                                    placeholder="e.g. Mr. Rohan &amp; Mrs. Dilrukshi Fernando"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Scripture Verse / Wedding Motto</label>
                                <input
                                    type="text"
                                    v-model="form.scripture_verse"
                                    placeholder="e.g. Therefore what God has joined together, let no one separate. — Matthew 19:6"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Our Journey / Personal Blessing Note</label>
                                <textarea
                                    v-model="form.our_story"
                                    rows="3"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                ></textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Background Music URL or Path (MP3)</label>
                                <input
                                    type="text"
                                    v-model="form.music_url"
                                    placeholder="e.g. /music/wedding.mp3"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                                <p class="text-[11px] text-stone-400 mt-1">
                                    Place an audio file in <code>public/music/wedding.mp3</code> or provide any direct public MP3 link.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Church & Reception Venues -->
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#EDE8E1] shadow-[0_2px_12px_rgba(0,0,0,0.02)] space-y-5">
                        <div class="border-b border-[#F0EDE6] pb-4 flex items-center justify-between">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-stone-900">
                                    Church Wedding Mass &amp; Reception Venues
                                </h3>
                                <p class="text-xs text-stone-500 mt-0.5">
                                    Locations, service times, and Google Maps directions
                                </p>
                            </div>
                            <span class="text-[10px] font-semibold uppercase tracking-widest text-[#7A5B22] bg-[#FAF7F0] border border-[#E8DFCB] px-2.5 py-1 rounded-full">
                                Venues
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Wedding Date &amp; Time (YYYY-MM-DD HH:MM:SS) *</label>
                                <input
                                    type="text"
                                    v-model="form.wedding_date"
                                    required
                                    placeholder="2026-12-29 09:00:00"
                                    class="w-full font-mono text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>

                            <!-- Church Info -->
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Church Name</label>
                                <input
                                    type="text"
                                    v-model="form.church_name"
                                    placeholder="e.g. St. Mary's Church"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Church Service Time</label>
                                <input
                                    type="text"
                                    v-model="form.church_time"
                                    placeholder="03:30 PM (Guests seated by 03:00 PM)"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Church Full Address</label>
                                <input
                                    type="text"
                                    v-model="form.church_address"
                                    placeholder="Nayakakanda, Hendala, Sri Lanka"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>

                            <!-- Reception Info -->
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Reception Venue Name *</label>
                                <input
                                    type="text"
                                    v-model="form.venue_name"
                                    required
                                    placeholder="e.g. Vinrich Lake Resort"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div>
                                <label class="block font-semibold text-stone-700 mb-1">Reception Google Maps URL *</label>
                                <input
                                    type="url"
                                    v-model="form.venue_map_url"
                                    required
                                    placeholder="https://maps.google.com/?q=..."
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">Reception Full Address *</label>
                                <input
                                    type="text"
                                    v-model="form.venue_address"
                                    required
                                    placeholder="Piliyandala, Sri Lanka"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block font-semibold text-stone-700 mb-1">RSVP Contact Mobile Phone *</label>
                                <input
                                    type="text"
                                    v-model="form.rsvp_phone"
                                    placeholder="+94 718626389"
                                    class="w-full text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                />
                                <p class="text-[11px] text-stone-400 mt-1">
                                    Guests can tap this number on the invitation to call directly or message via WhatsApp.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Ceremonies & Itinerary Schedule -->
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#EDE8E1] shadow-[0_2px_12px_rgba(0,0,0,0.02)] space-y-5">
                        <div class="flex items-center justify-between border-b border-[#F0EDE6] pb-4">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-stone-900">
                                    Liturgy &amp; Order of Events
                                </h3>
                                <p class="text-xs text-stone-500 mt-0.5">
                                    Cathedral Mass, Poruwa Ceremony, Cocktails, Dinner &amp; Evening Dancing
                                </p>
                            </div>
                            <button
                                type="button"
                                @click="addEvent"
                                class="px-3.5 py-1.5 rounded-xl bg-white border border-[#E5DAC0] text-[#7A5B22] text-xs font-semibold hover:bg-[#FAF7F0] transition-colors flex items-center gap-1.5"
                            >
                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                <span>Add Event</span>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div
                                v-for="(ev, idx) in form.events"
                                :key="idx"
                                class="p-4 sm:p-5 rounded-2xl border border-[#EDE8E1] bg-[#FAF9F6] space-y-3 relative"
                            >
                                <div class="flex items-center justify-between">
                                    <span class="font-serif font-bold text-xs text-[#7A5B22] uppercase tracking-wider">
                                        Event #{{ idx + 1 }} · {{ ev.name }}
                                    </span>
                                    <button
                                        type="button"
                                        @click="removeEvent(idx)"
                                        class="text-stone-400 hover:text-rose-600 text-xs font-semibold flex items-center gap-1 transition-colors"
                                    >
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        <span>Remove</span>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Event Name</label>
                                        <input
                                            type="text"
                                            v-model="ev.name"
                                            required
                                            class="w-full text-xs rounded-xl border border-stone-200 bg-white focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Date</label>
                                        <input
                                            type="text"
                                            v-model="ev.date"
                                            required
                                            class="w-full text-xs rounded-xl border border-stone-200 bg-white focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Time</label>
                                        <input
                                            type="text"
                                            v-model="ev.time"
                                            required
                                            class="w-full text-xs rounded-xl border border-stone-200 bg-white focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                        />
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-stone-600 mb-1">Venue Location</label>
                                        <input
                                            type="text"
                                            v-model="ev.venue"
                                            required
                                            class="w-full text-xs rounded-xl border border-stone-200 bg-white focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                        />
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block font-semibold text-stone-600 mb-1">Suggested Attire / Dress Code</label>
                                        <input
                                            type="text"
                                            v-model="ev.dress_code"
                                            placeholder="e.g. Formal Church Attire / Sri Lankan National / Black Tie"
                                            class="w-full text-xs rounded-xl border border-stone-200 bg-white focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Message Template -->
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-[#EDE8E1] shadow-[0_2px_12px_rgba(0,0,0,0.02)] space-y-4">
                        <div class="border-b border-[#F0EDE6] pb-4 flex items-center justify-between">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-stone-900">
                                    WhatsApp Invitation Message Template
                                </h3>
                                <p class="text-xs text-stone-500 mt-0.5">
                                    Sent via the one-click WhatsApp button on the guest list
                                </p>
                            </div>
                            <span class="text-[10px] font-semibold uppercase tracking-widest text-[#25D366] bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full">
                                Messaging
                            </span>
                        </div>

                        <div class="text-xs text-stone-600 bg-[#FAF9F6] p-3.5 rounded-2xl border border-[#EDE8E1] flex flex-wrap items-center gap-2">
                            <span class="font-semibold text-stone-700">Supported placeholders:</span>
                            <code class="px-2 py-0.5 bg-white rounded-md border border-stone-200 text-stone-800 font-mono">:greeting</code>
                            <code class="px-2 py-0.5 bg-white rounded-md border border-stone-200 text-stone-800 font-mono">:bride</code>
                            <code class="px-2 py-0.5 bg-white rounded-md border border-stone-200 text-stone-800 font-mono">:groom</code>
                            <code class="px-2 py-0.5 bg-white rounded-md border border-stone-200 text-stone-800 font-mono">:link</code>
                        </div>

                        <div>
                            <textarea
                                v-model="form.whatsapp_template"
                                rows="6"
                                required
                                class="w-full font-mono text-xs rounded-2xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="flex items-center justify-end pt-2">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full sm:w-auto px-8 py-3.5 sm:py-3 rounded-xl bg-[#15253b] hover:bg-[#0f1b2b] text-white font-medium text-xs tracking-wider shadow-2xs disabled:opacity-50 transition-all active:scale-[0.98] flex items-center justify-center gap-2"
                        >
                            <svg class="w-4 h-4 text-[#c5a059]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            <span>{{ form.processing ? 'Saving...' : 'Save All Wedding Settings' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
