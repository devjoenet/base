<script setup lang="ts">
  import { computed, inject, type HTMLAttributes } from "vue";
  import { cn } from "@/lib/utils";
  import { alertVariantKey, defaultAlertVisuals } from "./";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();

  const visuals = inject(alertVariantKey, defaultAlertVisuals);
  const titleClass = computed(() => visuals.value.titleClass);
</script>

<template>
  <p class="text-sm font-medium" :class="cn(titleClass, props.class)">
    <slot />
  </p>
</template>
