<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    src?: string;
    alt?: string;
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <img :src="props.src" :alt="props.alt" :class="cn('aspect-square h-full w-full object-cover', props.class)" />
</template>
