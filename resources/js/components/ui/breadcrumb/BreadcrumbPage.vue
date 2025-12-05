<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <span
    data-slot="breadcrumb-page"
    role="link"
    aria-disabled="true"
    aria-current="page"
    :class="cn('text-sm font-medium text-gray-900 dark:text-gray-100', props.class)"
  >
    <slot />
  </span>
</template>
