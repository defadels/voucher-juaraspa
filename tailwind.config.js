import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
                serif: ['Lusitana', ...defaultTheme.fontFamily.serif],
                lato: ['Lato', 'sans-serif'],
                lusitana: ['Lusitana', 'serif'],
            },
            colors: {
                spa: {
                    cream: '#F6EFDE',
                    'cream-light': '#FAF6ED',
                    dark: '#2A2421',
                    'dark-muted': '#635752',
                    gold: '#C5A059',
                    'gold-dark': '#9E7B3B',
                },
            },
        },
    },

    plugins: [forms],
};
