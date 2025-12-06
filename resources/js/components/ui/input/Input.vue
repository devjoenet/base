<script setup lang="ts">
  import { computed, useId } from "vue";
  import { useDensity } from "@/composables/useDensity";
  import type { Density } from "@/composables/useDensity";

  defineOptions({
    inheritAttrs: false,
  });

  const props = withDefaults(
    defineProps<{
      id?: string;
      label?: string;
      type?: string;
      error?: string;
      help?: string;
      density?: Density;
    }>(),
    {
      type: "text",
      density: "normal",
    },
  );

  // Vue 3.4+ defineModel is the cleanest way to handle v-model
  const model = defineModel<string | number>();

  // If no ID is provided, generate a unique one for accessibility
  const inputId = computed(() => props.id || `input-${useId()}`);

  // Hook into our density system
  const { densityClass, iconSizeClass } = useDensity(props);

  // Base styles ensuring we match the "Teal/Charcoal" vibe
  // Tailwind v4 note: We are using specific border colors that adapt to light/dark
  const baseStyles = computed(() => {
    const errorState = props.error
      ? "border-red-500 focus:border-red-500 focus:ring-red-500/20 text-red-900 dark:text-red-100 placeholder:text-red-300"
      : "border-zinc-300 dark:border-zinc-700 hover:border-zinc-400 dark:hover:border-zinc-600 focus:border-teal-500 dark:focus:border-teal-400 focus:ring-teal-500/20 dark:focus:ring-teal-400/20 text-zinc-900 dark:text-zinc-100 placeholder:text-zinc-400 dark:placeholder:text-zinc-500";

    return [
      "block w-full rounded-lg border bg-white dark:bg-zinc-900",
      "shadow-sm transition-all duration-200 ease-in-out",
      "focus:outline-none focus:ring-4",
      "disabled:cursor-not-allowed disabled:bg-zinc-50 dark:disabled:bg-zinc-800 disabled:text-zinc-500",
      densityClass.value,
      errorState,
    ];
  });
</script>

<template>
  <div class="w-full space-y-1.5">
    <!-- Label -->
    <label v-if="label" :for="inputId" class="block text-sm font-medium leading-none text-zinc-700 dark:text-zinc-300" :class="{ 'text-red-600 dark:text-red-400': error }">
      {{ label }}
      <span v-if="$attrs.required" class="text-teal-600 dark:text-teal-400 ml-0.5">*</span>
    </label>

    <!-- Input Wrapper (Relative for Icons) -->
    <div class="relative group">
      <!-- Leading Icon/Content -->
      <div v-if="$slots.leading" class="absolute inset-y-0 left-0 flex items-center pl-3 text-zinc-500 pointer-events-none" :class="iconSizeClass">
        <slot name="leading" />
      </div>

      <input :id="inputId" ref="inputRef" v-model="model" :type="type" :class="[baseStyles, $slots.leading ? 'pl-10' : '', $slots.trailing ? 'pr-10' : '']" :aria-invalid="!!error" :aria-describedby="error ? `${inputId}-error` : help ? `${inputId}-help` : undefined" v-bind="$attrs" />

      <!-- Trailing Icon/Content -->
      <div v-if="$slots.trailing" class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-500 cursor-pointer hover:text-zinc-700 dark:hover:text-zinc-300" :class="iconSizeClass">
        <slot name="trailing" />
      </div>
    </div>

    <!-- Hint Text -->
    <p v-if="help && !error" :id="`${inputId}-help`" class="text-xs text-zinc-500 dark:text-zinc-400 transition-opacity">
      {{ help }}
    </p>

    <!-- Error Message -->
    <p v-if="error" :id="`${inputId}-error`" class="text-sm font-medium text-red-600 dark:text-red-400 animate-in slide-in-from-top-1 fade-in duration-200">
      {{ error }}
    </p>
  </div>
</template>
