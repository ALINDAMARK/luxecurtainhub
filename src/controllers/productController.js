const productModel = require('../models/productModel');

exports.index = (req, res) => {
  const products = productModel.getAllProducts();
  res.render('products', {
    title: 'Our Curtains',
    products,
  });
};
