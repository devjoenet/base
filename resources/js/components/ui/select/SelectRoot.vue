<script setup lang="ts">
  import type { HTMLAttributes } from "vue";
  import { computed, provide, reactive } from "vue";
  import { useVModel } from "@vueuse/core";
  import { cn } from "@/lib/utils";
  import { inputFieldVariants } from "@/components/ui/input";
  import { DropdownMenu, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";
  import { ChevronDown } from "lucide-vue-next";
  import { SELECT_CTX_KEY } from "./context";

  const props = withDefaults(
    defineProps<{
      modelValue?: string | number;
      defaultValue?: string | number;
      placeholder?: string;
      disabled?: boolean;
      error?: string;
      variant?: "filled" | "outlined";
      class?: HTMLAttributes["class"];
      controlClass?: HTMLAttributes["class"];
    }>(),
    {
      variant: "filled",
      disabled: false,
      placeholder: "Select an option",
    },
  );

  const emits = defineEmits<{
    (e: "update:modelValue", payload: string | number): void;
    (e: "change", payload: string | number): void;
  }>();

  const value = useVModel(props, "modelValue", emits, {
    passive: true,
    defaultValue: props.defaultValue,
  });

  const items = reactive(new Map<string | number, string>());
  const registerItem = (v: string | number, label: string) => {
    items.set(v, label);
  };
  const getLabel = (v: string | number | undefined) => (v === undefined ? undefined : items.get(v));

  const setValue = (v: string | number) => {
    value.value = v;
    emits("change", v);
  };

  provide(SELECT_CTX_KEY, {
    modelValue: value,
    setValue,
    placeholder: props.placeholder,
    disabled: props.disabled,
    registerItem,
    getLabel,
  });

  const hasError = computed(() => Boolean(props.error));
</script>

<template>
  <DropdownMenu>
    <div data-slot="select-field" :class="cn('group/select flex w-full flex-col gap-1.5', props.class)">
      <div data-slot="control" :class="cn(inputFieldVariants({ variant, invalid: hasError, disabled }), 'shadow-xs px-3 py-2', props.controlClass)">
        <DropdownMenuTrigger asChild>
          <button type="button" :disabled="disabled" class="flex w-full items-center justify-between gap-2 outline-hidden">
            <span class="truncate text-left text-base leading-6 text-foreground">
              <slot name="value">
                {{ getLabel(value as any) ?? placeholder }}
              </slot>
            </span>
            <ChevronDown class="size-4 shrink-0 text-muted-foreground" />
          </button>
        </DropdownMenuTrigger>
      </div>

      <p v-if="error" class="min-h-5 text-sm leading-snug text-destructive">{{ error }}</p>
    </div>

    <slot />
  </DropdownMenu>
</template>
