<script setup lang="ts">
  import type { HTMLAttributes } from "vue";
  import { cn } from "@/lib/utils";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <div data-slot="card" :class="cn('flex flex-col gap-6 rounded-2xl border border-gray-200/80 bg-white/80 py-6 shadow-sm shadow-gray-900/5 dark:border-white/15 dark:bg-white/4 dark:shadow-black/30', props.class)">
    <slot />
  </div>
</template>
