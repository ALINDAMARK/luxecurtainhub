<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SiteImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot',
        'title',
        'image_url',
        'alt_text',
        'caption',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function activeForSlot(string $slot): Collection
    {
        $images = static::query()
            ->where('slot', $slot)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function (self $image) {
                return $image->toArray();
            });

        if ($images->isNotEmpty()) {
            return $images;
        }

        return collect(static::defaultsForSlot($slot));
    }

    public static function defaultsForSlot(string $slot): array
    {
        return match ($slot) {
            'hero' => [[
                'slot' => 'hero',
                'title' => 'Hero Interior',
                'image_url' => 'https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg',
                'alt_text' => 'Luxury curtain interior',
                'caption' => null,
                'is_active' => true,
                'sort_order' => 1,
            ]],
            'strip' => [
                ['slot' => 'strip', 'title' => 'Living Room', 'image_url' => 'https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg', 'alt_text' => 'Curtains in a living room', 'caption' => 'Living Room', 'is_active' => true, 'sort_order' => 1],
                ['slot' => 'strip', 'title' => 'Bedroom', 'image_url' => 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg', 'alt_text' => 'Bedroom curtains', 'caption' => 'Bedroom', 'is_active' => true, 'sort_order' => 2],
                ['slot' => 'strip', 'title' => 'Dining Room', 'image_url' => 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg', 'alt_text' => 'Dining room curtains', 'caption' => 'Dining Room', 'is_active' => true, 'sort_order' => 3],
                ['slot' => 'strip', 'title' => 'Home Office', 'image_url' => 'https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg', 'alt_text' => 'Home office curtain design', 'caption' => 'Home Office', 'is_active' => true, 'sort_order' => 4],
                ['slot' => 'strip', 'title' => 'Entryway', 'image_url' => 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg', 'alt_text' => 'Entryway curtains', 'caption' => 'Entryway', 'is_active' => true, 'sort_order' => 5],
            ],
            'lookbook' => [
                ['slot' => 'lookbook', 'title' => 'Serene Living Room', 'image_url' => 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg', 'alt_text' => 'Serene living room with curtains', 'caption' => 'Serene Living Room', 'is_active' => true, 'sort_order' => 1],
                ['slot' => 'lookbook', 'title' => 'Master Bedroom Suite', 'image_url' => 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg', 'alt_text' => 'Master bedroom drapes', 'caption' => 'Master Bedroom Suite', 'is_active' => true, 'sort_order' => 2],
                ['slot' => 'lookbook', 'title' => 'Sheer Morning Light', 'image_url' => 'https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg', 'alt_text' => 'Sheer morning panels', 'caption' => 'Sheer Morning Light', 'is_active' => true, 'sort_order' => 3],
                ['slot' => 'lookbook', 'title' => 'Formal Dining Room', 'image_url' => 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg', 'alt_text' => 'Formal dining room', 'caption' => 'Formal Dining Room', 'is_active' => true, 'sort_order' => 4],
                ['slot' => 'lookbook', 'title' => 'Executive Home Office', 'image_url' => 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg', 'alt_text' => 'Executive home office', 'caption' => 'Executive Home Office', 'is_active' => true, 'sort_order' => 5],
            ],
            'featured' => [[
                'slot' => 'featured',
                'title' => 'Golden Hour Collection',
                'image_url' => 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg',
                'alt_text' => 'Featured curtain interior',
                'caption' => null,
                'is_active' => true,
                'sort_order' => 1,
            ]],
            default => [],
        };
    }
}
