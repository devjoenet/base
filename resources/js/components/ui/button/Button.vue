<script setup lang="ts">
  import { buttonVariants, type ButtonVariants } from "@/components/ui/button/variants";
  import { Spinner, type SpinnerVariants } from "@/components/ui/spinner";
  import { cn } from "@/lib/utils";
  import { computed, type Component, type HTMLAttributes } from "vue";

  const emit = defineEmits<{
    (e: "click", event: MouseEvent): void;
  }>();

  const props = withDefaults(
    defineProps<{
      as?: string | Component;
      class?: HTMLAttributes["class"];
      variant?: ButtonVariants["variant"];
      size?: ButtonVariants["size"];
      type?: "button" | "submit" | "reset";
      loading?: boolean;
      disabled?: boolean;
      loadingLabel?: string;
    }>(),
    {
      as: "button",
      type: "button",
      loading: false,
      disabled: false,
      loadingLabel: "Loading",
    },
  );

  const isDisabled = computed(() => props.disabled || props.loading);

  const spinnerSize = computed<SpinnerVariants["size"]>(() => {
    switch (props.size) {
      case "sm":
        return "sm";
      case "lg":
        return "lg";
      default:
        return "md";
    }
  });

  const spinnerColor = computed<SpinnerVariants["color"]>(() => {
    switch (props.variant) {
      case "secondary":
      case "ghost":
      case "link":
        return "primary";
      case "outline":
        return "muted";
      default:
        return "contrast";
    }
  });
</script>

<template>
  <component
    :is="props.as"
    data-slot="button"
    v-bind="$attrs"
    :type="props.as === 'button' ? props.type : undefined"
    :disabled="props.as === 'button' ? isDisabled : undefined"
    :aria-busy="props.loading || undefined"
    :aria-disabled="props.as !== 'button' ? isDisabled : undefined"
    :class="cn(buttonVariants({ variant: props.variant, size: props.size }), props.class, props.loading ? 'cursor-progress' : '', isDisabled ? 'opacity-70' : '')"
    @click="
      (event: MouseEvent) => {
        if (!props.loading) {
          emit('click', event as MouseEvent);
        }
      }
    "
  >
    <span class="flex items-center gap-2">
      <span v-if="props.loading" class="flex items-center" aria-live="polite" aria-atomic="true">
        <Spinner :size="spinnerSize" :color="spinnerColor" :label="props.loadingLabel" />
        <span class="sr-only">{{ props.loadingLabel }}</span>
      </span>
      <span :class="props.loading ? 'opacity-80' : ''">
        <slot />
      </span>
    </span>
  </component>
</template>
