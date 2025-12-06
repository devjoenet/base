<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { computed, type HTMLAttributes } from "vue";
  import { spinnerRingVariants, spinnerVariants, type SpinnerVariants } from "@/components/ui/spinner/variants";

  const props = withDefaults(
    defineProps<{
      class?: HTMLAttributes["class"];
      size?: SpinnerVariants["size"];
      color?: SpinnerVariants["color"];
      label?: string;
      as?: "svg" | "div";
    }>(),
    {
      label: "Loading",
      as: "svg",
      color: "primary",
    },
  );

  const spinnerClass = computed(() => spinnerVariants({ size: props.size, color: props.color }));
  const ringClass = computed(() => spinnerRingVariants[props.color ?? "primary"] ?? spinnerRingVariants.primary);
</script>

<template>
  <svg v-if="props.as === 'svg'" data-slot="spinner" viewBox="0 0 24 24" role="status" :aria-label="props.label" :class="cn(spinnerClass, 'shrink-0 fill-none stroke-[3px]', props.class)">
    <title>{{ props.label }}</title>
    <circle class="opacity-25" cx="12" cy="12" r="9" stroke="currentColor" />
    <path class="opacity-90" fill="currentColor" d="M21 12a9 9 0 0 1-9 9v-3a6 6 0 0 0 6-6z" />
  </svg>

  <div v-else data-slot="spinner" role="status" :aria-label="props.label" :class="cn('shrink-0 rounded-full border-[3px] border-solid border-t-transparent', ringClass, spinnerClass, props.class)">
    <span class="sr-only">{{ props.label }}</span>
  </div>
</template>
