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
      placeholder: " ",
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
    <label :class="cn('floating-label w-full', props.controlClass)">
      <input
        v-model="modelValue"
        :id="inputId"
        :type="type"
        :disabled="disabled"
        :placeholder="placeholder"
        :aria-invalid="error ? 'true' : undefined"
        :aria-errormessage="error && messageId ? messageId : undefined"
        :aria-describedby="messageId"
        data-slot="input"
        :class="cn(inputFieldVariants({ variant, invalid: Boolean(error), disabled }), props.inputClass)"
        v-bind="delegatedProps"
      />
      <span v-if="label">{{ label }}</span>

      <div v-if="$slots.leading" class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground [&>svg]:size-5 [&>svg]:shrink-0">
        <slot name="leading" />
      </div>

      <div v-if="$slots.trailing" class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground [&>svg]:size-5 [&>svg]:shrink-0">
        <slot name="trailing" />
      </div>
    </label>

    <p v-if="hasMessageContent" :id="messageId" :class="cn('min-h-5 text-sm leading-snug text-muted-foreground', error ? 'text-error' : null)">
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
