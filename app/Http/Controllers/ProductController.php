<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', [
            'title' => 'Curtain Collection | LuxeCurtain Hub',
            'metaDescription' => 'Browse custom curtains, drapes, blackout panels, and premium window dressings from LuxeCurtain Hub.',
            'metaKeywords' => 'curtain collection, custom curtains, drapes, blackout curtains, window dressings, curtain shop Uganda',
            'canonicalUrl' => route('products'),
            'ogImage' => 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg',
            'pageType' => 'product.group',
            'products' => Product::catalog()->values()->all(),
        ]);
    }
}
