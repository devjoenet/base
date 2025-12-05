<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { useVModel } from "@vueuse/core";
  import { computed, ref, type HTMLAttributes, type InputTypeHTMLAttribute } from "vue";

  const props = withDefaults(
    defineProps<{
      modelValue?: string | number | null;
      defaultValue?: string | number | null;
      type?: InputTypeHTMLAttribute;
      label?: string;
      placeholder?: string;
      disabled?: boolean;
      invalid?: boolean;
      variant?: "filled" | "outlined";
      class?: HTMLAttributes["class"];
    }>(),
    {
      type: "text",
      placeholder: "",
      disabled: false,
      invalid: false,
      variant: "filled",
    },
  );

  const emit = defineEmits<{
    (e: "update:modelValue", value: string | number | null): void;
    (e: "focus", event: FocusEvent): void;
    (e: "blur", event: FocusEvent): void;
  }>();

  const modelValue = useVModel(props, "modelValue", emit, {
    passive: true,
    defaultValue: props.defaultValue ?? "",
  });

  const isFocused = ref(false);

  const hasContent = computed(() => {
    if (modelValue.value === null || modelValue.value === undefined) return false;
    return String(modelValue.value).length > 0;
  });

  const floatLabel = computed(() => isFocused.value || hasContent.value);

  const placeholderValue = computed(() => {
    if (props.label) {
      return props.placeholder || " ";
    }

    return props.placeholder;
  });

  const inputClasses = computed(() => {
    const base =
      "peer block w-full rounded-md border px-3 pt-5 pb-2 text-base transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60 focus-visible:border-primary shadow-xs placeholder:text-transparent disabled:cursor-not-allowed disabled:opacity-65 md:text-sm";

    const theme = props.variant === "outlined"
      ? "bg-transparent border-border text-foreground dark:border-white/15 dark:text-white"
      : "bg-muted/50 border-transparent text-foreground shadow-inner focus:bg-background dark:bg-white/5 dark:focus:bg-white/10";

    const invalid = props.invalid
      ? "border-destructive text-destructive placeholder:text-destructive/70 focus-visible:border-destructive focus-visible:ring-destructive/60"
      : "border-input";

    const disabled = props.disabled ? "bg-muted/60 dark:bg-white/5" : "";

    return cn(base, theme, invalid, disabled);
  });

  const labelClasses = computed(() =>
    cn(
      "pointer-events-none absolute left-3 select-none text-sm text-muted-foreground transition-all duration-150",
      props.variant === "outlined" && floatLabel.value ? "bg-background px-1 dark:bg-gray-950" : "",
      props.invalid ? "text-destructive" : "",
      props.disabled ? "text-muted-foreground/70" : "",
      floatLabel.value ? "top-1.5 text-xs" : "top-1/2 -translate-y-1/2",
    ),
  );
</script>

<template>
  <label class="relative block" :class="props.class">
    <input
      v-model="modelValue"
      v-bind="$attrs"
      data-slot="input"
      :type="props.type"
      :placeholder="placeholderValue"
      :disabled="props.disabled"
      :aria-invalid="props.invalid || undefined"
      :aria-disabled="props.disabled || undefined"
      :class="inputClasses"
      @focus="(event) => { isFocused.value = true; emit('focus', event); }"
      @blur="(event) => { isFocused.value = false; emit('blur', event); }"
    />

    <span v-if="props.label" :class="labelClasses">{{ props.label }}</span>

    <p v-if="$slots.supportingText" class="mt-1 text-xs text-muted-foreground" :class="props.invalid ? 'text-destructive' : ''">
      <slot name="supportingText" />
    </p>
  </label>
</template>
