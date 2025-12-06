<script setup lang="ts">
  import SheetOverlay from "@/components/ui/sheet/SheetOverlay.vue";
  import { useSheetContext } from "@/components/ui/sheet/context";
  import { cn } from "@/lib/utils";
  import { DialogPanel, TransitionChild } from "@headlessui/vue";
  import { computed, type HTMLAttributes } from "vue";

  type SheetSide = "top" | "right" | "bottom" | "left";
  type SheetSize = "sm" | "md" | "lg" | "xl" | "full";

  const props = withDefaults(
    defineProps<{
      class?: HTMLAttributes["class"];
      overlayClass?: HTMLAttributes["class"];
      side?: SheetSide;
      size?: SheetSize;
    }>(),
    {
      side: "right",
      size: "md",
    },
  );

  useSheetContext("SheetContent");

  const sideClasses: Record<SheetSide, { container: string; enterFrom: string; leaveTo: string; sizeKey: "width" | "height" }> = {
    right: {
      container: "inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16",
      enterFrom: "translate-x-full",
      leaveTo: "translate-x-full",
      sizeKey: "width",
    },
    left: {
      container: "inset-y-0 left-0 flex max-w-full pr-10 sm:pr-16",
      enterFrom: "-translate-x-full",
      leaveTo: "-translate-x-full",
      sizeKey: "width",
    },
    top: {
      container: "inset-x-0 top-0 flex max-h-full pb-10 sm:pb-16",
      enterFrom: "-translate-y-full",
      leaveTo: "-translate-y-full",
      sizeKey: "height",
    },
    bottom: {
      container: "inset-x-0 bottom-0 flex max-h-full pt-10 sm:pt-16",
      enterFrom: "translate-y-full",
      leaveTo: "translate-y-full",
      sizeKey: "height",
    },
  };

  const widthClasses: Record<SheetSize, string> = {
    sm: "max-w-sm",
    md: "max-w-md",
    lg: "max-w-lg",
    xl: "max-w-2xl",
    full: "max-w-full",
  };

  const heightClasses: Record<SheetSize, string> = {
    sm: "h-[35vh]",
    md: "h-[50vh]",
    lg: "h-[65vh]",
    xl: "h-[80vh]",
    full: "h-full",
  };

  const transitionClasses = computed(() => sideClasses[props.side]);

  const neutralTransform = computed(() => (transitionClasses.value.sizeKey === "width" ? "translate-x-0" : "translate-y-0"));

  const panelClasses = computed(() => cn("pointer-events-auto w-screen", transitionClasses.value.sizeKey === "width" ? widthClasses[props.size] : "max-w-full", transitionClasses.value.sizeKey === "height" ? heightClasses[props.size] : "h-full"));

  const contentClasses = computed(() => cn("relative flex h-full flex-col overflow-y-auto bg-white py-6 shadow-xl dark:bg-gray-800 dark:after:absolute dark:after:inset-y-0 dark:after:left-0 dark:after:w-px dark:after:bg-white/10", props.class));
</script>

<template>
  <SheetOverlay :class="props.overlayClass" />
  <TransitionChild
    as="template"
    enter="transform transition ease-in-out duration-500 sm:duration-700"
    :enter-from="transitionClasses.enterFrom"
    :enter-to="neutralTransform"
    leave="transform transition ease-in-out duration-500 sm:duration-700"
    :leave-from="neutralTransform"
    :leave-to="transitionClasses.leaveTo"
  >
    <div class="fixed inset-0 z-10 overflow-hidden">
      <div class="absolute inset-0 overflow-hidden">
        <div class="pointer-events-none fixed" :class="transitionClasses.container">
          <DialogPanel data-slot="sheet-content" :class="panelClasses">
            <div :class="contentClasses">
              <slot />
            </div>
          </DialogPanel>
        </div>
      </div>
    </div>
  </TransitionChild>
</template>
