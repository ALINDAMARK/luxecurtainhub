<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireAdminKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $expectedKey = (string) env('ADMIN_API_KEY', 'luxe-curtain-admin');
        $providedKey = (string) ($request->header('X-Admin-Key') ?? $request->query('admin_key') ?? '');

        if ($expectedKey === '' || ! hash_equals($expectedKey, $providedKey)) {
            return response()->json([
                'message' => 'Unauthorized admin access.',
            ], 401);
        }

        return $next($request);
    }
}
