<script setup lang="ts">
import { dialogContextKey } from "@/components/ui/dialog/context";
import { cn } from "@/lib/utils";
import { TransitionRoot, Dialog as HeadlessDialog } from "@headlessui/vue";
import { computed, provide, type HTMLAttributes } from "vue";

const modelValue = defineModel<boolean>("open", { default: false });

const props = defineProps<{
  class?: HTMLAttributes["class"];
  initialFocus?: HTMLElement | null;
}>();

const emit = defineEmits<{ (e: "close"): void }>();

const setOpen = (value: boolean) => {
  if (!value) {
    emit("close");
  }

  modelValue.value = value;
};

provide(dialogContextKey, { setOpen });

const dialogClasses = computed(() => cn("relative z-50", props.class));
</script>

<template>
  <TransitionRoot as="template" :show="modelValue">
    <HeadlessDialog
      data-slot="dialog"
      :open="modelValue"
      :class="dialogClasses"
      :initial-focus="props.initialFocus"
      @close="setOpen(false)"
    >
      <slot />
    </HeadlessDialog>
  </TransitionRoot>
</template>
