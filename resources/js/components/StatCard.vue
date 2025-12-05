<script setup lang="ts">
  import { computed, type Component } from "vue";

  interface StatChange {
    label?: string;
    value?: string;
    trend?: "up" | "down" | "neutral";
  }

  interface StatCardProps {
    title: string;
    value: string;
    icon?: Component;
    change?: StatChange;
    loading?: boolean;
  }

  const props = withDefaults(defineProps<StatCardProps>(), {
    loading: false,
  });

  const trendClasses = computed(() => {
    if (props.change?.trend === "down") {
      return "text-rose-600 bg-rose-50 ring-rose-100 dark:text-rose-300 dark:bg-rose-500/10 dark:ring-rose-500/30";
    }
    if (props.change?.trend === "up") {
      return "text-emerald-600 bg-emerald-50 ring-emerald-100 dark:text-emerald-300 dark:bg-emerald-500/10 dark:ring-emerald-500/30";
    }
    return "text-amber-600 bg-amber-50 ring-amber-100 dark:text-amber-200 dark:bg-amber-400/10 dark:ring-amber-400/30";
  });
</script>

<template>
  <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm ring-1 ring-gray-100/60 dark:border-white/5 dark:bg-gray-900 dark:ring-white/5">
    <div class="flex items-start gap-3">
      <div v-if="icon" class="flex size-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-50 to-blue-50 text-indigo-600 ring-1 ring-inset ring-indigo-100/80 dark:from-indigo-500/10 dark:to-blue-500/10 dark:text-indigo-300 dark:ring-indigo-500/30">
        <component :is="icon" class="size-5" aria-hidden="true" />
      </div>
      <div v-else class="size-10 rounded-xl bg-gradient-to-br from-indigo-50 to-blue-50 ring-1 ring-inset ring-indigo-100/80 dark:from-indigo-500/10 dark:to-blue-500/10 dark:ring-indigo-500/30" />
      <div class="flex-1 space-y-1">
        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ title }}</p>
        <div v-if="loading" class="space-y-2">
          <div class="h-7 w-28 rounded bg-gray-100 animate-pulse dark:bg-white/10" />
          <div class="h-4 w-20 rounded bg-gray-100 animate-pulse dark:bg-white/10" />
        </div>
        <div v-else class="flex items-center gap-2">
          <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ value }}</p>
          <span v-if="change?.value" :class="['inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-medium ring-1', trendClasses]">
            <span>{{ change.value }}</span>
            <span v-if="change.label" class="text-gray-600 dark:text-gray-300">{{ change.label }}</span>
          </span>
        </div>
        <p v-if="!loading && !change?.value && change?.label" class="text-sm text-gray-500 dark:text-gray-400">{{ change.label }}</p>
      </div>
    </div>
  </div>
</template>
