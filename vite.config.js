import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '192.168.0.101',
        port: 5173,
        hmr: {
            host: '192.168.0.101' // 👉 mets TON IP ici
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
