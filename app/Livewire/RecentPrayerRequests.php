<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prayer;

class RecentPrayerRequests extends Component
{
    public $prayers;

    public function mount()
    {
        $this->prayers = Prayer::latest()->take(3)->get();
    }

    public function render()
    {
        $this->prayers = Prayer::latest()->take(3)->get();
        return view('livewire.recent-prayer-requests');
    }
}
