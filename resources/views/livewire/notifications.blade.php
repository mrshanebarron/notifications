@php
$positionStyles = [
    'top-right' => 'top: 1rem; right: 1rem;',
    'top-left' => 'top: 1rem; left: 1rem;',
    'bottom-right' => 'bottom: 1rem; right: 1rem;',
    'bottom-left' => 'bottom: 1rem; left: 1rem;',
    'top-center' => 'top: 1rem; left: 50%; transform: translateX(-50%);',
    'bottom-center' => 'bottom: 1rem; left: 50%; transform: translateX(-50%);',
];
$posStyle = $positionStyles[$position] ?? $positionStyles['top-right'];

$typeStyles = [
    'success' => ['bg' => '#f0fdf4', 'border' => '#22c55e', 'text' => '#166534', 'icon' => '#22c55e'],
    'error' => ['bg' => '#fef2f2', 'border' => '#ef4444', 'text' => '#991b1b', 'icon' => '#ef4444'],
    'warning' => ['bg' => '#fffbeb', 'border' => '#f59e0b', 'text' => '#92400e', 'icon' => '#f59e0b'],
    'info' => ['bg' => '#eff6ff', 'border' => '#3b82f6', 'text' => '#1e40af', 'icon' => '#3b82f6'],
];

$icons = [
    'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />',
    'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />',
    'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
    'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
];
@endphp

<div style="position: fixed; {{ $posStyle }} z-index: 50; max-width: 24rem; width: 100%;">
    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
        @foreach($notifications as $notification)
            @php
                $style = $typeStyles[$notification['type']] ?? $typeStyles['info'];
                $iconPath = $icons[$notification['type']] ?? $icons['info'];
            @endphp
            <div
                wire:key="{{ $notification['id'] }}"
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => { show = false; $wire.removeNotification('{{ $notification['id'] }}') }, {{ $duration }})"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform translate-x-full"
                style="padding: 1rem; border-left: 4px solid {{ $style['border'] }}; border-radius: 0.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); background-color: {{ $style['bg'] }}; color: {{ $style['text'] }};"
            >
                <div style="display: flex; align-items: flex-start;">
                    <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem; flex-shrink: 0; color: {{ $style['icon'] }};" fill="none" viewBox="0 0 24 24" stroke="currentColor">{!! $iconPath !!}</svg>
                    <div style="flex: 1;">
                        @if($notification['title'])
                            <p style="font-weight: 500; margin: 0 0 0.25rem 0;">{{ $notification['title'] }}</p>
                        @endif
                        <p style="font-size: 0.875rem; margin: 0;">{{ $notification['message'] }}</p>
                    </div>
                    <button
                        wire:click="removeNotification('{{ $notification['id'] }}')"
                        style="margin-left: 0.75rem; color: {{ $style['text'] }}; opacity: 0.6; background: none; border: none; cursor: pointer; padding: 0;"
                        onmouseover="this.style.opacity='1'"
                        onmouseout="this.style.opacity='0.6'"
                    >
                        <svg style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
