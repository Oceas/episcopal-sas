<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import the Validator facade
use App\Models\Prayer;
use Illuminate\Support\Str;

class PrayerController extends Controller
{

    public function index() {

        $prayers = Prayer::where('public', true)
            ->where('reported', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List all Prayers',
            'data' => [
                'prayers' => $prayers
            ]
        ], 200);
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

        return response()->json([
            'success' => true,
            'message' => 'Prayer request received!',
        ], 200);

    }

    public function prayed_for(Prayer $prayer) {
        $prayer->prayed_for();
        // Your logic here, using the $prayer model instance resolved by UUID
        return response()->json(['message' => 'Prayer has been marked as prayed for!', 'prayer' => $prayer], 200);
    }

    public function reported(Prayer $prayer, Request $request)
    {
        // Step 1: Validate input
        $validator = Validator::make($request->all(), [
            'reported_reason' => 'required|string|in:mistake,inappropriate,other',
            'reported_text' => 'nullable|string',
        ]);

        // Step 2: Additional validation to ensure 'reported_text' is required if 'reported_reason' is 'other'
        $validator->after(function ($validator) use ($request) {
            if ($request->input('reported_reason') === 'other' && empty($request->input('reported_text'))) {
                $validator->errors()->add('reported_text', 'The reported text is required when the reported reason is other.');
            }
        });

        // Step 3: Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $prayer->reported_reason = $request->input('reported_reason');
        $prayer->reported_text = $request->input('reported_text');
        $prayer->reported = $prayer->reported + 1;
        $prayer->save();


        // Step 5: Return success response
        return response()->json(['message' => 'Prayer has been reported!'], 200);
    }


}
