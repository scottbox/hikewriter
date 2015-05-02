var elixir = require('laravel-elixir');

require('laravel-elixir-sass-compass');

var paths = {
	'jquery': './resources/assets/vendor/jquery/',
	'bootstrap': './resources/assets/vendor/bootstrap-sass-official/assets/'
}

elixir(function(mix){
	mix
		.copy(paths.bootstrap + 'stylesheets/**', './resources/assets/sass/bootstrap')
		.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
		.compass("app.scss", 'public/css/', {
			style: "compressed",
			sass: "./resources/assets/sass"
		})
		.scripts([
			paths.jquery + "dist/jquery.js",
			paths.bootstrap + "javascripts/bootstrap.js"
		], 'public/js/app.js', './');
		
});