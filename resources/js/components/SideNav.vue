<script setup lang="ts">
  import { XMarkIcon } from "@heroicons/vue/24/outline";
  import { Link, usePage } from "@inertiajs/vue3";
  import { computed } from "vue";

  import type { AppPageProps, NavItem, User } from "@/types";

  const props = defineProps<{
    brand: string;
    navItems: NavItem[];
    user?: User;
    mobile?: boolean;
    brandHref?: string;
  }>();

  const emit = defineEmits<{
    (e: "close"): void;
  }>();

  const page = usePage<AppPageProps>();
  const currentUrl = computed(() => page.url);

  const resolveClass = (item: NavItem) => {
    const active = item.isActive ?? currentUrl.value.startsWith(item.href.toString());
    return active ? "bg-white/10 text-white" : "text-gray-200 hover:bg-white/10 hover:text-white";
  };
</script>

<template>
  <div class="flex grow flex-col gap-y-4 bg-gray-950 px-4 pb-6 pt-5 text-white dark:bg-gray-950">
    <div class="flex items-center gap-3 px-2">
      <Link :href="props.brandHref ?? '/'" class="text-lg font-semibold tracking-tight text-white">
        {{ props.brand }}
      </Link>
      <button v-if="props.mobile" type="button" class="ml-auto inline-flex size-9 items-center justify-center rounded-lg text-gray-300 hover:bg-white/5 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400" @click="emit('close')">
        <span class="sr-only">Close navigation</span>
        <XMarkIcon class="size-5" aria-hidden="true" />
      </button>
    </div>

    <nav class="flex-1">
      <ul class="space-y-1">
        <li v-for="item in props.navItems" :key="item.title">
          <Link :href="item.href" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400" :class="resolveClass(item)">
            <span class="truncate">{{ item.title }}</span>
          </Link>
        </li>
      </ul>
    </nav>

    <div v-if="props.user" class="mt-auto rounded-xl bg-white/5 px-3 py-3 text-sm ring-1 ring-inset ring-white/10">
      <p class="font-semibold text-white">{{ props.user.name }}</p>
      <p class="text-xs text-gray-300">{{ props.user.email }}</p>
    </div>
  </div>
</template>
