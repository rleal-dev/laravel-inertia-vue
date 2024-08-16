<script setup>
import { useForm } from '@inertiajs/vue3';

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    user: { type: Object },
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
});
</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('users.edit.page_title') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">{{ __('users.edit.info') }}</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('users.edit.description') }}
                            </p>
                        </header>
                        <form @submit.prevent="form.put(route('users.update', user))" class="mt-6 space-y-6">
                            <div>
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

                            <div>
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

                            <div class="flex items-center gap-4">
                                <PrimaryButton :loading="form.processing">{{ __('common.save') }}</PrimaryButton>

                                <Link :href="route('users.index')" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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
