<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'

defineProps({
    user: { type: Object },
})

const breadcrumbs = [
    { label: 'menus.dashboard', to: 'dashboard' },
    { label: 'menus.users', to: 'users.index' },
    { label: 'common.show', active: true },
]
</script>

<template>
    <Head title="Show User" />

    <AuthenticatedLayout v-bind="{breadcrumbs}">
        <template #header>
            <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                {{ __('users.show.page_title') }}
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('users.show.info') }}</h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('users.show.description') }}
                            </p>
                        </header>

                        <div class="my-4">
                            <p class="mb-4">
                                <img :src="user.avatar_url" class="h-20 w-20 rounded-full" />
                            </p>

                            <InputLabel for="name" :value="__('fields.name')" />
                            <p class="text-sm text-gray dark:text-white mb-4">{{ user.name }}</p>

                            <InputLabel for="name" :value="__('fields.email')" />
                            <p class="text-sm text-gray dark:text-white mb-4">{{ user.email }}</p>

                            <InputLabel for="name" :value="__('fields.roles')" />
                            <span v-for="role in user.roles" :key="role" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 mt-1 mr-2 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                {{ role }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <Link :href="route('users.index')" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('common.back') }}
                            </Link>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.checkbox:checked + .check-icon {
    display: flex;
}
</style>
