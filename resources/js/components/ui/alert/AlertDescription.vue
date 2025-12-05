<script setup lang="ts">
  import { computed, inject, type HTMLAttributes } from "vue";
  import { cn } from "@/lib/utils";
  import { alertVariantKey, defaultAlertVisuals } from ".";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();

  const visuals = inject(alertVariantKey, defaultAlertVisuals);
  const descriptionClass = computed(() => visuals.value.descriptionClass);
</script>

<template>
  <div class="mt-2 text-sm" :class="cn(descriptionClass, props.class)">
    <slot />
  </div>
</template>
