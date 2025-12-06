<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { RadioGroup } from "@headlessui/vue";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    modelValue?: any;
    class?: HTMLAttributes["class"];
    disabled?: boolean;
    name?: string;
  }>();

  const emit = defineEmits<{
    (e: "update:modelValue", value: any): void;
  }>();
</script>

<template>
  <RadioGroup :model-value="props.modelValue" :disabled="props.disabled" :name="props.name" :class="cn('grid gap-2', props.class)" @update:model-value="(v) => emit('update:modelValue', v)">
    <slot />
  </RadioGroup>
</template>
