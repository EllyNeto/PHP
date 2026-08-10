/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        ink:    '#0F1B2D', // fundo institucional (sidebar/topbar)
        ink2:   '#16273F',
        surface:'#F6F7F9', // fundo da área de conteúdo
        card:   '#FFFFFF',
        amber:  '#E8A33D', // acento técnico (electricidade/energia)
        amberD: '#C6832A',
        green:  '#2F7D5A', // pago / activo
        red:    '#C4453D', // em atraso / inactivo
        slate2: '#5B6B7A',
      },
      fontFamily: {
        display: ['"Space Grotesk"', 'sans-serif'],
        body: ['Inter', 'sans-serif'],
        mono: ['"IBM Plex Mono"', 'monospace'],
      },
    },
  },
  plugins: [],
};
