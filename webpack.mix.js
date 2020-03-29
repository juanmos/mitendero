const mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
require('dotenv').config();
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

mix.js('resources/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/src'),
                '@assets': path.resolve(__dirname, 'resources/assets'),
                '@sass': path.resolve(__dirname, 'resources/sass')
            }
        }
    })
    .sass('resources/sass/app.scss', 'public/css').options({
        postCss: [require('autoprefixer')]
    })
    .postCss('resources/assets/css/main.css', 'public/css', [
        tailwindcss('tailwind.js')
    ])
    .copy('node_modules/vuesax/dist/vuesax.css', 'public/css/vuesax.css') // Vuesax framework css
    .copy('resources/assets/css/iconfont.css', 'public/css/iconfont.css') // Feather Icon Font css
    .copyDirectory('resources/assets/fonts', 'public/fonts') // Feather Icon fonts
    .copyDirectory('node_modules/material-icons/iconfont', 'public/css/material-icons') // Material Icon fonts
    .copyDirectory('node_modules/material-icons/iconfont/material-icons.css', 'public/css/material-icons/material-icons.css') // Material Icon fonts css
    .copy('node_modules/prismjs/themes/prism-tomorrow.css', 'public/css/prism-tomorrow.css') // Prism Tomorrow theme css
    .copyDirectory('resources/assets/images', 'public/images')
    .copyDirectory('resources/assets/web', 'public/images/web'); // Copy all images from resources to public folder

mix.styles([
        "resources/js/web/vendors/bootstrap/bootstrap.min.css",
        "resources/js/web/vendors/fontawesome/css/all.min.css",
        "resources/js/web/vendors/themify-icons/themify-icons.css",
        "resources/js/web/vendors/linericon/style.css",
        "resources/js/web/vendors/owl-carousel/owl.theme.default.min.css",
        "resources/js/web/vendors/owl-carousel/owl.carousel.min.css",
        "resources/js/web/vendors/flat-icon/font/flaticon.css",
        "resources/js/web/vendors/nice-select/nice-select.css"
    ], 'public/css/web/vendor.min.css')
    .sass('resources/sass/web/style.scss', 'public/css/web/').options({
        postCss: [require('autoprefixer')]
    })
    .scripts([
        "resources/js/web/vendors/jquery/jquery-3.2.1.min.js",
        "resources/js/web/vendors/bootstrap/bootstrap.bundle.min.js",
        "resources/js/web/vendors/owl-carousel/owl.carousel.min.js",
        "resources/js/web/vendors/nice-select/jquery.nice-select.min.js",
        "resources/js/web/jquery.ajaxchimp.min.js",
        "resources/js/web/mail-script.js",
        "resources/js/web/skrollr.min.js",
        "resources/js/web/main.js"
    ], 'public/js/web.min.js');

// Change below options according to your requirement
if (mix.inProduction()) {
    mix.version();
    mix.webpackConfig({
        output: {
            chunkFilename: 'js/chunks/[name].[chunkhash].js',
        }
    });
    mix.setResourceRoot("/demo/vuexy-vuejs-laravel-admin-template/demo-1/");
} else {
    mix.webpackConfig({
        output: {
            chunkFilename: 'js/chunks/[name].js',
        }
    });
}