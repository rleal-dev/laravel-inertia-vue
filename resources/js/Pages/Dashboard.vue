<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>

                {{ __('dashboard.page_title') }}
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-xl bg-white dark:bg-gray-800 text-card-foreground shadow-sm">
                        <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                            <h3 class="tracking-tight text-sm font-medium text-gray-900 dark:text-gray-100">Total Revenue</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                class="h-4 w-4 text-muted-foreground dark:text-gray-100">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">$45,231.89</div>
                            <p class="text-xs text-muted-foreground text-gray-900 dark:text-gray-100">+20.1% from last month</p>
                        </div>
                    </div>
                    <div class="rounded-xl bg-white dark:bg-gray-800 text-card-foreground shadow-sm">
                        <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                            <h3 class="tracking-tight text-sm font-medium text-gray-900 dark:text-gray-100">Subscriptions</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                class="h-4 w-4 text-muted-foreground dark:text-gray-100">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">+2350</div>
                            <p class="text-xs text-muted-foreground text-gray-900 dark:text-gray-100">+180.1% from last month</p>
                        </div>
                    </div>
                    <div class="rounded-xl bg-white dark:bg-gray-800 text-card-foreground shadow-sm">
                        <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                            <h3 class="tracking-tight text-sm font-medium text-gray-900 dark:text-gray-100">Sales</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                class="h-4 w-4 text-muted-foreground dark:text-gray-100">
                                <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                                <path d="M2 10h20"></path>
                            </svg>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">+12,234</div>
                            <p class="text-xs text-muted-foreground text-gray-900 dark:text-gray-100">+19% from last month</p>
                        </div>
                    </div>
                    <div class="rounded-xl bg-white dark:bg-gray-800 text-card-foreground shadow-sm">
                        <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                            <h3 class="tracking-tight text-sm font-medium text-gray-900 dark:text-gray-100">Active Now</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                class="h-4 w-4 text-muted-foreground dark:text-gray-100">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                            </svg>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">+573</div>
                            <p class="text-xs text-muted-foreground text-gray-900 dark:text-gray-100">+201 since last hour</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
