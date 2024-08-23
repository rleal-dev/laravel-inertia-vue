<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3'

import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
    mustVerifyEmail: { type: Boolean },
    status: { type: String },
});

const user = usePage().props.auth.user

const form = useForm({
    name: user.name,
    email: user.email,
    avatar: null
})

const previewImage = event => {
    const file = event.target.files[0]
    user.avatar_url = URL.createObjectURL(file)
}

const updateProfile = () => {
    router.post(route('profile.update'), {
        _method: 'patch',
        ...form,
    })
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('profile.edit.title') }}</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('profile.edit.info') }}
            </p>
        </header>

        <form @submit.prevent="updateProfile" class="mt-6 space-y-6">
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

            <div class="col-span-full">
                <InputLabel for="password_confirmation" :value="__('fields.photo')" />

                <div class="mt-2 flex items-center gap-x-3">
                    <img :src="user.avatar_url" class="h-10 w-10 rounded-full" />
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

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('profile.edit.unverified_email') }}

                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        {{ __('profile.edit.resend_email') }}
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    {{ __('profile.edit.resend_info') }}
                </div>
            </div>

            <div class="flex items-center gap-2">
                <PrimaryButton :loading="form.processing">
                    {{ __('common.save') }}
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">{{ __('common.saved') }}</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
