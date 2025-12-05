<script setup lang="ts">
import { useDialogContext } from "@/components/ui/dialog/context";
import { cn } from "@/lib/utils";
import { type HTMLAttributes } from "vue";

const props = defineProps<{ class?: HTMLAttributes["class"] }>();
const emit = defineEmits<{ (e: "click", event: MouseEvent): void }>();

const { setOpen } = useDialogContext("DialogClose");

const handleClick = (event: MouseEvent) => {
  emit("click", event);
  setOpen(false);
};
</script>

<template>
  <button
    type="button"
    data-slot="dialog-close"
    :class="cn('absolute right-4 top-4 rounded-xs p-1 text-gray-500 transition hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 dark:text-gray-400 dark:hover:bg-white/10 dark:focus-visible:outline-indigo-400', props.class)"
    @click="handleClick"
  >
    <svg
      aria-hidden="true"
      viewBox="0 0 20 20"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      class="size-4"
    >
      <path
        d="M5.75 5.75l8.5 8.5m0-8.5l-8.5 8.5"
        stroke="currentColor"
        stroke-width="1.5"
        stroke-linecap="round"
      />
    </svg>
    <span class="sr-only">Close dialog</span>
  </button>
</template>
