<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prayer;

class PrayerSummary extends Component
{
    public $prayerCount;

    public function mount()
    {
        // Set the initial prayer count
        $this->prayerCount = Prayer::count();
    }

    public function render()
    {
        // Update the prayer count on every render
        $this->prayerCount = Prayer::count();

        return view('livewire.prayer-summary');
    }
}
