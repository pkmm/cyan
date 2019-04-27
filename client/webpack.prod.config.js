const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const merge = require('webpack-merge');

const webpack = require('webpack');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const OfflinePlugin = require('offline-plugin');
const commonConfig = require('./webpack.base.config.js');

const publicConfig = {
  mode: 'production',
  module: {
    rules: [{
      test: /\.css$/,
      use: [
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: {
            url: false
          }
        }
      ]
    }]
  },
  plugins: [
    new CleanWebpackPlugin(),
    new UglifyJSPlugin(),
    new webpack.DefinePlugin({
      'process.env': {
        'NODE_ENV': JSON.stringify('production')
      }
    }),
    new MiniCssExtractPlugin({
      filename: '[name].[contenthash:8].css'
    }),

    // it's always better if OfflinePlugin is the last plugin added
    new OfflinePlugin()
  ]

};

module.exports = merge(commonConfig, publicConfig);