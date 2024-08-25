
<script setup>
defineProps({
    links: { type: Array }
})
</script>

<template>
    <nav class="flex pt-4 md:pt-0" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li v-for="(link, index) in links" :key="index" class="flex items-center">
                <svg v-if="index > 0" class="rtl:rotate-180 w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>

                <component
                    :is="link.active ? 'span' : 'Link'"
                    :href="link.active ? null : route(link.to)"
                    :class="[
                        'ms-1 text-sm font-medium md:ms-2 dark:text-gray-400',
                        link.active ? 'text-gray-500' : 'text-gray-700 hover:text-blue-600 dark:hover:text-white'
                    ]"
                >
                    {{ __(link.label) }}
                </component>
            </li>
        </ol>
    </nav>
</template>