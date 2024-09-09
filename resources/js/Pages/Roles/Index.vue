<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Search, Pagination, AlertError, AlertSuccess, ConfirmationDialog } from '@/Components'

import Form from './Form.vue'

const { filters } = defineProps({
    roles: Object,
    filters: Object,
    permissions: Object,
})

const search = ref(filters.search)
const showModalForm = ref(false)
const showConfirmDelete = ref(false)
const selectedRole = ref({})

const breadcrumbs = [
    { label: 'menus.dashboard', to: 'dashboard' },
    { label: 'menus.roles', active: true },
]

const searchRoles = () => {
    router.get('/roles', { search: search.value }, { preserveState: true })
}

const showForm = (role = null) => {
    selectedRole.value = role
    showModalForm.value = true
}

const closeForm = () => {
    showModalForm.value = false
}

const confirmDelete = role => {
    selectedRole.value = role
    showConfirmDelete.value = true
}

const deleteRole = () => {
    router.delete(route('roles.destroy', selectedRole.value.id))

    selectedRole.value = null
    showConfirmDelete.value = false
}
</script>

<template>
    <Head title="Roles" />

    <AuthenticatedLayout v-bind="{breadcrumbs}">
        <template #header>
            <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                {{ __('roles.index.page_title') }}
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
                                        <Search v-model="search" @search="searchRoles" />

                                        <button @click="showForm" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            {{ __('roles.index.add_role') }}
                                        </button>
                                    </div>

                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('fields.id') }}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                        {{ __('fields.name') }}
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
                                                <tr v-for="role in roles.data" :key="role.id">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ role.id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ role.name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ role.created_at }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <button @click="showForm(role)" v-if="permissions.edit" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-blue-500 dark:border-blue-400 rounded-md font-semibold text-xs text-blue-500 dark:text-blue-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">
                                                            {{ __('common.edit') }}
                                                        </button>

                                                        <button @click="confirmDelete(role)" v-if="permissions.edit" class="inline-flex items-center px-4 py-2 bg-red dark:bg-gray-800 border border-red-300 dark:border-red-400 rounded-md font-semibold text-xs text-red-300 dark:text-red-400 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                            {{ __('common.delete') }}
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr v-if="!roles.data.length">
                                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap bg-red-100 text-center text-sm font-medium text-red-800">
                                                        {{ __('roles.index.not_found') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="py-1 px-4">
                                        <Pagination :links="roles.links" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Form v-if="showModalForm" :role="selectedRole" @close="closeForm" />

        <ConfirmationDialog
            :show="showConfirmDelete"
            :title="__('roles.delete.confirm_delete_title')"
            :message="__('roles.delete.confirm_delete_message')"
            @close="showConfirmDelete = false"
            @confirm="deleteRole"
        />
    </AuthenticatedLayout>
</template>
