<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\JsonResponse;

class ContactInquiryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => ContactInquiry::query()->latest()->get(),
        ]);
    }
}
