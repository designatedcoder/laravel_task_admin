<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />
    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="card-body">
          <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 d-block w-100"
                        :class="{'is-invalid' : form.errors.name}"
                        autofocus
                        autocomplete="name"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
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
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 d-block w-100"
                        :class="{'is-invalid' : form.errors.password_confirmation}"
                        autocomplete="new-password"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="mt-3" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <div class="form-check">
                        <Checkbox name="terms" id="terms" :class="{'is-invalid' : form.errors.terms}" v-model:checked="form.terms"
                        required />
                        <label class="form-check-label" for="terms">
                        I agree to the <a target="_blank" :href="route('terms.show')">Terms of Service</a> and <a target="_blank" :href="route('policy.show')">Privacy Policy</a>
                        </label>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </div>
                </div>
                <div class="mt-3">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <Link :href="route('login')" class="text-muted me-3 text-decoration-none">
                        Already registered?
                        </Link>

                        <PrimaryButton class="ms-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                            <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Register
                        </PrimaryButton>
                    </div>
                </div>
          </form>
        </div>
    </AuthenticationCard>
</template>
