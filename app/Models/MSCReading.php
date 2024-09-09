<?php

namespace App\Models;

use App\HidesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class MSCReading extends Model
{
    use HasFactory, HidesId;

    protected $table = 'msc_readings';

    protected $fillable = [
        'month',
        'day',
        'reading',
        'language',
        'text'
    ];

    /**
     * Get the reading for the specified parameters.
     *
     * @param string $reading
     * @param string $month
     * @param string $day
     * @param string $language
     * @return self
     */
    public static function getReading($reading, $month, $day, $language)
    {
        // Find existing record if it exists
        $mscReading = self::where('reading', $reading)
            ->where('month', $month)
            ->where('day', $day)
            ->where('language', $language)
            ->first();

        if (!$mscReading) {
            // If no record exists, fetch from the URL and create a new record
            try {
                $finalUrl = self::getReadingURL($reading, $month, $day, $language);

                // Fetch the content from the URL
                $response = Http::get($finalUrl);

                if ($response->successful()) {
                    // Create a new MSCReading record
                    $mscReading = self::create([
                        'month' => $month,
                        'day' => $day,
                        'reading' => $reading,
                        'language' => $language,
                        'text' => $response->body(), // Store the fetched content
                    ]);

                    return $mscReading->text; // Return the content
                } else {
                    throw new \Exception("Failed to retrieve reading from URL");
                }
            } catch (\Exception $e) {
                return null; // Handle the exception gracefully
            }
        }

        // Return the stored text if the record already exists
        return $mscReading->text;
    }

    /**
     * Build the reading URL based on parameters.
     *
     * @param string $reading
     * @param string $month
     * @param string $day
     * @param string $language
     * @return string|null
     */
    private static function getReadingURL($reading, $month, $day, $language)
    {
        // Take month (e.g., "07") and convert it to the full month name (e.g., "July")
        $month = $month ? (\DateTime::createFromFormat('!m', $month)->format('F')) : ''; // Should be English or Español
        $day = $day ? str_pad($day, 2, '0', STR_PAD_LEFT) : '';

        // Construct the base URL based on the language and month
        $baseUrl = "https://www.missionstclare.com/{$language}/{$month}/whole/";

        // Determine the final URL based on the reading type
        switch ($reading) {
            case 'morning':
                return "{$baseUrl}morning/{$day}m.html";
            case 'noontime':
                return "{$baseUrl}noonday/{$day}.html";
            case 'evening':
                return "{$baseUrl}evening/{$day}e.html";
            case 'compline':
                return "{$baseUrl}compline/{$day}.html";
            default:
                return null;
        }
    }
}
