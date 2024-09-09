<?php

namespace App\Http\Controllers\API;

use App\Models\MSCReading;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DailyOfficeController extends Controller
{
    function missionStClareReading(Request $request)
    {
        $reading = $request->query('reading');
        $month = $request->query('month');
        $day = $request->query('day');
        $language = $request->query('language');

        $reading = MSCReading::getReading( $reading, $month, $day, $language );

        if ( ! $reading) {
            return response()->json([
                'success' => false,
                'message' => 'No reading available for today'
            ], 404);
        }

        return response()->json([
            'message' => 'Reading fetched successfully!',
            'success' => true,
            'data' => [
                'reading' => $reading
            ]
        ]);

    }
}
