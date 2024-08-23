<script setup>
defineProps({
    links: { type: Array },
})
</script>

<template>
    <nav class="flex items-center space-x-1">
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :key="link.url"
            :href="link.url"
            class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 dark:hover:bg-gray-800 disabled:opacity-50 disabled:pointer-events-none"
            :class="{
                'text-gray-500 dark:text-gray-200': ! link.url,
                'bg-gray-200 dark:text-gray-800 font-bold' : link.active
            }"
        >
            <span v-html="link.label"></span>
        </Component>
    </nav>
</template>