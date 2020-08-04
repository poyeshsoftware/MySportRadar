module.exports = {
    purge: [
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.jsx',
        './resources/**/*.js',
        './resources/**/*.scss',
    ],
    theme: {
        extend: {},
    },
    variants: {},
    plugins: [
        require('@tailwindcss/custom-forms')
    ],
};
