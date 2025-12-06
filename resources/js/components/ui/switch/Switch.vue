<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { Switch } from "@headlessui/vue";
  import { computed, type HTMLAttributes } from "vue";
  import { switchVariants, thumbVariants } from "@/components/ui/switch/variants";

  const props = withDefaults(
    defineProps<{
      modelValue?: boolean;
      class?: HTMLAttributes["class"];
      size?: "sm" | "md" | "lg";
      disabled?: boolean;
    }>(),
    {
      modelValue: false,
      size: "md",
      disabled: false,
    },
  );

  const emit = defineEmits<{
    (e: "update:modelValue", value: boolean): void;
  }>();

  const toggle = (value: boolean) => {
    emit("update:modelValue", value);
  };

  const switchClass = computed(() => cn(switchVariants({ size: props.size, checked: props.modelValue }), props.disabled ? "opacity-50 cursor-not-allowed" : "", props.class));

  const thumbClass = computed(() => thumbVariants({ size: props.size, checked: props.modelValue }));
</script>

<template>
  <Switch :model-value="props.modelValue" :disabled="props.disabled" :class="switchClass" @update:model-value="toggle">
    <span class="sr-only">
      <slot name="label" />
    </span>
    <span aria-hidden="true" :class="thumbClass" />
  </Switch>
</template>
