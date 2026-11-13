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
</script>

<template>
    <Head title="Wedding Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="font-serif text-2xl font-bold leading-tight text-stone-900">
                        {{ settings.bride_name }} &amp; {{ settings.groom_name }}'s Wedding Command Center
                    </h2>
                    <p class="text-xs text-stone-500 mt-0.5">
                        Track invitations, RSVPs, guest list and wedding ceremonies
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <Link
                        :href="route('guests.index')"
                        class="px-4 py-2 rounded-xl bg-amber-600 text-white font-medium text-xs shadow hover:bg-amber-700 transition-colors"
                    >
                        + Manage Guests
                    </Link>
                    <a
                        :href="previewUrl"
                        target="_blank"
                        class="px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-medium text-xs shadow-sm hover:bg-stone-50 transition-colors"
                    >
                        Preview Invitation Card ↗
                    </a>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
                <!-- Metrics Bar -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    <!-- Total Invited -->
                    <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm flex flex-col">
                        <span class="text-xs uppercase tracking-wider font-semibold text-stone-400">Total Invitations</span>
                        <span class="font-display text-3xl font-bold text-stone-800 mt-2">{{ metrics.total_guests }}</span>
                        <span class="text-[11px] text-stone-500 mt-1">Unique links created</span>
                    </div>

                    <!-- Attending Headcount -->
                    <div class="bg-white p-5 rounded-2xl border border-emerald-200 shadow-sm flex flex-col bg-gradient-to-br from-white to-emerald-50/50">
                        <span class="text-xs uppercase tracking-wider font-semibold text-emerald-700">Attending Headcount</span>
                        <span class="font-display text-3xl font-bold text-emerald-800 mt-2">{{ metrics.total_attending_people }}</span>
                        <span class="text-[11px] text-emerald-600 mt-1">From {{ metrics.attending_count }} guest invites</span>
                    </div>

                    <!-- Pending Responses -->
                    <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-sm flex flex-col bg-gradient-to-br from-white to-amber-50/50">
                        <span class="text-xs uppercase tracking-wider font-semibold text-amber-700">Pending RSVP</span>
                        <span class="font-display text-3xl font-bold text-amber-800 mt-2">{{ metrics.pending_count }}</span>
                        <span class="text-[11px] text-amber-600 mt-1">Awaiting response</span>
                    </div>

                    <!-- Declined -->
                    <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm flex flex-col">
                        <span class="text-xs uppercase tracking-wider font-semibold text-rose-500">Declined</span>
                        <span class="font-display text-3xl font-bold text-rose-700 mt-2">{{ metrics.declined_count }}</span>
                        <span class="text-[11px] text-stone-400 mt-1">Cannot attend</span>
                    </div>

                    <!-- Invitations Opened -->
                    <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-sm flex flex-col col-span-2 sm:col-span-1 bg-gradient-to-br from-white to-yellow-50/40">
                        <span class="text-xs uppercase tracking-wider font-semibold text-amber-700">Cards Opened</span>
                        <span class="font-display text-3xl font-bold text-amber-800 mt-2">{{ metrics.opened_count }}</span>
                        <span class="text-[11px] text-stone-500 mt-1">Wax seals unsealed</span>
                    </div>
                </div>

                <!-- Wedding Overview Card -->
                <div class="bg-gradient-to-r from-amber-50 via-yellow-50 to-amber-50 border border-amber-300 rounded-3xl p-6 sm:p-8 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-200/80 text-amber-900 text-xs font-serif uppercase tracking-widest font-semibold mb-2">
                            <span>💍</span> Celebration Details
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-stone-900">
                            {{ settings.bride_name }} &amp; {{ settings.groom_name }}
                        </h3>
                        <p class="text-sm text-stone-600 mt-1">
                            📅 <strong>{{ settings.wedding_date }}</strong> &nbsp;|&nbsp; 📍 {{ settings.venue_name }}
                        </p>
                        <p class="text-xs text-stone-500 mt-2 max-w-xl">
                            {{ settings.our_story }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                        <Link
                            :href="route('settings.index')"
                            class="px-5 py-2.5 rounded-xl bg-white border border-amber-300 text-amber-900 text-xs font-semibold shadow-sm hover:bg-amber-100 transition-colors text-center"
                        >
                            ✏️ Edit Wedding Details
                        </Link>
                        <Link
                            :href="route('guests.index')"
                            class="px-5 py-2.5 rounded-xl bg-amber-600 text-white text-xs font-semibold shadow hover:bg-amber-700 transition-colors text-center"
                        >
                            📋 Send WhatsApp Invites
                        </Link>
                    </div>
                </div>

                <!-- Two-Column Layout: Recent RSVPs & Wishes -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Recent RSVPs -->
                    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-serif text-lg font-bold text-stone-900">
                                Recent RSVP Activity
                            </h3>
                            <Link :href="route('guests.index')" class="text-xs font-semibold text-amber-700 hover:text-amber-900">
                                View all guests &rarr;
                            </Link>
                        </div>

                        <div v-if="recentRsvps.length > 0" class="divide-y divide-stone-100">
                            <div
                                v-for="guest in recentRsvps"
                                :key="guest.id"
                                class="py-3 flex items-center justify-between gap-3"
                            >
                                <div>
                                    <p class="font-medium text-sm text-stone-800">
                                        {{ guest.name }}
                                    </p>
                                    <p class="text-[11px] text-stone-400">
                                        Responded {{ formatDate(guest.rsvp_at) }}
                                        <span v-if="guest.dietary_notes"> • {{ guest.dietary_notes }}</span>
                                    </p>
                                </div>
                                <div class="text-right shrink-0">
                                    <span
                                        class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold"
                                        :class="guest.status === 'attending' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800'"
                                    >
                                        {{ guest.status === 'attending' ? `✓ Attending (${guest.attending_count})` : '✕ Declined' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div v-else class="text-center py-8 text-stone-400 text-xs italic">
                            No RSVP responses yet. Send out invitation links to start receiving responses!
                        </div>
                    </div>

                    <!-- Recent Wishes -->
                    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-serif text-lg font-bold text-stone-900">
                                Latest Blessings &amp; Wishes
                            </h3>
                            <span class="text-xs text-stone-400">
                                {{ metrics.total_wishes }} total wishes
                            </span>
                        </div>

                        <div v-if="recentWishes.length > 0" class="space-y-3">
                            <div
                                v-for="wish in recentWishes"
                                :key="wish.id"
                                class="p-3.5 rounded-xl bg-amber-50/50 border border-amber-200/60"
                            >
                                <div class="flex items-center justify-between gap-2">
                                    <h4 class="font-bold text-stone-800 text-xs">
                                        {{ wish.guest_name }}
                                    </h4>
                                    <span class="text-[10px] text-stone-400">
                                        {{ formatDate(wish.created_at) }}
                                    </span>
                                </div>
                                <p class="text-xs text-stone-600 mt-1 italic">
                                    "{{ wish.message }}"
                                </p>
                            </div>
                        </div>
                        <div v-else class="text-center py-8 text-stone-400 text-xs italic">
                            No guestbook wishes recorded yet.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
