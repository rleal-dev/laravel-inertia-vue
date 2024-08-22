<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    user: { type: Object },
});
</script>

<template>
    <Head title="Show User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('users.show.page_title') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                            <p class="text-sm text-gray dark:text-white mb-4">{{ user.name }}</p>
                            <p class="text-sm text-gray dark:text-white">{{ user.email }}</p>
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
