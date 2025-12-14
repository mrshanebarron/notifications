<template>
  <Teleport to="body">
    <div :class="['fixed z-50 space-y-2 max-w-sm w-full', positionClass]">
      <TransitionGroup name="notification">
        <div
          v-for="notification in notifications"
          :key="notification.id"
          :class="['p-4 border-l-4 rounded-lg shadow-lg', typeStyles[notification.type] || typeStyles.info]"
        >
          <div class="flex items-start">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" v-html="icons[notification.type] || icons.info"></svg>
            <div class="flex-1">
              <p v-if="notification.title" class="font-medium">{{ notification.title }}</p>
              <p class="text-sm">{{ notification.message }}</p>
            </div>
            <button @click="remove(notification.id)" class="ml-3 text-gray-400 hover:text-gray-600">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
          </div>
        </div>
      </TransitionGroup>
    </div>
  </Teleport>
</template>

<script>
import { ref, computed } from 'vue';

export default {
  name: 'SbNotifications',
  props: {
    position: { type: String, default: 'top-right' },
    duration: { type: Number, default: 5000 }
  },
  setup(props) {
    const notifications = ref([]);
    const positions = { 'top-right': 'top-4 right-4', 'top-left': 'top-4 left-4', 'bottom-right': 'bottom-4 right-4', 'bottom-left': 'bottom-4 left-4', 'top-center': 'top-4 left-1/2 -translate-x-1/2', 'bottom-center': 'bottom-4 left-1/2 -translate-x-1/2' };
    const typeStyles = { success: 'bg-green-50 border-green-500 text-green-800', error: 'bg-red-50 border-red-500 text-red-800', warning: 'bg-yellow-50 border-yellow-500 text-yellow-800', info: 'bg-blue-50 border-blue-500 text-blue-800' };
    const icons = { success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />', error: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />', warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />', info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />' };
    const positionClass = computed(() => positions[props.position] || positions['top-right']);

    const add = (message, type = 'info', title = null) => {
      const id = Date.now().toString();
      notifications.value.push({ id, message, type, title });
      setTimeout(() => remove(id), props.duration);
    };

    const remove = (id) => {
      notifications.value = notifications.value.filter(n => n.id !== id);
    };

    return { notifications, positionClass, typeStyles, icons, add, remove };
  }
};
</script>

<style scoped>
.notification-enter-active, .notification-leave-active { transition: all 0.3s ease; }
.notification-enter-from, .notification-leave-to { opacity: 0; transform: translateX(100%); }
</style>
