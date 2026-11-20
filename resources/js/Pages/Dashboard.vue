<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    metrics: { type: Object, required: true },
    recentRsvps: { type: Array, default: () => [] },
    recentWishes: { type: Array, default: () => [] },
    settings: { type: Object, required: true },
    previewUrl: { type: String, required: true },
});

const formatDate = (dateStr) => {
    if (!dateStr) return '—';
    try {
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' });
    } catch {
        return dateStr;
    }
};

const formatWeddingDate = (dateStr) => {
    if (!dateStr) return '—';
    try {
        // Support formats like "2026-12-29 16:00:00" or ISO
        const cleaned = dateStr.replace(' ', 'T');
        const d = new Date(cleaned);
        if (isNaN(d.getTime())) return dateStr;

        const weekday = d.toLocaleDateString('en-US', { weekday: 'long' });
        const day = d.getDate();
        const month = d.toLocaleDateString('en-US', { month: 'long' });
        const year = d.getFullYear();
        const time = d.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

        // Ordinal suffix
        const suffix = (day % 10 === 1 && day !== 11) ? 'st' :
                       (day % 10 === 2 && day !== 12) ? 'nd' :
                       (day % 10 === 3 && day !== 13) ? 'rd' : 'th';

        return `${weekday}, ${day}${suffix} ${month} ${year} · ${time}`;
    } catch {
        return dateStr;
    }
};
</script>

