<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="card-body">
            <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
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
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 d-block w-100"
                        :class="{'is-invalid' : form.errors.password}"
                        autocomplete="new-password"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="mt-3">
                    <div class="form-check">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <label class="form-check-label" for="remember">Remember me
                        </label>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="text-muted me-3">
                            Forgot your password?
                        </Link>

                        <PrimaryButton class="ms-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                            <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Log in
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticationCard>
</template>
