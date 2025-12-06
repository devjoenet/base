<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { ComboboxButton, ComboboxInput as HeadlessComboboxInput } from "@headlessui/vue";
  import { ChevronUpDownIcon } from "@heroicons/vue/20/solid";
  import { computed, ref, type HTMLAttributes } from "vue";
  import { comboboxContainerVariants, comboboxInputVariants } from "@/components/ui/combobox/variants";
  import { labelVariants } from "@/components/ui/input/variants";

  const props = withDefaults(
    defineProps<{
      class?: HTMLAttributes["class"];
      variant?: "filled" | "outlined";
      invalid?: boolean;
      label?: string;
      displayValue?: (item: any) => string;
      disabled?: boolean;
    }>(),
    {
      variant: "filled",
      invalid: false,
      disabled: false,
    },
  );

  const emit = defineEmits<{
    (e: "change", value: string): void;
  }>();

  const isFocused = ref(false);
  // We can't easily know if the input has content without binding, so we rely on focus
  // or the consumer passing a key to force re-render if needed.
  // For MD3 floating labels in comboboxes, it's safer to always float if focused or if we assume a value is selected.
  const floatLabel = computed(() => isFocused.value || !!props.label);
</script>

<template>
  <div :class="cn(comboboxContainerVariants({ variant: props.variant, invalid: props.invalid, disabled: props.disabled }), props.class)">
    <HeadlessComboboxInput
      :class="cn(comboboxInputVariants({ variant: props.variant, invalid: props.invalid }))"
      :display-value="props.displayValue"
      :placeholder="props.label ? ' ' : undefined"
      @change="emit('change', $event.target.value)"
      @focus="isFocused = true"
      @blur="isFocused = false"
    />

    <span v-if="props.label" :class="cn(labelVariants({ float: true, invalid: props.invalid, disabled: props.disabled }), props.variant === 'outlined' ? 'bg-background px-1 dark:bg-gray-950' : '')">
      {{ props.label }}
    </span>

    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
      <ChevronUpDownIcon class="size-5 text-gray-500/70" aria-hidden="true" />
    </ComboboxButton>
  </div>
</template>
