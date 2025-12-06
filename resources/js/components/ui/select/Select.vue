<script setup lang="ts">
  import { Listbox } from "@headlessui/vue";

  const props = defineProps<{
    modelValue?: any;
    multiple?: boolean;
    disabled?: boolean;
    name?: string;
  }>();

  const emit = defineEmits<{
    (e: "update:modelValue", value: any): void;
  }>();
</script>

<template>
  <Listbox :model-value="props.modelValue" :multiple="props.multiple" :disabled="props.disabled" :name="props.name" as="div" class="relative space-y-2" @update:model-value="(v) => emit('update:modelValue', v)">
    <slot />
  </Listbox>
</template>
