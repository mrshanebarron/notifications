<?php

namespace MrShaneBarron\Notifications\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public array $notifications = [];
    public string $position = 'top-right';
    public int $duration = 5000;

    protected $listeners = ['notify' => 'addNotification'];

    public function mount(string $position = 'top-right', int $duration = 5000): void
    {
        $this->position = $position;
        $this->duration = $duration;
    }

    public function addNotification(string $message, string $type = 'info', ?string $title = null): void
    {
        $id = uniqid();
        $this->notifications[] = ['id' => $id, 'message' => $message, 'type' => $type, 'title' => $title];
    }

    public function removeNotification(string $id): void
    {
        $this->notifications = array_filter($this->notifications, fn($n) => $n['id'] !== $id);
    }

    public function render()
    {
        return view('ld-notifications::livewire.notifications');
    }
}
