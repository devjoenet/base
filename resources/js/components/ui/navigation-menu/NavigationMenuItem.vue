<script setup lang="ts">
  import { orientationDataAttr, provideNavigationMenuItemContext, useNavigationMenuContext } from "./context";
  import { cn } from "@/lib/utils";
  import { computed, shallowRef, useId, type HTMLAttributes } from "vue";

  const props = defineProps<{ class?: HTMLAttributes["class"]; value?: string }>();
  const menu = useNavigationMenuContext("NavigationMenuItem");
  const internalId = useId();
  const id = computed(() => props.value ?? internalId);
  const triggerRef = shallowRef<HTMLElement | null>(null);
  const isOpen = computed(() => menu.openItem.value === id.value);
  const open = (trigger?: HTMLElement | null) => menu.setOpenItem(id.value, trigger ?? triggerRef.value);
  const close = () => menu.setOpenItem(null);

  provideNavigationMenuItemContext({ id, isOpen, open, close, setTrigger: (el) => (triggerRef.value = el) });
</script>

<template>
  <div data-slot="navigation-menu-item" :data-open="isOpen" :data-orientation="orientationDataAttr(menu.orientation.value)" :class="cn('relative', props.class)">
    <slot />
  </div>
</template>
