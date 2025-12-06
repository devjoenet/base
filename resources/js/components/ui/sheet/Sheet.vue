<script setup lang="ts">
  import { sheetContextKey } from "@/components/ui/sheet/context";
  import { cn } from "@/lib/utils";
  import { Dialog as HeadlessDialog, TransitionRoot } from "@headlessui/vue";
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

  provide(sheetContextKey, { open: modelValue, setOpen });

  const sheetClasses = computed(() => cn("relative z-50", props.class));
</script>

<template>
  <TransitionRoot as="template" :show="modelValue">
    <HeadlessDialog
      data-slot="sheet"
      :open="modelValue"
      :class="sheetClasses"
      :initial-focus="props.initialFocus"
      @close="setOpen(false)"
    >
      <slot />
    </HeadlessDialog>
  </TransitionRoot>
</template>
