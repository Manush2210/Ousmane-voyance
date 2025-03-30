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
    build: {
        // Force single-threaded build
        minify: 'terser',
        terserOptions: {
            compress: {
                // Reduce memory usage
                passes: 1,
            },
        },
        // Use the JS implementation instead of Rust/WASM
        rollupOptions: {
            maxParallelFileOps: 1, // Limit parallel operations
            cache: false,          // Disable cache to save memory
        },
        // Disable reporting which consumes memory
        reportCompressedSize: false,
        chunkSizeWarningLimit: 1000,
    },
    optimizeDeps: {
        // Reduce parallel operations
        force: true,
        esbuildOptions: {
            target: 'es2020',
        },
    },
});
