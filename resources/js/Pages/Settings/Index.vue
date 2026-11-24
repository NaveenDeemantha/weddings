<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    settings: { type: Object, required: true },
});

const form = useForm({
    bride_name: props.settings.bride_name || 'Shavindi',
    groom_name: props.settings.groom_name || 'Buddhima',
    bride_full_name: props.settings.bride_full_name || 'Shavindi',
    groom_full_name: props.settings.groom_full_name || 'Buddhima',
    bride_parents: props.settings.bride_parents || 'Mr. Lalith Fernando & Mrs. Priska Pieris',
    groom_parents: props.settings.groom_parents || '(Late) Mr. Sumith Rodrigo & Mrs. Banduwathi',
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
    whatsapp_template_si: props.settings.whatsapp_template_si || "ආදරණීය :greeting,\n\nඅප දෙපාර්ශවයේ දෙමාපියන්ගේ ආශීර්වාදය ඇතිව, :groom සහ :bride වන අපගේ ශුද්ධ වූ විවාහ මංගලෝත්සවය සඳහා ඔබ සැමට සාදරයෙන් ඇරයුම් කරමු.\n\nශුද්ධ වූ මංගල දිව්‍ය පූජාව: 2026 දෙසැම්බර් 29 වන අඟහරුවාදා පස්වරු 4:00 ට මොරටුව ශාන්ත සෙබස්තියන් දේවස්ථානයේදී.\nඉන් අනතුරුව මංගල සාදය: පස්වරු 6:30 සිට පිළියන්දල වින්රිච් ලේක් රිසෝට් හිදී.\n\nඔබ වෙනුවෙන්ම වෙන් කළ විශේෂ ඩිජිටල් ආරාධනා පත්‍රය මෙතැනින් විවෘත කරන්න:\n:link\n\nඔබගේ පැමිණීම කාරුණිකව දන්වන්න (බුද්ධිම - 0718626389). ඔබ සැමගේ ආශීර්වාදය සහ සහභාගීත්වය ඉමහත් සතුටින් අපේක්ෂා කරමු!\n\nමෙත් සිතින්,\nරුද්‍රිගු සහ ප්‍රනාන්දු පවුල්වල සැම",
    events: Array.isArray(props.settings.events) ? JSON.parse(JSON.stringify(props.settings.events)) : [],
});

const activeTemplateTab = ref('en');

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
                <form @submit.prevent="submit" novalidate class="space-y-7">
                    <!-- Feedback Notifications -->
                    <div
                        v-if="form.recentlySuccessful"
                        class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center gap-3 text-sm shadow-xs transition-all animate-fadeIn"
                    >
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="font-medium">All wedding settings have been saved successfully!</p>
                    </div>

                    <div
                        v-if="form.hasErrors"
                        class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 space-y-1 text-xs shadow-xs"
                    >
                        <div class="flex items-center gap-2 font-bold text-sm text-rose-800">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Unable to save settings. Please review the errors below:</span>
                        </div>
                        <ul class="list-disc list-inside space-y-0.5 pl-2 text-rose-700">
                            <li v-for="(err, key) in form.errors" :key="key">
                                {{ err }}
                            </li>
                        </ul>
                    </div>

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

                    <!-- WhatsApp Message Templates (Expanded High-Visibility Container) -->
                    <div class="bg-gradient-to-b from-[#fafcf9] to-white p-6 sm:p-8 rounded-3xl border-2 border-emerald-500/30 shadow-[0_4px_20px_rgba(37,211,102,0.08)] space-y-5">
                        <div class="border-b border-emerald-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <h3 class="font-serif text-xl sm:text-2xl font-bold text-stone-900 flex items-center gap-2.5">
                                    <span class="w-8 h-8 rounded-full bg-[#25D366] text-white flex items-center justify-center shrink-0 shadow-xs">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                        </svg>
                                    </span>
                                    <span>WhatsApp Invitation Message Templates</span>
                                </h3>
                                <p class="text-xs sm:text-sm text-stone-600 mt-1">
                                    Configure messages sent to guests via WhatsApp. Choose which language to send on the guest list!
                                </p>
                            </div>

                            <!-- Language Template Tabs -->
                            <div class="flex items-center gap-1.5 p-1 bg-stone-100 rounded-2xl border border-stone-200 shrink-0 self-start sm:self-auto">
                                <button
                                    type="button"
                                    @click="activeTemplateTab = 'en'"
                                    class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all"
                                    :class="activeTemplateTab === 'en' ? 'bg-white text-stone-900 shadow-sm border border-stone-200' : 'text-stone-600 hover:text-stone-900'"
                                >
                                    🇬🇧 English Template
                                </button>
                                <button
                                    type="button"
                                    @click="activeTemplateTab = 'si'"
                                    class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all"
                                    :class="activeTemplateTab === 'si' ? 'bg-[#25D366] text-white shadow-sm' : 'text-stone-600 hover:text-stone-900'"
                                >
                                    🇱🇰 සිංහල Template
                                </button>
                            </div>
                        </div>

                        <!-- Placeholders Guide & Tokens -->
                        <div class="text-xs text-stone-700 bg-white p-4 rounded-2xl border border-emerald-200 shadow-xs space-y-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="font-bold text-stone-800 text-xs">Supported placeholders (automatically replaced):</span>
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg font-mono font-bold text-xs">:greeting</span>
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg font-mono font-bold text-xs">:name</span>
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg font-mono font-bold text-xs">:bride</span>
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg font-mono font-bold text-xs">:groom</span>
                                <span class="px-2.5 py-1 bg-amber-50 text-amber-900 border border-amber-300 rounded-lg font-mono font-bold text-xs">:link</span>
                            </div>
                            <p class="text-[11.5px] text-stone-500">
                                💡 Note: The <code class="font-mono text-amber-700 bg-amber-50 px-1 rounded font-bold">:link</code> in the English template automatically opens the site in <strong>English</strong>. The <code class="font-mono text-amber-700 bg-amber-50 px-1 rounded font-bold">:link</code> in the Sinhala template automatically opens the site in <strong>සිංහල (Sinhala)</strong>!
                            </p>
                        </div>

                        <!-- English Template Editor -->
                        <div v-show="activeTemplateTab === 'en'" class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="block font-bold text-xs uppercase tracking-wider text-stone-700">
                                    English Message Content (Default)
                                </label>
                                <span class="text-xs text-stone-400 font-mono">{{ (form.whatsapp_template || '').length }} characters</span>
                            </div>
                            <textarea
                                v-model="form.whatsapp_template"
                                rows="12"
                                placeholder="Type your English WhatsApp invitation message here..."
                                class="w-full font-mono text-xs sm:text-sm leading-relaxed p-4 rounded-2xl border-2 border-stone-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-white text-stone-900 shadow-inner"
                            ></textarea>
                        </div>

                        <!-- Sinhala Template Editor -->
                        <div v-show="activeTemplateTab === 'si'" class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="block font-bold text-xs uppercase tracking-wider text-emerald-800">
                                    සිංහල ආරාධනා පණිවිඩය (Sinhala Message Content)
                                </label>
                                <span class="text-xs text-stone-400 font-mono">{{ (form.whatsapp_template_si || '').length }} characters</span>
                            </div>
                            <textarea
                                v-model="form.whatsapp_template_si"
                                rows="12"
                                placeholder="Type your Sinhala WhatsApp invitation message here..."
                                class="w-full font-mono text-xs sm:text-sm leading-relaxed p-4 rounded-2xl border-2 border-emerald-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-white text-stone-900 shadow-inner"
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
