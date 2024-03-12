mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
      require('postcss-import'),
      require('tailwindcss'),
      require('autoprefixer'),
   ])
   .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css');