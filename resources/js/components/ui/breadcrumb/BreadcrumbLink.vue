<script setup lang="ts">
  import { Link } from "@inertiajs/vue3";
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <Link :class="cn('transition-colors hover:text-zinc-900 dark:hover:text-zinc-50 cursor-pointer', props.class)">
    <slot />
  </Link>
</template>
