<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SuccessStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'location',
        'quote',
        'story',
        'image_url',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function featured(): Collection
    {
        $stories = static::query()
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->limit(3)
            ->get()
            ->map(function (self $story) {
                return $story->toArray();
            });

        if ($stories->isNotEmpty()) {
            return $stories;
        }

        return collect(static::defaults());
    }

    public static function defaults(): array
    {
        return [
            [
                'client_name' => 'Amara N.',
                'location' => 'Kampala',
                'quote' => 'LuxeCurtain Hub transformed our entire living space.',
                'story' => 'The room felt like a different world after the install.',
                'image_url' => 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'David K.',
                'location' => 'Kampala',
                'quote' => 'The quality is unmatched.',
                'story' => 'They came to measure, brought samples, and delivered exactly what I imagined.',
                'image_url' => 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'Sarah M.',
                'location' => 'Kampala',
                'quote' => 'I’ve used them twice now.',
                'story' => 'Both times, the result was flawless.',
                'image_url' => 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg',
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];
    }
}
