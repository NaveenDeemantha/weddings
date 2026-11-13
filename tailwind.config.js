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
                serif: ['"Playfair Display"', 'Georgia', 'serif'],
                display: ['"Cinzel"', 'serif'],
                script: ['"Great Vibes"', 'cursive'],
            },
            colors: {
                gold: {
                    50: '#fffcf2',
                    100: '#fef8de',
                    200: '#fcf0b5',
                    300: '#f8e280',
                    400: '#eecb46',
                    500: '#d4ab1e',
                    600: '#b88915',
                    700: '#946613',
                    800: '#7a5116',
                    900: '#674218',
                },
                ivory: {
                    50: '#fdfcf9',
                    100: '#f9f6ed',
                    200: '#f3edd9',
                    300: '#e9dfbd',
                    400: '#dcce9e',
                },
            },
            animation: {
                'float-slow': 'float 4s ease-in-out infinite',
                'float-gentle': 'float 6s ease-in-out infinite',
                'spin-slow': 'spin 12s linear infinite',
                'pulse-glow': 'pulseGlow 2.5s ease-in-out infinite',
                'sparkle': 'sparkle 1.8s ease-in-out infinite',
                'sway': 'sway 3s ease-in-out infinite alternate',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-8px)' },
                },
                pulseGlow: {
                    '0%, 100%': { opacity: '0.9', transform: 'scale(1)' },
                    '50%': { opacity: '1', transform: 'scale(1.03)' },
                },
                sparkle: {
                    '0%, 100%': { opacity: '0.3', transform: 'scale(0.8) rotate(0deg)' },
                    '50%': { opacity: '1', transform: 'scale(1.2) rotate(15deg)' },
                },
                sway: {
                    '0%': { transform: 'rotate(-3deg)' },
                    '100%': { transform: 'rotate(3deg)' },
                },
            },
        },
    },

    plugins: [forms],
};
