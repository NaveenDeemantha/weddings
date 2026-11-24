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
                serif: ['"Cormorant Garamond"', '"Abhaya Libre"', '"Noto Serif Sinhala"', 'Georgia', 'serif'],
                display: ['"Cinzel"', '"Abhaya Libre"', '"Noto Serif Sinhala"', 'serif'],
                script: ['"Alex Brush"', 'cursive'],
                sinhala: ['"Abhaya Libre"', '"Noto Serif Sinhala"', 'serif'],
            },
            colors: {
                gold: {
                    50: '#fff5f8',
                    100: '#ffe4ee',
                    200: '#fdc7da',
                    300: '#fba3c2',
                    400: '#F678A4',
                    500: '#C8636F',
                    600: '#b8365a',
                    700: '#ad2c51',
                    800: '#8a2342',
                    900: '#6e1a34',
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
