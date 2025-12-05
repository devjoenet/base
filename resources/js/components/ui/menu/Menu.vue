<script setup lang="ts">
  import { Menu as HeadlessMenu } from "@headlessui/vue";
  import { cn } from "@/lib/utils";
  import type { Component, HTMLAttributes } from "vue";

  /**
   * Accessible menu wrapper built on Headless UI. Keyboard navigation mirrors the
   * Tailwind Plus profile dropdown reference: triggers follow the button styles from
   * the design token classes, items receive active states on arrow key movement, and
   * Escape closes the menu while focus returns to the trigger.
   */
  const props = withDefaults(
    defineProps<{
      as?: string | Component;
      class?: HTMLAttributes["class"];
    }>(),
    {
      as: "div",
    },
  );
</script>

<template>
  <HeadlessMenu :as="props.as" :class="cn('relative', props.class)" data-slot="menu">
    <slot />
  </HeadlessMenu>
</template>
