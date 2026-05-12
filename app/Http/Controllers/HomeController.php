<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Product;
use App\Models\SiteImage;
use App\Models\SuccessStory;

class HomeController extends Controller
{
    public function index()
    {
        $heroImage = SiteImage::activeForSlot('hero')->first();
        $featuredImage = SiteImage::activeForSlot('featured')->first();

        return view('home', [
            'title' => 'LuxeCurtain Hub',
            'heroImageUrl' => $heroImage['image_url'] ?? 'https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg',
            'featuredImageUrl' => $featuredImage['image_url'] ?? 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg',
            'featuredProducts' => Product::featured()->values()->all(),
            'stripImages' => SiteImage::activeForSlot('strip')->values()->all(),
            'lookbookImages' => SiteImage::activeForSlot('lookbook')->values()->all(),
            'successStories' => SuccessStory::featured()->values()->all(),
            'blogPosts' => BlogPost::published()->values()->all(),
        ]);
    }
}
