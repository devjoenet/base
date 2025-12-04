<script setup lang="ts">
import FlashBanner from "@/components/FlashBanner.vue";
import SideNav from "@/components/SideNav.vue";
import TopNav from "@/components/TopNav.vue";
import { dashboard } from "@/routes";
import type { AppPageProps, NavItem } from "@/types";
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { computed, ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";

type FlashPayload = Partial<Record<"success" | "error" | "status" | "message" | "warning", string>>;

const page = usePage<AppPageProps>();
const sidebarOpen = ref(page.props.sidebarOpen ?? true);

watch(
  () => page.props.sidebarOpen,
  (value) => {
    if (typeof value === "boolean") {
      sidebarOpen.value = value;
    }
  },
);

const brand = computed(() => page.props.name);
const flash = computed<FlashPayload | undefined>(() => page.props.flash as FlashPayload | undefined);
const navigation = computed<NavItem[]>(() => {
  const current = page.url;
  const dashboardLink = dashboard().url;

  return [
    { title: "Dashboard", href: dashboardLink, isActive: current.startsWith(dashboardLink) },
  ];
});
</script>

<template>
  <div class="min-h-screen bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50">
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog class="relative z-50 lg:hidden" @close="sidebarOpen = false">
        <TransitionChild
          as="template"
          enter="transition-opacity ease-linear duration-150"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="transition-opacity ease-linear duration-150"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black/50" />
        </TransitionChild>

        <div class="fixed inset-0 flex">
          <TransitionChild
            as="template"
            enter="transition ease-in-out duration-200 transform"
            enter-from="-translate-x-full"
            enter-to="translate-x-0"
            leave="transition ease-in-out duration-200 transform"
            leave-from="translate-x-0"
            leave-to="-translate-x-full"
          >
            <DialogPanel class="relative mr-10 flex w-full max-w-72 flex-1">
              <SideNav
                :brand="brand"
                :brand-href="dashboard().url"
                :mobile="true"
                :nav-items="navigation"
                :user="page.props.auth.user"
                class="w-full"
                @close="sidebarOpen = false"
              />
            </DialogPanel>
          </TransitionChild>
        </div>
      </Dialog>
    </TransitionRoot>

    <TopNav
      class="lg:pl-72"
      :brand="brand"
      :brand-href="dashboard().url"
      :user="page.props.auth.user"
      @open-sidebar="sidebarOpen = true"
    >
      <template #actions>
        <slot name="header-actions" />
      </template>
    </TopNav>

    <div class="flex">
      <aside
        class="hidden lg:fixed lg:inset-y-0 lg:z-40 lg:flex lg:w-72 lg:flex-col lg:border-r lg:border-white/10 lg:bg-gray-950 lg:pt-2"
        aria-label="Primary navigation"
      >
        <SideNav :brand="brand" :brand-href="dashboard().url" :nav-items="navigation" :user="page.props.auth.user" />
      </aside>

      <div class="flex w-full flex-col lg:pl-72">
        <div class="px-4 pb-2 pt-4 sm:px-6 lg:px-8">
          <FlashBanner :flash="flash" />
        </div>

        <main class="flex-1 px-4 pb-10 sm:px-6 lg:px-8">
          <slot />
        </main>
      </div>
    </div>
  </div>
</template>
