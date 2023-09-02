<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
            <div class="container">
                <!-- Logo -->
                <Link class="navbar-brand me-4" :href="route('dashboard')">
                    <ApplicationMark width="36" />
                </Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </NavLink>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav align-items-baseline">

                        <!-- Authentication Links -->
                        <Dropdown id="settingsDropdown">
                            <template #trigger>
                                <img v-if="$page.props.jetstream.managesProfilePhotos" class="rounded-circle" width="32" height="32" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" />

                                <span v-else>
                                {{ $page.props.auth.user.name }}

                                <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <h6 class="dropdown-header small text-muted">
                                    Manage Account
                                </h6>

                                <DropdownLink :href="route('profile.show')">
                                    Profile
                                </DropdownLink>

                                <DropdownLink :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                    API Tokens
                                </DropdownLink>

                                <hr class="dropdown-divider">

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">
                                        Log out
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="d-flex py-3 bg-white shadow-sm border-bottom">
            <div class="container">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main class="container my-5">
        <slot></slot>
        </main>
    </div>
</template>
