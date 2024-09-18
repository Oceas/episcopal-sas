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
        $requestData = $request->all();

        if (isset($requestData['supported_cpu_architectures']) && is_array($requestData['supported_cpu_architectures'])) {
            // Convert the array to a string (using JSON format for flexibility)
            $requestData['supported_cpu_architectures'] = json_encode($requestData['supported_cpu_architectures']);
        }

        // Validate the incoming request
        $validator = Validator::make($requestData, [
            'device_id' => 'required|string',
            'app_version' => 'nullable|string',
            'brand' => 'nullable|string',
            'design_name' => 'nullable|string',
            'device_name' => 'nullable|string',
            'product_name' => 'nullable|string',
            'supported_cpu_architectures' => 'nullable|string',
            'total_memory' => 'nullable|numeric',
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
        $device = Device::findOrCreateByDeviceId($requestData);

        // Return the device data as JSON response
        return response()->json([
            'success' => true,
            'message' => $device->wasRecentlyCreated ? 'Device registered successfully.' : 'Device found.',
            'data' => [
                'VID' => $device->vid
            ]
        ], $device->wasRecentlyCreated ? 201 : 200);
    }

    public function registerPushToken(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'vid' => 'required|string|exists:devices,vid', // Ensure the VID exists in the devices table
            'push_token' => 'required|string',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Find the device using VID
        $device = Device::where('vid', $request->vid)->first();

        // Update the push token
        $device->push_token = $request->push_token;
        $device->push_token_valid = true; // You may want to set this flag if applicable
        $device->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Push token registered successfully',
        ], 200);
    }


}
