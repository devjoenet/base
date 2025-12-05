<script setup lang="ts">
  import { type AlertVariants, variantVisuals, alertVariantKey, alertVariants } from "./";
  import { computed, provide, useSlots, type Component, type HTMLAttributes } from "vue";
  import { cn } from "@/lib/utils";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
    variant?: AlertVariants["variant"];
    icon?: Component | null;
    title?: string;
  }>();

  const slots = useSlots();
  const variant = computed(() => props.variant ?? "info");
  const visuals = computed(() => variantVisuals[variant.value] ?? variantVisuals.info);
  const iconComponent = computed(() => props.icon ?? visuals.value.icon);

  provide(alertVariantKey, visuals);
</script>

<template>
  <div :class="cn(alertVariants({ variant }), props.class)" role="alert">
    <div v-if="slots.icon || iconComponent" class="shrink-0">
      <slot name="icon">
        <component :is="iconComponent" v-if="iconComponent" class="size-5" :class="visuals.iconClass" aria-hidden="true" />
      </slot>
    </div>

    <div class="ml-3 flex-1">
      <p v-if="slots.title || title" class="text-sm font-medium" :class="visuals.titleClass">
        <slot name="title">{{ title }}</slot>
      </p>
      <div v-if="slots.default" class="mt-2 text-sm" :class="visuals.descriptionClass">
        <slot />
      </div>
      <div v-if="slots.actions" class="mt-4">
        <slot name="actions" />
      </div>
    </div>

    <slot name="dismiss" />
  </div>
</template>
