<script setup>
import { ref, watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    guests: { type: Object, required: true },
    filters: { type: Object, default: () => ({ search: '', status: 'all' }) },
    metrics: { type: Object, required: true },
});

// Search & Status filters
const search = ref(props.filters.search || '');
const currentStatus = ref(props.filters.status || 'all');

let searchTimeout = null;
watch(search, () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        applyFilters();
    }, 350);
});

const setStatus = (status) => {
    currentStatus.value = status;
    applyFilters();
};

const applyFilters = () => {
    router.get(
        route('guests.index'),
        { search: search.value, status: currentStatus.value },
        { preserveState: true, replace: true }
    );
};

// Modals
const showAddModal = ref(false);
const showBulkModal = ref(false);
const showEditModal = ref(false);
const guestToEdit = ref(null);

// Add Single Guest Form
const addForm = useForm({
    name: '',
    phone: '',
    custom_greeting: '',
    notes: '',
});

const submitAdd = () => {
    addForm.post(route('guests.store'), {
        onSuccess: () => {
            showAddModal.value = false;
            addForm.reset();
        },
    });
};

// Bulk Add Form
const bulkForm = useForm({
    raw_list: '',
});

const submitBulk = () => {
    bulkForm.post(route('guests.bulk'), {
        onSuccess: () => {
            showBulkModal.value = false;
            bulkForm.reset();
        },
    });
};

// Edit Guest Form
const editForm = useForm({
    id: null,
    name: '',
    phone: '',
    custom_greeting: '',
    status: 'pending',
    dietary_notes: '',
    notes: '',
});

const openEditModal = (guest) => {
    guestToEdit.value = guest;
    editForm.id = guest.id;
    editForm.name = guest.name;
    editForm.phone = guest.phone || '';
    editForm.custom_greeting = guest.custom_greeting || '';
    editForm.status = guest.status;
    editForm.dietary_notes = guest.dietary_notes || '';
    editForm.notes = guest.notes || '';
    showEditModal.value = true;
};

const submitEdit = () => {
    editForm.put(route('guests.update', editForm.id), {
        onSuccess: () => {
            showEditModal.value = false;
        },
    });
};

const deleteGuest = (guest) => {
    if (confirm(`Are you sure you want to delete invitation for ${guest.name}?`)) {
        router.delete(route('guests.destroy', guest.id));
    }
};

// Copy link helper
const copiedId = ref(null);
const copyLink = (guest) => {
    navigator.clipboard.writeText(guest.invitation_url).then(() => {
        copiedId.value = guest.id;
        setTimeout(() => (copiedId.value = null), 2000);
    });
};

const clearSearch = () => {
    search.value = '';
    applyFilters();
};

const updatingStatusId = ref(null);
const quickUpdateStatus = (guest, newStatus) => {
    if (guest.status === newStatus || updatingStatusId.value === guest.id) return;
    updatingStatusId.value = guest.id;
    router.put(
        route('guests.update', guest.id),
        {
            name: guest.name,
            phone: guest.phone,
            custom_greeting: guest.custom_greeting,
            status: newStatus,
            notes: guest.notes,
            dietary_notes: guest.dietary_notes,
            max_guests: guest.max_guests || 1,
        },
        {
            preserveScroll: true,
            onFinish: () => {
                updatingStatusId.value = null;
            },
        }
    );
};

const shareNativeInvite = async (guest) => {
    if (typeof navigator !== 'undefined' && navigator.share) {
        try {
            await navigator.share({
                title: `Wedding Invitation · ${guest.name}`,
                text: `Personal wedding invitation for ${guest.custom_greeting || guest.name}`,
                url: guest.invitation_url,
            });
            return;
        } catch (_) {
            // User cancelled or unsupported
        }
    }
    copyLink(guest);
};

const formatDate = (dateStr) => {
    if (!dateStr) return null;
    try {
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' });
    } catch {
        return dateStr;
    }
};
</script>

