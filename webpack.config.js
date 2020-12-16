const path = require('path');
const IgnoreEmitPlugin = require('ignore-emit-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');
const defaultConfig = require('./node_modules/@wordpress/scripts/config/webpack.config.js');

const devMode = process.env.NODE_ENV !== 'production';
const devDirectory = `/wecodeart/wp-content/plugins/${__dirname.split('\\').pop()}/assets/`;
const liveDirectory = `/wp-content/plugins/${__dirname.split('\\').pop()}/assets/`;
const wplib = ['apiFetch', 'i18n'];

module.exports = {
	...defaultConfig,
	entry: {
		'js/frontend': path.resolve(process.cwd(), 'src', 'js', 'frontend.js'),
		'css/frontend': path.resolve(process.cwd(), 'src', 'scss', 'frontend.scss'),
	},
	output: {
		path: path.resolve(process.cwd(), 'assets'),
		publicPath: devMode ? devDirectory : liveDirectory,
		filename: '[name].js',
		chunkFilename: '[name].js'
	},
	optimization: {
		...defaultConfig.optimization,
		namedChunks: true,
	},
	externals: wplib.reduce((externals, lib) => {
		externals[`wp.${lib}`] = {
			window: ['wp', lib],
		};

		return externals;
	}, {
		'wp': 'wp',
		'jquery': 'jQuery',
	}),
	plugins: [
		/* ...defaultConfig.plugins, */ // We Use custom similar setup but with BSync
		process.env.WP_BUNDLE_ANALYZER && new BundleAnalyzerPlugin(),
		new MiniCssExtractPlugin(),
		new IgnoreEmitPlugin([
			'css/frontend.js',
			'css/frontend.asset.php',
			'css/frontend.deps.json',
		]),
		!devMode ? new DependencyExtractionWebpackPlugin({
			injectPolyfill: true
		}) : false,
		devMode ? new BrowserSyncPlugin({
			host: 'localhost',
			proxy: `http://working.on/wecodeart/`,
			port: 3000,
		}, {
			injectCss: true
		}) : false
	].filter(Boolean),
};