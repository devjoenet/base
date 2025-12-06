<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { useNavigationMenuContext } from "./context";
  import { computed, onBeforeUnmount, onMounted, ref, type HTMLAttributes } from "vue";

  const props = defineProps<{ class?: HTMLAttributes["class"] }>();
  const menu = useNavigationMenuContext("NavigationMenuViewport");
  const viewportEl = ref<HTMLElement | null>(null);
  const state = computed(() => (menu.openItem.value ? "open" : "closed"));

  onMounted(() => {
    menu.viewportRef.value = viewportEl.value;
  });

  onBeforeUnmount(() => {
    if (menu.viewportRef.value === viewportEl.value) {
      menu.viewportRef.value = null;
    }
  });
</script>

<template>
  <div class="absolute top-full left-0 isolate z-50 flex w-full justify-center">
    <div
      ref="viewportEl"
      v-show="menu.openItem"
      data-slot="navigation-menu-viewport"
      :data-state="state"
      :class="
        cn(
          'origin-top-center bg-surface text-foreground data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-90 relative mt-2 w-full overflow-hidden rounded-xl border border-border/60 shadow-lg shadow-gray-900/20 md:w-(--nav-viewport-width,24rem)',
          'dark:border-white/10 dark:shadow-black/30',
          props.class,
        )
      "
    >
      <slot />
    </div>
  </div>
</template>
