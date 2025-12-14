# Laravel Design Notifications

Toast notification system for Laravel. Supports Livewire, Blade, and Vue 3.

## Installation

```bash
composer require mrshanebarron/notifications
```

For Vue components:
```bash
npm install @laraveldesign/notifications
```

## Usage

### Livewire Component

Add the notification container to your layout:

```blade
{{-- In your layout file --}}
<livewire:ld-notifications position="top-right" />
```

Dispatch notifications from your Livewire components:

```php
// In your Livewire component
$this->dispatch('notify', message: 'Profile updated successfully!', type: 'success');

// With title
$this->dispatch('notify',
    message: 'Your changes have been saved.',
    type: 'success',
    title: 'Saved!'
);

// With custom duration
$this->dispatch('notify',
    message: 'This will disappear in 10 seconds',
    type: 'info',
    duration: 10000
);
```

### Notification Types

```php
// Success
$this->dispatch('notify', message: 'Success!', type: 'success');

// Error
$this->dispatch('notify', message: 'Something went wrong', type: 'error');

// Warning
$this->dispatch('notify', message: 'Please review before continuing', type: 'warning');

// Info
$this->dispatch('notify', message: 'New features available', type: 'info');
```

### Blade Component (with Alpine.js)

```blade
<x-ld-notifications position="bottom-right" />

<button @click="$dispatch('notify', { message: 'Hello!', type: 'success' })">
    Show Notification
</button>
```

### Vue 3 Component

```vue
<script setup>
import { LdNotifications, useNotifications } from '@laraveldesign/notifications'

const { notify } = useNotifications()

function showSuccess() {
  notify({
    message: 'Operation completed!',
    type: 'success',
    title: 'Success',
    duration: 5000
  })
}
</script>

<template>
  <LdNotifications position="top-right" />

  <button @click="showSuccess">Show Notification</button>
</template>
```

## Props

### Container Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `position` | string | `'top-right'` | Position: `top-right`, `top-left`, `bottom-right`, `bottom-left`, `top-center`, `bottom-center` |
| `duration` | number | `5000` | Default duration in milliseconds |
| `maxNotifications` | number | `5` | Maximum notifications to show at once |

### Notification Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `message` | string | required | Notification message |
| `type` | string | `'info'` | Type: `success`, `error`, `warning`, `info` |
| `title` | string | `null` | Optional title |
| `duration` | number | container default | Override default duration |

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ld-notifications-config
```

### Configuration Options

```php
// config/ld-notifications.php
return [
    'position' => 'top-right',
    'duration' => 5000,
    'max_notifications' => 5,
    'types' => [
        'success' => [
            'icon' => 'check-circle',
            'class' => 'bg-green-50 border-green-500 text-green-800',
        ],
        'error' => [
            'icon' => 'x-circle',
            'class' => 'bg-red-50 border-red-500 text-red-800',
        ],
        'warning' => [
            'icon' => 'exclamation',
            'class' => 'bg-yellow-50 border-yellow-500 text-yellow-800',
        ],
        'info' => [
            'icon' => 'information-circle',
            'class' => 'bg-blue-50 border-blue-500 text-blue-800',
        ],
    ],
];
```

## Customization

### Publishing Views

```bash
php artisan vendor:publish --tag=ld-notifications-views
```

## Session Flash Notifications

Automatically show session flash messages:

```php
// In your controller
return redirect()->back()->with('success', 'Profile updated!');
```

```blade
{{-- In your layout --}}
@if(session('success'))
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.dispatch('notify', {
                message: '{{ session('success') }}',
                type: 'success'
            });
        });
    </script>
@endif
```

## License

MIT
