import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'reveal': 'reveal 1s cubic-bezier(0.22, 1, 0.36, 1) forwards',
                'spin-slow': 'spin 10s linear infinite',
                'fade-in': 'fadeIn 0.8s ease-out forwards',
                'fade-in-up': 'fadeIn 1s ease-out forwards',
                'slow-zoom': 'slowZoom 20s linear infinite alternate',
            },
            keyframes: {
                reveal: {
                    'from': { opacity: '0', transform: 'translateY(30px)' },
                    'to': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    'from': { opacity: '0', transform: 'translateY(20px)' },
                    'to': { opacity: '1', transform: 'translateY(0)' },
                },
                slowZoom: {
                    'from': { transform: 'scale(1)' },
                    'to': { transform: 'scale(1.1)' },
                },
                spin: {
                    'from': { transform: 'rotate(0deg)' },
                    'to': { transform: 'rotate(360deg)' },
                }
            }
        },
    },

    plugins: [
        forms,
        typography,
        plugin(function ({ addUtilities }) {
            addUtilities({
                '.text-glow': {
                    'text-shadow': '0 0 20px rgba(74, 222, 128, 0.3)',
                },
                '.no-scrollbar::-webkit-scrollbar': {
                    'display': 'none',
                },
                '.no-scrollbar': {
                    '-ms-overflow-style': 'none',
                    'scrollbar-width': 'none',
                },
            })
        })
    ],
};
