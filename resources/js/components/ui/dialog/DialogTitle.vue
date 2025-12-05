<script setup lang="ts">
  import { DialogTitle as HeadlessDialogTitle } from "@headlessui/vue";
  import { cn } from "@/lib/utils";
  import { type HTMLAttributes } from "vue";

  const props = defineProps<{ class?: HTMLAttributes["class"] }>();
</script>

<template>
  <HeadlessDialogTitle data-slot="dialog-title" :class="cn('text-lg font-semibold leading-7 text-gray-900 dark:text-white', props.class)">
    <slot />
  </HeadlessDialogTitle>
</template>