<template>
    <Head title="Wedding Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-[#c5a059]"></span>
                        <span class="text-[11px] font-semibold uppercase tracking-widest text-stone-500">Live Wedding Suite</span>
                    </div>
                    <h2 class="font-serif text-2xl font-bold leading-tight text-stone-900 mt-1">
                        {{ settings.bride_name }} &amp; {{ settings.groom_name }}'s Wedding Dashboard
                    </h2>
                    <p class="text-xs text-stone-500 mt-0.5">
                        Real-time overview of guest invitations, RSVPs, attendance and liturgy settings
                    </p>
                </div>
                <div class="flex items-center gap-2.5">
                    <a
                        :href="route('invitation.print')"
                        target="_blank"
                        class="px-3.5 py-2 rounded-xl bg-white border border-[#E5DAC0] text-[#7A5B22] font-semibold text-xs shadow-2xs hover:bg-[#FAF7F0] transition-colors flex items-center gap-2"
                    >
                        <svg class="w-3.5 h-3.5 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg>
                        <span>Print Invitation</span>
                    </a>
                    <Link
                        :href="route('guests.index')"
                        class="px-4 py-2 rounded-xl bg-[#15253b] hover:bg-[#0f1b2b] text-white font-medium text-xs shadow-2xs transition-colors flex items-center gap-2"
                    >
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <line x1="19" y1="8" x2="19" y2="14" />
                            <line x1="22" y1="11" x2="16" y2="11" />
                        </svg>
                        <span>Manage Guests</span>
                    </Link>
                    <a
                        :href="previewUrl"
                        target="_blank"
                        class="px-3.5 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-medium text-xs shadow-2xs hover:bg-stone-50 transition-colors flex items-center gap-1.5"
                    >
                        <span>Preview Card</span>
                        <svg class="w-3 h-3 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 17 17 7M7 7h10v10" />
                        </svg>
                    </a>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-7">
                <!-- Executive Metrics Bar -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    <!-- Total Invited -->
                    <div class="bg-white p-5 rounded-2xl border border-[#EDE8E1] shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] uppercase tracking-wider font-semibold text-stone-500">Invitations</span>
                            <div class="w-7 h-7 rounded-lg bg-stone-100 flex items-center justify-center text-stone-600">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="font-serif text-3xl font-bold text-stone-900 block leading-tight">{{ metrics.total_guests }}</span>
                            <span class="text-[11px] text-stone-500 mt-1 block">Dedicated links created</span>
                        </div>
                    </div>

                    <!-- Attending -->
                    <div class="bg-white p-5 rounded-2xl border border-emerald-100 shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] uppercase tracking-wider font-semibold text-emerald-800">Attending</span>
                            <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="font-serif text-3xl font-bold text-emerald-900 block leading-tight">{{ metrics.attending_count }}</span>
                            <span class="text-[11px] text-emerald-700 mt-1 block">Confirmed guests</span>
                        </div>
                    </div>

                    <!-- Pending Responses -->
                    <div class="bg-white p-5 rounded-2xl border border-amber-100 shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] uppercase tracking-wider font-semibold text-amber-800">Pending RSVP</span>
                            <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="font-serif text-3xl font-bold text-amber-900 block leading-tight">{{ metrics.pending_count }}</span>
                            <span class="text-[11px] text-amber-700 mt-1 block">Awaiting confirmation</span>
                        </div>
                    </div>

                    <!-- Declined -->
                    <div class="bg-white p-5 rounded-2xl border border-[#EDE8E1] shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] uppercase tracking-wider font-semibold text-stone-500">Declined</span>
                            <div class="w-7 h-7 rounded-lg bg-stone-100 text-stone-600 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="font-serif text-3xl font-bold text-stone-800 block leading-tight">{{ metrics.declined_count }}</span>
                            <span class="text-[11px] text-stone-500 mt-1 block">Cannot attend</span>
                        </div>
                    </div>

                    <!-- Cathedral Doors Opened -->
                    <div class="bg-white p-5 rounded-2xl border border-[#E5DAC0] shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex flex-col justify-between col-span-2 sm:col-span-1">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] uppercase tracking-wider font-semibold text-[#7A5B22]">Doors Opened</span>
                            <div class="w-7 h-7 rounded-lg bg-[#FAF7F0] text-[#7A5B22] flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 21h18" />
                                    <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16" />
                                    <circle cx="10" cy="12" r="1" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="font-serif text-3xl font-bold text-[#7A5B22] block leading-tight">{{ metrics.opened_count }}</span>
                            <span class="text-[11px] text-[#8c6d37] mt-1 block">Cathedral doors opened</span>
                        </div>
                    </div>
                </div>

                <!-- Wedding Overview Executive Card -->
                <div class="relative overflow-hidden bg-white border border-[#E6E0D4] rounded-3xl p-6 sm:p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
                    <!-- Subtle luxury gold top hairline -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-[#c5a059] to-transparent"></div>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <div class="space-y-3">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FAF7F0] text-[#7A5B22] border border-[#E8DFCB] text-[11px] font-semibold tracking-wider uppercase">
                                <svg class="w-3 h-3 text-[#c5a059]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                                <span>Holy Matrimony &amp; Celebration</span>
                            </div>

                            <h3 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 tracking-wide">
                                {{ settings.bride_name }} &amp; {{ settings.groom_name }}
                            </h3>

                            <div class="flex flex-wrap items-center gap-y-2 gap-x-4 text-xs text-stone-600">
                                <span class="flex items-center gap-1.5 font-medium text-stone-900">
                                    <svg class="w-3.5 h-3.5 text-[#c5a059]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    {{ formatWeddingDate(settings.wedding_date) }}
                                </span>
                                <span class="hidden sm:inline text-stone-300">|</span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-[#c5a059]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    {{ settings.venue_name }}
                                </span>
                            </div>

                            <p v-if="settings.our_story" class="text-xs text-stone-500 italic max-w-2xl leading-relaxed pt-1">
                                "{{ settings.our_story }}"
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 shrink-0 pt-2 md:pt-0">
                            <Link
                                :href="route('settings.index')"
                                class="px-4 py-2.5 rounded-xl bg-white border border-stone-200 text-stone-800 text-xs font-semibold shadow-2xs hover:bg-stone-50 transition-colors flex items-center justify-center gap-2"
                            >
                                <svg class="w-3.5 h-3.5 text-stone-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                <span>Edit Wedding Details</span>
                            </Link>
                            <Link
                                :href="route('guests.index')"
                                class="px-5 py-2.5 rounded-xl bg-[#15253b] hover:bg-[#0f1b2b] text-white text-xs font-semibold shadow-2xs transition-colors flex items-center justify-center gap-2"
                            >
                                <svg class="w-3.5 h-3.5 text-[#25D366]" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                <span>Send WhatsApp Invites</span>
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Two-Column Layout: Recent RSVPs & Wishes -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-7">
                    <!-- Recent RSVPs -->
                    <div class="bg-white rounded-3xl border border-[#EDE8E1] shadow-[0_2px_12px_rgba(0,0,0,0.02)] p-6 sm:p-7 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between pb-4 border-b border-stone-100 mb-2">
                                <div>
                                    <h3 class="font-serif text-lg font-bold text-stone-900">
                                        Recent RSVP Activity
                                    </h3>
                                    <p class="text-xs text-stone-400">Live guest responses and party size updates</p>
                                </div>
                                <Link :href="route('guests.index')" class="text-xs font-semibold text-[#8c6d37] hover:text-[#5e471d] flex items-center gap-1">
                                    <span>All guests</span>
                                    <span>&rarr;</span>
                                </Link>
                            </div>

                            <div v-if="recentRsvps.length > 0" class="divide-y divide-stone-100">
                                <div
                                    v-for="guest in recentRsvps"
                                    :key="guest.id"
                                    class="py-3.5 flex items-center justify-between gap-3"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-stone-100 border border-stone-200 flex items-center justify-center text-xs font-bold text-stone-700 shrink-0">
                                            {{ guest.name?.charAt(0) || 'G' }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-xs text-stone-900">
                                                {{ guest.name }}
                                            </p>
                                            <p class="text-[11px] text-stone-400 mt-0.5">
                                                Responded {{ formatDate(guest.rsvp_at) }}
                                                <span v-if="guest.dietary_notes" class="text-stone-500 font-medium"> · {{ guest.dietary_notes }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span
                                            v-if="guest.status === 'attending'"
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-800 border border-emerald-200/60"
                                        >
                                            <svg class="w-3 h-3 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <span>Attending</span>
                                        </span>
                                        <span
                                            v-else
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-stone-100 text-stone-600 border border-stone-200"
                                        >
                                            <svg class="w-3 h-3 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <line x1="18" y1="6" x2="6" y2="18" />
                                                <line x1="6" y1="6" x2="18" y2="18" />
                                            </svg>
                                            <span>Declined</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="text-center py-10 text-stone-400 text-xs italic">
                                No RSVP responses received yet. Send out invitation links via WhatsApp to begin receiving RSVPs.
                            </div>
                        </div>

                        <div class="pt-4 border-t border-stone-100 mt-4 flex items-center justify-between text-xs text-stone-500">
                            <span>RSVP Summary: <strong>{{ metrics.attending_count }} attending · {{ metrics.declined_count }} declined</strong></span>
                            <Link :href="route('guests.index')" class="text-[#8c6d37] hover:underline font-medium">
                                Manage guest list
                            </Link>
                        </div>
                    </div>

                    <!-- Recent Wishes -->
                    <div class="bg-white rounded-3xl border border-[#EDE8E1] shadow-[0_2px_12px_rgba(0,0,0,0.02)] p-6 sm:p-7 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between pb-4 border-b border-stone-100 mb-4">
                                <div>
                                    <h3 class="font-serif text-lg font-bold text-stone-900">
                                        Blessings &amp; Wishes
                                    </h3>
                                    <p class="text-xs text-stone-400">Warm messages left by guests on the invitation</p>
                                </div>
                                <span class="px-2.5 py-1 rounded-full bg-[#FAF7F0] border border-[#E8DFCB] text-[11px] font-semibold text-[#7A5B22]">
                                    {{ metrics.total_wishes }} messages
                                </span>
                            </div>

                            <div v-if="recentWishes.length > 0" class="space-y-3">
                                <div
                                    v-for="wish in recentWishes"
                                    :key="wish.id"
                                    class="p-4 rounded-2xl bg-[#FAF9F6] border border-[#EBE6DC] relative"
                                >
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-[#FAF7F0] border border-[#E5DAC0] flex items-center justify-center text-[10px] font-bold text-[#7A5B22]">
                                                {{ wish.guest_name?.charAt(0) || 'W' }}
                                            </div>
                                            <h4 class="font-semibold text-stone-900 text-xs">
                                                {{ wish.guest_name }}
                                            </h4>
                                        </div>
                                        <span class="text-[10px] text-stone-400">
                                            {{ formatDate(wish.created_at) }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-stone-600 mt-2 italic leading-relaxed pl-8">
                                        "{{ wish.message }}"
                                    </p>
                                </div>
                            </div>
                            <div v-else class="text-center py-10 text-stone-400 text-xs italic">
                                No guestbook blessings recorded yet. Guest messages will appear here once submitted.
                            </div>
                        </div>

                        <div class="pt-4 border-t border-stone-100 mt-4 text-xs text-stone-400 flex items-center justify-between">
                            <span>Messages are visible to the couple in this dashboard</span>
                            <a :href="previewUrl" target="_blank" class="text-[#8c6d37] hover:underline font-medium">
                                View live guestbook &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
