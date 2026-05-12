const productModel = require('../models/productModel');

exports.index = (req, res) => {
  const featuredProducts = productModel.getFeaturedProducts();
  res.render('home', {
    title: 'LuxeCurtain Hub',
    featuredProducts,
  });
};
