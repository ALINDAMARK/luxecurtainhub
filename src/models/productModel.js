const products = [
  {
    id: 1,
    name: 'Velvet Drape',
    category: 'Luxury Living Room',
    price: 120,
    featured: true,
  },
  {
    id: 2,
    name: 'Sheer Glow',
    category: 'Airy Daylight',
    price: 85,
    featured: true,
  },
  {
    id: 3,
    name: 'Royal Blackout',
    category: 'Bedroom Comfort',
    price: 145,
    featured: false,
  },
];

exports.getAllProducts = () => products;

exports.getFeaturedProducts = () => products.filter((product) => product.featured);
