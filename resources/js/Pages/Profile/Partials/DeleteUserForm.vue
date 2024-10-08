<script setup>
import { nextTick, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

import Modal from '@/Components/Modal.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import DangerButton from '@/Components/DangerButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const passwordInput = ref(null)
const confirmingUserDeletion = ref(false)

const form = useForm({
    password: '',
})

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true

    nextTick(() => passwordInput.value.focus())
}

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    })
}

const closeModal = () => {
    confirmingUserDeletion.value = false
    form.reset()
}
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Delete Account</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('profile.delete.info') }}
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">{{ __('profile.delete.delete_account') }}</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('profile.delete.confirm') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('profile.delete.confirm_info') }}
                </p>

                <div class="mt-6">
                    <InputLabel for="password" :value="__('fields.password')" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        :placeholder="__('fields.password')"
                        @keyup.enter="deleteUser"
                        :error="form.errors.password"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">{{ __('common.cancel') }}</SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        {{ __('profile.delete.delete_account') }}
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
