<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => BlogPost::published()->values(),
        ]);
    }

    public function show(BlogPost $blogPost): JsonResponse
    {
        return response()->json(['data' => $blogPost]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['required', 'string', 'max:220', 'unique:blog_posts,slug'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string', 'max:10000'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'author' => ['required', 'string', 'max:120'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer'],
        ]);

        $post = BlogPost::create($validated);

        return response()->json(['data' => $post], 201);
    }

    public function update(Request $request, BlogPost $blogPost): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:200'],
            'slug' => ['sometimes', 'string', 'max:220', 'unique:blog_posts,slug,' . $blogPost->id],
            'excerpt' => ['sometimes', 'string', 'max:500'],
            'content' => ['sometimes', 'string', 'max:10000'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'author' => ['sometimes', 'string', 'max:120'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer'],
        ]);

        $blogPost->update($validated);

        return response()->json(['data' => $blogPost->fresh()]);
    }

    public function destroy(BlogPost $blogPost): JsonResponse
    {
        $blogPost->delete();

        return response()->json(null, 204);
    }
}
