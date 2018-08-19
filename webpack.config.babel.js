import ExtractTextPlugin from 'extract-text-webpack-plugin';
import OptimizeCssAssetsPlugin from 'optimize-css-assets-webpack-plugin';
import path from 'path';

const entry = {
	darenorthward: path.resolve( __dirname, './src/js/' ),
	'darenorthward-editor': path.resolve( __dirname, './src/js/editor' ),
	'darenorthward-frontend': path.resolve( __dirname, './src/js/frontend' ),
};

const filename = '[name].js';
const plugins  = [
	new ExtractTextPlugin( '[name].css' ),
	new OptimizeCssAssetsPlugin( { cssProcessor: require( 'cssnano' ) } ),
];

const main = {
	mode: 'production' === process.env.NODE_ENV ? 'production' : 'development',
	entry,
	output: {
		filename,
		chunkFilename: '[name].js',
		path: path.resolve( __dirname, 'dist' ),
	},
	plugins,
	externals: {
		lodash: 'lodash',
		react: 'React',
		'@wordpress/blocks': 'wp.blocks',
		'@wordpress/i18n': 'wp.i18n',
		'@wordpress/components': 'wp.components',
		'@wordpress/element': 'wp.element',
		'@wordpress/editor': 'wp.editor',
		'@wordpress/html-entities': 'wp.htmlEntities',
		'@wordpress/data': 'wp.data',
		'@wordpress/compose': 'wp.compose',
		'@wordpress/dom-ready': 'wp.domReady',
		'@wordpress/keycodes': 'wp.keycodes',
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: [ '@wordpress/babel-preset-default' ],
						plugins: [
							[
								'@wordpress/babel-plugin-import-jsx-pragma',
								{
									scopeVariable: 'createElement',
									source: '@wordpress/element',
									isDefault: false,
						},
							],
						],
					},
				},
		},
			{
				test: /\.scss$/,
				use: ExtractTextPlugin.extract(
					{
						fallback: 'style-loader',
						use: [ 'css-loader', 'postcss-loader', 'sass-loader' ],
					}
				),
		},
			{
				test: /\.(png|svg|jpg|gif|woff|woff2|eot|ttf|otf)$/,
				use: { loader: 'file-loader', options: { publicPath: '' } },
		},
		],
	},
	devtool: 'sourcemap',
	optimization: {
		splitChunks: {
			cacheGroups: {
				commons: {
					test: /[\\/]node_modules[\\ / ] / ,
					name: 'vendors',
					chunks: 'all',
				},
			},
		},
	},
};

export default main;
