<script setup lang="ts">
  import type { HTMLAttributes, SelectHTMLAttributes } from "vue";
  import { computed, useId, useSlots } from "vue";
  import { useVModel, reactiveOmit } from "@vueuse/core";
  import { cn } from "@/lib/utils";
  import { inputFieldVariants } from "@/components/ui/input";

  const props = withDefaults(
    defineProps<{
      id?: string;
      modelValue?: string | number;
      defaultValue?: string | number;
      label?: string;
      placeholder?: string;
      helper?: string;
      error?: string;
      variant?: "filled" | "outlined";
      disabled?: boolean;
      class?: HTMLAttributes["class"];
      selectClass?: HTMLAttributes["class"];
      controlClass?: HTMLAttributes["class"];
    }>(),
    {
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
  const selectId = computed(() => props.id ?? `select-${useId()}`);
  const hasMessageContent = computed(() => Boolean(props.error || props.helper || slots.message || slots.helper || slots.error));
  const messageId = computed(() => (hasMessageContent.value ? `${selectId.value}-assistive` : undefined));
  const delegatedProps = reactiveOmit(props, "class", "selectClass", "label", "helper", "error", "variant", "disabled", "controlClass", "defaultValue", "modelValue", "id");
</script>

<template>
  <div data-slot="select-field" :class="cn('group/select flex w-full flex-col gap-1.5', props.class)">
    <div data-slot="control" :class="cn(inputFieldVariants({ variant, invalid: Boolean(error), disabled }), 'shadow-xs px-3 py-2', props.controlClass)">
      <div class="relative flex-1">
        <select
          v-model="modelValue"
          :id="selectId"
          :disabled="disabled"
          :aria-invalid="error ? 'true' : undefined"
          :aria-errormessage="error && messageId ? messageId : undefined"
          :aria-describedby="messageId"
          data-slot="select"
          :class="cn('peer block w-full appearance-none border-0 bg-transparent px-0 pt-4 pb-1 text-base text-foreground focus-visible:outline-none disabled:cursor-not-allowed disabled:text-muted-foreground', props.selectClass)"
          v-bind="delegatedProps as unknown as SelectHTMLAttributes"
        >
          <slot>
            <option v-if="placeholder" disabled value="">{{ placeholder }}</option>
          </slot>
        </select>

        <label
          v-if="label"
          :for="selectId"
          class="pointer-events-none absolute inset-x-0 top-2 origin-top-left truncate text-sm text-muted-foreground transition-all duration-200 ease-out peer-focus-visible:-translate-y-3 peer-focus-visible:text-xs peer-focus-visible:text-primary peer-not-[:has(option:checked[value=''])]:-translate-y-3 peer-not-[:has(option:checked[value=''])]:text-xs peer-disabled:text-muted-foreground/70"
        >
          {{ label }}
        </label>
      </div>
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
