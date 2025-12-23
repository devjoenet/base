<script setup lang="ts">
  import type { HTMLAttributes } from "vue";
  import { DropdownMenuContent, DropdownMenuPortal } from "@/components/ui/dropdown-menu";
  import { cn } from "@/lib/utils";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
    align?: "start" | "center" | "end";
  }>();
</script>

<template>
  <DropdownMenuPortal>
    <DropdownMenuContent :align="props.align ?? 'start'" :class="cn('w-[--reka-popper-anchor-width] rounded-md', props.class)">
      <slot />
    </DropdownMenuContent>
  </DropdownMenuPortal>
</template>
