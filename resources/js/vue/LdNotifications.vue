<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'

interface Notification {
  id: string
  message: string
  type: 'success' | 'error' | 'warning' | 'info'
  title?: string
  duration: number
}

interface Props {
  position?: 'top-right' | 'top-left' | 'bottom-right' | 'bottom-left' | 'top-center' | 'bottom-center'
  duration?: number
  maxNotifications?: number
}

const props = withDefaults(defineProps<Props>(), {
  position: 'top-right',
  duration: 5000,
  maxNotifications: 5,
})

const notifications = ref<Notification[]>([])

function notify(message: string, type: Notification['type'] = 'info', title?: string, duration?: number) {
  const id = Math.random().toString(36).substring(7)
  const notif: Notification = { id, message, type, title, duration: duration ?? props.duration }

  notifications.value.push(notif)

  if (notifications.value.length > props.maxNotifications) {
    notifications.value.shift()
  }

  if (notif.duration > 0) {
    setTimeout(() => remove(id), notif.duration)
  }
}

function remove(id: string) {
  notifications.value = notifications.value.filter(n => n.id !== id)
}

// Expose notify method globally
onMounted(() => {
  (window as any).$notify = notify
})

onUnmounted(() => {
  delete (window as any).$notify
})

defineExpose({ notify })

const icons = {
  success: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
  error: 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
  warning: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
  info: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
}

const colors = {
  success: 'text-green-400',
  error: 'text-red-400',
  warning: 'text-yellow-400',
  info: 'text-blue-400',
}

const positionClasses = {
  'top-right': 'top-4 right-4',
  'top-left': 'top-4 left-4',
  'bottom-right': 'bottom-4 right-4',
  'bottom-left': 'bottom-4 left-4',
  'top-center': 'top-4 left-1/2 -translate-x-1/2',
  'bottom-center': 'bottom-4 left-1/2 -translate-x-1/2',
}
</script>

<template>
  <div :class="['fixed z-50 flex flex-col gap-2 max-w-sm w-full', positionClasses[position]]">
    <TransitionGroup
      enter-active-class="transform ease-out duration-300 transition"
      enter-from-class="translate-y-2 opacity-0"
      enter-to-class="translate-y-0 opacity-100"
      leave-active-class="transition ease-in duration-100"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-for="notif in notifications"
        :key="notif.id"
        class="w-full bg-white shadow-lg rounded-lg ring-1 ring-black ring-opacity-5 overflow-hidden"
      >
        <div class="p-4 flex items-start">
          <svg :class="['h-6 w-6 flex-shrink-0', colors[notif.type]]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" :d="icons[notif.type]" />
          </svg>
          <div class="ml-3 flex-1">
            <p v-if="notif.title" class="text-sm font-medium text-gray-900">{{ notif.title }}</p>
            <p class="text-sm text-gray-500">{{ notif.message }}</p>
          </div>
          <button @click="remove(notif.id)" class="ml-4 flex-shrink-0 text-gray-400 hover:text-gray-500">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>
          </button>
        </div>
      </div>
    </TransitionGroup>
  </div>
</template>
