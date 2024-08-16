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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('users.show.page_title') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">{{ __('users.show.info') }}</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('users.show.description') }}
                            </p>
                        </header>

                        <div class="my-4 ">
                            <p>{{ user.name }}</p>
                            <p>{{ user.email }}</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <Link :href="route('users.index')" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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
