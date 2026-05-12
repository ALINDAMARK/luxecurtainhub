<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'image_url',
        'description',
        'featured',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function catalog(): Collection
    {
        $products = static::query()->orderBy('sort_order')->get()->map(function (self $product) {
            return $product->toArray();
        });

        if ($products->isNotEmpty()) {
            return $products;
        }

        return collect(static::defaults());
    }

    public static function featured(): Collection
    {
        $products = static::query()->where('featured', true)->orderBy('sort_order')->get()->map(function (self $product) {
            return $product->toArray();
        });

        if ($products->isNotEmpty()) {
            return $products;
        }

        return collect(static::defaults())->where('featured', true)->values();
    }

    public static function defaults(): array
    {
        return [
            [
                'name' => 'Velvet Drape',
                'category' => 'Luxury Living Room',
                'price' => 120,
                'image_url' => 'https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg',
                'description' => 'A rich blackout velvet made for dramatic interiors.',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Sheer Glow',
                'category' => 'Airy Daylight',
                'price' => 85,
                'image_url' => 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg',
                'description' => 'Light-filtering sheers for softer daylight.',
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Royal Blackout',
                'category' => 'Bedroom Comfort',
                'price' => 145,
                'image_url' => 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg',
                'description' => 'A tailored blackout panel for privacy and rest.',
                'featured' => false,
                'sort_order' => 3,
            ],
        ];
    }
}
