<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { useVModel } from "@vueuse/core";
  import { inputVariants, labelVariants } from "./variants";
  import { computed, ref, useAttrs, type HTMLAttributes, type InputTypeHTMLAttribute, type Ref } from "vue";

  defineOptions({
    inheritAttrs: false,
  });

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

  const attrs = useAttrs();
  const { class: labelClass, ...inputAttrs } = attrs;

  const isFocused: Ref<boolean> = ref(false);

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

  const inputClasses = computed(() => inputVariants({ variant: props.variant, invalid: props.invalid, disabled: props.disabled }));

  const labelClasses = computed(() =>
    cn(
      labelVariants({
        invalid: props.invalid,
        disabled: props.disabled,
        float: floatLabel.value,
      }),
      props.variant === "outlined" && floatLabel.value ? "bg-background px-1 dark:bg-gray-950" : "",
    ),
  );
</script>

<template>
  <label class="relative block" :class="labelClass">
    <input
      v-model="modelValue"
      v-bind="inputAttrs"
      data-slot="input"
      :type="props.type"
      :placeholder="placeholderValue"
      :disabled="props.disabled"
      :aria-invalid="props.invalid || undefined"
      :aria-disabled="props.disabled || undefined"
      :class="inputClasses"
      @focus="
        (event) => {
          isFocused = true;
          emit('focus', event);
        }
      "
      @blur="
        (event) => {
          isFocused = false;
          emit('blur', event);
        }
      "
    />

    <span v-if="props.label" :class="labelClasses">{{ props.label }}</span>

    <p v-if="$slots.supportingText" class="mt-1 text-xs text-muted-foreground" :class="props.invalid ? 'text-destructive' : ''">
      <slot name="supportingText" />
    </p>
  </label>
</template>
