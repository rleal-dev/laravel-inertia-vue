<script setup>
import { computed } from 'vue'
import { useForm } from '@inertiajs/vue3'

import GuestLayout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
    status: { type: String },
});

const form = useForm({})

const verificationLinkSent = computed(() => props.status === 'verification-link-sent')

const submit = () => {
    form.post(route('verification.send'))
}
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('verify_email.info') }}
        </div>

        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400" v-if="verificationLinkSent">
            {{ __('verify_email.verification_link_sent') }}
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center">
                <PrimaryButton class="flex w-full justify-center" :loading="form.processing">
                    {{ __('verify_email.resend_email') }}
                </PrimaryButton>
            </div>
            <div class="flex items-center justify-between mt-4">
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        {{ __('verify_email.logout') }}
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
