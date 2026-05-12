<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image_url',
        'author',
        'published_at',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function published(): Collection
    {
        $posts = static::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->get()
            ->map(function (self $post) {
                return $post->toArray();
            });

        if ($posts->isNotEmpty()) {
            return $posts;
        }

        return collect(static::defaults());
    }

    public static function defaults(): array
    {
        return [
            [
                'title' => 'Behind the Seam: What Makes a Custom Curtain Feel Expensive',
                'slug' => 'behind-the-seam-custom-curtain-feel-expensive',
                'excerpt' => 'A look at fabric weight, lining, fullness, and why finishing matters more than most people think.',
                'content' => 'Custom curtains feel premium when the proportions, folds, and finishing details are intentional.',
                'image_url' => 'https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg',
                'author' => 'LuxeCurtain Hub',
                'published_at' => now(),
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Success Story: Turning a Bright Living Room into a Softer Evening Space',
                'slug' => 'success-story-bright-living-room-softer-evening-space',
                'excerpt' => 'A customer case study on how layered sheers and blackout panels transformed the room.',
                'content' => 'We paired sheers with heavier panels to balance daylight during the day and privacy at night.',
                'image_url' => 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg',
                'author' => 'LuxeCurtain Hub',
                'published_at' => now(),
                'is_published' => true,
                'sort_order' => 2,
            ],
        ];
    }
}
