<script setup lang="ts">
  import type { HTMLAttributes } from "vue";
  import { cn } from "@/lib/utils";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <div data-slot="card" :class="cn('card bg-base-100 shadow-sm border border-base-300', props.class)">
    <slot />
  </div>
</template>
