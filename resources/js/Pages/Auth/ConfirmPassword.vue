<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Head title="Secure Area" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="card-body">

            <div class="mb-2">
            This is a secure area of the application. Please confirm your password before continuing.
            </div>

            <form @submit.prevent="submit">
                <div class="mt-3">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 d-block w-100"
                        :class="{'is-invalid' : form.errors.password}"
                        required
                        autocomplete="current-password"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-3">
                    <div class="d-flex justify-content-end">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="text-muted me-3">
                            Forgot your password?
                        </Link>

                        <PrimaryButton class="ms-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                            <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Confirm
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticationCard>
</template>
