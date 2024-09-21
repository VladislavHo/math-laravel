import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/react/main.tsx'],
            refresh: true,
        }),
        react()
    ],
    server: {
        https: true, // Enable HTTPS
        host: '0.0.0.0', // Allow access from external IPs
        port: 3000, // Change this if needed
    },
});
