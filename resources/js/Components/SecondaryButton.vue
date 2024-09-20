<script setup>
defineProps({
    type: { type: String, default: 'button' },
    disabled: { type: Boolean, default: false },
    loading: { type: Boolean, default: false },
})
</script>

<template>
    <button
        :type="type"
        :disabled="disabled || loading"
        class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <span v-if="loading" class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-dark dark:text-gray-200 rounded-full mr-2" role="status" aria-label="loading">
            <span class="sr-only">Loading...</span>
        </span>
        <slot />
    </button>
</template>
