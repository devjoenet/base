<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { useTooltipContext } from "@/components/ui/tooltip/context";
  import { FloatingPortal, autoUpdate, flip, offset, shift, arrow, useFloating } from "@floating-ui/vue";
  import { computed, ref, watch, type HTMLAttributes } from "vue";

  const props = withDefaults(
    defineProps<{ class?: HTMLAttributes["class"]; sideOffset?: number }>(),
    {
      sideOffset: 4,
    },
  );

  const tooltip = useTooltipContext("TooltipContent");

  const arrowRef = ref<HTMLElement | null>(null);
  const floatingRef = ref<HTMLElement | null>(null);

  const { x, y, middlewareData, placement, strategy, update } = useFloating(tooltip.triggerRef, floatingRef, {
    placement: tooltip.placement.value,
    middleware: [offset(props.sideOffset), flip(), shift({ padding: 8 }), arrow({ element: arrowRef })],
    whileElementsMounted: autoUpdate,
  });

  watch(
    () => tooltip.open.value,
    (isOpen) => {
      if (isOpen) {
        update();
      }
    },
  );

  const currentSide = computed(() => placement.value.split("-")[0]);
  const alignment = computed(() => placement.value.split("-")[1] ?? "center");

  const arrowStyle = computed(() => ({
    left: middlewareData.value.arrow?.x != null ? `${middlewareData.value.arrow.x}px` : undefined,
    top: middlewareData.value.arrow?.y != null ? `${middlewareData.value.arrow.y}px` : undefined,
  }));
</script>

<template>
  <FloatingPortal>
    <div
      v-if="tooltip.open"
      ref="floatingRef"
      :id="tooltip.contentId"
      role="tooltip"
      data-slot="tooltip-content"
      :data-state="tooltip.open ? 'open' : 'closed'"
      :data-side="currentSide"
      :data-align="alignment"
      :class="cn('bg-primary text-primary-foreground animate-in fade-in-0 zoom-in-95 data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=closed]:zoom-out-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 z-50 w-fit rounded-md px-3 py-1.5 text-xs text-balance shadow-sm outline-hidden', props.class)"
      :style="{ position: strategy, top: `${y ?? 0}px`, left: `${x ?? 0}px` }"
      @mouseenter="tooltip.openWithDelay"
      @mouseleave="tooltip.closeWithDelay"
    >
      <slot />

      <span
        ref="arrowRef"
        class="bg-primary fill-primary z-50 size-2.5 translate-y-[calc(-50%_-_2px)] rotate-45 rounded-[2px]"
        :style="arrowStyle"
        aria-hidden="true"
      />
    </div>
  </FloatingPortal>
</template>
