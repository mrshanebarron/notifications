<?php

return [
    'position' => 'top-right', // top-right, top-left, bottom-right, bottom-left, top-center, bottom-center
    'duration' => 5000, // milliseconds, 0 for no auto-dismiss
    'max_notifications' => 5,
    'types' => [
        'success' => ['icon' => 'check-circle', 'color' => 'green'],
        'error' => ['icon' => 'x-circle', 'color' => 'red'],
        'warning' => ['icon' => 'exclamation-triangle', 'color' => 'yellow'],
        'info' => ['icon' => 'information-circle', 'color' => 'blue'],
    ],
];
