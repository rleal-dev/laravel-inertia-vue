<script setup>
import { router, useForm } from '@inertiajs/vue3'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
    user: { type: Object },
    roles: { type: Array },
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    roles: props.user.roles,
    avatar: null,
    image_preview: null
})

const updateUser = () => {
    router.post(route('users.update', props.user), {
        _method: 'put',
        ...form,
    })
}

const previewImage = event => {
    const file = event.target.files[0]
    form.image_preview = URL.createObjectURL(file)
}
</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('users.edit.page_title') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('users.edit.info') }}</h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('users.edit.description') }}
                            </p>
                        </header>
                        <form @submit.prevent="updateUser" class="mt-6 space-y-6">
                            <div class="grid gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <InputLabel for="name" :value="__('fields.name')" />
    
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                        :error="form.errors.name"
                                    />
    
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div class="sm:col-span-3">
                                    <InputLabel for="email" :value="__('fields.email')" />
    
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                        autocomplete="username"
                                        :error="form.errors.email"
                                    />
    
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="col-span-full">
                                    <InputLabel for="password_confirmation" :value="__('fields.photo')" />

                                    <div class="mt-2 flex items-center gap-x-3">
                                        <img :src="form.image_preview ?? user.avatar_url" class="h-10 w-10 rounded-full" />
                                        <input
                                            type="file"
                                            @input="form.avatar = $event.target.files[0]"
                                            @change="previewImage"
                                            ref="photo"
                                            class="w-100 px-2 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                        />
                                    </div>
                                    
                                    <InputError class="mt-2" :message="form.errors.avatar" />
                                </div>

                                <div class="sm:col-span-6">
                                    <InputLabel for="email" :value="__('fields.roles')" />

                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                        <div v-for="role in roles" :key="role.id" class="flex items-center">
                                            <input
                                                type="checkbox"
                                                :id="`role-${role.id}`"
                                                :value="role.id"
                                                v-model="form.roles"
                                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-100 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            />
                                            <label :for="`role-${role.id}`" class="ml-2 block text-gray-700 dark:text-gray-100">
                                                {{ role.name }}
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <InputError class="mt-2" :message="form.errors.roles" />
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <PrimaryButton :loading="form.processing">{{ __('common.save') }}</PrimaryButton>

                                <Link :href="route('users.index')" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('common.cancel') }}
                                </Link>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
