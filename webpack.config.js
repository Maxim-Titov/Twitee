const path = require('path');

module.exports = {
  // Вхідні точки: обробляємо лише JavaScript-файли
  entry: {
    'add-twit-res': './js/add-twit-res.js',
    'edit-twit-res': './js/edit-twit-res.js'
  },
  // Вихідна збірка
  output: {
    filename: '[name].bundle.js', // формування імені файлу: наприклад, add-twit-resizeBy.bundle.js
    path: path.resolve(__dirname, 'dist'), // усі згенеровані файли потраплять у папку dist
    clean: true
  },
  module: {
    rules: [
      // Обробка JavaScript через Babel
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: { 
            presets: ['@babel/preset-env'] 
          }
        }
      },
      // Приклад правила для обробки зображень
      {
        test: /\.(png|svg|jpg|jpeg|gif)$/i,
        type: 'asset/resource'
      },
      // Приклад правила для обробки шрифтів
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/i,
        type: 'asset/resource'
      }
    ]
  },
  // Налаштування webpack-dev-server для локальної розробки
  devServer: {
    static: {
      directory: path.join(__dirname, 'dist')
    },
    compress: true,
    port: 9000
  },
  mode: 'development' // або 'production' для фінальної збірки
};
