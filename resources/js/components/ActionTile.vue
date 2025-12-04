<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { type Component } from "vue";

interface ActionTileProps {
  title: string;
  description?: string;
  href: string;
  icon?: Component;
  loading?: boolean;
}

withDefaults(defineProps<ActionTileProps>(), {
  loading: false,
});
</script>

<template>
  <Link
    :href="href"
    class="group flex flex-col gap-3 rounded-2xl border border-gray-200 bg-white p-4 text-left shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-white/5 dark:bg-gray-900"
  >
    <div class="flex items-center justify-between">
      <div
        class="flex size-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-50 to-blue-50 text-indigo-600 ring-1 ring-inset ring-indigo-100/70 transition group-hover:scale-105 dark:from-indigo-500/10 dark:to-blue-500/10 dark:text-indigo-200 dark:ring-indigo-500/30"
      >
        <component v-if="icon" :is="icon" class="size-5" aria-hidden="true" />
        <div v-else class="size-5 rounded-full bg-indigo-200/70 dark:bg-indigo-400/40" />
      </div>
      <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600 ring-1 ring-gray-200 dark:bg-white/5 dark:text-gray-300 dark:ring-white/10">
        Shortcut
      </span>
    </div>
    <div class="space-y-1">
      <p v-if="loading" class="h-5 w-32 rounded bg-gray-100 animate-pulse dark:bg-white/10" />
      <p v-else class="text-base font-semibold text-gray-900 transition group-hover:text-indigo-600 dark:text-white">
        {{ title }}
      </p>
      <p v-if="loading" class="h-4 w-48 rounded bg-gray-100 animate-pulse dark:bg-white/10" />
      <p v-else-if="description" class="text-sm text-gray-600 dark:text-gray-300">{{ description }}</p>
    </div>
  </Link>
</template>
