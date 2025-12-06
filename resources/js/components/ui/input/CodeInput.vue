<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { useVModel } from "@vueuse/core";
  import { computed, ref, watch } from "vue";

  const props = withDefaults(
    defineProps<{
      modelValue?: string;
      length?: number;
      disabled?: boolean;
      invalid?: boolean;
      ariaLabel?: string;
    }>(),
    {
      modelValue: "",
      length: 6,
      disabled: false,
      invalid: false,
      ariaLabel: "Verification code",
    },
  );

  const emit = defineEmits<{
    (e: "update:modelValue", value: string): void;
    (e: "complete", value: string): void;
  }>();

  const modelValue = useVModel(props, "modelValue", emit, {
    passive: true,
    defaultValue: props.modelValue ?? "",
  });

  const normalizedLength = computed(() => Math.max(1, props.length));
  const inputRefs = ref<(HTMLInputElement | null)[]>([]);
  const digits = ref<string[]>(Array(normalizedLength.value).fill(""));

  const fieldClasses = computed(() =>
    cn(
      "block h-12 w-12 rounded-md bg-white text-center text-lg text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:h-11 sm:w-11 sm:text-sm/6 dark:bg-gray-800/50 dark:text-white dark:outline-gray-700 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-400 dark:disabled:bg-gray-900/50 dark:disabled:text-gray-500",
      props.invalid && "outline-destructive text-destructive focus:outline-destructive focus:ring-destructive/60 dark:outline-red-500 dark:focus:outline-red-500",
    ),
  );

  const syncFromModel = (value: string) => {
    const sanitized = (value ?? "").replace(/\D/g, "").slice(0, normalizedLength.value);
    const nextDigits = sanitized.split("");
    digits.value = Array.from({ length: normalizedLength.value }, (_, i) => nextDigits[i] || "");
  };

  const updateModel = () => {
    const value = digits.value.join("");
    modelValue.value = value;

    if (value.length === normalizedLength.value) {
      emit("complete", value);
    }
  };

  const focusInput = (index: number) => {
    const el = inputRefs.value[index];

    if (!el) return;

    el.focus();
    el.select();
  };

  const handleInput = (index: number, event: Event) => {
    const target = event.target as HTMLInputElement;
    const sanitized = target.value.replace(/\D/g, "");

    if (!sanitized) {
      digits.value[index] = "";
      updateModel();
      return;
    }

    const available = normalizedLength.value - index;
    const chars = sanitized.slice(0, available).split("");

    chars.forEach((char, offset) => {
      digits.value[index + offset] = char;
    });

    updateModel();

    const nextIndex = index + chars.length;

    if (nextIndex < normalizedLength.value) {
      focusInput(nextIndex);
    }
  };

  const handlePaste = (index: number, event: ClipboardEvent) => {
    event.preventDefault();

    const text = event.clipboardData?.getData("text") ?? "";
    const sanitized = text.replace(/\D/g, "");

    if (!sanitized) return;

    const available = normalizedLength.value - index;
    const chars = sanitized.slice(0, available).split("");

    chars.forEach((char, offset) => {
      digits.value[index + offset] = char;
    });

    updateModel();

    const nextIndex = Math.min(index + chars.length, normalizedLength.value - 1);
    focusInput(nextIndex);
  };

  const handleKeydown = (index: number, event: KeyboardEvent) => {
    if (event.key === "ArrowLeft") {
      event.preventDefault();
      if (index > 0) focusInput(index - 1);
      return;
    }

    if (event.key === "ArrowRight") {
      event.preventDefault();
      if (index < normalizedLength.value - 1) focusInput(index + 1);
      return;
    }

    if (event.key !== "Backspace") return;

    event.preventDefault();

    if (digits.value[index]) {
      digits.value[index] = "";
      updateModel();
      return;
    }

    if (index === 0) return;

    digits.value[index - 1] = "";
    focusInput(index - 1);
    updateModel();
  };

  watch(
    () => props.length,
    () => {
      digits.value = Array(normalizedLength.value).fill("");
      syncFromModel(modelValue.value ?? "");
    },
  );

  watch(
    () => modelValue.value,
    (value) => syncFromModel(value ?? ""),
    { immediate: true },
  );
</script>

<template>
  <div class="flex flex-col gap-2" role="group" :aria-label="props.ariaLabel" :aria-invalid="props.invalid || undefined">
    <div class="flex items-center justify-center gap-2 sm:gap-3">
      <input
        v-for="(_, index) in normalizedLength"
        :key="index"
        :ref="(el) => (inputRefs[index] = el as HTMLInputElement | null)"
        :value="digits[index]"
        type="text"
        inputmode="numeric"
        autocomplete="one-time-code"
        enterkeyhint="next"
        pattern="[0-9]*"
        :maxlength="1"
        :disabled="props.disabled"
        :aria-invalid="props.invalid || undefined"
        :aria-disabled="props.disabled || undefined"
        :aria-label="`Digit ${index + 1} of ${normalizedLength}`"
        :class="fieldClasses"
        @input="(event) => handleInput(index, event)"
        @keydown="(event) => handleKeydown(index, event)"
        @paste="(event) => handlePaste(index, event)"
      />
    </div>
  </div>
</template>
