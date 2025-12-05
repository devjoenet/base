<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <li data-slot="breadcrumb-item" :class="cn('flex items-center gap-2', props.class)">
    <slot />
  </li>
</template>
