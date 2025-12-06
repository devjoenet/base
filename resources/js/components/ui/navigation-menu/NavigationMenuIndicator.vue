<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { useElementBounding } from "@vueuse/core";
  import { computed, type CSSProperties, type HTMLAttributes } from "vue";
  import { useNavigationMenuContext } from "./context";

  const props = defineProps<{ class?: HTMLAttributes["class"] }>();

  const menu = useNavigationMenuContext("NavigationMenuIndicator");

  const { width, left } = useElementBounding(() => menu.activeTrigger.value);
  const { left: menuLeft } = useElementBounding(() => menu.rootRef.value);

  const indicatorStyle = computed<CSSProperties>(() => {
    if (!menu.activeTrigger.value || !menu.rootRef.value) return { opacity: 0 };

    const translateX = left.value - menuLeft.value;

    return {
      width: `${width.value}px`,
      transform: `translateX(${translateX}px) translateY(-0.25rem)`,
      opacity: menu.openItem.value ? 1 : 0,
    };
  });
</script>

<template>
  <div
    aria-hidden="true"
    data-slot="navigation-menu-indicator"
    :data-state="menu.openItem.value ? 'visible' : 'hidden'"
    :class="
      cn(
        'data-[state=visible]:animate-in data-[state=hidden]:animate-out data-[state=hidden]:fade-out data-[state=visible]:fade-in top-full z-[1] flex h-1.5 items-end justify-center overflow-hidden',
        props.class,
      )
    "
    :style="indicatorStyle"
  >
    <div class="bg-border relative top-[60%] h-2 w-2 rotate-45 rounded-sm shadow-md shadow-gray-900/20 dark:bg-white/70" />
  </div>
</template>
