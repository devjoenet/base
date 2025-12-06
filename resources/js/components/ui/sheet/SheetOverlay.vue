<script setup lang="ts">
  import { DialogOverlay as HeadlessDialogOverlay, TransitionChild } from "@headlessui/vue";
  import { cn } from "@/lib/utils";
  import { type HTMLAttributes } from "vue";

  const props = defineProps<{ class?: HTMLAttributes["class"] }>();
</script>

<template>
  <TransitionChild
    as="template"
    enter="ease-in-out duration-500"
    enter-from="opacity-0"
    enter-to=""
    leave="ease-in-out duration-500"
    leave-from=""
    leave-to="opacity-0"
  >
    <HeadlessDialogOverlay
      data-slot="sheet-overlay"
      :class="cn('fixed inset-0 bg-gray-500/75 transition-opacity dark:bg-gray-900/50', props.class)"
    />
  </TransitionChild>
</template>
