<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-[#F8F6F2] text-stone-800">
            <!-- Navigation Bar -->
            <nav class="border-b border-[#E8E4DC] bg-white/95 backdrop-blur-md sticky top-0 z-40 transition-shadow">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between items-center">
                        <div class="flex items-center gap-8">
                            <!-- Logo / Monogram -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')" class="flex items-center gap-3 group">
                                    <div class="w-10 h-10 rounded-full bg-[#15253b] ring-1 ring-[#c5a059]/40 flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                                        <span class="font-serif font-bold text-xs tracking-wider text-[#d8ab43]">S &amp; B</span>
                                    </div>
                                    <div>
                                        <span class="font-serif font-semibold text-stone-900 text-sm block leading-tight tracking-wide">
                                            Shavindi &amp; Buddhima
                                        </span>
                                        <span class="text-[10px] text-[#8c6d37] tracking-widest uppercase font-semibold block">
                                            Wedding Administration
                                        </span>
                                    </div>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-7 sm:-my-px sm:flex">
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </NavLink>
                                <NavLink
                                    :href="route('guests.index')"
                                    :active="route().current('guests.*')"
                                >
                                    Guests &amp; RSVPs
                                </NavLink>
                                <NavLink
                                    :href="route('settings.index')"
                                    :active="route().current('settings.*')"
                                >
                                    Wedding Settings
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:gap-3">
                            <!-- Quick View Card Button -->
                            <a
                                :href="route('invitation.preview')"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#FAF7F0] text-[#7A5B22] border border-[#E5DAC0] text-xs font-semibold hover:bg-[#F3EBD8] transition-colors shadow-2xs"
                            >
                                <svg class="w-3.5 h-3.5 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <span>Preview Invitation</span>
                                <svg class="w-3 h-3 opacity-60 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 17 17 7M7 7h10v10" />
                                </svg>
                            </a>

                            <!-- Settings Dropdown -->
                            <div class="relative ms-2">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-lg">
                                            <button
                                                type="button"
                                                class="inline-flex items-center gap-2 rounded-lg border border-[#E8E4DC] bg-white px-3 py-1.5 text-xs font-medium text-stone-700 shadow-2xs hover:bg-stone-50 hover:text-stone-900 focus:outline-none transition-colors"
                                            >
                                                <span class="w-5 h-5 rounded-full bg-stone-100 border border-stone-200 flex items-center justify-center text-[10px] font-bold text-stone-600">
                                                    {{ $page.props.auth.user.name?.charAt(0) || 'H' }}
                                                </span>
                                                <span>{{ $page.props.auth.user.name }}</span>

                                                <svg
                                                    class="-me-0.5 ms-1 h-3.5 w-3.5 text-stone-400"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')">
                                            Account Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center rounded-lg p-2 text-stone-600 hover:bg-stone-100 hover:text-stone-900 focus:outline-none transition-colors"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden border-t border-[#E8E4DC] bg-white"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('guests.index')"
                            :active="route().current('guests.*')"
                        >
                            Guests &amp; RSVPs
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('settings.index')"
                            :active="route().current('settings.*')"
                        >
                            Wedding Settings
                        </ResponsiveNavLink>
                        <a
                            :href="route('invitation.preview')"
                            target="_blank"
                            class="flex items-center justify-between w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-sm font-semibold text-[#8c6d37] hover:bg-amber-50"
                        >
                            <span>Preview Invitation</span>
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M7 17 17 7M7 7h10v10" />
                            </svg>
                        </a>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="border-t border-[#E8E4DC] pb-3 pt-4">
                        <div class="px-4">
                            <div class="text-sm font-semibold text-stone-900">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-xs text-stone-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Account Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white border-b border-[#E8E4DC]" v-if="$slots.header">
                <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Flash Messages -->
            <div v-if="$page.props.flash?.success" class="mx-auto max-w-7xl mt-4 px-4 sm:px-6 lg:px-8">
                <div class="p-4 rounded-xl bg-emerald-50/90 border border-emerald-200 text-emerald-900 text-xs font-medium flex items-center justify-between shadow-2xs">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>{{ $page.props.flash.success }}</span>
                    </div>
                </div>
            </div>
            <div v-if="$page.props.flash?.error" class="mx-auto max-w-7xl mt-4 px-4 sm:px-6 lg:px-8">
                <div class="p-4 rounded-xl bg-rose-50/90 border border-rose-200 text-rose-900 text-xs font-medium flex items-center justify-between shadow-2xs">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>{{ $page.props.flash.error }}</span>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="pb-24 sm:pb-8">
                <slot />
            </main>

            <!-- Mobile Bottom App Dock -->
            <nav class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-[#EDE8E1] px-2 py-1 shadow-[0_-4px_25px_rgba(0,0,0,0.06)] pb-[max(0.4rem,env(safe-area-inset-bottom))]">
                <div class="grid grid-cols-4 items-center gap-1 max-w-md mx-auto">
                    <!-- Dashboard -->
                    <Link
                        :href="route('dashboard')"
                        class="flex flex-col items-center justify-center py-1.5 px-1 rounded-xl transition-all"
                        :class="route().current('dashboard') ? 'text-[#15253b] font-bold' : 'text-stone-400 hover:text-stone-700'"
                    >
                        <div class="relative">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            <span v-if="route().current('dashboard')" class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-[#c5a059]"></span>
                        </div>
                        <span class="text-[10px] mt-1 tracking-tight">Overview</span>
                    </Link>

                    <!-- Guests -->
                    <Link
                        :href="route('guests.index')"
                        class="flex flex-col items-center justify-center py-1.5 px-1 rounded-xl transition-all"
                        :class="route().current('guests.*') ? 'text-[#15253b] font-bold' : 'text-stone-400 hover:text-stone-700'"
                    >
                        <div class="relative">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span v-if="route().current('guests.*')" class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-[#c5a059]"></span>
                        </div>
                        <span class="text-[10px] mt-1 tracking-tight">Guests &amp; Invites</span>
                    </Link>

                    <!-- Settings -->
                    <Link
                        :href="route('settings.index')"
                        class="flex flex-col items-center justify-center py-1.5 px-1 rounded-xl transition-all"
                        :class="route().current('settings.*') ? 'text-[#15253b] font-bold' : 'text-stone-400 hover:text-stone-700'"
                    >
                        <div class="relative">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                            <span v-if="route().current('settings.*')" class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-[#c5a059]"></span>
                        </div>
                        <span class="text-[10px] mt-1 tracking-tight">Settings</span>
                    </Link>

                    <!-- Preview -->
                    <a
                        :href="route('invitation.preview')"
                        target="_blank"
                        class="flex flex-col items-center justify-center py-1.5 px-1 rounded-xl text-stone-400 hover:text-stone-700 transition-all"
                    >
                        <svg class="w-5 h-5 text-[#c5a059]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <span class="text-[10px] mt-1 text-[#8c6d37] font-medium tracking-tight">Preview</span>
                    </a>
                </div>
            </nav>
        </div>
    </div>
</template>
