<script setup>
import { useForm } from '@inertiajs/vue3';

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});
</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('users.create.page_title') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('users.create.info') }}</h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('users.create.description') }}
                            </p>
                        </header>

                        <form @submit.prevent="form.post(route('users.store'))" class="mt-6 space-y-6">
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
    
                                <div class="sm:col-span-3">
                                    <InputLabel for="password" :value="__('fields.password')" />
    
                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password"
                                        required
                                        autocomplete="new-password"
                                        :error="form.errors.password"
                                    />
    
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>
    
                                <div class="sm:col-span-3">
                                    <InputLabel for="password_confirmation" :value="__('fields.confirm_password')" />
    
                                    <TextInput
                                        id="password_confirmation"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password_confirmation"
                                        required
                                        autocomplete="new-password"
                                        :error="form.errors.password_confirmation"
                                    />
    
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
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
