<?php

namespace App\Console\Commands;

use App\Models\Prayer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MigratePrayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate-prayers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate prayer requests from a CSV file into the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Path to the CSV file in the same directory
        $csvFilePath = __DIR__ . '/prayer_requests.csv';

        // Check if the file exists
        if (!File::exists($csvFilePath)) {
            $this->error('CSV file not found.');
            return;
        }

        // Open and read the CSV file
        $file = fopen($csvFilePath, 'r');

        // Fetch the header row (first row)
        $header = fgetcsv($file);

        if ($header === false || count($header) < 4) {
            $this->error('CSV header is invalid.');
            return;
        }

        // Process each row in the CSV file
        while (($row = fgetcsv($file)) !== false) {
            // Create a simple object for each row
            $prayerRequest = new \stdClass();
            $prayerRequest->name = $row[0] ?? null;
            $prayerRequest->request = $row[1] ?? null;
            $prayerRequest->public = $row[2] ?? null;
            $prayerRequest->created_at = $row[3] ?? null;

            // Check if a prayer with the same name and request already exists
            $existingPrayer = Prayer::where('name', $prayerRequest->name)
                ->where('request', $prayerRequest->request)
                ->first();

            if ($existingPrayer) {
                $this->info("Prayer request for {$prayerRequest->name} already exists, skipping.");
                continue; // Skip this entry
            }

            // Create a new Prayer model if it doesn't exist
            try {
                Prayer::create([
                    'name' => $prayerRequest->name, // Will be null or a provided string
                    'request' => $prayerRequest->request,
                    'public' => $prayerRequest->public == '1', // Already cast to boolean
                    'uuid' => Str::uuid()->toString(),
                    'created_at' => $prayerRequest->created_at
                ]);

                $this->info("Migrated prayer request: {$prayerRequest->name}");
            } catch (\Exception $e) {
                $this->error("Error migrating prayer request for {$prayerRequest->name}: " . $e->getMessage());
            }
        }

        // Close the file
        fclose($file);

        $this->info('Migration completed.');
    }
}
