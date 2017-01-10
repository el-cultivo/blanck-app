module.exports = function(config) {
    config.set({

        browsers: ['PhantomJS'],

        files: [
            './node_modules/phantomjs-polyfill/bind-polyfill.js',
            { pattern: 'test-context.js'}
        ],

        frameworks: ['jasmine'],

        preprocessors: {
            'test-context.js': ['webpack']
        },

        webpack: {
            module: {
                loaders: [
                    { test: /\.js/, exclude: /node_modules/, loader: 'babel-loader' }
                ]
            },
            watch: true
        }
    });
};