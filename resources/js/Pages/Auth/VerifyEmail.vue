<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Email Verification" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="card-body">
            <div class="mb-3 small text-muted">
                Thanks for signing up! Before getting started, could you verify your
                email address by clicking on the link we just emailed to you? If you
                didn't receive the email, we will gladly send you another.
            </div>

            <div class="alert alert-success" role="alert" v-if="verificationLinkSent">
                A new verification link has been sent to the email address you provided
                during registration.
            </div>

            <form @submit.prevent="submit">
                <div class="mt-3">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <PrimaryButton
                            :class="{ 'text-white-50': form.processing }"
                            :disabled="form.processing"
                        >
                            <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                            </div>
                            Resend Verification Email
                        </PrimaryButton>

                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="btn btn-link"
                        >
                            Log out
                        </Link>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticationCard>
</template>
