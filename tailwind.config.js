import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/js/**/*.{vue, js, ts, jsx, tsx}"
    ],

    theme: {
        extend: {
            maxHeight: {
                '0': '0',
                '1/4': '25%',
                '1/2': '50%',
                '3/4': '75%',
                'full': '100%',
                '36': '9rem',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
