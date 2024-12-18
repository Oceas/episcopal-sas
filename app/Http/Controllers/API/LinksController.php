<?php

namespace App\Http\Controllers\API;

use App\Models\VOTD;
use Illuminate\Routing\Controller;

class LinksController extends Controller
{
    public function countdown()
    {

        // Get countdown text and URL from environment variables
        $countdownText = env('COUNTDOWN_TEXT', 'Bible Study');
        $countdownUrl = env('COUNTDOWN_URL', 'https://ctkcfl.com/events/evening-prayer/');

        return response()->json([
            'success' => true,
            'data' => [
                'countdownText' => $countdownText,
                'countdownUrl' => $countdownUrl
            ]
        ], 200);
    }

    public function quickMessage()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'message' => 'Enjoying the app? Buy me a cup of ☕!',
                'link' => 'https://buymeacoffee.com/oceas',
            ]
        ], 200);
    }
}
