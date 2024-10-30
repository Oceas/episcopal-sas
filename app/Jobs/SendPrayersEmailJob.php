<?php

namespace App\Jobs;

use App\Mail\RecentPrayersEmail;
use App\Models\Prayer;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendPrayersEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $prayers = Prayer::where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('created_at', 'desc')
            ->get();

        Mail::to(['workingwellconnection@yahoo.com', 'oceass@gmail.com'])->send(new RecentPrayersEmail($prayers));
    }
}
