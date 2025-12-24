<script setup lang="ts">
  import type { CheckboxRootEmits, CheckboxRootProps } from "reka-ui";
  import type { HTMLAttributes } from "vue";
  import { reactiveOmit } from "@vueuse/core";
  import { Check } from "lucide-vue-next";
  import { CheckboxIndicator, CheckboxRoot, useForwardPropsEmits } from "reka-ui";
  import { cn } from "@/lib/utils";

  const props = defineProps<CheckboxRootProps & { class?: HTMLAttributes["class"] }>();
  const emits = defineEmits<CheckboxRootEmits>();

  const delegatedProps = reactiveOmit(props, "class");

  const forwarded = useForwardPropsEmits(delegatedProps, emits);
</script>

<template>
  <CheckboxRoot
    v-slot="slotProps"
    data-slot="checkbox"
    v-bind="forwarded"
    :class="cn('peer checkbox checkbox-primary size-5 shrink-0 transition-shadow outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-50', props.class)"
  >
    <CheckboxIndicator data-slot="checkbox-indicator" class="flex items-center justify-center text-current">
      <slot v-bind="slotProps">
        <Check class="size-4" stroke-width="3" />
      </slot>
    </CheckboxIndicator>
  </CheckboxRoot>
</template>
