<script setup lang="ts">
import { cn } from "@/lib/utils";
import { computed, type HTMLAttributes } from "vue";

type SkeletonShape = "rounded" | "circle" | "pill" | "square";

const props = withDefaults(
  defineProps<{
    class?: HTMLAttributes["class"];
    shape?: SkeletonShape;
    width?: number | string;
    height?: number | string;
  }>(),
  {
    shape: "rounded",
  }
);

const resolvedStyle = computed(() => {
  const style: Record<string, string> = {};

  if (props.width !== undefined) {
    style.width = typeof props.width === "number" ? `${props.width}px` : props.width;
  }

  if (props.height !== undefined) {
    style.height = typeof props.height === "number" ? `${props.height}px` : props.height;
  }

  return style;
});

const shapeClass = computed(() => {
  switch (props.shape) {
    case "circle":
      return "rounded-full";
    case "pill":
      return "rounded-full";
    case "square":
      return "rounded-md";
    default:
      return "rounded-md";
  }
});

const fallbackHeightClass = computed(() => (props.height === undefined ? "h-4" : ""));
const fallbackWidthClass = computed(() => {
  if (props.width !== undefined) return "";
  if (props.shape === "circle" || props.shape === "square") return "size-10";

  return "w-full";
});
</script>

<template>
  <div
    data-slot="skeleton"
    :class="
      cn(
        "relative isolate block overflow-hidden bg-gray-950/5 dark:bg-white/10",
        shapeClass,
        fallbackHeightClass,
        fallbackWidthClass,
        props.class
      )
    "
    :style="resolvedStyle"
    aria-hidden="true"
  >
    <span
      class="
        pointer-events-none absolute inset-0 -translate-x-full bg-gradient-to-r
        from-transparent via-white/60 to-transparent
        dark:via-white/15
        skeleton-shimmer
      "
    />
  </div>
</template>

<style scoped>
@keyframes skeleton-shimmer {
  100% {
    transform: translateX(100%);
  }
}

.skeleton-shimmer {
  animation: skeleton-shimmer 1.6s linear infinite;
}
</style>
