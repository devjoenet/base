<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { ChevronRightIcon } from "@heroicons/vue/24/outline";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <li role="presentation" aria-hidden="true" :class="cn('[&>svg]:size-3.5', props.class)">
    <slot>
      <ChevronRightIcon />
    </slot>
  </li>
</template>
