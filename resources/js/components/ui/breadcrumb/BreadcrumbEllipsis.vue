<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { EllipsisHorizontalIcon } from "@heroicons/vue/24/outline";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <span role="presentation" aria-hidden="true" :class="cn('flex h-9 w-9 items-center justify-center', props.class)">
    <slot>
      <EllipsisHorizontalIcon class="h-4 w-4" />
    </slot>
  </span>
</template>
