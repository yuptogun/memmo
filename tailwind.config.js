import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

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
                sans: ['Overused Grotesk', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'binder': {
                    50: '#f7f4ef',
                    100: '#eae5d7',
                    200: '#d8cab0',
                    300: '#c1a983',
                    400: '#ae8e61',
                    500: '#9f7c53',
                    600: '#886446',
                    700: '#6e4e3a',
                    800: '#624538',
                    DEFAULT: '#624538',
                    900: '#523a31',
                    950: '#2e1f1a',
                },
                'paper': {
                    50: '#fdfced',
                    100: '#f9f6cc',
                    DEFAULT: '#f9f6cc',
                    200: '#f3ed94',
                    300: '#ecde5d',
                    400: '#e7cd38',
                    500: '#e0b320',
                    600: '#c68d19',
                    700: '#a46819',
                    800: '#86511a',
                    900: '#6e4319',
                    950: '#3f2309',
                },
            }
        },
    },

    plugins: [forms, typography],
};
