<script setup lang="ts">
  import { navigationMenuTriggerStyle } from "./index";
  import { cn } from "@/lib/utils";
  import { useNavigationMenuContext, useNavigationMenuItemContext } from "./context";
  import { Transition } from "vue";
  import { computed, onMounted, onUnmounted, ref, watch, type HTMLAttributes } from "vue";

  const props = defineProps<{ class?: HTMLAttributes["class"]; chevron?: boolean }>();

  const item = useNavigationMenuItemContext("NavigationMenuTrigger");
  const menu = useNavigationMenuContext("NavigationMenuTrigger");
  const triggerRef = ref<HTMLElement | null>(null);
  const isOpen = computed(() => item.isOpen.value);

  const onClick = () => {
    if (isOpen.value) {
      item.close();
    } else {
      item.open(triggerRef.value ?? undefined);
    }
  };

  const openOnHover = () => item.open(triggerRef.value ?? undefined);
  watch(isOpen, (value) => {
    if (value) {
      menu.setOpenItem(item.id.value, triggerRef.value ?? undefined);
    }
  });

  onMounted(() => item.setTrigger(triggerRef.value));
  onUnmounted(() => item.setTrigger(null));
</script>

<template>
  <button
    ref="triggerRef"
    type="button"
    role="menuitem"
    :data-state="isOpen ? 'open' : 'closed'"
    :aria-expanded="isOpen"
    :class="cn(navigationMenuTriggerStyle(), 'group', props.class)"
    @click.prevent="onClick"
    @mouseenter="openOnHover"
    @focus="openOnHover"
  >
    <span class="flex items-center gap-2">
      <slot />
      <Transition enter-active-class="transition-transform duration-200" leave-active-class="transition-transform duration-200">
        <svg
          v-if="props.chevron !== false"
          class="size-3 text-foreground/70 transition-transform duration-200 group-data-[state=open]:rotate-180"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          aria-hidden="true"
        >
          <path d="M6 9l6 6 6-6" />
        </svg>
      </Transition>
    </span>
  </button>
</template>
