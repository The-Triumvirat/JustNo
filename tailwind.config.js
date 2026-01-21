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
            colors: {
                /* Trium CI */
                trium: {
                50:  "#e8f8f8",
                100: "#c9eeee",
                200: "#a8e2e1",
                300: "#87cfce",
                400: "#62c1bf", // primary
                500: "#44acaa", // strong
                },

                /* App surfaces */
                "trium-bg":    "#0b1014",
                "trium-bg2":   "#0f151b",
                "trium-panel": "#101820",
                "trium-border":"#1f2a33",
                "trium-text":  "#e6ecec",
                "trium-sub":   "#9fb3b5",
            },

            boxShadow: {
                "trium": "0 0 30px rgba(98, 193, 191, .25)",
                "trium-soft": "0 0 18px rgba(68, 172, 170, .18)"
            },

            borderRadius: {
                xl: "14px"
            },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
