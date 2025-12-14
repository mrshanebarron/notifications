<?php

namespace MrShaneBarron\Notifications\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notifications extends Component
{
    public function __construct(
        public string $position = 'top-right',
        public int $duration = 5000,
        public int $maxNotifications = 5
    ) {}

    public function render(): View
    {
        return view('ld-notifications::components.notifications');
    }
}
