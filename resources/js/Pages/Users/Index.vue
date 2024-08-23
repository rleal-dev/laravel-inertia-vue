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

    <AuthenticatedLayout>
        
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('users.index.page_title') }}
            </h2>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ user.roles }}</td>
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
            @cancel="showConfirmDelete = false"
            @confirm="deleteUser"
        />
    </AuthenticatedLayout>
</template>

<style>
.checkbox:checked + .check-icon {
    display: flex
}
</style>
