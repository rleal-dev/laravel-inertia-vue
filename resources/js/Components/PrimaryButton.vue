<script setup>
defineProps({
    disabled: { type: Boolean, default: false },
    loading: { type: Boolean, default: false },
})
</script>
<template>
    <button
        :disabled="disabled || loading"
        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
        :class="{ 'opacity-25': loading }" 
    >
        <span v-if="loading" class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white dark:text-gray-800 rounded-full mr-2" role="status" aria-label="loading">
            <span class="sr-only">Loading...</span>
        </span>
        <slot />
    </button>
</template>
