<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { ListboxOptions } from "@headlessui/vue";
  import type { HTMLAttributes } from "vue";

  const props = defineProps<{
    class?: HTMLAttributes["class"];
  }>();
</script>

<template>
  <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0" enter-active-class="transition duration-200 ease-out" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0">
    <ListboxOptions :class="cn('absolute z-50 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none dark:bg-gray-900 dark:ring-white/10 sm:text-sm', props.class)">
      <slot />
    </ListboxOptions>
  </transition>
</template>
