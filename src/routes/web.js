const express = require('express');
const homeController = require('../controllers/homeController');
const productController = require('../controllers/productController');

const router = express.Router();

router.get('/', homeController.index);
router.get('/products', productController.index);

module.exports = router;
