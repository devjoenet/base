<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { Component, HTMLAttributes } from "vue";

  const props = defineProps<{
    as?: string | Component;
    href?: string;
    class?: HTMLAttributes["class"];
    current?: boolean;
  }>();
</script>

<template>
  <component :is="props.as ?? 'a'" data-slot="breadcrumb-link" :href="props.href" :aria-current="props.current ? 'page' : undefined" :class="cn('text-sm font-medium text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200', props.class)">
    <slot />
  </component>
</template>
