<script setup lang="ts">
  import type { InputHTMLAttributes, HTMLAttributes } from "vue";
  import { computed, useId, useSlots } from "vue";
  import { reactiveOmit, useVModel } from "@vueuse/core";
  import { cn } from "@/lib/utils";
  import type { InputVariants } from ".";
  import { inputFieldVariants } from ".";

  const props = withDefaults(
    defineProps<{
      id?: string;
      type?: InputHTMLAttributes["type"];
      defaultValue?: string | number;
      modelValue?: string | number;
      label?: string;
      placeholder?: string;
      helper?: string;
      error?: string;
      variant?: InputVariants["variant"];
      disabled?: boolean;
      class?: HTMLAttributes["class"];
      inputClass?: HTMLAttributes["class"];
      controlClass?: HTMLAttributes["class"];
    }>(),
    {
      type: "text",
      variant: "filled",
      disabled: false,
    },
  );

  const emits = defineEmits<{
    (e: "update:modelValue", payload: string | number): void;
  }>();

  const modelValue = useVModel(props, "modelValue", emits, {
    passive: true,
    defaultValue: props.defaultValue,
  });

  const slots = useSlots();
  const inputId = computed(() => props.id ?? `input-${useId()}`);
  const hasMessageContent = computed(() => Boolean(props.error || props.helper || slots.message || slots.helper || slots.error));
  const messageId = computed(() => (hasMessageContent.value ? `${inputId.value}-assistive` : undefined));
  const delegatedProps = reactiveOmit(props, "class", "inputClass", "label", "helper", "error", "variant", "disabled", "controlClass", "defaultValue", "modelValue", "id");
</script>

<template>
  <div data-slot="input-field" :class="cn('group/input flex w-full flex-col gap-1.5', props.class)">
    <div data-slot="control" :class="cn(inputFieldVariants({ variant, invalid: Boolean(error), disabled }), 'shadow-xs px-3 py-2', props.controlClass)">
      <span v-if="$slots.leading" class="text-muted-foreground [&>svg]:size-5 [&>svg]:shrink-0">
        <slot name="leading" />
      </span>

      <div class="relative flex-1">
        <input
          v-model="modelValue"
          :id="inputId"
          :disabled="disabled"
          :aria-invalid="error ? 'true' : undefined"
          :aria-errormessage="error && messageId ? messageId : undefined"
          :aria-describedby="messageId"
          data-slot="input"
          :class="
            cn(
              'peer block w-full border-0 bg-transparent px-0 pt-4 pb-1 text-base text-foreground caret-[oklch(0.63_0.18_270)] placeholder:text-muted-foreground focus-visible:outline-none disabled:cursor-not-allowed disabled:text-muted-foreground dark:caret-[oklch(0.72_0.15_260)]',
              props.inputClass,
            )
          "
          v-bind="delegatedProps"
        />

        <label
          v-if="label"
          :for="inputId"
          class="pointer-events-none absolute inset-x-0 top-2 origin-top-left truncate text-sm text-muted-foreground transition-all duration-200 ease-out peer-focus-visible:-translate-y-3 peer-focus-visible:text-xs peer-focus-visible:text-primary peer-not-placeholder-shown:-translate-y-3 peer-not-placeholder-shown:text-xs peer-disabled:text-muted-foreground/70"
        >
          {{ label }}
        </label>
      </div>

      <span v-if="$slots.trailing" class="text-muted-foreground [&>svg]:size-5 [&>svg]:shrink-0">
        <slot name="trailing" />
      </span>
    </div>

    <p v-if="hasMessageContent" :id="messageId" :class="cn('min-h-5 text-sm leading-snug text-muted-foreground', error ? 'text-destructive' : null)">
      <slot name="message" :error="error" :helper="helper">
        <slot name="error" :error="error" :helper="helper">
          <slot name="helper" :error="error" :helper="helper">
            {{ error ?? helper }}
          </slot>
        </slot>
      </slot>
    </p>
  </div>
</template>
