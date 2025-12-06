<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { type Component, type HTMLAttributes } from "vue";

  const props = withDefaults(
    defineProps<{
      as?: string | Component;
      href?: string;
      class?: HTMLAttributes["class"];
      active?: boolean;
    }>(),
    {
      as: "a",
      href: undefined,
      active: false,
    },
  );
</script>

<template>
  <component
    :is="props.as"
    :href="props.as === 'a' ? props.href : undefined"
    data-slot="navigation-menu-link"
    :data-active="props.active"
    :class="
      cn(
        'flex flex-col gap-1 rounded-md px-3 py-2 text-sm font-medium text-foreground/80 transition-[color,box-shadow] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ring/70',
        'hover:bg-accent/80 hover:text-accent-foreground focus:bg-accent/80 focus:text-accent-foreground data-[active=true]:bg-accent/70 data-[active=true]:text-accent-foreground',
        'ring-ring/30 dark:ring-ring/30 [&_svg:not([class*=text-])]:text-muted-foreground [&_svg:not([class*=size-])]:size-4',
        props.class,
      )
    "
  >
    <slot />
  </component>
</template>
