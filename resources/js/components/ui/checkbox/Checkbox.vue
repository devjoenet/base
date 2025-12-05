<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { ref, type HTMLAttributes } from "vue";

  const props = withDefaults(
    defineProps<{
      modelValue?: boolean;
      id?: string;
      name?: string;
      value?: string;
      required?: boolean;
      disabled?: boolean;
      invalid?: boolean;
      ariaLabel?: string;
      ariaLabelledby?: string;
      ariaDescribedby?: string;
      class?: HTMLAttributes["class"];
    }>(),
    {
      modelValue: false,
      required: false,
      disabled: false,
      invalid: false,
    },
  );

  const emit = defineEmits<{
    (e: "update:modelValue", value: boolean): void;
    (e: "change", value: boolean, event: Event): void;
    (e: "focus", event: FocusEvent): void;
    (e: "blur", event: FocusEvent): void;
  }>();

  const isFocused = ref(false);

  const handleChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    emit("update:modelValue", target.checked);
    emit("change", target.checked, event);
  };

  const handleFocus = (event: FocusEvent) => {
    isFocused.value = true;
    emit("focus", event);
  };

  const handleBlur = (event: FocusEvent) => {
    isFocused.value = false;
    emit("blur", event);
  };
</script>

<template>
  <label
    :for="props.id"
    :class="
      cn(
        'group inline-flex items-start gap-3 text-sm font-medium text-gray-900 dark:text-gray-100',
        props.disabled ? 'cursor-not-allowed opacity-75' : 'cursor-pointer',
        props.class,
      )
    "
    :data-focused="isFocused ? '' : undefined"
    :data-invalid="props.invalid ? '' : undefined"
  >
    <span class="relative flex h-5 w-5 items-center justify-center">
      <input
        :id="props.id"
        :name="props.name"
        :value="props.value"
        type="checkbox"
        :checked="props.modelValue"
        :required="props.required"
        :disabled="props.disabled"
        :aria-label="props.ariaLabel"
        :aria-labelledby="props.ariaLabelledby"
        :aria-describedby="props.ariaDescribedby"
        :aria-invalid="props.invalid || undefined"
        class="
          peer size-5 shrink-0 appearance-none rounded-[6px] border border-gray-300 bg-white text-white shadow-[0_1px_0_rgba(0,0,0,0.08)]
          ring-1 ring-inset ring-gray-200 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500
          focus-visible:ring-offset-2 focus-visible:ring-offset-white checked:border-indigo-600 checked:bg-indigo-600 checked:ring-indigo-500/60
          aria-invalid:border-red-500 aria-invalid:ring-red-500/40 aria-invalid:focus-visible:ring-red-500 aria-invalid:checked:bg-red-600
          disabled:cursor-not-allowed disabled:opacity-60 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-50 dark:ring-gray-800
          dark:focus-visible:ring-offset-gray-950 dark:checked:border-indigo-400 dark:checked:bg-indigo-500
          dark:aria-invalid:border-red-500 dark:aria-invalid:ring-red-500/40 dark:aria-invalid:focus-visible:ring-red-500
        "
        @change="handleChange"
        @focus="handleFocus"
        @blur="handleBlur"
      />
      <span
        class="
          pointer-events-none absolute inset-0 flex items-center justify-center text-white opacity-0 transition-opacity duration-150
          peer-checked:opacity-100
        "
        aria-hidden="true"
      >
        <svg class="size-3.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M5 10.5 8.5 14 15 7.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </span>
    </span>

    <span v-if="$slots.default" class="leading-5 text-gray-700 dark:text-gray-300">
      <slot />
    </span>
  </label>
</template>
