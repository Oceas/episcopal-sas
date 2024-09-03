<?php

namespace App\Http\Controllers\API;

use App\Models\VOTD;
use Illuminate\Routing\Controller;

class VODController extends Controller
{

    public function index()
    {

        $verse = VOTD::getVerseOfTheDay();

        if (!$verse) {
            return response()->json([
                'success' => false,
                'message' => 'No verse available for today'
            ], 404);
        }

        return response()->json([
            'message' => 'Verse of the Day fetched successfully!',
            'success' => true,
            'data' => [
                'verse' => $verse
            ]
        ], 200);

    }

}
