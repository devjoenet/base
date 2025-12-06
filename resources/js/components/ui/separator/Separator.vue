<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { computed, type HTMLAttributes } from "vue";

  type Orientation = "horizontal" | "vertical";

  const props = withDefaults(
    defineProps<{
      class?: HTMLAttributes["class"];
      orientation?: Orientation;
      decorative?: boolean;
    }>(),
    {
      orientation: "horizontal",
      decorative: false,
    },
  );

  const role = computed(() => (props.decorative ? undefined : "separator"));
  const ariaOrientation = computed(() => (props.decorative ? undefined : props.orientation));
  const ariaHidden = computed(() => (props.decorative ? true : undefined));

  const sizeClasses = computed(() => (props.orientation === "horizontal" ? "h-px w-full" : "h-full w-px"));
</script>

<template>
  <div data-slot="separator-root" :role="role" :aria-hidden="ariaHidden" :aria-orientation="ariaOrientation" :class="cn('shrink-0 bg-gray-900/10 dark:bg-white/10', sizeClasses, props.class)" />
</template>