<template>
    <Head title="Guest List &amp; Invitations" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-[#c5a059]"></span>
                        <span class="text-[10px] sm:text-[11px] font-semibold uppercase tracking-widest text-stone-500">Guest Directory</span>
                    </div>
                    <h2 class="font-serif text-xl sm:text-2xl font-bold leading-tight text-stone-900 mt-0.5 sm:mt-1">
                        Personal Guest List &amp; Invitations
                    </h2>
                    <p class="text-xs text-stone-500 mt-0.5 hidden sm:block">
                        Create personalized invitation links, send via WhatsApp, and track attendance responses
                    </p>
                </div>
                <div class="grid grid-cols-2 sm:flex sm:items-center gap-2 sm:gap-2.5">
                    <button
                        type="button"
                        @click="showBulkModal = true"
                        class="px-3 py-2.5 sm:px-3.5 sm:py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-medium text-xs shadow-2xs hover:bg-stone-50 active:bg-stone-100 transition-colors flex items-center justify-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5 text-stone-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1" />
                        </svg>
                        <span>Bulk Import</span>
                    </button>
                    <button
                        type="button"
                        @click="showAddModal = true"
                        class="px-3.5 py-2.5 sm:px-4 sm:py-2 rounded-xl bg-[#15253b] hover:bg-[#0f1b2b] active:scale-[0.98] text-white font-medium text-xs shadow-2xs transition-all flex items-center justify-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5 text-[#d8ab43] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        <span>Add Guest</span>
                    </button>
                </div>
            </div>
        </template>

        <div class="py-5 sm:py-8">
            <div class="mx-auto max-w-7xl px-3.5 sm:px-6 lg:px-8 space-y-4 sm:space-y-6">
                <!-- Summary Metrics Bar (Filterable) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4">
                    <div
                        @click="setStatus('all')"
                        class="bg-white p-3 sm:p-4 rounded-2xl border cursor-pointer transition-all shadow-[0_2px_8px_rgba(0,0,0,0.02)] active:scale-[0.98]"
                        :class="currentStatus === 'all' ? 'border-[#15253b] ring-2 ring-[#15253b]' : 'border-[#EDE8E1] hover:border-stone-400'"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] sm:text-[11px] uppercase tracking-wider font-semibold text-stone-500">Total Guests</span>
                            <span v-if="currentStatus === 'all'" class="w-2 h-2 rounded-full bg-[#15253b]"></span>
                        </div>
                        <div class="font-serif text-xl sm:text-2xl font-bold text-stone-900 mt-1 sm:mt-2">{{ metrics.total_guests }}</div>
                        <span class="text-[10px] sm:text-[11px] text-stone-400 mt-0.5 block truncate">All invitations</span>
                    </div>

                    <div
                        @click="setStatus('attending')"
                        class="bg-white p-3 sm:p-4 rounded-2xl border cursor-pointer transition-all shadow-[0_2px_8px_rgba(0,0,0,0.02)] active:scale-[0.98]"
                        :class="currentStatus === 'attending' ? 'border-emerald-600 ring-2 ring-emerald-600' : 'border-emerald-100 hover:border-emerald-300'"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] sm:text-[11px] uppercase tracking-wider font-semibold text-emerald-800">Attending</span>
                            <span v-if="currentStatus === 'attending'" class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        </div>
                        <div class="font-serif text-xl sm:text-2xl font-bold text-emerald-900 mt-1 sm:mt-2">
                            {{ metrics.attending_count }}
                        </div>
                        <span class="text-[10px] sm:text-[11px] text-emerald-700 mt-0.5 block truncate">Confirmed attending</span>
                    </div>

                    <div
                        @click="setStatus('pending')"
                        class="bg-white p-3 sm:p-4 rounded-2xl border cursor-pointer transition-all shadow-[0_2px_8px_rgba(0,0,0,0.02)] active:scale-[0.98]"
                        :class="currentStatus === 'pending' ? 'border-amber-600 ring-2 ring-amber-600' : 'border-amber-100 hover:border-amber-300'"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] sm:text-[11px] uppercase tracking-wider font-semibold text-amber-800">Pending</span>
                            <span v-if="currentStatus === 'pending'" class="w-2 h-2 rounded-full bg-amber-600"></span>
                        </div>
                        <div class="font-serif text-xl sm:text-2xl font-bold text-amber-900 mt-1 sm:mt-2">{{ metrics.pending_count }}</div>
                        <span class="text-[10px] sm:text-[11px] text-amber-700 mt-0.5 block truncate">Awaiting response</span>
                    </div>

                    <div
                        @click="setStatus('declined')"
                        class="bg-white p-3 sm:p-4 rounded-2xl border cursor-pointer transition-all shadow-[0_2px_8px_rgba(0,0,0,0.02)] active:scale-[0.98]"
                        :class="currentStatus === 'declined' ? 'border-stone-600 ring-2 ring-stone-600' : 'border-[#EDE8E1] hover:border-stone-400'"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] sm:text-[11px] uppercase tracking-wider font-semibold text-stone-500">Declined</span>
                            <span v-if="currentStatus === 'declined'" class="w-2 h-2 rounded-full bg-stone-600"></span>
                        </div>
                        <div class="font-serif text-xl sm:text-2xl font-bold text-stone-800 mt-1 sm:mt-2">{{ metrics.declined_count }}</div>
                        <span class="text-[10px] sm:text-[11px] text-stone-400 mt-0.5 block truncate">Cannot attend</span>
                    </div>
                </div>

                <!-- Search and Filters Bar -->
                <div class="bg-white p-3 sm:p-4 rounded-2xl border border-[#EDE8E1] shadow-[0_2px_8px_rgba(0,0,0,0.02)] space-y-3 sm:space-y-0 sm:flex sm:items-center sm:justify-between sm:gap-4">
                    <div class="relative w-full sm:w-88">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </span>
                        <input
                            type="text"
                            v-model="search"
                            placeholder="Search name, greeting, phone..."
                            class="w-full pl-10 pr-9 py-2.5 sm:py-2 text-sm sm:text-xs rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059] transition-colors"
                        />
                        <button
                            v-if="search"
                            type="button"
                            @click="clearSearch"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-600"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>

                    <!-- Status Filter Tabs (Touch scrollable on mobile) -->
                    <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 w-full sm:w-auto">
                        <button
                            v-for="st in [
                                { label: 'All', val: 'all', count: metrics.total_guests },
                                { label: 'Attending', val: 'attending', count: metrics.attending_count },
                                { label: 'Pending', val: 'pending', count: metrics.pending_count },
                                { label: 'Declined', val: 'declined', count: metrics.declined_count },
                            ]"
                            :key="st.val"
                            type="button"
                            @click="setStatus(st.val)"
                            class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors whitespace-nowrap flex items-center gap-1.5 active:scale-95"
                            :class="currentStatus === st.val ? 'bg-[#15253b] text-white shadow-2xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200'"
                        >
                            <span>{{ st.label }}</span>
                            <span class="text-[10px] opacity-75 font-mono">({{ st.count }})</span>
                        </button>
                    </div>
                </div>

                <!-- Mobile Guest Cards View (Shown on mobile screens < md) -->
                <div class="block md:hidden space-y-3">
                    <div
                        v-for="guest in guests.data"
                        :key="'mobile-' + guest.id"
                        class="bg-white rounded-2xl border border-[#EDE8E1] p-4 shadow-[0_2px_10px_rgba(0,0,0,0.03)] space-y-3 relative transition-all"
                    >
                        <!-- Top Row: Name, Status Badge, Cathedral Door Status -->
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <h3 class="font-serif font-bold text-stone-900 text-base leading-snug">
                                        {{ guest.name }}
                                    </h3>
                                    <span
                                        v-if="guest.opened_at"
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#FAF7F0] text-[#7A5B22] border border-[#E8DFCB]"
                                        title="Guest opened invitation"
                                    >
                                        <svg class="w-3 h-3 text-[#c5a059]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        <span>Opened</span>
                                    </span>
                                </div>

                                <!-- Custom Salutation / Greeting & Notes -->
                                <p v-if="guest.custom_greeting && guest.custom_greeting !== guest.name" class="text-xs text-[#7A5B22] italic mt-0.5">
                                    "{{ guest.custom_greeting }}"
                                </p>
                                <p v-if="guest.notes" class="text-[11px] text-stone-500 mt-0.5">
                                    Note: {{ guest.notes }}
                                </p>
                                <p v-if="guest.dietary_notes" class="text-[11px] text-amber-700 font-medium mt-0.5">
                                    Diet: {{ guest.dietary_notes }}
                                </p>
                            </div>

                            <!-- RSVP Status Pill -->
                            <span
                                class="shrink-0 inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold"
                                :class="{
                                    'bg-emerald-50 text-emerald-800 border border-emerald-200': guest.status === 'attending',
                                    'bg-amber-50 text-amber-800 border border-amber-200': guest.status === 'pending',
                                    'bg-stone-100 text-stone-600 border border-stone-200': guest.status === 'declined',
                                }"
                            >
                                <span class="w-1.5 h-1.5 rounded-full" :class="{
                                    'bg-emerald-500': guest.status === 'attending',
                                    'bg-amber-500': guest.status === 'pending',
                                    'bg-stone-400': guest.status === 'declined',
                                }"></span>
                                <span class="capitalize">{{ guest.status }}</span>
                            </span>
                        </div>

                        <!-- Contact & Card Preview Row -->
                        <div class="flex items-center justify-between text-xs text-stone-600 bg-[#FAF9F6] rounded-xl px-3 py-2 border border-[#EDE8E1]">
                            <div class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-stone-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <a v-if="guest.phone" :href="`tel:${guest.phone}`" class="font-mono font-medium text-stone-900 underline decoration-stone-300">
                                    {{ guest.phone }}
                                </a>
                                <span v-else class="text-stone-400 italic">No phone added</span>
                            </div>

                            <a
                                :href="guest.invitation_url"
                                target="_blank"
                                class="text-[11px] font-semibold text-[#7A5B22] hover:text-[#5e471d] flex items-center gap-1"
                            >
                                <span>Preview Card</span>
                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M7 17 17 7M7 7h10v10" />
                                </svg>
                            </a>
                        </div>

                        <!-- Primary Action Row: WhatsApp + Copy Link -->
                        <div class="grid grid-cols-5 gap-2 pt-0.5">
                            <a
                                :href="guest.whatsapp_url"
                                target="_blank"
                                class="col-span-3 h-11 rounded-xl bg-[#25D366] hover:bg-[#20ba59] active:scale-[0.98] text-white font-bold text-xs shadow-xs flex items-center justify-center gap-2 transition-all"
                            >
                                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                <span>Send WhatsApp</span>
                            </a>

                            <button
                                type="button"
                                @click="copyLink(guest)"
                                class="col-span-2 h-11 rounded-xl border border-stone-200 bg-white active:bg-stone-50 active:scale-[0.98] text-stone-700 font-semibold text-xs shadow-2xs flex items-center justify-center gap-1.5 transition-all"
                            >
                                <svg v-if="copiedId === guest.id" class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <svg v-else class="w-4 h-4 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                </svg>
                                <span>{{ copiedId === guest.id ? 'Copied!' : 'Copy Link' }}</span>
                            </button>
                        </div>

                        <!-- Quick 1-Tap RSVP Status Switcher -->
                        <div class="pt-2 border-t border-stone-100 flex items-center justify-between gap-1 text-[11px]">
                            <span class="text-stone-400 font-medium">Quick Status:</span>
                            <div class="flex items-center gap-1">
                                <button
                                    type="button"
                                    @click="quickUpdateStatus(guest, 'attending')"
                                    :disabled="updatingStatusId === guest.id"
                                    class="px-2.5 py-1 rounded-lg font-medium transition-all active:scale-95 disabled:opacity-50"
                                    :class="guest.status === 'attending' ? 'bg-emerald-600 text-white shadow-2xs' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100'"
                                >
                                    Attending
                                </button>
                                <button
                                    type="button"
                                    @click="quickUpdateStatus(guest, 'pending')"
                                    :disabled="updatingStatusId === guest.id"
                                    class="px-2.5 py-1 rounded-lg font-medium transition-all active:scale-95 disabled:opacity-50"
                                    :class="guest.status === 'pending' ? 'bg-amber-600 text-white shadow-2xs' : 'bg-amber-50 text-amber-800 hover:bg-amber-100'"
                                >
                                    Pending
                                </button>
                                <button
                                    type="button"
                                    @click="quickUpdateStatus(guest, 'declined')"
                                    :disabled="updatingStatusId === guest.id"
                                    class="px-2.5 py-1 rounded-lg font-medium transition-all active:scale-95 disabled:opacity-50"
                                    :class="guest.status === 'declined' ? 'bg-stone-700 text-white shadow-2xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200'"
                                >
                                    Declined
                                </button>
                            </div>
                        </div>

                        <!-- Card Footer: Share, Edit & Delete -->
                        <div class="pt-2 border-t border-dashed border-stone-100 flex items-center justify-between text-xs text-stone-500">
                            <button
                                type="button"
                                @click="openEditModal(guest)"
                                class="py-1 px-2 rounded-lg hover:bg-stone-100 text-stone-700 font-medium flex items-center gap-1.5"
                            >
                                <svg class="w-3.5 h-3.5 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                <span>Edit</span>
                            </button>

                            <div class="flex items-center gap-2">
                                <button
                                    type="button"
                                    @click="shareNativeInvite(guest)"
                                    class="py-1 px-2 rounded-lg hover:bg-stone-100 text-[#7A5B22] font-medium flex items-center gap-1"
                                    title="Share invite via phone apps"
                                >
                                    <svg class="w-3.5 h-3.5 text-[#c5a059]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="18" cy="5" r="3"></circle>
                                        <circle cx="6" cy="12" r="3"></circle>
                                        <circle cx="18" cy="19" r="3"></circle>
                                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                    </svg>
                                    <span>Share</span>
                                </button>

                                <button
                                    type="button"
                                    @click="deleteGuest(guest)"
                                    class="py-1 px-2 rounded-lg hover:bg-rose-50 text-stone-400 hover:text-rose-600 flex items-center gap-1"
                                    title="Delete guest"
                                >
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Empty State -->
                    <div v-if="guests.data.length === 0" class="p-8 text-center bg-white rounded-2xl border border-stone-200 text-stone-400 text-xs italic">
                        No guests found matching your criteria. Tap "+ Add Guest" to create one!
                    </div>
                </div>

                <!-- Desktop Guests Table (Hidden on small screens < md) -->
                <div class="hidden md:block bg-white rounded-3xl border border-[#EDE8E1] shadow-[0_2px_12px_rgba(0,0,0,0.02)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-[#EDE8E1] bg-[#FAF9F6] text-[11px] font-semibold text-stone-500 uppercase tracking-wider">
                                    <th class="py-4 px-5">Guest Details</th>
                                    <th class="py-4 px-4">Contact</th>
                                    <th class="py-4 px-4">RSVP Status</th>
                                    <th class="py-4 px-4">Cathedral Doors</th>
                                    <th class="py-4 px-5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#F0EDE6] text-xs text-stone-700">
                                <tr
                                    v-for="guest in guests.data"
                                    :key="guest.id"
                                    class="hover:bg-[#FAF9F6]/80 transition-colors"
                                >
                                    <!-- Guest Name -->
                                    <td class="py-4 px-5">
                                        <div class="font-semibold text-stone-900 text-sm">
                                            {{ guest.name }}
                                        </div>
                                        <div v-if="guest.custom_greeting && guest.custom_greeting !== guest.name" class="text-[11px] text-[#7A5B22] italic mt-0.5">
                                            "{{ guest.custom_greeting }}"
                                        </div>
                                        <div v-if="guest.notes" class="text-[10px] text-stone-400 mt-0.5">
                                            Note: {{ guest.notes }}
                                        </div>
                                    </td>

                                    <!-- Phone -->
                                    <td class="py-4 px-4">
                                        <span v-if="guest.phone" class="font-mono text-xs text-stone-800">
                                            {{ guest.phone }}
                                        </span>
                                        <span v-else class="text-stone-400 italic text-[11px]">
                                            —
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-medium"
                                            :class="{
                                                'bg-emerald-50 text-emerald-800 border border-emerald-200/60': guest.status === 'attending',
                                                'bg-amber-50 text-amber-800 border border-amber-200/60': guest.status === 'pending',
                                                'bg-stone-100 text-stone-600 border border-stone-200': guest.status === 'declined',
                                            }"
                                        >
                                            <span v-if="guest.status === 'attending'" class="flex items-center gap-1">
                                                <svg class="w-3 h-3 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                Attending
                                            </span>
                                            <span v-else-if="guest.status === 'declined'" class="flex items-center gap-1">
                                                <svg class="w-3 h-3 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <line x1="18" y1="6" x2="6" y2="18" />
                                                    <line x1="6" y1="6" x2="18" y2="18" />
                                                </svg>
                                                Declined
                                            </span>
                                            <span v-else class="flex items-center gap-1">
                                                <svg class="w-3 h-3 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                Pending
                                            </span>
                                        </span>
                                        <div v-if="guest.dietary_notes" class="text-[11px] text-stone-500 mt-1 max-w-[150px] truncate" :title="guest.dietary_notes">
                                            Diet: {{ guest.dietary_notes }}
                                        </div>
                                    </td>

                                    <!-- Opened -->
                                    <td class="py-4 px-4">
                                        <span
                                            v-if="guest.opened_at"
                                            class="inline-flex items-center gap-1.5 text-[11px] text-[#7A5B22] font-medium"
                                            :title="formatDate(guest.opened_at)"
                                        >
                                            <svg class="w-3.5 h-3.5 text-[#c5a059]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M22 13V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h9" />
                                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                                <path d="m16 19 2 2 4-4" />
                                            </svg>
                                            <span>Opened</span>
                                        </span>
                                        <span v-else class="text-stone-400 text-[11px] italic">
                                            Unopened
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-4 px-5 text-right">
                                        <div class="inline-flex items-center gap-1.5">
                                            <!-- One-Click WhatsApp Share Button -->
                                            <a
                                                :href="guest.whatsapp_url"
                                                target="_blank"
                                                class="px-2.5 py-1.5 rounded-lg bg-[#25D366] hover:bg-[#20ba59] text-white font-medium text-[11px] shadow-2xs transition-all flex items-center gap-1.5"
                                                title="Send WhatsApp invitation message with link"
                                            >
                                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                                </svg>
                                                <span>WhatsApp</span>
                                            </a>

                                            <!-- Copy Link Button -->
                                            <button
                                                type="button"
                                                @click="copyLink(guest)"
                                                class="px-2.5 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-700 font-medium text-[11px] shadow-2xs transition-colors flex items-center gap-1.5"
                                                :title="guest.invitation_url"
                                            >
                                                <svg v-if="copiedId === guest.id" class="w-3.5 h-3.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                <svg v-else class="w-3.5 h-3.5 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                                </svg>
                                                <span>{{ copiedId === guest.id ? 'Copied' : 'Copy' }}</span>
                                            </button>

                                            <!-- Preview Dedicated Card -->
                                            <a
                                                :href="guest.invitation_url"
                                                target="_blank"
                                                class="p-1.5 rounded-lg border border-transparent hover:border-stone-200 hover:bg-white text-stone-500 hover:text-stone-900 transition-colors"
                                                title="View card as this guest"
                                            >
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                            </a>

                                            <!-- Edit Button -->
                                            <button
                                                type="button"
                                                @click="openEditModal(guest)"
                                                class="p-1.5 rounded-lg border border-transparent hover:border-stone-200 hover:bg-white text-stone-500 hover:text-[#7A5B22] transition-colors"
                                                title="Edit guest details"
                                            >
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                            </button>

                                            <!-- Delete Button -->
                                            <button
                                                type="button"
                                                @click="deleteGuest(guest)"
                                                class="p-1.5 rounded-lg border border-transparent hover:border-rose-200 hover:bg-rose-50 text-stone-400 hover:text-rose-600 transition-colors"
                                                title="Delete guest"
                                            >
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr v-if="guests.data.length === 0">
                                    <td colspan="5" class="py-14 text-center text-stone-400 text-xs italic">
                                        No guests found matching your filter criteria. Click "+ Add New Guest" above to begin.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination Links (Responsive) -->
                <div
                    v-if="guests.links && guests.links.length > 3"
                    class="p-4 rounded-2xl border border-[#EDE8E1] bg-white shadow-2xs flex flex-col sm:flex-row items-center justify-between gap-3 text-xs"
                >
                    <span class="text-stone-500 text-center sm:text-left">
                        Showing {{ guests.from || 0 }} to {{ guests.to || 0 }} of {{ guests.total }} guests
                    </span>
                    <div class="flex items-center gap-1 flex-wrap justify-center">
                        <Component
                            :is="link.url ? Link : 'span'"
                            v-for="(link, i) in guests.links"
                            :key="i"
                            :href="link.url"
                            v-html="link.label"
                            class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors"
                            :class="{
                                'bg-[#15253b] text-white shadow-2xs': link.active,
                                'text-stone-600 hover:bg-stone-200/70': !link.active && link.url,
                                'text-stone-300 pointer-events-none': !link.url,
                            }"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Floating Action Button: Quick Add Guest -->
        <button
            type="button"
            @click="showAddModal = true"
            class="sm:hidden fixed bottom-20 right-4 z-30 px-4 py-3 rounded-full bg-[#15253b] text-white shadow-xl ring-2 ring-[#c5a059]/40 flex items-center gap-2 active:scale-95 transition-transform"
            aria-label="Add New Guest"
        >
            <svg class="w-4 h-4 text-[#d8ab43]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            <span class="text-xs font-bold tracking-wide">Add Guest</span>
        </button>

        <!-- Add Guest Modal -->
        <div v-if="showAddModal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/50 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-md w-full p-5 sm:p-7 shadow-2xl border border-[#EDE8E1] max-h-[92vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-stone-100">
                    <div>
                        <h3 class="font-serif text-lg font-bold text-stone-900">Add New Guest</h3>
                        <p class="text-xs text-stone-400">Generate a personalized digital invitation</p>
                    </div>
                    <button @click="showAddModal = false" class="text-stone-400 hover:text-stone-600 p-2 rounded-lg">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="submitAdd" class="space-y-3.5 text-xs">
                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Guest Name *</label>
                        <input
                            type="text"
                            v-model="addForm.name"
                            required
                            placeholder="e.g. Rahul &amp; Priya Sharma"
                            class="w-full text-sm sm:text-xs py-2.5 sm:py-2 px-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                        />
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Custom Salutation / Greeting (Optional)</label>
                        <input
                            type="text"
                            v-model="addForm.custom_greeting"
                            placeholder="e.g. Respected Sharma Ji &amp; Family"
                            class="w-full text-sm sm:text-xs py-2.5 sm:py-2 px-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                        />
                        <p class="text-[10px] text-stone-400 mt-1">Optional subtitle. The Guest Name above will always be the main name displayed.</p>
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Phone / WhatsApp Number</label>
                        <input
                            type="tel"
                            v-model="addForm.phone"
                            placeholder="+94771234567"
                            class="w-full text-sm sm:text-xs py-2.5 sm:py-2 px-3 font-mono rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                        />
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Internal Note (Optional)</label>
                        <textarea
                            v-model="addForm.notes"
                            rows="2"
                            placeholder="e.g. Bride's colleague, reserved table 4..."
                            class="w-full text-sm sm:text-xs py-2 px-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                        ></textarea>
                    </div>

                    <div class="mt-5 flex items-center justify-end gap-2.5 pt-3 border-t border-stone-100">
                        <button
                            type="button"
                            @click="showAddModal = false"
                            class="px-4 py-2.5 rounded-xl text-stone-600 hover:bg-stone-100 font-medium transition-colors"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="addForm.processing"
                            class="px-5 py-2.5 rounded-xl bg-[#15253b] hover:bg-[#0f1b2b] active:scale-95 text-white font-medium shadow-2xs disabled:opacity-50 transition-all"
                        >
                            {{ addForm.processing ? 'Creating...' : 'Create Invitation' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bulk Add Modal -->
        <div v-if="showBulkModal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/50 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-lg w-full p-5 sm:p-7 shadow-2xl border border-[#EDE8E1] max-h-[92vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-stone-100">
                    <div>
                        <h3 class="font-serif text-lg font-bold text-stone-900">Bulk Import Guests</h3>
                        <p class="text-xs text-stone-400">Quickly add multiple guests at once</p>
                    </div>
                    <button @click="showBulkModal = false" class="text-stone-400 hover:text-stone-600 p-2 rounded-lg">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>

                <p class="text-xs text-stone-600 mb-3 leading-relaxed">
                    Paste one guest per line. Format: <code class="bg-stone-100 px-1.5 py-0.5 rounded text-stone-800">Guest Name, Phone</code>
                </p>

                <form @submit.prevent="submitBulk" class="space-y-4 text-xs">
                    <div>
                        <textarea
                            v-model="bulkForm.raw_list"
                            rows="7"
                            required
                            placeholder="Dr. Rajesh Fernando &amp; Family, +94771234567&#10;Kamal &amp; Nadeesha, +94779876543&#10;Suresh Perera"
                            class="w-full font-mono text-sm sm:text-xs p-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059] bg-[#FAF9F6]"
                        ></textarea>
                    </div>

                    <div class="mt-5 flex items-center justify-end gap-2.5 pt-3 border-t border-stone-100">
                        <button
                            type="button"
                            @click="showBulkModal = false"
                            class="px-4 py-2.5 rounded-xl text-stone-600 hover:bg-stone-100 font-medium transition-colors"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="bulkForm.processing"
                            class="px-5 py-2.5 rounded-xl bg-[#15253b] hover:bg-[#0f1b2b] active:scale-95 text-white font-medium shadow-2xs disabled:opacity-50 transition-all"
                        >
                            {{ bulkForm.processing ? 'Importing...' : 'Add All Guests' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Guest Modal -->
        <div v-if="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/50 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-md w-full p-5 sm:p-7 shadow-2xl border border-[#EDE8E1] max-h-[92vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-stone-100">
                    <div>
                        <h3 class="font-serif text-lg font-bold text-stone-900">Edit Guest Details</h3>
                        <p class="text-xs text-stone-400">Update RSVP status, salutation, or notes</p>
                    </div>
                    <button @click="showEditModal = false" class="text-stone-400 hover:text-stone-600 p-2 rounded-lg">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="submitEdit" class="space-y-3.5 text-xs">
                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Guest Name</label>
                        <input
                            type="text"
                            v-model="editForm.name"
                            required
                            class="w-full text-sm sm:text-xs py-2.5 sm:py-2 px-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                        />
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Custom Salutation / Greeting on Invitation</label>
                        <input
                            type="text"
                            v-model="editForm.custom_greeting"
                            class="w-full text-sm sm:text-xs py-2.5 sm:py-2 px-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                        />
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Phone / WhatsApp</label>
                            <input
                                type="tel"
                                v-model="editForm.phone"
                                class="w-full text-sm sm:text-xs py-2.5 sm:py-2 px-3 font-mono rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                            />
                        </div>
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">RSVP Status</label>
                            <select
                                v-model="editForm.status"
                                class="w-full text-sm sm:text-xs py-2.5 sm:py-2 px-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                            >
                                <option value="pending">Pending</option>
                                <option value="attending">Attending</option>
                                <option value="declined">Declined</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Dietary Preferences</label>
                        <input
                            type="text"
                            v-model="editForm.dietary_notes"
                            placeholder="e.g. Vegetarian, Non-alcoholic"
                            class="w-full text-sm sm:text-xs py-2.5 sm:py-2 px-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                        />
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Internal Notes</label>
                        <textarea
                            v-model="editForm.notes"
                            rows="2"
                            class="w-full text-sm sm:text-xs py-2 px-3 rounded-xl border border-stone-200 focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059]"
                        ></textarea>
                    </div>

                    <div class="mt-5 flex items-center justify-end gap-2.5 pt-3 border-t border-stone-100">
                        <button
                            type="button"
                            @click="showEditModal = false"
                            class="px-4 py-2.5 rounded-xl text-stone-600 hover:bg-stone-100 font-medium transition-colors"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="editForm.processing"
                            class="px-5 py-2.5 rounded-xl bg-[#15253b] hover:bg-[#0f1b2b] active:scale-95 text-white font-medium shadow-2xs disabled:opacity-50 transition-all"
                        >
                            {{ editForm.processing ? 'Saving...' : 'Save Changes' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
