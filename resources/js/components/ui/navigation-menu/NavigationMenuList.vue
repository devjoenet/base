<script setup lang="ts">
  import { orientationDataAttr, useNavigationMenuContext } from "./context";
  import { cn } from "@/lib/utils";
  import { onBeforeUnmount, ref, type HTMLAttributes } from "vue";

  const props = defineProps<{ class?: HTMLAttributes["class"] }>();

  const menu = useNavigationMenuContext("NavigationMenuList");
  const closeTimer = ref<number | undefined>();

  const startCloseTimer = () => {
    closeTimer.value = window.setTimeout(() => menu.setOpenItem(null), 120);
  };

  const clearCloseTimer = () => {
    if (closeTimer.value) {
      window.clearTimeout(closeTimer.value);
    }
  };

  onBeforeUnmount(() => clearCloseTimer());
</script>

<template>
  <div
    role="menubar"
    :data-orientation="orientationDataAttr(menu.orientation.value)"
    :class="
      cn(
        'group flex flex-1 list-none items-center justify-center gap-1',
        menu.orientation.value === 'vertical' ? 'flex-col' : 'flex-row',
        props.class,
      )
    "
    @mouseleave="startCloseTimer"
    @mouseenter="clearCloseTimer"
  >
    <slot />
  </div>
</template>
