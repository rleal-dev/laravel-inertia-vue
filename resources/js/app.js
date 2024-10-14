import '../css/app.css'

import { createApp, h } from 'vue'
import { router, usePage, createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import NProgress from 'nprogress'
import { Head, Link } from '@inertiajs/vue3'
import __ from '@/lang'

router.on('start', () => NProgress.start())

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Head', Head)
            .component('Link', Link);

            app.config.globalProperties.__ = __

            app.config.globalProperties.$can = permissions => {
                const { can } = usePage().props.auth || {}

                if (typeof permissions === 'string') {
                    return can?.[permissions] ?? false
                }

                if (Array.isArray(permissions)) {
                    return permissions.some(permission => can?.[permission] ?? false)
                }

                return false
            }
            
            app.mount(el);
    },
    progress: {
        color: '#818cf8',
        showSpinner: true,
    },
})
