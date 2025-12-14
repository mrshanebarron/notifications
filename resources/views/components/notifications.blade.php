<div
    class="fixed z-50 flex flex-col gap-2 max-w-sm w-full
        {{ str_contains($position, 'top') ? 'top-4' : 'bottom-4' }}
        {{ str_contains($position, 'right') ? 'right-4' : '' }}
        {{ str_contains($position, 'left') ? 'left-4' : '' }}
        {{ str_contains($position, 'center') ? 'left-1/2 -translate-x-1/2' : '' }}"
>
    @foreach($notifications as $notification)
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="@if($notification['duration'] > 0) setTimeout(() => { show = false; $wire.removeNotification('{{ $notification['id'] }}') }, {{ $notification['duration'] }}) @endif"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
            wire:key="{{ $notification['id'] }}"
        >
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        @if($notification['type'] === 'success')
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @elseif($notification['type'] === 'error')
                            <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @elseif($notification['type'] === 'warning')
                            <svg class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        @else
                            <svg class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @endif
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        @if($notification['title'])
                            <p class="text-sm font-medium text-gray-900">{{ $notification['title'] }}</p>
                        @endif
                        <p class="text-sm text-gray-500">{{ $notification['message'] }}</p>
                    </div>
                    <div class="ml-4 flex flex-shrink-0">
                        <button @click="show = false; $wire.removeNotification('{{ $notification['id'] }}')" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
