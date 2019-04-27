const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const webpack = require('webpack');

commonConfig = {
  entry: {
    app: [
      path.join(__dirname, 'src/Index.js')
    ],
    vendor2: ['react', 'react-router-dom', 'mobx', 'react-dom', 'mobx-react']//分离第三方库,可自定义增加
  },
  output: {
    path: path.join(__dirname, '../server/public/admin/'),
    filename: '[name].[chunkhash].js',
    chunkFilename: '[name].[chunkhash].js',
    publicPath: "/admin"
  },
  module: {
    rules: [{
      test: /\.js$/,
      use: ['babel-loader?cacheDirectory=true'],
      include: path.join(__dirname, 'src')
    }, {
      test: /\.(png|jpg|gif|ico|jpeg|bmp)$/,
      use: [{
        loader: 'url-loader',
        options: {
          limit: 8192
        }
      }]
    }, {
      test: /\.less$/,
      use: [{
        loader: "style-loader"
      }, {
        loader: "css-loader"
      }, {
        loader: "less-loader",
        options: {
          javascriptEnabled: true
        }
      }]
    }, {
      test: /\.scss$/,
      use: [
        {loader: 'style-loader', options: {sourceMap: true}},
        {loader: 'css-loader', options: {sourceMap: true}},
        {loader: 'postcss-loader', options: {sourceMap: true}},
        {loader: 'sass-loader', options: {sourceMap: true}}
      ]
    }]
  },
  plugins: [
    new HtmlWebpackPlugin({
      filename: 'index.html',
      favicon: 'src/assets/favicon.ico',
      template: path.join(__dirname, 'src/index.html')
    }),
    // new webpack.HashedModuleIdsPlugin(),
    // new webpack.optimize.splitChunks({
    //     name: 'vendor'
    // }),
    // new webpack.optimize.splitChunks({
    //     name: 'runtime'
    // })
  ],
  optimization: {
    splitChunks: {
      chunks: "all",
      cacheGroups: {
        // 提取 node_modules 中代码
        vendors: {
          test: /[\\/]node_modules[\\/]/,
          name: "vendors",
          chunks: "all"
        },
        commons: {
          // async 设置提取异步代码中的公用代码
          chunks: "async",
          name: 'commons-async',
          /**
           * minSize 默认为 30000
           * 想要使代码拆分真的按照我们的设置来
           * 需要减小 minSize
           */
          minSize: 0,
          // 至少为两个 chunks 的公用代码
          minChunks: 2
        }
      }
    },
    /**
     * 对应原来的 minchunks: Infinity
     * 提取 webpack 运行时代码
     * 直接置为 true 或设置 name
     */
    runtimeChunk: {
      name: 'manifest'
    }
  },

  resolve: {
    alias: {
      '@': path.join(__dirname, 'src'),
      'assets': path.join(__dirname, 'src/assets'),
      'pages': path.join(__dirname, 'src/pages'),
      'components': path.join(__dirname, 'src/components'),
      'router': path.join(__dirname, 'src/router'),
      'stores': path.join(__dirname, 'src/stores')
    },
    modules: [path.join(__dirname, 'src'), 'node_modules'],
    extensions: [".js", ".jsx"]
  },
};

module.exports = commonConfig;