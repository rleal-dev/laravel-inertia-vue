<template>
    <Link v-if="$page.props.language !== 'pt_BR'" :href="route('language', 'pt_BR')">
        <img src="/images/brasil.webp" class="mr-2 w-7 h-7" />
    </Link>
    <Link v-if="$page.props.language !== 'en'" :href="route('language', 'en')">
        <img src="/images/usa.webp" class="mr-2 w-7 h-7" />
    </Link>
</template>