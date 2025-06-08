import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: { extend: {} },
  plugins: [require('@tailwindcss/typography'), require('@tailwindcss/line-clamp')],
}
