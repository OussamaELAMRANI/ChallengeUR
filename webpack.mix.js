const config = require('./webpack.config');
const mix = require('laravel-mix');

mix.browserSync('challenge.io');

mix.js('resources/js/app.js', 'public/js')
	.webpackConfig({
		output: {chunkFilename: 'js/[name].js'}
	})
	.sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig(config);
