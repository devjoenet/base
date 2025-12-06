<script setup lang="ts">
  import { DialogDescription as HeadlessDialogDescription } from "@headlessui/vue";
  import { cn } from "@/lib/utils";
  import { type HTMLAttributes } from "vue";

  const props = defineProps<{ class?: HTMLAttributes["class"] }>();
</script>

<template>
  <HeadlessDialogDescription data-slot="sheet-description" :class="cn('text-sm text-gray-500 dark:text-gray-400', props.class)">
    <slot />
  </HeadlessDialogDescription>
</template>
