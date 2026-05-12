<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => SuccessStory::featured()->values(),
        ]);
    }

    public function show(SuccessStory $successStory): JsonResponse
    {
        return response()->json(['data' => $successStory]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:120'],
            'location' => ['required', 'string', 'max:120'],
            'quote' => ['required', 'string', 'max:500'],
            'story' => ['required', 'string', 'max:2000'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'is_featured' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer'],
        ]);

        $story = SuccessStory::create($validated);

        return response()->json(['data' => $story], 201);
    }

    public function update(Request $request, SuccessStory $successStory): JsonResponse
    {
        $validated = $request->validate([
            'client_name' => ['sometimes', 'string', 'max:120'],
            'location' => ['sometimes', 'string', 'max:120'],
            'quote' => ['sometimes', 'string', 'max:500'],
            'story' => ['sometimes', 'string', 'max:2000'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'is_featured' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer'],
        ]);

        $successStory->update($validated);

        return response()->json(['data' => $successStory->fresh()]);
    }

    public function destroy(SuccessStory $successStory): JsonResponse
    {
        $successStory->delete();

        return response()->json(null, 204);
    }
}
