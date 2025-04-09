import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                    'resources/css/home.css',
                    'resources/css/game.css',
                    'resources/css/pano.css',
                    'resources/css/leaderboard.css',
                    'resources/css/auth.css',
                    'resources/css/manual.css',
                    'resources/js/map.js',
                    'resources/js/home.js',
                    'resources/js/pano.js'
                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
