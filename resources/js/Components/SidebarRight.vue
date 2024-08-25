<script setup>
const props = defineProps({
    show: { type: Boolean, default: false },
})

const emit = defineEmits(['close'])
</script>

<template>
    <aside v-if="show" class="fixed top-0 right-0 z-50 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 border-l border-gray-100 dark:border-gray-700">
        <button class="w-6 h-6 fixed top-4 left-2" @click="($event) => emit('close')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="oi sl">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div class="h-full px-3 py-12 overflow-y-auto bg-white dark:bg-gray-800">
            <slot />
        </div>
    </aside>
</template>