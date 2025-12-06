<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { useTooltipContext } from "@/components/ui/tooltip/context";
  import { computed, type Component, type HTMLAttributes } from "vue";

  const props = withDefaults(
    defineProps<{
      as?: string | Component;
      class?: HTMLAttributes["class"];
      disabled?: boolean;
    }>(),
    {
      as: "button",
      disabled: false,
    },
  );

  const tooltip = useTooltipContext("TooltipTrigger");

  const triggerTag = computed(() => props.as ?? "button");
</script>

<template>
  <component
    :is="triggerTag"
    v-bind="$attrs"
    :ref="tooltip.setTrigger"
    :type="triggerTag === 'button' ? 'button' : undefined"
    :disabled="triggerTag === 'button' ? props.disabled : undefined"
    data-slot="tooltip-trigger"
    :aria-describedby="tooltip.open ? tooltip.contentId : undefined"
    :class="cn(props.class)"
    @mouseenter="tooltip.openWithDelay"
    @mouseleave="tooltip.closeWithDelay"
    @focus="tooltip.openWithDelay"
    @blur="tooltip.closeNow"
    @keydown.escape.prevent.stop="tooltip.closeNow"
  >
    <slot :open="tooltip.open" />
  </component>
</template>
