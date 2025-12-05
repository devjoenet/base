<script setup lang="ts">
import { DialogOverlay as HeadlessDialogOverlay, TransitionChild } from "@headlessui/vue";
import { cn } from "@/lib/utils";
import { type HTMLAttributes } from "vue";

const props = defineProps<{
  class?: HTMLAttributes["class"];
}>();
</script>

<template>
  <TransitionChild
    as="template"
    enter="ease-out duration-200"
    enter-from="opacity-0"
    enter-to="opacity-100"
    leave="ease-in duration-150"
    leave-from="opacity-100"
    leave-to="opacity-0"
  >
    <HeadlessDialogOverlay
      data-slot="dialog-overlay"
      :class="cn('fixed inset-0 bg-gray-500/25 transition-opacity dark:bg-gray-900/50', props.class)"
    />
  </TransitionChild>
</template>
