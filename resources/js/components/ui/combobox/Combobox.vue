<script setup lang="ts">
  import { Combobox } from "@headlessui/vue";

  const props = defineProps<{
    modelValue?: any;
    multiple?: boolean;
    disabled?: boolean;
    nullable?: boolean;
    name?: string;
  }>();

  const emit = defineEmits<{
    (e: "update:modelValue", value: any): void;
  }>();
</script>

<template>
  <Combobox :model-value="props.modelValue" :multiple="props.multiple" :disabled="props.disabled" :nullable="props.nullable" :name="props.name" as="div" class="relative w-full" @update:model-value="(v) => emit('update:modelValue', v)">
    <slot />
  </Combobox>
</template>
