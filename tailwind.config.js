import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        'bg-red-600',
        'group-hover:bg-red-600',
        'group-hover:text-red-400',
        'group-hover:shadow-red-500/50',
        'bg-yellow-600',
        'group-hover:bg-yellow-600',
        'group-hover:text-yellow-400',
        'group-hover:shadow-yellow-500/50',
        'bg-green-600',
        'group-hover:bg-green-600',
        'group-hover:text-green-400',
        'group-hover:shadow-green-500/50',
        'bg-blue-600',
        'group-hover:bg-blue-600',
        'group-hover:text-blue-400',
        'group-hover:shadow-blue-500/50',
        'bg-indigo-600',
        'group-hover:bg-indigo-600',
        'group-hover:text-indigo-400',
        'group-hover:shadow-indigo-500/50',
        'bg-purple-600',
        'group-hover:bg-purple-600',
        'group-hover:text-purple-400',
        'group-hover:shadow-purple-500/50',
        'bg-pink-600',
        'group-hover:bg-pink-600',
        'group-hover:text-pink-400',
        'group-hover:shadow-pink-500/50',
      ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    darkMode: "class",

    plugins: [forms, typography],

    corePlugins: {
        container: false,
    }
};
