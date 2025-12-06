<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { ListboxButton } from "@headlessui/vue";
  import { ChevronDownIcon } from "@heroicons/vue/16/solid";
  import { computed, type HTMLAttributes } from "vue";
  import { selectLabelVariants, selectTriggerVariants } from "@/components/ui/select/variants";

  const props = withDefaults(
    defineProps<{
      class?: HTMLAttributes["class"];
      variant?: "filled" | "outlined";
      invalid?: boolean;
      label?: string;
      hasValue?: boolean;
    }>(),
    {
      variant: "filled",
      invalid: false,
      hasValue: false,
    },
  );

  const labelClasses = computed(() =>
    cn(
      selectLabelVariants({
        float: props.hasValue,
        invalid: props.invalid,
      }),
      props.variant === "outlined" && props.hasValue ? "bg-background px-1 dark:bg-gray-950" : "",
    ),
  );
</script>

<template>
  <div class="relative">
    <ListboxButton :class="cn(selectTriggerVariants({ variant: props.variant, invalid: props.invalid }), props.class)">
      <span class="block truncate">
        <slot />
      </span>
      <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
        <ChevronDownIcon class="size-4 text-gray-500/70" aria-hidden="true" />
      </span>
    </ListboxButton>
    <span v-if="props.label" :class="labelClasses">{{ props.label }}</span>
  </div>
</template>
