<script setup lang="ts">
  import { MenuButton as HeadlessMenuButton } from "@headlessui/vue";
  import { cn } from "@/lib/utils";
  import type { Component, HTMLAttributes } from "vue";

  /**
   * Reference trigger API: mirrors the Tailwind Plus profile dropdown with a flex, relative
   * trigger area so the Headless UI roving focus and keyboard navigation (Tab to focus,
   * Enter/Space to open, Escape to close) remain predictable.
   */
  const props = withDefaults(
    defineProps<{
      as?: string | Component;
      class?: HTMLAttributes["class"];
      chevron?: boolean;
      disabled?: boolean;
    }>(),
    {
      as: "button",
      chevron: false,
      disabled: false,
    },
  );
</script>

<template>
  <HeadlessMenuButton
    :as="props.as"
    :disabled="props.disabled"
    :type="props.as === 'button' ? 'button' : undefined"
    :class="cn('relative flex items-center', props.class)"
    data-slot="menu-trigger"
  >
    <slot />
    <svg
      v-if="props.chevron"
      class="ml-2 size-5 text-gray-400 dark:text-gray-500"
      viewBox="0 0 20 20"
      fill="currentColor"
      aria-hidden="true"
    >
      <path
        fill-rule="evenodd"
        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08Z"
        clip-rule="evenodd"
      />
    </svg>
  </HeadlessMenuButton>
</template>
