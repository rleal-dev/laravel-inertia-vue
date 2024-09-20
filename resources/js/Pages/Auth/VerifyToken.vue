<script setup>
import { ref } from 'vue'
import { router, useForm } from '@inertiajs/vue3'

import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

defineProps({
    status: { type: String },
})

const isResend = ref(false)
const form = useForm({ token: '' })

const submit = () => {
    form.post(route('check.token'))
}

const resendToken = async () => {
    router.post(route('resend.token'), {}, {
        onStart: () => isResend.value = true,
        onFinish: () => isResend.value = false
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Verificar Token" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('verify_token.info') }}
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="token" :value="__('fields.token')" />

                <TextInput
                    id="token"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.token"
                    required
                    autofocus
                    autocomplete="username"
                    :error="form.errors.token"
                />

                <InputError class="mt-2" :message="form.errors.token" />
            </div>

            <div class="flex items-center mt-4">
                <PrimaryButton
                    class="flex w-full justify-center"
                    :loading="form.processing"
                >
                    {{ __('verify_token.check') }}
                </PrimaryButton>
            </div>

            <div class="flex items-center mt-4">
                <SecondaryButton
                    class="flex w-full justify-center"
                    :loading="isResend"
                    @click="resendToken"
                >
                    {{ __('verify_token.resend') }}
                </SecondaryButton>
            </div>

                <div class="flex items-center justify-between mt-4">

                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    {{ __('verify_token.return_login') }}
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
