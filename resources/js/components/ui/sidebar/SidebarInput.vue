<script setup lang="ts">
  import type { HTMLAttributes } from "vue";
  import { cn } from "@/lib/utils";
  import { Input } from "@/components/ui/input";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <Input data-slot="sidebar-input" data-sidebar="input" :class="cn('w-full', props.class)" control-class="bg-background h-8 shadow-none">
    <slot />
  </Input>
</template>
