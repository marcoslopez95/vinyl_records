const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                descripcion: "#7C8498",
                descripcion_variant: "#ACBADC",
                titulo: "#3D465B",
                link: "#3568F0",
                "link-hover": "#353cf0",
                container: "#EEF0F6",
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
