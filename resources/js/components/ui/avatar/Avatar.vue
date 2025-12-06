<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";
  import { avatarVariants } from "@/components/ui/avatar/variants";

  const props = withDefaults(
    defineProps<{
      class?: HTMLAttributes["class"];
      size?: "sm" | "md" | "lg" | "xl";
    }>(),
    {
      size: "md",
    },
  );
</script>

<template>
  <div :class="cn(avatarVariants({ size: props.size }), props.class)">
    <slot />
  </div>
</template>
