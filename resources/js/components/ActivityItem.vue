<script setup lang="ts">
import { computed, type Component } from "vue";

interface ActivityItemProps {
  title: string;
  description?: string;
  timestamp?: string;
  icon?: Component;
  loading?: boolean;
}

const props = withDefaults(defineProps<ActivityItemProps>(), {
  loading: false,
});

const placeholderIcon = computed(() => props.icon ?? "");
</script>

<template>
  <li class="flex gap-4 rounded-xl p-3 ring-1 ring-inset ring-gray-100/80 dark:ring-white/10">
    <div
      class="flex size-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100/80 dark:bg-indigo-500/10 dark:text-indigo-200 dark:ring-indigo-500/30"
    >
      <component :is="placeholderIcon || 'div'" v-if="placeholderIcon" class="size-5" aria-hidden="true" />
      <div v-else class="size-5 rounded-full bg-indigo-200/70 dark:bg-indigo-400/40" />
    </div>
    <div class="flex flex-1 flex-col gap-1">
      <div v-if="loading" class="space-y-2">
        <div class="h-5 w-40 rounded bg-gray-100 animate-pulse dark:bg-white/10" />
        <div class="h-4 w-28 rounded bg-gray-100 animate-pulse dark:bg-white/10" />
      </div>
      <template v-else>
        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ title }}</p>
        <p v-if="description" class="text-sm text-gray-600 dark:text-gray-300">{{ description }}</p>
        <p v-if="timestamp" class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ timestamp }}</p>
      </template>
    </div>
  </li>
</template>
