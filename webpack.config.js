module.exports = {
	entry: {
		main: './js/src/index.js',
		editor: './js/src/editor.js',
	},
	output: {
		filename: '[name].js',
		path: __dirname + '/js/dist',
	},
	watch: false,
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules\/(?!(swiper)\/).*/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: [ '@babel/preset-env' ],
					},
				},
			},
		],
	},
	externals: {
		jquery: 'jQuery',
	},
};
