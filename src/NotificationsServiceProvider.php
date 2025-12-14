<?php

namespace MrShaneBarron\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-notifications', Livewire\Notifications::class);
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-notifications');
    }
}
