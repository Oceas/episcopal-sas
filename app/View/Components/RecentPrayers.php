<?php


namespace App\View\Components;

use App\Models\Prayer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecentPrayers extends Component
{
    public $prayers;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch prayers with pagination
        $this->prayers = Prayer::orderBy('created_at', 'desc')->paginate();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recent-prayers');
    }
}
