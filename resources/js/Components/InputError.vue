<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message" class="invalid-feedback" role="alert">
        <strong>{{ message }}</strong>
    </div>
</template>
