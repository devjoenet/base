<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <ol
    role="list"
    data-slot="breadcrumb-list"
    :class="cn('flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400', props.class)"
  >
    <slot />
  </ol>
</template>
