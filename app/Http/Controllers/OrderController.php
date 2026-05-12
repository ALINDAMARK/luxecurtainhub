<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
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

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Order placed successfully.',
                'data' => $order,
            ], 201);
        }

        return redirect('/products#order-form')
            ->with('order_success', 'Your order was received. We will contact you shortly.');
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Order::query()->latest()->get(),
        ]);
    }
}
