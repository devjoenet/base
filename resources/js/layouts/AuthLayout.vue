<script setup lang="ts">
  import FlashBanner from "@/components/FlashBanner.vue";
  import TopNav from "@/components/TopNav.vue";
  import type { AppPageProps } from "@/types";
  import { computed } from "vue";
  import { usePage } from "@inertiajs/vue3";

  type FlashPayload = Partial<Record<"success" | "error" | "status" | "message" | "warning", string>>;

  const page = usePage<AppPageProps>();
  const brand = computed(() => page.props.name);
  const flash = computed<FlashPayload | undefined>(() => page.props.flash as FlashPayload | undefined);
</script>

<template>
  <div class="min-h-screen bg-linear-to-b from-gray-50 to-white text-gray-900 dark:from-gray-900 dark:via-gray-950 dark:to-black">
    <TopNav :brand="brand" brand-href="/" :show-menu-button="false">
      <template #actions>
        <slot name="header-actions" />
      </template>
    </TopNav>

    <div class="mx-auto w-full max-w-4xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
      <FlashBanner :flash="flash" />

      <main class="mt-6 rounded-2xl border border-gray-200 bg-white/80 p-6 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/80 sm:p-8">
        <slot />
      </main>
    </div>
  </div>
</template>
