<script setup lang="ts">
import DialogOverlay from "@/components/ui/dialog/DialogOverlay.vue";
import { DialogPanel, TransitionChild } from "@headlessui/vue";
import { cn } from "@/lib/utils";
import { computed, type HTMLAttributes } from "vue";

type DialogSize = "sm" | "md" | "lg" | "xl" | "2xl";

const props = withDefaults(
  defineProps<{
    class?: HTMLAttributes["class"];
    size?: DialogSize;
  }>(),
  {
    size: "lg",
  },
);

const sizeClasses: Record<DialogSize, string> = {
  sm: "sm:max-w-md",
  md: "sm:max-w-lg",
  lg: "sm:max-w-2xl",
  xl: "sm:max-w-3xl",
  "2xl": "sm:max-w-4xl",
};

const panelClasses = computed(() =>
  cn(
    "mx-auto max-w-2xl transform divide-y divide-gray-500/10 overflow-hidden rounded-xl bg-white/80 shadow-2xl outline-1 outline-black/5 backdrop-blur-sm backdrop-filter transition-all dark:divide-white/10 dark:bg-gray-900/80 dark:-outline-offset-1 dark:outline-white/10",
    sizeClasses[props.size],
    props.class,
  ),
);
</script>

<template>
  <DialogOverlay />
  <TransitionChild
    as="template"
    enter="ease-out duration-300"
    enter-from="opacity-0 scale-95"
    enter-to="opacity-100 scale-100"
    leave="ease-in duration-200"
    leave-from="opacity-100 scale-100"
    leave-to="opacity-0 scale-95"
  >
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
      <div class="flex min-h-full items-start justify-center">
        <DialogPanel data-slot="dialog-content" :class="panelClasses">
          <slot />
        </DialogPanel>
      </div>
    </div>
  </TransitionChild>
</template>
