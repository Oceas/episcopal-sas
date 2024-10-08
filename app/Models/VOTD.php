<?php
namespace App\Models;

use App\HidesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class VOTD extends Model
{
    use HasFactory, HidesId;

    protected $table = 'votd';

    protected $fillable = [
        'year',
        'month',
        'day',
        'text',
        'content',
        'reference',
        'version_id',
    ];

    /**
     * Get the verse of the day.
     *
     * @return self
     */
    public static function getVerseOfTheDay()
    {
        // Get the current date
        $currentDate = Carbon::now();

        $year = $currentDate->format('Y'); // e.g., 2024
        $month = $currentDate->format('m'); // e.g., 09
        $day = $currentDate->format('d'); // e.g., 02

        $votd = self::where('year', $year)
            ->where('month', $month)
            ->where('day', $day)
            ->first();

        if ( ! $votd ) {

            // Make the HTTP GET request to fetch the verse of the day
            try {
                $final_url = 'https://www.biblegateway.com/votd/get/?format=json&version=NIV';
                $response = Http::get($final_url);

                // Check if the request was successful
                if ($response->successful()) {
                    $verseData= $response->json();

                    // Check if the response data format matches the expected structure
                    if (isset($verseData['votd']['text'], $verseData['votd']['content'], $verseData['votd']['reference'], $verseData['votd']['version_id'])) {
                        $votd = self::create([
                            'year' => $year,
                            'month' => $month,
                            'day' => $day,
                            'text' => html_entity_decode($verseData['votd']['text'], ENT_QUOTES | ENT_HTML5),
                            'content' => $verseData['votd']['content'],
                            'reference' => $verseData['votd']['reference'],
                            'version_id' => $verseData['votd']['version_id'],
                        ]);
                    } else {
                        // Log unexpected response structure or handle it accordingly
                        return null;
                    }
                } else {
                    return null;
                }
            } catch (\Exception $e) {
                return null;
            }
        }

        return $votd;
    }
}
