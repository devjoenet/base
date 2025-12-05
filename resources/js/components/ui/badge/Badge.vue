<script setup lang="ts">
  import { badgeVariants, type BadgeVariants } from "@/components/ui/badge/variants";
  import { cn } from "@/lib/utils";
  import { type HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
    variant?: BadgeVariants["variant"];
    size?: BadgeVariants["size"];
  }>();
</script>

<template>
  <span data-slot="badge" :class="cn(badgeVariants({ variant: props.variant, size: props.size }), props.class)">
    <slot />
  </span>
</template>
