<?php

namespace MrShaneBarron\Notifications\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    public array $notifications = [];
    public string $position = 'top-right';
    public int $duration = 5000;

    public function mount(string $position = 'top-right', int $duration = 5000): void
    {
        $this->position = $position;
        $this->duration = $duration;
    }

    #[On('notify')]
    public function addNotification(string $message, string $type = 'info', ?string $title = null): void
    {
        $id = uniqid();
        $this->notifications[] = ['id' => $id, 'message' => $message, 'type' => $type, 'title' => $title];
    }

    public function removeNotification(string $id): void
    {
        $this->notifications = array_filter($this->notifications, fn($n) => $n['id'] !== $id);
        $this->notifications = array_values($this->notifications);
    }

    public function render()
    {
        return view('sb-notifications::livewire.notifications');
    }
}
