<script setup lang="ts">
  import { tooltipContextKey, useTooltipProviderContext } from "@/components/ui/tooltip/context";
  import type { Placement } from "./types";
  import { computed, onBeforeUnmount, provide, ref, useId, watch } from "vue";

  const emit = defineEmits<{
    (e: "update:open", value: boolean): void;
    (e: "open-change", value: boolean): void;
  }>();

  const props = withDefaults(
    defineProps<{
      open?: boolean;
      defaultOpen?: boolean;
      delayDuration?: number;
      placement?: Placement;
    }>(),
    {
      defaultOpen: false,
      placement: "top",
    },
  );

  const provider = useTooltipProviderContext();

  const delayDuration = computed(() => props.delayDuration ?? provider?.delayDuration.value ?? 0);

  const openState = ref(props.defaultOpen);

  watch(
    () => props.open,
    (value) => {
      if (value !== undefined) {
        openState.value = value;
      }
    },
    { immediate: true },
  );

  const open = computed(() => props.open ?? openState.value);

  const setOpen = (value: boolean) => {
    if (props.open === undefined) {
      openState.value = value;
    }

    emit("update:open", value);
    emit("open-change", value);
  };

  const openTimeout = ref<number>();
  const closeTimeout = ref<number>();

  const openWithDelay = () => {
    window.clearTimeout(closeTimeout.value);
    window.clearTimeout(openTimeout.value);

    openTimeout.value = window.setTimeout(() => setOpen(true), delayDuration.value);
  };

  const closeWithDelay = () => {
    window.clearTimeout(openTimeout.value);
    window.clearTimeout(closeTimeout.value);

    closeTimeout.value = window.setTimeout(() => setOpen(false), 75);
  };

  const closeNow = () => {
    window.clearTimeout(openTimeout.value);
    window.clearTimeout(closeTimeout.value);

    setOpen(false);
  };

  onBeforeUnmount(() => {
    window.clearTimeout(openTimeout.value);
    window.clearTimeout(closeTimeout.value);
  });

  const triggerRef = ref<HTMLElement | null>(null);

  provide(tooltipContextKey, {
    open,
    placement: computed(() => props.placement ?? "top"),
    triggerRef,
    contentId: `tooltip-${useId()}`,
    openWithDelay,
    closeWithDelay,
    closeNow,
    setTrigger: (element) => {
      triggerRef.value = element;
    },
  });
</script>

<template>
  <slot />
</template>
