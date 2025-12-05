<script setup lang="ts">
  import { MenuItem as HeadlessMenuItem } from "@headlessui/vue";
  import { cn } from "@/lib/utils";
  import { Fragment, computed, type Component, type HTMLAttributes } from "vue";

  /**
   * Reference item API: items reuse the Tailwind Plus padding and active background classes
   * (`bg-gray-50 outline-hidden dark:bg-white/5`). Arrow keys move the active state, Enter/Space
   * selects the item, and Escape returns focus to the trigger.
   */
  const emit = defineEmits<{ (e: "select", event: MouseEvent): void }>();

  const props = withDefaults(
    defineProps<{
      as?: string | Component;
      class?: HTMLAttributes["class"];
      activeClass?: string;
      disabled?: boolean;
      inset?: boolean;
      closeOnSelect?: boolean;
    }>(),
    {
      as: "button",
      activeClass: "bg-gray-50 outline-hidden dark:bg-white/5",
      disabled: false,
      inset: false,
      closeOnSelect: true,
    },
  );

  const baseClasses = computed(() =>
    cn(
      "block px-3 py-1 text-sm/6 text-gray-900 transition-colors duration-75 dark:text-white",
      props.inset ? "pl-10" : "",
      props.class,
    ),
  );
</script>

<template>
  <HeadlessMenuItem v-slot="{ active, close, disabled }" :as="Fragment" :disabled="props.disabled">
    <component
      :is="props.as"
      v-bind="$attrs"
      :type="props.as === 'button' ? 'button' : undefined"
      :disabled="props.as === 'button' ? props.disabled : undefined"
      data-slot="menu-item"
      :class="cn(baseClasses, active ? props.activeClass : '')"
      @click="(event: MouseEvent) => {
        emit('select', event);
        if (props.closeOnSelect) {
          close();
        }
      }"
    >
      <slot :active="active" :close="close" :disabled="disabled" />
    </component>
  </HeadlessMenuItem>
</template>
