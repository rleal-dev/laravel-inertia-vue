<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 text-sm text-gray-600">
            {{ __('verify_email.info') }}
        </div>

        <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
            {{ __('verify_email.verification_link_sent') }}
        </div>

        <form @submit.prevent="submit">
            <div class="flex items-center mt-4">
                <PrimaryButton class="flex w-full justify-center" :loading="form.processing">
                    {{ __('verify_email.resend_email') }}
                </PrimaryButton>
            </div>
            <div class="flex items-center justify-between mt-4">
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('verify_email.logout') }}
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
