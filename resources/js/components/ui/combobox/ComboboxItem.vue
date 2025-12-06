<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { ComboboxOption } from "@headlessui/vue";
  import { CheckIcon } from "@heroicons/vue/20/solid";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    value: any;
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <ComboboxOption v-slot="{ active, selected }" :value="props.value" as="template">
    <li :class="cn('relative cursor-default select-none py-2 pl-10 pr-4', active ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-foreground' : 'text-gray-900 dark:text-gray-100', props.class)">
      <span :class="cn('block truncate', selected ? 'font-medium' : 'font-normal')">
        <slot />
      </span>
      <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary">
        <CheckIcon class="size-4" aria-hidden="true" />
      </span>
    </li>
  </ComboboxOption>
</template>
