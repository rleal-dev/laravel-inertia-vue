<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import Pagination from '@/Components/Pagination.vue'
import ConfirmationDialog from '@/Components/ConfirmationDialog.vue'
import Form from './Form.vue'

const props = defineProps({
    roles: Object,
    filters: Object,
    permissions: Object,
})

const search = ref(props.filters.search)
const showModalForm = ref(false)
const showConfirmDelete = ref(false)
const selectedRole = ref({})

const onEnter = () => {
    router.get('/roles', { search: search.value }, { preserveState: true, replace: true })
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

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('roles.index.page_title') }}
            </h2>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div v-if="$page.props.flash.success" class="bg-teal-100 dark:bg-teal-900 rounded-b text-teal-900 dark:text-teal-100 px-4 py-3 mb-3" role="alert">
                        <div class="flex">
                            <svg class="fill-current h-6 w-6 text-teal-500 dark:text-teal-400 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                            </svg>
                            <p>{{ $page.props.flash.success }}</p>
                        </div>
                    </div>

                    <div v-if="$page.props.flash.error" class="bg-red-100 dark:bg-red-900 rounded-b text-red-900 dark:text-red-100 px-4 py-3 mb-3" role="alert">
                        <div class="flex">
                            <svg class="fill-current h-6 w-6 text-red-500 dark:text-red-400 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                            </svg>
                            <p>{{ $page.props.flash.error }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="border dark:border-gray-700 rounded-lg divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex justify-between py-3 px-4 bg-white dark:bg-gray-800">
                                        <div class="relative max-w-xs md:max-w-xl md:w-full">
                                            <label class="sr-only">Search</label>
                                            <div class="relative flex rounded-lg shadow-sm">
                                                <input v-model="search" @keyup.enter="onEnter" type="text" class="py-2 px-3 ps-9 block w-full border-gray-200 dark:border-gray-600 shadow-sm rounded-s-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:text-gray-200" :placeholder="__('common.search')">
                                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                                    <svg class="flex-shrink-0 size-4 text-gray-400 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <path d="m21 21-4.3-4.3"></path>
                                                    </svg>
                                                </div>
                                                <button type="button" @click="onEnter" class="px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-700 hover:text-white disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-gray-600">
                                                    {{ __('common.search') }}
                                                </button>
                                            </div>
                                        </div>

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
            @cancel="showConfirmDelete = false"
            @confirm="deleteUser"
        />
    </AuthenticatedLayout>
</template>
