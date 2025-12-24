<script setup lang="ts">
  import type { PrimitiveProps } from "reka-ui";
  import type { HTMLAttributes } from "vue";
  import { ref } from "vue";
  import type { ButtonVariants } from ".";
  import { Primitive } from "reka-ui";
  import { cn } from "@/lib/utils";
  import { buttonVariants } from ".";

  interface Props extends PrimitiveProps {
    variant?: ButtonVariants["variant"];
    size?: ButtonVariants["size"];
    class?: HTMLAttributes["class"];
  }

  const props = withDefaults(defineProps<Props>(), {
    as: "button",
  });

  const ripples = ref<{ id: number; x: number; y: number; size: number }[]>([]);
  let rippleId = 0;

  function createRipple(event: MouseEvent) {
    const button = event.currentTarget as HTMLElement;
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;

    const id = rippleId++;
    ripples.value.push({ id, x, y, size });

    setTimeout(() => {
      ripples.value = ripples.value.filter((r) => r.id !== id);
    }, 600);
  }
</script>

<template>
  <Primitive data-slot="button" :as="as" :as-child="asChild" :class="cn(buttonVariants({ variant, size }), props.class)" @mousedown="createRipple">
    <slot />
    <span v-for="ripple in ripples" :key="ripple.id" class="animate-ripple pointer-events-none absolute rounded-full bg-current opacity-25" :style="{ width: ripple.size + 'px', height: ripple.size + 'px', left: ripple.x + 'px', top: ripple.y + 'px' }" />
  </Primitive>
</template>
