import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/php.css', 'resources/js/php.js'],
            refresh: true,
        }),
    ],
});
