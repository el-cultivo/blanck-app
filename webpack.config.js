require('dotenv').config();

const path = require('path');
const webpack = require('webpack');
const autoprefixer = require('autoprefixer');
const ManifestPlugin = require('webpack-manifest-plugin');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');

const extractSass = new ExtractTextPlugin({
    filename: "[name].[hash].css",
    // disable: process.env.NODE_ENV === "dev"
});

const addProductionPlugins = plugins_arr => {
	if (process.env.NODE_ENV === 'prod') {
		return plugins_arr.concat([
			new webpack.optimize.UglifyJsPlugin({
				compress: {
					drop_console: true,
					dead_code: true
				},
				mangle: {
					reserved: ['$']
				},
				output: {
					comments: false
				}
			}),
			new webpack.DefinePlugin({
			      'process.env': {
			        NODE_ENV: '"production"'
			      }
			    }),
			new webpack.LoaderOptionsPlugin({
			    options: {
			      postcss: [
			        autoprefixer({
				      browsers: ['last 5 versions', '> 5%']
				    }),
			      ]
			     }
			  }),
			extractSass,
			 new OptimizeCssAssetsPlugin(),
			 new ManifestPlugin({fileName: 'rev-manifest.json'})
		])
	} else if (process.env.NODE_ENV === 'dev' && process.env.WEBPACK !== 'hot'){
		return plugins_arr.concat([
			extractSass,
			new webpack.LoaderOptionsPlugin({
			    options: {
			      postcss: [
			        autoprefixer({
				      browsers: ['last 5 versions', '> 5%']
				    }),
			      ]
			     }
			  }),
			new ManifestPlugin({fileName: 'rev-manifest.json'})
		])
	} else if (process.env.WEBPACK === 'hot') {
		return plugins_arr.concat([
			new webpack.HotModuleReplacementPlugin(),
			new webpack.DefinePlugin({
			      'process.env': {
			        NODE_ENV: '"webpack"'
			      }
			    })
		]);
	} else {
		return plugins_arr
	}
}

const entry = (hot_build) => {
	if (hot_build === 'functions') {
		return {
			bundle: './resources/assets/js/micorriza.js'
		}
	}

	if (hot_build === 'admin-bundle') {
		return {
			'admin-bundle': './resources/assets/js/micorriza-admin.js',
		}
	}

	if (process.env.WEBPACK === 'hot') {
		return  {
			bundle: './resources/assets/js/micorriza.js',
			'admin-bundle': './resources/assets/js/micorriza-admin.js'
		}
	}

	return  {
		bundle: ['./resources/assets/js/mazorca.js', './resources/assets/js/micorriza.js'],
		'admin-bundle': ['./resources/assets/js/mazorca-admin.js','./resources/assets/js/micorriza-admin.js']
	}
}

module.exports = {
	entry: entry(process.env.HOT_BUILD),

	output: {
		filename: process.env.WEBPACK === 'hot' ? '[name].js' : '[name].[hash].js',
		path:  process.env.WEBPACK === 'hot' ? '/' :path.resolve(__dirname, 'public/build'),
		publicPath: 'http://localhost:8080/'
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /(node_modules|bower_components)/,
				use: {
					loader: 'babel-loader?cacheDirectory',
					options: {
						presets: ['env']
					}
				}
			},
			{
				test: /\.html/,
				loader: 'html-loader',
				options: {
					attrs: false,
				}
			},
			{
				test: /\.scss$/,
				use: extractSass.extract({
	               use: [{
	                   // loader: "raw-loader"
	                   loader: "css-loader?url=false"//for sourcemaps
	               },
	               {
	                   loader: "postcss-loader"
	               },
	               {
	                   loader: "sass-loader",
	               }],
	               // use style-loader in development
	               fallback: "style-loader"
	           })
			},
			{
			        test: /\.vue$/,
			        loader: 'vue-loader',
			               options: {
			               	loaders: {
			                 scss: 'vue-style-loader!css-loader!sass-loader'
			               	}
			               },
			}
			// ,
			// {//para purescript
			// 	test: /\.purs$/,
			// 	use: [
			// 		{
			// 			loader: 'purs-loader',
			// 			options: {
			// 				src: [
			// 				'./purescript/bower_components/purescript-*/src/**/*.purs',
			// 				'./purescript/src/**/*.purs'
			// 				],
			// 				bundle: false,
			// 				psc: 'psa',
			// 				// watch: isWebpackDevServer || isWatch,
			// 				watch: true,
			// 				pscIde: false
			// 			}
			// 		}
			// 	]
			// }
		]
	},
	resolve: {
		alias: {
		  vue$: 'vue/dist/vue.common.js',
		}
	},
	plugins: addProductionPlugins([
			new webpack.NamedModulesPlugin()
		]),
	devtool: "source-map",
	devServer: {
		hot: true, // this enables hot reload
	  	inline: true, // use inline method for hmr
	  	headers: {'Access-Control-Allow-Origin': '*'}
	},
};
