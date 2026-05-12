<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteImageController extends Controller
{
    public function show(string $slot): JsonResponse
    {
        return response()->json([
            'data' => SiteImage::activeForSlot($slot)->values(),
        ]);
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => SiteImage::query()->latest()->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'slot' => ['required', 'string', 'max:80'],
            'title' => ['required', 'string', 'max:160'],
            'image_url' => ['required', 'string', 'max:2048'],
            'alt_text' => ['required', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer'],
        ]);

        $image = SiteImage::create($validated);

        return response()->json(['data' => $image], 201);
    }

    public function update(Request $request, SiteImage $siteImage): JsonResponse
    {
        $validated = $request->validate([
            'slot' => ['sometimes', 'string', 'max:80'],
            'title' => ['sometimes', 'string', 'max:160'],
            'image_url' => ['sometimes', 'string', 'max:2048'],
            'alt_text' => ['sometimes', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer'],
        ]);

        $siteImage->update($validated);

        return response()->json(['data' => $siteImage->fresh()]);
    }

    public function destroy(SiteImage $siteImage): JsonResponse
    {
        $siteImage->delete();

        return response()->json(null, 204);
    }
}
