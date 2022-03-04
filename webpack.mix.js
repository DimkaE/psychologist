const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/front/js/app.js', 'public/front/js').vue()
    .sass('resources/front/sass/app.scss', 'public/front/css')
    .webpackConfig(require('./webpack.config'))
    .sourceMaps(true, 'source-map');

mix.js('resources/back/js/app.js', 'public/back/js').vue()
    .sass('resources/back/sass/app.scss', 'public/back/css')
    .webpackConfig(require('./webpack.config'))
    .sourceMaps(true, 'source-map');

if (mix.inProduction()) {
    mix.version();
}
