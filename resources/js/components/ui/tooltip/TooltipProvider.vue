<script setup lang="ts">
  import { tooltipProviderContextKey } from "@/components/ui/tooltip/context";
  import { provide, ref } from "vue";

  const props = withDefaults(defineProps<{ delayDuration?: number }>(), {
    delayDuration: 0,
  });

  const delayDuration = ref(props.delayDuration);

  provide(tooltipProviderContextKey, { delayDuration });
</script>

<template>
  <slot />
</template>
