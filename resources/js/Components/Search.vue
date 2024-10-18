<script setup>
const model = defineModel()
const emit = defineEmits(['search'])
</script>

<template>
    <div class="relative max-w-xs md:max-w-xl md:w-full">
        <label class="sr-only">{{ __('common.search') }}</label>
        <div class="relative flex rounded-lg shadow-sm">
            <input v-model="model" @keyup.enter="($event) => emit('search')" type="text" class="py-3 px-3 ps-9 block w-full border-gray-200 dark:border-gray-600 shadow-sm rounded-s-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:text-gray-200" :placeholder="__('common.search')">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                <svg class="flex-shrink-0 size-4 text-gray-400 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
            </div>
            <button type="button" @click="($event) => emit('search')" class="px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-700 hover:text-white disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-gray-600">
                {{ __('common.search') }}
            </button>
        </div>
    </div>
</template>