<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <li data-slot="breadcrumb-separator" role="presentation" aria-hidden="true" :class="cn('flex items-center text-gray-300 dark:text-gray-600', props.class)">
    <slot>
      <svg class="size-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
      </svg>
    </slot>
  </li>
</template>
