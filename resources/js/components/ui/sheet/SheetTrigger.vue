<script setup lang="ts">
  import { useSheetContext } from "@/components/ui/sheet/context";
  import { cn } from "@/lib/utils";
  import { computed, type Component, type HTMLAttributes } from "vue";

  const props = withDefaults(
    defineProps<{
      as?: string | Component;
      class?: HTMLAttributes["class"];
    }>(),
    {
      as: "button",
    },
  );

  const emit = defineEmits<{ (e: "click", event: MouseEvent): void }>();

  const { setOpen } = useSheetContext("SheetTrigger");

  const triggerTag = computed(() => props.as ?? "button");

  const handleClick = (event: MouseEvent) => {
    emit("click", event);
    setOpen(true);
  };
</script>

<template>
  <component :is="triggerTag" :type="triggerTag === 'button' ? 'button' : undefined" data-slot="sheet-trigger" :class="cn(props.class)" @click="handleClick">
    <slot />
  </component>
</template>
