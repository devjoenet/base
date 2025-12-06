<script setup lang="ts">
  import NavigationMenuViewport from "@/components/ui/navigation-menu/NavigationMenuViewport.vue";
  import { cn } from "@/lib/utils";
  import { onClickOutside } from "@vueuse/core";
  import { computed, ref, shallowRef, type HTMLAttributes } from "vue";
  import { provideNavigationMenuContext, type NavigationMenuOrientation } from "./context";

  const props = withDefaults(
    defineProps<{
      class?: HTMLAttributes["class"];
      orientation?: NavigationMenuOrientation;
      viewport?: boolean;
    }>(),
    {
      orientation: "horizontal",
      viewport: true,
    },
  );

  const openItem = ref<string | null>(null);
  const rootRef = shallowRef<HTMLElement | null>(null);
  const viewportRef = shallowRef<HTMLElement | null>(null);
  const activeTrigger = shallowRef<HTMLElement | null>(null);

  const setOpenItem = (id: string | null, trigger?: HTMLElement | null) => {
    openItem.value = id;
    activeTrigger.value = id ? (trigger ?? activeTrigger.value) : null;
  };

  const handleKeydown = (event: KeyboardEvent) => {
    if (event.key === "Escape") {
      setOpenItem(null);
    }
  };

  onClickOutside(rootRef, () => setOpenItem(null));

  provideNavigationMenuContext({
    orientation: computed(() => props.orientation),
    openItem,
    setOpenItem,
    rootRef,
    viewportRef,
    viewportEnabled: computed(() => props.viewport),
    activeTrigger,
  });
</script>

<template>
  <nav ref="rootRef" data-slot="navigation-menu" :data-orientation="props.orientation" :data-viewport="props.viewport" :class="cn('group/navigation-menu relative flex max-w-max flex-1 items-center justify-center', props.class)" @keydown="handleKeydown">
    <slot />
    <NavigationMenuViewport v-if="props.viewport" />
  </nav>
</template>
