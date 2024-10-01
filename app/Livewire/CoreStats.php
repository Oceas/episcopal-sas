<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Device;
use App\Models\Prayer;
use App\Models\Analytics;


class CoreStats extends Component
{
    public $deviceCount;
    public $prayerCount;
    public $analyticsCount;

    public function mount()
    {
        // Set the initial prayer count
        $this->deviceCount = Device::count();
        $this->prayerCount = Prayer::count();
        $this->analyticsCount = Analytics::count();
    }

    public function render()
    {
        // Update the prayer count on every render
        $this->deviceCount = Device::count();
        $this->prayerCount = Prayer::count();
        $this->analyticsCount = Analytics::count();

        return view('livewire.core-stats');
    }
}
