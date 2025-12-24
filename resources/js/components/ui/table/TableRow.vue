// resources/js/components/ui/table/TableRow.vue
<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <tr :class="cn('hover transition-colors', props.class)">
    <slot />
  </tr>
</template>
