<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:120'],
            'space_type' => ['required', 'string', 'max:80'],
            'vision' => ['required', 'string', 'max:2000'],
        ]);

        ContactInquiry::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your consultation request has been sent. We will contact you shortly.',
            ], 201);
        }

        return redirect('/#contact')
            ->with('success', 'Your consultation request has been sent. We will contact you shortly.');
    }
}
