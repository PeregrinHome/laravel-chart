let mix = require('laravel-mix');
// // require('laravel-mix-purgecss')();
//
const bourbonPaths = require("bourbon").includePaths;
const foundationPath = path.resolve(__dirname, 'node_modules/foundation-sites/scss');

mix.webpackConfig({
    module : {
        rules : [
            {
                test: /\.scss$/,
                use : [
                    {
                        loader: 'sass-loader',
                        options : {
                            includePaths: [bourbonPaths[0],foundationPath ],
                        }
                    },
                ]
            },
        ]
    },
});
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
mix.copyDirectory('resources/libs/materialize-src/fonts', 'public/fonts');
mix.copyDirectory('resources/libs/materialize-colorpicker-master/dist/img', 'public/img');

mix.js('resources/assets/js/app.js', 'public/js/compelled/app.js')
    .sass('resources/libs/materialize-src/sass/materialize.scss', 'public/css/compelled')
    .sass('resources/assets/sass/app.scss', 'public/css/app.css')
    .scripts(
        [
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/jquery-validation/dist/jquery.validation.min.js',
            'node_modules/moment/min/moment-with-locales.min.js',
            'node_modules/moment-timezone/moment-timezone.js',
            'node_modules/highcharts/highstock.js',
            'node_modules/highcharts/modules/exporting.js',
            'resources/libs/materialize-src/js/bin/materialize.min.js',
            'resources/libs/materialize-colorpicker-master/dist/js/materialize-colorpicker.min.js',
            'public/js/compelled/**/*.js'


        ], 'public/js/all.js')
    .styles([
        'public/css/compelled/**/*.css',
        'resources/libs/materialize-colorpicker-master/dist/css/materialize-colorpicker.min.css',
        'public/css/app.css'
    ], 'public/css/all.css');

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css')
//    .purgeCss();
// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

// mix.browserSync({
//     proxy:  // проксирование вашего удаленного сервера, не важно на чем back-end
//         {
//             target: "94.154.14.1",
//             ws: true
//         },
//     logPrefix: '94.154.14.1', // префикс для лога bs, маловажная настройка
//     host:      '94.154.14.1', // можно использовать ip сервера
//     port:      3000, // порт через который будет проксироваться сервер
//     // open: 'external', // указываем, что наш url внешний
//     notify:    true,
//     ghost:     true,
//     // httpModule: 'http2',
//     // https: {
//     //     key: "./ssl/privkey.pem",
//     //     cert: "./ssl/fullchain.pem",
//     // },
// });