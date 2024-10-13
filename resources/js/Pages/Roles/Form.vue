<script setup>
import { watch } from 'vue'
import { useForm } from '@inertiajs/vue3'

import Modal from '@/Components/Modal.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
    open: { type: Boolean, default: true},
    role: { type: Object, default: {}},
})

const emit = defineEmits(['close'])

const form = useForm({
    name: props.role.name ?? '',
})

const saveRole = () => {
    const params = {
        preserveScroll: false,
        onSuccess: closeModal,
    }

    return props.role.id
        ? form.put(route('roles.update', props.role.id), params)
        : form.post(route('roles.store'), params)
}

const closeModal = () => {
    form.reset()
    form.clearErrors()
    emit('close')
}
</script>

<template>
    <Modal :show="props.open" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ props.role?.id ? __('roles.edit.page_title') : __('roles.create.page_title') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('roles.create.description') }}
            </p>

            <div class="mt-6">
                <InputLabel for="name" :value="__('fields.name')" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autocomplete="name"
                    :error="form.errors.name"
                    required
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-6 flex justify-end">
                <PrimaryButton  @click="saveRole" :loading="form.processing">{{ __('common.save') }}</PrimaryButton>
                <SecondaryButton class="ml-2" @click="closeModal">{{ __('common.cancel') }}</SecondaryButton>
            </div>
        </div>
    </Modal>
</template>
