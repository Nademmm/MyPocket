import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Optimize build output
        rollupOptions: {
            output: {
                // Manual chunks for better caching
                manualChunks: {
                    'alpine': ['alpinejs'],
                },
            },
        },
        // Enable minification (esbuild is default and already included)
        minify: 'esbuild',
    },
    // Optimize dependencies
    optimizeDeps: {
        include: ['alpinejs'],
    },
});
