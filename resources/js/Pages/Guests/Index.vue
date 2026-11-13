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
watch(search, (newVal) => {
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
    max_guests: 2,
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
    default_max_guests: 2,
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
    max_guests: 1,
    status: 'pending',
    attending_count: 0,
    dietary_notes: '',
    notes: '',
});

const openEditModal = (guest) => {
    guestToEdit.value = guest;
    editForm.id = guest.id;
    editForm.name = guest.name;
    editForm.phone = guest.phone || '';
    editForm.custom_greeting = guest.custom_greeting || '';
    editForm.max_guests = guest.max_guests;
    editForm.status = guest.status;
    editForm.attending_count = guest.attending_count;
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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="font-serif text-2xl font-bold leading-tight text-stone-900">
                        Guest List &amp; Personal Invitations
                    </h2>
                    <p class="text-xs text-stone-500 mt-0.5">
                        Generate dedicated invitation links, send via WhatsApp, and monitor RSVPs
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        @click="showBulkModal = true"
                        class="px-3.5 py-2 rounded-xl bg-white border border-stone-300 text-stone-700 font-medium text-xs shadow-sm hover:bg-stone-50 transition-colors"
                    >
                        📋 Bulk Add Guests
                    </button>
                    <button
                        type="button"
                        @click="showAddModal = true"
                        class="px-4 py-2 rounded-xl bg-amber-600 text-white font-medium text-xs shadow hover:bg-amber-700 transition-colors"
                    >
                        + Add Guest
                    </button>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6">
                <!-- Summary Metrics Bar -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div
                        @click="setStatus('all')"
                        class="bg-white p-4 rounded-xl border cursor-pointer transition-all"
                        :class="currentStatus === 'all' ? 'border-amber-500 ring-2 ring-amber-400/20 shadow-sm' : 'border-stone-200 hover:border-amber-300'"
                    >
                        <span class="text-[11px] uppercase tracking-wider font-semibold text-stone-400">Total Guests</span>
                        <div class="font-display text-2xl font-bold text-stone-800 mt-1">{{ metrics.total_guests }}</div>
                    </div>

                    <div
                        @click="setStatus('attending')"
                        class="bg-white p-4 rounded-xl border cursor-pointer transition-all"
                        :class="currentStatus === 'attending' ? 'border-emerald-500 ring-2 ring-emerald-400/20 shadow-sm' : 'border-stone-200 hover:border-emerald-300'"
                    >
                        <span class="text-[11px] uppercase tracking-wider font-semibold text-emerald-700">Attending (Headcount)</span>
                        <div class="font-display text-2xl font-bold text-emerald-800 mt-1">
                            {{ metrics.total_attending_people }}
                            <span class="text-xs text-stone-400 font-normal">({{ metrics.attending_count }} invites)</span>
                        </div>
                    </div>

                    <div
                        @click="setStatus('pending')"
                        class="bg-white p-4 rounded-xl border cursor-pointer transition-all"
                        :class="currentStatus === 'pending' ? 'border-amber-500 ring-2 ring-amber-400/20 shadow-sm' : 'border-stone-200 hover:border-amber-300'"
                    >
                        <span class="text-[11px] uppercase tracking-wider font-semibold text-amber-700">Pending</span>
                        <div class="font-display text-2xl font-bold text-amber-800 mt-1">{{ metrics.pending_count }}</div>
                    </div>

                    <div
                        @click="setStatus('declined')"
                        class="bg-white p-4 rounded-xl border cursor-pointer transition-all"
                        :class="currentStatus === 'declined' ? 'border-rose-500 ring-2 ring-rose-400/20 shadow-sm' : 'border-stone-200 hover:border-rose-300'"
                    >
                        <span class="text-[11px] uppercase tracking-wider font-semibold text-rose-600">Declined</span>
                        <div class="font-display text-2xl font-bold text-rose-800 mt-1">{{ metrics.declined_count }}</div>
                    </div>
                </div>

                <!-- Search and Filters -->
                <div class="bg-white p-4 rounded-2xl border border-stone-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="relative w-full sm:w-80">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400 text-sm">
                            🔍
                        </span>
                        <input
                            type="text"
                            v-model="search"
                            placeholder="Search by name, greeting, phone..."
                            class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        />
                    </div>

                    <!-- Status Filter Tabs -->
                    <div class="flex items-center gap-1.5 self-start sm:self-auto overflow-x-auto w-full sm:w-auto">
                        <button
                            v-for="st in [
                                { label: 'All', val: 'all' },
                                { label: 'Attending', val: 'attending' },
                                { label: 'Pending', val: 'pending' },
                                { label: 'Declined', val: 'declined' },
                            ]"
                            :key="st.val"
                            type="button"
                            @click="setStatus(st.val)"
                            class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors whitespace-nowrap"
                            :class="currentStatus === st.val ? 'bg-amber-600 text-white shadow-sm' : 'bg-stone-100 text-stone-600 hover:bg-stone-200'"
                        >
                            {{ st.label }}
                        </button>
                    </div>
                </div>

                <!-- Guests Table -->
                <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-stone-200 bg-stone-50/70 text-[11px] font-semibold text-stone-500 uppercase tracking-wider">
                                    <th class="py-3.5 px-4">Guest Details</th>
                                    <th class="py-3.5 px-4">Contact</th>
                                    <th class="py-3.5 px-4">Party Size</th>
                                    <th class="py-3.5 px-4">RSVP Status</th>
                                    <th class="py-3.5 px-4">Card Opened</th>
                                    <th class="py-3.5 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100 text-xs text-stone-700">
                                <tr
                                    v-for="guest in guests.data"
                                    :key="guest.id"
                                    class="hover:bg-amber-50/30 transition-colors"
                                >
                                    <!-- Guest Name -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-stone-900 text-sm">
                                            {{ guest.name }}
                                        </div>
                                        <div v-if="guest.custom_greeting && guest.custom_greeting !== guest.name" class="text-[11px] text-amber-800 italic mt-0.5">
                                            "{{ guest.custom_greeting }}"
                                        </div>
                                        <div v-if="guest.notes" class="text-[10px] text-stone-400 mt-0.5">
                                            Note: {{ guest.notes }}
                                        </div>
                                    </td>

                                    <!-- Phone -->
                                    <td class="py-3.5 px-4">
                                        <span v-if="guest.phone" class="font-mono text-xs text-stone-800">
                                            {{ guest.phone }}
                                        </span>
                                        <span v-else class="text-stone-400 italic text-[11px]">
                                            Not provided
                                        </span>
                                    </td>

                                    <!-- Max & Attending Count -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-medium">
                                            Max: {{ guest.max_guests }}
                                        </div>
                                        <div v-if="guest.status === 'attending'" class="text-[11px] text-emerald-700 font-semibold">
                                            Attending: {{ guest.attending_count }}
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-4">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold"
                                            :class="{
                                                'bg-emerald-100 text-emerald-800': guest.status === 'attending',
                                                'bg-amber-100 text-amber-800': guest.status === 'pending',
                                                'bg-rose-100 text-rose-800': guest.status === 'declined',
                                            }"
                                        >
                                            <span v-if="guest.status === 'attending'">✓ Attending</span>
                                            <span v-else-if="guest.status === 'declined'">✕ Declined</span>
                                            <span v-else>⏳ Pending</span>
                                        </span>
                                        <div v-if="guest.dietary_notes" class="text-[10px] text-stone-500 mt-1 max-w-[140px] truncate" :title="guest.dietary_notes">
                                            🍽️ {{ guest.dietary_notes }}
                                        </div>
                                    </td>

                                    <!-- Opened -->
                                    <td class="py-3.5 px-4">
                                        <span
                                            v-if="guest.opened_at"
                                            class="inline-flex items-center gap-1 text-[11px] text-emerald-700 font-medium"
                                            :title="guest.opened_at"
                                        >
                                            <span>💌 Opened</span>
                                        </span>
                                        <span v-else class="text-stone-400 text-[11px] italic">
                                            Unopened
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-3.5 px-4 text-right">
                                        <div class="inline-flex items-center gap-1.5">
                                            <!-- One-Click WhatsApp Share Button -->
                                            <a
                                                :href="guest.whatsapp_url"
                                                target="_blank"
                                                class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-[11px] shadow-sm transition-all flex items-center gap-1"
                                                title="Send WhatsApp invitation message with link"
                                            >
                                                <span>💬</span> WhatsApp
                                            </a>

                                            <!-- Copy Link Button -->
                                            <button
                                                type="button"
                                                @click="copyLink(guest)"
                                                class="px-2.5 py-1 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-700 font-medium text-[11px] transition-colors"
                                                :title="guest.invitation_url"
                                            >
                                                {{ copiedId === guest.id ? '✓ Copied' : '🔗 Link' }}
                                            </button>

                                            <!-- Preview Dedicated Card -->
                                            <a
                                                :href="guest.invitation_url"
                                                target="_blank"
                                                class="p-1 rounded-lg hover:bg-stone-100 text-stone-500 hover:text-stone-900"
                                                title="View card as guest"
                                            >
                                                👁️
                                            </a>

                                            <!-- Edit Button -->
                                            <button
                                                type="button"
                                                @click="openEditModal(guest)"
                                                class="p-1 rounded-lg hover:bg-stone-100 text-stone-500 hover:text-amber-800"
                                                title="Edit guest details"
                                            >
                                                ✏️
                                            </button>

                                            <!-- Delete Button -->
                                            <button
                                                type="button"
                                                @click="deleteGuest(guest)"
                                                class="p-1 rounded-lg hover:bg-stone-100 text-stone-400 hover:text-rose-600"
                                                title="Delete guest"
                                            >
                                                🗑️
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr v-if="guests.data.length === 0">
                                    <td colspan="6" class="py-12 text-center text-stone-400 text-xs italic">
                                        No guests found matching your criteria. Click "+ Add Guest" or "Bulk Add" above.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div
                        v-if="guests.links && guests.links.length > 3"
                        class="p-4 border-t border-stone-200 flex items-center justify-between text-xs"
                    >
                        <span class="text-stone-500">
                            Showing {{ guests.from || 0 }} to {{ guests.to || 0 }} of {{ guests.total }} guests
                        </span>
                        <div class="flex items-center gap-1">
                            <Component
                                :is="link.url ? Link : 'span'"
                                v-for="(link, i) in guests.links"
                                :key="i"
                                :href="link.url"
                                v-html="link.label"
                                class="px-2.5 py-1 rounded-md text-xs font-medium transition-colors"
                                :class="{
                                    'bg-amber-600 text-white': link.active,
                                    'text-stone-600 hover:bg-stone-100': !link.active && link.url,
                                    'text-stone-300 pointer-events-none': !link.url,
                                }"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Guest Modal -->
        <div v-if="showAddModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-stone-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-serif text-lg font-bold text-stone-900">Add New Guest</h3>
                    <button @click="showAddModal = false" class="text-stone-400 hover:text-stone-600 text-xl font-bold">&times;</button>
                </div>

                <form @submit.prevent="submitAdd" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Guest Name *</label>
                        <input
                            type="text"
                            v-model="addForm.name"
                            required
                            placeholder="e.g. Rahul &amp; Priya Sharma"
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        />
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Custom Greeting / Salutation on Card</label>
                        <input
                            type="text"
                            v-model="addForm.custom_greeting"
                            placeholder="e.g. Respected Sharma Ji &amp; Family"
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        />
                        <p class="text-[10px] text-stone-400 mt-1">Leave blank to use the Guest Name above.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Phone / WhatsApp</label>
                            <input
                                type="text"
                                v-model="addForm.phone"
                                placeholder="+919876543210"
                                class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                            />
                        </div>
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Party Limit (Max Guests)</label>
                            <input
                                type="number"
                                v-model="addForm.max_guests"
                                min="1"
                                max="20"
                                required
                                class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Internal Note (Optional)</label>
                        <textarea
                            v-model="addForm.notes"
                            rows="2"
                            placeholder="e.g. Groom's college friend, requires accommodation..."
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        ></textarea>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-2 pt-2 border-t border-stone-100">
                        <button
                            type="button"
                            @click="showAddModal = false"
                            class="px-4 py-2 rounded-xl text-stone-600 hover:bg-stone-100 font-medium"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="addForm.processing"
                            class="px-5 py-2 rounded-xl bg-amber-600 text-white font-medium shadow hover:bg-amber-700 disabled:opacity-50"
                        >
                            {{ addForm.processing ? 'Creating...' : 'Create Invitation' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bulk Add Modal -->
        <div v-if="showBulkModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-stone-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-serif text-lg font-bold text-stone-900">Bulk Add Guests</h3>
                    <button @click="showBulkModal = false" class="text-stone-400 hover:text-stone-600 text-xl font-bold">&times;</button>
                </div>

                <p class="text-xs text-stone-600 mb-3">
                    Paste multiple guests (one per line). Format: <code>Guest Name, Phone, MaxGuests</code>
                </p>

                <form @submit.prevent="submitBulk" class="space-y-4 text-xs">
                    <div>
                        <textarea
                            v-model="bulkForm.raw_list"
                            rows="8"
                            required
                            placeholder="Dr. Rajesh Verma &amp; Family, +919876543210, 4&#10;Amit &amp; Sneha, +919811223344, 2&#10;Suresh Kumar, , 1"
                            class="w-full font-mono text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500 bg-stone-50"
                        ></textarea>
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Default Max Guests if not specified</label>
                        <input
                            type="number"
                            v-model="bulkForm.default_max_guests"
                            min="1"
                            max="10"
                            class="w-24 text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        />
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-2 pt-2 border-t border-stone-100">
                        <button
                            type="button"
                            @click="showBulkModal = false"
                            class="px-4 py-2 rounded-xl text-stone-600 hover:bg-stone-100 font-medium"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="bulkForm.processing"
                            class="px-5 py-2 rounded-xl bg-amber-600 text-white font-medium shadow hover:bg-amber-700 disabled:opacity-50"
                        >
                            {{ bulkForm.processing ? 'Importing...' : 'Add All Guests' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Guest Modal -->
        <div v-if="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-stone-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-serif text-lg font-bold text-stone-900">Edit Guest</h3>
                    <button @click="showEditModal = false" class="text-stone-400 hover:text-stone-600 text-xl font-bold">&times;</button>
                </div>

                <form @submit.prevent="submitEdit" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Guest Name</label>
                        <input
                            type="text"
                            v-model="editForm.name"
                            required
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        />
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Custom Salutation / Greeting on Card</label>
                        <input
                            type="text"
                            v-model="editForm.custom_greeting"
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        />
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Phone / WhatsApp</label>
                            <input
                                type="text"
                                v-model="editForm.phone"
                                class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                            />
                        </div>
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Max Guests</label>
                            <input
                                type="number"
                                v-model="editForm.max_guests"
                                min="1"
                                max="20"
                                required
                                class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">RSVP Status</label>
                            <select
                                v-model="editForm.status"
                                class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                            >
                                <option value="pending">Pending</option>
                                <option value="attending">Attending</option>
                                <option value="declined">Declined</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Headcount Attending</label>
                            <input
                                type="number"
                                v-model="editForm.attending_count"
                                min="0"
                                :max="editForm.max_guests"
                                class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Dietary Preferences</label>
                        <input
                            type="text"
                            v-model="editForm.dietary_notes"
                            placeholder="e.g. Pure Veg, Jain"
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        />
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Notes</label>
                        <textarea
                            v-model="editForm.notes"
                            rows="2"
                            class="w-full text-xs rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500"
                        ></textarea>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-2 pt-2 border-t border-stone-100">
                        <button
                            type="button"
                            @click="showEditModal = false"
                            class="px-4 py-2 rounded-xl text-stone-600 hover:bg-stone-100 font-medium"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="editForm.processing"
                            class="px-5 py-2 rounded-xl bg-amber-600 text-white font-medium shadow hover:bg-amber-700 disabled:opacity-50"
                        >
                            {{ editForm.processing ? 'Saving...' : 'Save Changes' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

