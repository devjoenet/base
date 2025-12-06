<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import {
    orientationDataAttr,
    useNavigationMenuContext,
    useNavigationMenuItemContext,
  } from "./context";
  import { Transition, Teleport, computed, type HTMLAttributes } from "vue";

  const props = defineProps<{ class?: HTMLAttributes["class"]; forceMount?: boolean }>();

  const item = useNavigationMenuItemContext("NavigationMenuContent");
  const menu = useNavigationMenuContext("NavigationMenuContent");
  const shouldPortal = computed(
    () => menu.viewportEnabled.value && !!menu.viewportRef.value && menu.orientation.value === "horizontal",
  );

  const target = computed(() => menu.viewportRef.value ?? "body");
</script>

<template>
  <Teleport :to="target" :disabled="!shouldPortal">
    <Transition
      enter-active-class="data-[state=open]:duration-200"
      leave-active-class="data-[state=closed]:duration-150"
    >
      <div
        v-if="item.isOpen || props.forceMount"
        role="group"
        data-slot="navigation-menu-content"
        :data-state="item.isOpen ? 'open' : 'closed'"
        :data-orientation="orientationDataAttr(menu.orientation.value)"
        :class="
          cn(
            'data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=open]:fade-in data-[state=closed]:fade-out',
            'group-data-[orientation=horizontal]/navigation-menu:top-0 group-data-[orientation=horizontal]/navigation-menu:left-0',
            'group-data-[orientation=horizontal]/navigation-menu:md:absolute group-data-[orientation=horizontal]/navigation-menu:md:w-auto',
            'group-data-[orientation=horizontal]/navigation-menu:w-full group-data-[orientation=horizontal]/navigation-menu:p-2',
            'group-data-[viewport=false]/navigation-menu:bg-surface group-data-[viewport=false]/navigation-menu:shadow-sm group-data-[viewport=false]/navigation-menu:ring-1 group-data-[viewport=false]/navigation-menu:ring-border/60',
            'group-data-[viewport=false]/navigation-menu:rounded-xl group-data-[viewport=false]/navigation-menu:mt-2',
            'bg-surface text-foreground w-full rounded-xl border border-border/60 p-3 shadow-sm shadow-gray-900/10 dark:border-white/10 dark:shadow-black/30',
            props.class,
          )
        "
        @mouseenter="item.open()"
        @mouseleave="item.close()"
      >
        <slot />
      </div>
    </Transition>
  </Teleport>
</template>
