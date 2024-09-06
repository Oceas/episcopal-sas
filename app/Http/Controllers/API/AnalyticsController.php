<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import the Validator facade
use App\Models\Analytics;
use Illuminate\Support\Str;

// Import the Analytics model

class AnalyticsController extends Controller
{
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'platform' => 'required|string|max:255',
            'vid' => 'nullable|string|max:255',
            'event_name' => 'required|string|max:255',
            'event_details' => 'nullable|string|max:255',
            'reference_url' => 'nullable|string|max:255',
            'app_version' => 'nullable|string|max:255',
            'payload' => 'nullable|json',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Modify the payload if necessary
        $data = $validator->validated();

        if (isset($data['payload'])) {
            $payload = trim($data['payload']);
            if ($payload === '' || strtolower($payload) === 'null') {
                $data['payload'] = null;
            } else {
                $data['payload'] = json_decode($data['payload'], true); // Decode JSON to store it as an array or object
            }
        }

        // Step to create analytics
        $analytics = Analytics::create([
            'uuid' => Str::uuid()->toString(),
            'platform' => $data['platform'] ?? null,
            'vid' => $data['vid'] ?? null,
            'event_name' => $data['event_name'] ?? null,
            'event_details' => $data['event_details'] ?? null,
            'payload' => $data['payload'] ?? null,
            'app_version' => $data['app_version'] ?? null,
        ]);

        // Return the created record as a JSON response with a 201 status code
        return response()->json(['succes' => true, 'message' => 'Recorded', 'data' => $analytics], 201);
    }
}
