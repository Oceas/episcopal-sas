<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import the Validator facade
use App\Models\Newsletter;

class NewsletterController extends Controller
{

    public function store(Request $request) {
        // Step 1: Validate input using Validator
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'source' => 'required|string|in:web,mobile',
            'email' => 'required|email|unique:newsletters,email',
        ]);

        // Step 2: Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Step 3: Create a new Newsletter record
        $newsletter = Newsletter::create($validator->validated());

        // Optionally, send a response or some feedback
        return response()->json(['message' => 'Newsletter subscription created successfully!', 'data' => $newsletter], 201);
    }
}
