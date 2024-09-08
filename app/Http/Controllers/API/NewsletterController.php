<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import the Validator facade
use App\Models\Newsletter;

class NewsletterController extends Controller
{

    public function store(Request $request) {

        $request->merge([
            'email' => strtolower($request->input('email')),
        ]);

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
        Newsletter::create($validator->validated());

        // Optionally, send a response or some feedback
        return response()->json([ 'success' => true, 'message' => 'Newsletter subscription created successfully!'], 201);
    }
}
