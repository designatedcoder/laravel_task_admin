<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="card-body">

            <div class="mb-2">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>

            <div v-if="status" class="alert alert-success" role="alert">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="mt-3">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 d-block w-100"
                        :class="{'is-invalid' : form.errors.email}"
                        autocomplete="username"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
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
                            Email Password Reset Link
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticationCard>
</template>
