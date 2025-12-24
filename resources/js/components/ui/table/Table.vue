// resources/js/components/ui/table/Table.vue
<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <div class="relative w-full overflow-auto">
    <table :class="cn('table w-full', props.class)">
      <slot />
    </table>
  </div>
</template>
