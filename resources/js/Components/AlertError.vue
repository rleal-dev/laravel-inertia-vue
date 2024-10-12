<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

defineProps({
    message: { type: String, default: null }
})

const isVisible = ref(true)
let timer = null

const closeAlert = () => isVisible.value = false

onMounted(() => timer = setInterval(() => closeAlert(), 10000))
onUnmounted(() => clearInterval(timer))
</script>

<template>
    <div v-if="message && isVisible" class="bg-red-100 dark:bg-red-900 rounded text-red-900 dark:text-red-100 px-4 py-3 mb-3" role="alert">
        <div class="flex">
            <svg class="fill-current h-6 w-6 text-red-500 dark:text-red-400 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
            </svg>
            <p>{{ message }}</p>
            <button @click="closeAlert" class="ml-auto text-red-500 hover:text-red-700 dark:hover:text-red-300 font-bold focus:outline-none">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
</template>