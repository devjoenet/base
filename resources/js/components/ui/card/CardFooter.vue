<script setup lang="ts">
  import type { HTMLAttributes } from "vue";
  import { cn } from "@/lib/utils";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <div
    data-slot="card-footer"
    :class="cn('flex items-center gap-4 border-t border-gray-200/80 px-6 pt-6 dark:border-white/10', props.class)"
  >
    <slot />
  </div>
</template>
