import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    css: {
        transformer: 'postcss', // Gunakan PostCSS, bukan LightningCSS
    },
    build: {
        minify: 'esbuild',
    },
});
