<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    as: String,
});
</script>

<template>
    <button type="submit" @click="$emit('clicked')" class="dropdown-item px-4" v-if="as == 'button'">
      <slot></slot>
    </button>

    <Link :href="href" class="dropdown-item px-4" v-else>
      <slot></slot>
    </Link>
</template>
