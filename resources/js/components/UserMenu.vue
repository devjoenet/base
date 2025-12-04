<script setup lang="ts">
import { Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { ChevronDownIcon, Cog6ToothIcon, PowerIcon } from "@heroicons/vue/24/outline";
import { UserCircleIcon } from "@heroicons/vue/24/solid";
import { Link, router } from "@inertiajs/vue3";
import { computed } from "vue";

import { logout } from "@/routes";
import { edit as editProfile } from "@/routes/profile";
import type { User } from "@/types";

const props = defineProps<{
  user: User;
}>();

const initials = computed(() => {
  const parts = props.user.name.split(" ").filter(Boolean);
  return parts.length >= 2 ? `${parts[0][0]}${parts[1][0]}`.toUpperCase() : props.user.name.slice(0, 2).toUpperCase();
});

const handleLogout = () => {
  router.post(logout().url);
};
</script>

<template>
  <Menu as="div" class="relative inline-block text-left">
    <MenuButton class="group flex items-center gap-3 rounded-full px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-200 transition hover:bg-gray-50 hover:text-gray-950 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 dark:text-white dark:ring-white/10 dark:hover:bg-white/5">
      <span class="relative inline-flex size-9 items-center justify-center overflow-hidden rounded-full bg-gradient-to-br from-indigo-500 to-sky-500 text-sm font-semibold uppercase text-white ring-2 ring-white dark:ring-gray-900">
        <img
          v-if="props.user.avatar"
          :src="props.user.avatar"
          alt=""
          class="absolute inset-0 size-full object-cover"
        />
        <span v-else class="text-base" aria-hidden="true">{{ initials }}</span>
        <UserCircleIcon v-if="!props.user.avatar" class="pointer-events-none absolute inset-0 size-full text-white/80" aria-hidden="true" />
      </span>
      <div class="hidden text-left leading-tight sm:block">
        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ props.user.name }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ props.user.email }}</p>
      </div>
      <ChevronDownIcon class="size-4 text-gray-500 transition group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-200" aria-hidden="true" />
    </MenuButton>

    <TransitionRoot as="template" appear>
      <TransitionChild
        as="template"
        enter="transition ease-out duration-150"
        enter-from="opacity-0 translate-y-1"
        enter-to="opacity-100 translate-y-0"
        leave="transition ease-in duration-100"
        leave-from="opacity-100 translate-y-0"
        leave-to="opacity-0 translate-y-1"
      >
        <MenuItems class="absolute right-0 mt-2 w-56 origin-top-right overflow-hidden rounded-2xl bg-white p-1 text-sm shadow-lg ring-1 ring-black/5 focus:outline-none dark:bg-gray-900 dark:ring-white/10">
          <div class="border-b border-gray-100 px-3 py-2 text-left text-xs font-semibold uppercase text-gray-500 dark:border-white/5 dark:text-gray-400">
            Signed in as
            <p class="truncate text-[13px] font-semibold text-gray-900 dark:text-white">{{ props.user.email }}</p>
          </div>
          <div class="py-1">
            <MenuItem v-slot="{ close }">
              <Link
                :href="editProfile().url"
                class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-white/5"
                @click="close"
              >
                <Cog6ToothIcon class="size-4" aria-hidden="true" />
                Profile & Settings
              </Link>
            </MenuItem>
            <MenuItem>
              <button
                type="button"
                class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-left text-rose-600 hover:bg-rose-50 hover:text-rose-700 dark:text-rose-400 dark:hover:bg-rose-500/10"
                @click="handleLogout"
              >
                <PowerIcon class="size-4" aria-hidden="true" />
                Sign out
              </button>
            </MenuItem>
          </div>
        </MenuItems>
      </TransitionChild>
    </TransitionRoot>
  </Menu>
</template>
