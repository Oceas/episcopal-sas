<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import the Validator facade
use App\Models\Prayer;
use Illuminate\Support\Str;

class PrayerController extends Controller
{

    public function index() {
        // Step 1: Query prayers that are public and not reported
        $prayers = Prayer::where('public', true)
            ->where('reported', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Step 2: Return the paginated prayers
        return response()->json($prayers);
    }


    public function store(Request $request) {

        // Step 1: Cast 'public' field to boolean (if necessary) before validation
        $public = filter_var($request->input('public', false), FILTER_VALIDATE_BOOLEAN);

        // Step 2: Replace the 'public' input with the casted value
        $request->merge(['public' => $public]);

        // Step 3: Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string', // Name can be null or a string; it's optional
            'request' => 'required|string', // The prayer request is required and must be a string
            'public' => 'boolean', // Must be a boolean value (true or false)
        ]);

        // Step 4: Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Step 5: Create a new Prayer record
        Prayer::create([
            'name' => $request->input('name'), // Will be null or a provided string
            'request' => $request->input('request'),
            'public' => $request->input('public'), // Already cast to boolean
            'uuid' => Str::uuid()->toString()
        ]);

        // Step 6: Return success response
        return response()->json(['message' => 'Prayer request created successfully!'], 201);
    }

}
