<?php

namespace App\Http\Controllers\API;

use App\Models\VOTD;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator; // Import the Validator facade
use App\Models\Newsletter;
use Illuminate\Support\Facades\Http;


class VODController extends Controller
{

    public function index() {

        $verse = VOTD::getVerseOfTheDay();

        return $verse;

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
