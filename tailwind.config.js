import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // New Light Green Theme
                primary: {
                    50: '#f9f7e8',
                    100: '#f6f0d7',  // Light cream background
                    200: '#e8edc2',
                    300: '#c5d89d',  // Light green primary
                    400: '#b5cc7d',
                    500: '#9cab84',  // Sage green
                    600: '#89986d',  // Olive green
                    700: '#6b7854',
                    800: '#4d5740',
                    900: '#2f362b',
                    DEFAULT: '#c5d89d',
                },
                secondary: {
                    DEFAULT: '#9cab84',
                    light: '#b5cc7d',
                    dark: '#89986d',
                },
                accent: {
                    DEFAULT: '#f6f0d7',  // Cream
                    light: '#faf8ed',
                    dark: '#e8edc2',
                },
                background: {
                    DEFAULT: '#f6f0d7',  // Cream background
                    dark: '#2d2d2d',
                    card: '#ffffff',
                },
                surface: {
                    light: '#ffffff',
                    dark: '#3d3d3d',
                },
                text: {
                    primary: '#2d2d2d',    // Dark text
                    secondary: '#89986d',    // Olive text
                    muted: '#9cab84',        // Sage muted
                    light: '#f6f0d7',        // Cream text
                },
                // Status colors
                success: {
                    DEFAULT: '#9cab84',
                    light: '#c5d89d',
                    dark: '#6b7854',
                },
                danger: {
                    DEFAULT: '#c17b7b',
                    light: '#d9a3a3',
                    dark: '#8b4141',
                },
                warning: {
                    DEFAULT: '#d8c59d',
                    light: '#e8d9b8',
                    dark: '#9a8560',
                },
            },
            backgroundImage: {
                'gradient-primary': 'linear-gradient(135deg, #c5d89d 0%, #9cab84 100%)',
                'gradient-secondary': 'linear-gradient(135deg, #9cab84 0%, #89986d 100%)',
                'gradient-accent': 'linear-gradient(135deg, #f6f0d7 0%, #e8edc2 100%)',
                'gradient-dark': 'linear-gradient(135deg, #2d2d2d 0%, #3d3d3d 100%)',
            },
            boxShadow: {
                'soft': '0 4px 24px 0 rgba(137, 152, 109, 0.15)',
                'soft-lg': '0 10px 40px 0 rgba(137, 152, 109, 0.2)',
                'glow': '0 0 20px 2px rgba(197, 216, 157, 0.4)',
            },
            borderRadius: {
                'xl': '1rem',
                '2xl': '1.25rem',
                '3xl': '1.5rem',
            },
        },
    },
    plugins: [forms],
};
