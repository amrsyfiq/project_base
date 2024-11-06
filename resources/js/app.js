import './bootstrap';
import '../css/app.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'vue-select/dist/vue-select.css';
import 'flowbite';


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import vSelect from "vue-select";
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import FileUpload from 'primevue/fileupload';
import { definePreset } from '@primevue/themes';

const appName = import.meta.env.VITE_APP_NAME || 'Axon';

const MyPreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: '{gray.50}',
            100: '{gray.100}',
            200: '{gray.200}',
            300: '{gray.300}',
            400: '{gray.400}',
            500: '{gray.500}',
            600: '{gray.600}',
            700: '{gray.700}',
            800: '{gray.800}',
            900: '{gray.900}',
            950: '{gray.950}'
        }
    }
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                theme: {
                    preset: MyPreset,
                    options: {
                        darkModeSelector: '.dark',
                    },
                    colorScheme: {
                        dark: {
                            primary: {}
                        }
                    }
                }
            })
            .component("v-select", vSelect)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
