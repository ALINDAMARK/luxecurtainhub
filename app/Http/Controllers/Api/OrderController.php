<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'product_name' => ['required', 'string', 'max:160'],
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
            'delivery_address' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $order = Order::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
            'delivery_address' => $validated['delivery_address'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'new',
        ]);

        return response()->json([
            'message' => 'Order placed successfully.',
            'data' => $order,
        ], 201);
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Order::query()->latest()->get(),
        ]);
    }
}
