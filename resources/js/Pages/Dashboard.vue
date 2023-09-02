<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Dashboard
            </h2>
        </template>

        <Welcome />
    </AppLayout>
</template>
