<?php

namespace App\Http\Controllers\API;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|string',
            'app_version' => 'nullable|string',
            'brand' => 'nullable|string',
            'design_name' => 'nullable|string',
            'device_name' => 'nullable|string',
            'product_name' => 'nullable|string',
            'supported_cpu_architectures' => 'nullable|string',
            'total_memory' => 'nullable|integer',
            'device_year_class' => 'nullable|integer',
            'manufacturer' => 'nullable|string',
            'model_id' => 'nullable|string',
            'model_name' => 'nullable|string',
            'os_build_id' => 'nullable|string',
            'os_long_name' => 'nullable|string',
            'os_name' => 'nullable|string',
            'os_version' => 'nullable|string',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Find or create the device using the Device model method
        $device = Device::findOrCreateByDeviceId($request->all());

        // Return the device data as JSON response
        return response()->json([
            'success' => true,
            'message' => $device->wasRecentlyCreated ? 'Device registered successfully.' : 'Device found.',
            'data' => [
                'VID' => $device->uuid
            ]
        ], $device->wasRecentlyCreated ? 201 : 200);
    }
}
