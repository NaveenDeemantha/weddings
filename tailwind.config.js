import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                display: ['"Cinzel"', 'serif'],
                script: ['"Alex Brush"', 'cursive'],
            },
            colors: {
                gold: {
                    50: '#fdfbf4',
                    100: '#faf5e5',
                    200: '#f4e9c7',
                    300: '#ebdaa1',
                    400: '#dec373',
                    500: '#c5a059',
                    600: '#a7823b',
                    700: '#8c6d37',
                    800: '#6d532a',
                    900: '#543f1f',
                },
                linen: {
                    50: '#fcfbf8',
                    100: '#f8f6f0',
                    200: '#f1ede1',
                    300: '#e5dfcd',
                    400: '#d5cca7',
                },
                navy: {
                    800: '#15253b',
                    900: '#0e1a2b',
                    950: '#08111d',
                },
            },
            animation: {
                'float-gentle': 'float 5s ease-in-out infinite',
                'pulse-subtle': 'pulseSubtle 3s ease-in-out infinite',
                'shimmer': 'shimmer 2.5s infinite linear',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-6px)' },
                },
                pulseSubtle: {
                    '0%, 100%': { opacity: '0.9', transform: 'scale(1)' },
                    '50%': { opacity: '1', transform: 'scale(1.02)' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
        },
    },

    plugins: [forms],
};
