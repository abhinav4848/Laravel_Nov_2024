import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            // can also call css from the bootstrap JS file when building Single page applications
            // input: ['resources/js/app.js'], // in thsi approach, you will be calling the css from the js file
            refresh: true,
        }),
    ],
});
