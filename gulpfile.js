const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 * |-------------------------------------------------------------------------- |
 * Elixir Asset Management
 * |-------------------------------------------------------------------------- | |
 * Elixir provides a clean, fluent API for defining some basic Gulp tasks | for
 * your Laravel application. By default, we are compiling the Sass | file for
 * our application, as well as publishing vendor resources. |
 */

elixir(mix => {
    mix.styles(['app.css'])
       .webpack('app.js')
    //.copy('resources/assets/images', 'public/images')
    .copy('resources/assets/fonts', 'public/fonts');
    mix.version(['css/all.css', 'js/app.js'], 'public');
    
});
