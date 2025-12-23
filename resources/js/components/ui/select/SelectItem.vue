<script setup lang="ts">
  import type { HTMLAttributes } from "vue";
  import { computed, inject, onMounted, ref } from "vue";
  import { DropdownMenuItem } from "@/components/ui/dropdown-menu";
  import { cn } from "@/lib/utils";
  import { SELECT_CTX_KEY } from "./context";
  import { Check } from "lucide-vue-next";

  const props = withDefaults(
    defineProps<{
      value: string | number;
      class?: HTMLAttributes["class"];
      disabled?: boolean;
      label?: string;
    }>(),
    {},
  );

  const ctx = inject(SELECT_CTX_KEY);

  const selected = computed(() => ctx?.modelValue.value === props.value);

  const rootEl = ref<HTMLElement | null>(null);

  onMounted(() => {
    if (!ctx) return;
    // Prefer explicit label prop; otherwise, try to derive from text content
    const label = props.label ?? rootEl.value?.textContent?.trim();
    if (label) ctx.registerItem(props.value, label);
  });

  const onSelect = (e: Event) => {
    if (props.disabled || !ctx) return;
    ctx.setValue(props.value);
  };
</script>

<template>
  <DropdownMenuItem
    data-slot="select-item"
    :disabled="disabled"
    @select="onSelect"
    :class="cn('relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none data-disabled:pointer-events-none data-disabled:opacity-50', props.class)"
    ref="rootEl"
  >
    <Check v-if="selected" class="size-4 shrink-0 text-primary" />
    <slot />
  </DropdownMenuItem>
</template>
