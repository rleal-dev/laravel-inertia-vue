<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import ConfirmationDialog from '@/Components/ConfirmationDialog.vue'
import AlertSuccess from '@/Components/AlertSuccess.vue'
import AlertError from '@/Components/AlertError.vue'
import Search from '@/Components/Search.vue'

const props = defineProps({
    users: Object,
    filters: Object,
    permissions: Object,
})

const search = ref(props.filters.search)
const showConfirmDelete = ref(false)
const selectedUser = ref({})

const breadcrumbs = [
    { label: 'menus.dashboard', to: 'dashboard' },
    { label: 'menus.users', active: true },
]

const searchUsers = () => {
    router.get('/users', { search: search.value }, { preserveState: true, replace: true })
}

const confirmDelete = role => {
    selectedUser.value = role
    showConfirmDelete.value = true
}

const deleteUser = () => {
    router.delete(route('users.destroy', selectedUser.value.id))

    selectedUser.value = null
    showConfirmDelete.value = false
}
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout v-bind="{breadcrumbs}">
        <template #header>
            <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                {{ __('users.index.page_title') }}
            </h2>
        </template>
        
        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <AlertSuccess :message="$page.props.flash.success"/>
                    <AlertError :message="$page.props.flash.error"/>

                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="border dark:border-gray-700 rounded-lg divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex justify-between py-3 px-4 bg-white dark:bg-gray-800">
                                        <Search v-model="search" @search="searchUsers" />

                                        <Link :href="route('users.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            {{ __('users.index.add_user') }}
                                        </Link>
                                    </div>

                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('fields.id') }}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('fields.photo') }}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('fields.name') }}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('fields.email') }}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('fields.roles') }}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('fields.created_at') }}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('common.actions') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                <tr v-for="user in users.data" :key="user.id">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ user.id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        <img :src="user.avatar_url" class="h-10 w-10 rounded-full" />
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ user.name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ user.email }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        <span v-for="role in user.roles" :key="role" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 mr-2 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                            {{ role }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ user.created_at }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <Link :href="route('users.show', user)" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-200 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                                                            {{ __('common.show') }}
                                                        </Link>
                                                        <Link :href="route('users.edit', user)" v-if="permissions.edit" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-blue-500 dark:border-blue-400 rounded-md font-semibold text-xs text-blue-500 dark:text-blue-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">
                                                            {{ __('common.edit') }}
                                                        </Link>
                                                        <button @click="confirmDelete(user)" v-if="permissions.edit" class="inline-flex items-center px-4 py-2 bg-red dark:bg-gray-800 border border-red-300 dark:border-red-400 rounded-md font-semibold text-xs text-red-300 dark:text-red-400 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                            {{ __('common.delete') }}
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr v-if="!users.data.length">
                                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap bg-red-100 text-center text-sm font-medium text-red-800">
                                                        {{ __('users.index.not_found') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="py-1 px-4">
                                        <Pagination :links="users.links" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ConfirmationDialog
            :show="showConfirmDelete"
            :title="__('users.delete.confirm_delete_title')"
            :message="__('users.delete.confirm_delete_message')"
            @close="showConfirmDelete = false"
            @confirm="deleteUser"
        />
    </AuthenticatedLayout>
</template>

<style>
.checkbox:checked + .check-icon {
    display: flex
}
</style>
