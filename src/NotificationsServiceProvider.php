<?php

namespace MrShaneBarron\Notifications;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class NotificationsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-notifications.php', 'ld-notifications');
    }

    public function boot(): void
    {
        Livewire::component('ld-notifications', Livewire\Notifications::class);
        $this->loadViewComponentsAs('ld', [View\Components\Notifications::class, View\Components\Alert::class]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-notifications');

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/ld-notifications.php' => config_path('ld-notifications.php')], 'ld-notifications-config');
        }
    }
}
