# Notifications

A toast notification component for Laravel applications. Display success, error, warning, and info messages. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/notifications
```

## Livewire Usage

### Basic Setup

```blade
<!-- In your layout -->
<livewire:sb-notifications />
```

### Triggering Notifications

```php
// In your Livewire component
$this->dispatch('notify', [
    'message' => 'Item saved successfully!',
    'type' => 'success'
]);

$this->dispatch('notify', [
    'message' => 'Something went wrong',
    'type' => 'error',
    'title' => 'Error'
]);
```

### Position Options

```blade
<livewire:sb-notifications position="top-right" />
<livewire:sb-notifications position="top-left" />
<livewire:sb-notifications position="bottom-right" />
<livewire:sb-notifications position="bottom-left" />
<livewire:sb-notifications position="top-center" />
<livewire:sb-notifications position="bottom-center" />
```

### Custom Duration

```blade
<livewire:sb-notifications :duration="3000" />
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `position` | string | `'top-right'` | Screen position |
| `duration` | number | `5000` | Auto-dismiss time (ms) |

## Vue 3 Usage

### Setup

```javascript
import { SbNotifications } from './vendor/sb-notifications';
app.component('SbNotifications', SbNotifications);
```

### Basic Usage

```vue
<template>
  <div>
    <SbNotifications ref="notifications" />

    <button @click="showSuccess">Success</button>
    <button @click="showError">Error</button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const notifications = ref(null);

const showSuccess = () => {
  notifications.value.add('Item saved successfully!', 'success');
};

const showError = () => {
  notifications.value.add('Something went wrong', 'error', 'Error');
};
</script>
```

### Notification Types

```vue
<script setup>
// Success (green)
notifications.value.add('Saved!', 'success');

// Error (red)
notifications.value.add('Failed!', 'error');

// Warning (yellow)
notifications.value.add('Check this', 'warning');

// Info (blue)
notifications.value.add('FYI', 'info');
</script>
```

### With Title

```vue
<script setup>
notifications.value.add(
  'Your changes have been saved.',
  'success',
  'Success!'  // Optional title
);
</script>
```

### Position Options

```vue
<template>
  <SbNotifications position="top-right" />
  <SbNotifications position="top-left" />
  <SbNotifications position="bottom-right" />
  <SbNotifications position="bottom-left" />
  <SbNotifications position="top-center" />
  <SbNotifications position="bottom-center" />
</template>
```

### Custom Duration

```vue
<template>
  <!-- 3 second auto-dismiss -->
  <SbNotifications :duration="3000" />

  <!-- 10 second auto-dismiss -->
  <SbNotifications :duration="10000" />
</template>
```

### Global Notification Service

```javascript
// notifications.js - Create a global service
import { ref } from 'vue';

const notificationRef = ref(null);

export const notify = {
  setRef: (ref) => { notificationRef.value = ref; },
  success: (msg, title) => notificationRef.value?.add(msg, 'success', title),
  error: (msg, title) => notificationRef.value?.add(msg, 'error', title),
  warning: (msg, title) => notificationRef.value?.add(msg, 'warning', title),
  info: (msg, title) => notificationRef.value?.add(msg, 'info', title)
};

// App.vue
<template>
  <SbNotifications ref="notificationsRef" />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { notify } from './notifications';

const notificationsRef = ref(null);
onMounted(() => notify.setRef(notificationsRef.value));
</script>

// Any component
import { notify } from './notifications';
notify.success('Item saved!');
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `position` | String | `'top-right'` | Screen position |
| `duration` | Number | `5000` | Auto-dismiss milliseconds |

### Methods

| Method | Parameters | Description |
|--------|------------|-------------|
| `add` | `(message, type, title?)` | Add a notification |
| `remove` | `(id)` | Remove by ID |

## Notification Types

| Type | Color | Icon |
|------|-------|------|
| `success` | Green | Checkmark |
| `error` | Red | X |
| `warning` | Yellow | Warning triangle |
| `info` | Blue | Info circle |

## Positions

| Position | Location |
|----------|----------|
| `top-right` | Top right corner |
| `top-left` | Top left corner |
| `bottom-right` | Bottom right corner |
| `bottom-left` | Bottom left corner |
| `top-center` | Top center |
| `bottom-center` | Bottom center |

## Features

- **Multiple Types**: Success, error, warning, info
- **Auto-dismiss**: Configurable duration
- **Manual Close**: Click X to dismiss
- **Stacking**: Multiple notifications stack
- **Animations**: Smooth slide-in/out
- **Positioning**: 6 position options

## Styling

Uses Tailwind CSS:
- Colored left border
- Type-specific background colors
- Type-specific icons
- Shadow effect
- Rounded corners

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
