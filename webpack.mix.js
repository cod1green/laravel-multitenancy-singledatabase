const mix = require('laravel-mix');

// Tailwindcss
mix
    .postCss('resources/css/app.css', 'public/css/tailwind.css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

// Default
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/site/vue.js', 'public/js/component.js')
    .vue()
    .sourceMaps()
    .browserSync('localhost')
    .webpackConfig(require('./webpack.config'));

// Dashboard
mix.js('resources/js/dashboard/dashboard.js', 'public/js/dashboard')
    .js('resources/js/dashboard/vue.js', 'public/js/dashboard/component.js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/dashboard/dashboard.scss', 'public/css')
    .sourceMaps()
    .browserSync('localhost')
    .webpackConfig(require('./webpack.config'));

// The Project bootstrap and fortawesome
mix.sass('resources/views/frontend/the_project/sass/app.scss', 'public/frontend/the_project/css/app.css')
    .sourceMaps()
    .browserSync('localhost')
    .webpackConfig(require('./webpack.config'));

// The Project core
mix.sass('resources/views/frontend/the_project/sass/rtl_style.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/rtl_typography-default.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/rtl_typography-scheme-0.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/rtl_typography-scheme-2.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/rtl_typography-scheme-3.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/style.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/typography-default.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/typography-scheme-0.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/typography-scheme-2.scss', 'public/frontend/template/css/')
    .sass('resources/views/frontend/the_project/sass/typography-scheme-3.scss', 'public/frontend/template/css/')
    .sourceMaps()
    .browserSync('localhost')
    .webpackConfig(require('./webpack.config'));

// The Project skins
mix.sass('resources/views/frontend/the_project/sass/skins/blue.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/brown.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/cool_green.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/dark_cyan.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/dark_red.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/gold.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/gray.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/green.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/light_blue.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/orange.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/pink.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/purple.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/red.scss', 'public/frontend/template/css/skins')
    .sass('resources/views/frontend/the_project/sass/skins/vivid_red.scss', 'public/frontend/template/css/skins')
    .sourceMaps()
    .browserSync('localhost')
    .webpackConfig(require('./webpack.config'));

// plugins
mix.copy('node_modules/jquery.inputmask/dist/jquery.inputmask.bundle.js', 'public/vendor/jquery.inputmask/jquery.inputmask.js');

if (mix.inProduction()) {
    mix.version();
}
