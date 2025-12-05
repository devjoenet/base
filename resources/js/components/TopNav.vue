<script setup lang="ts">
  import { Bars3Icon } from "@heroicons/vue/24/outline";
  import { Link } from "@inertiajs/vue3";

  import UserMenu from "./UserMenu.vue";
  import type { User } from "@/types";

  const props = withDefaults(
    defineProps<{
      brand: string;
      user?: User;
      brandHref?: string;
      showMenuButton?: boolean;
    }>(),
    {
      showMenuButton: true,
    },
  );

  const emit = defineEmits<{
    (e: "openSidebar"): void;
  }>();
</script>

<template>
  <header class="sticky top-0 z-40 border-b border-gray-200 bg-white/85 backdrop-blur transition dark:border-white/10 dark:bg-gray-950/80">
    <div class="flex h-16 items-center gap-4 px-4 sm:px-6 lg:px-8">
      <button
        v-if="props.showMenuButton"
        type="button"
        class="-m-2.5 inline-flex size-10 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 dark:text-gray-300 dark:hover:bg-white/5 lg:hidden"
        @click="emit('openSidebar')"
      >
        <span class="sr-only">Open navigation</span>
        <Bars3Icon class="size-6" aria-hidden="true" />
      </button>

      <Link :href="props.brandHref ?? '/'" class="text-base font-semibold text-gray-900 hover:text-indigo-600 dark:text-white dark:hover:text-indigo-300">
        {{ props.brand }}
      </Link>

      <div class="ml-auto flex items-center gap-3">
        <slot name="actions" />
        <UserMenu v-if="props.user" :user="props.user" />
      </div>
    </div>
  </header>
</template>
