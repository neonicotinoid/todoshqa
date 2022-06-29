const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                soar: {
                    '50%': {transform: 'translateY(0.5rem)'}
                },
            },
            animation: {
                'soar': 'soar 8s ease-in-out infinite'
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
