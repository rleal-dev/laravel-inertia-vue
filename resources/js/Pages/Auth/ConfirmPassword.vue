<script setup>
import { useForm } from '@inertiajs/vue3'

import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const form = useForm({
    password: '',
})

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
}

const goBack = () => window.history.back()
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('confirm_password.info') }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" :value="__('fields.password')" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                    :error="form.errors.password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton class="ms-2" :loading="form.processing">
                    {{ __('confirm_password.confirm') }}
                </PrimaryButton>

                <SecondaryButton @click="goBack" class="ms-2">
                    {{ __('common.cancel') }}
                </SecondaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
