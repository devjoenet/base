<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <dl :class="cn('divide-y divide-gray-900/10 dark:divide-white/10', props.class)">
    <slot />
  </dl>
</template>
