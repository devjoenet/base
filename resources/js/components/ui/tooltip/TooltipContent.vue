<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { useTooltipContext } from "@/components/ui/tooltip/context";
  import { computed, ref, watch, onMounted, onUnmounted, type HTMLAttributes } from "vue";

  const props = withDefaults(defineProps<{ class?: HTMLAttributes["class"]; sideOffset?: number }>(), {
    sideOffset: 4,
  });

  const tooltip = useTooltipContext("TooltipContent");

  const floatingRef = ref<HTMLElement | null>(null);
  const x = ref(0);
  const y = ref(0);

  const updatePosition = () => {
    if (tooltip.triggerRef.value && floatingRef.value) {
      const triggerRect = tooltip.triggerRef.value.getBoundingClientRect();
      const floatingRect = floatingRef.value.getBoundingClientRect();

      switch (tooltip.placement.value) {
        case "top":
          y.value = triggerRect.top - floatingRect.height - props.sideOffset;
          x.value = triggerRect.left + (triggerRect.width - floatingRect.width) / 2;
          break;
        case "bottom":
          y.value = triggerRect.bottom + props.sideOffset;
          x.value = triggerRect.left + (triggerRect.width - floatingRect.width) / 2;
          break;
        case "left":
          x.value = triggerRect.left - floatingRect.width - props.sideOffset;
          y.value = triggerRect.top + (triggerRect.height - floatingRect.height) / 2;
          break;
        case "right":
          x.value = triggerRect.right + props.sideOffset;
          y.value = triggerRect.top + (triggerRect.height - floatingRect.height) / 2;
          break;
      }
    }
  };

  watch(
    () => tooltip.open.value,
    (isOpen) => {
      if (isOpen) {
        watch(floatingRef, () => {
          updatePosition();
        }, { once: true });
      }
    },
  );

  onMounted(() => {
    window.addEventListener("resize", updatePosition);
  });

  onUnmounted(() => {
    window.removeEventListener("resize", updatePosition);
  });

  const currentSide = computed(() => tooltip.placement.value.split("-")[0]);
  const alignment = computed(() => tooltip.placement.value.split("-")[1] ?? "center");
</script>

<template>
  <Teleport to="body">
    <div
      v-if="tooltip.open"
      ref="floatingRef"
      :id="tooltip.contentId"
      role="tooltip"
      data-slot="tooltip-content"
      :data-state="tooltip.open ? 'open' : 'closed'"
      :data-side="currentSide"
      :data-align="alignment"
      :class="
        cn(
          'bg-primary text-primary-foreground animate-in fade-in-0 zoom-in-95 data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=closed]:zoom-out-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 z-50 w-fit rounded-md px-3 py-1.5 text-xs text-balance shadow-sm outline-hidden',
          props.class,
        )
      "
      :style="{ position: 'fixed', top: `${y}px`, left: `${x}px` }"
      @mouseenter="tooltip.openWithDelay"
      @mouseleave="tooltip.closeWithDelay"
    >
      <slot />
    </div>
  </Teleport>
</template>