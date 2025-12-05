<script setup lang="ts">
  import { MenuItems as HeadlessMenuItems } from "@headlessui/vue";
  import { cn } from "@/lib/utils";
  import { computed, type Component, type HTMLAttributes } from "vue";

  const props = withDefaults(
    defineProps<{
      as?: string | Component;
      class?: HTMLAttributes["class"];
      align?: "start" | "end";
      widthClass?: string;
      static?: boolean;
    }>(),
    {
      as: "div",
      align: "end",
      widthClass: "w-32",
      static: false,
    },
  );

  const alignmentClasses = computed(() =>
    props.align === "start" ? "left-0 origin-top-left" : "right-0 origin-top-right",
  );
</script>

<template>
  <HeadlessMenuItems
    :as="props.as"
    :static="props.static"
    :class="cn(
      'absolute z-10 mt-2.5 rounded-md bg-white py-2 shadow-lg outline outline-gray-900/5 dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10',
      props.widthClass,
      alignmentClasses,
      props.class,
    )"
    data-slot="menu-items"
  >
    <slot />
  </HeadlessMenuItems>
</template>
