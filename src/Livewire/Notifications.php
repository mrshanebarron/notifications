<?php

namespace MrShaneBarron\Notifications\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Notifications extends Component
{
    public array $notifications = [];
    public string $position = 'top-right';
    public int $duration = 5000;
    public int $maxNotifications = 5;

    protected $listeners = ['notify' => 'addNotification'];

    public function mount(string $position = 'top-right', int $duration = 5000, int $maxNotifications = 5): void
    {
        $this->position = $position;
        $this->duration = $duration;
        $this->maxNotifications = $maxNotifications;
    }

    public function addNotification(string $message, string $type = 'info', ?string $title = null, ?int $duration = null): void
    {
        $id = uniqid();

        $this->notifications[] = [
            'id' => $id,
            'message' => $message,
            'type' => $type,
            'title' => $title,
            'duration' => $duration ?? $this->duration,
        ];

        // Limit notifications
        if (count($this->notifications) > $this->maxNotifications) {
            array_shift($this->notifications);
        }
    }

    public function removeNotification(string $id): void
    {
        $this->notifications = array_filter($this->notifications, fn($n) => $n['id'] !== $id);
    }

    public function render(): View
    {
        return view('ld-notifications::components.notifications');
    }
}
