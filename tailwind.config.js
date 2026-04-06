// tailwind.config.js
module.exports = {
  purge: ['./*.html'],
  theme: {
    extend: {
      colors: {
        orange: require('tailwindcss/colors').orange,
      },
    },
  },
  variants: {},
  plugins: [],
};
