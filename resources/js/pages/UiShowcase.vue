<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { type BreadcrumbItem } from "@/types";
  import { Head } from "@inertiajs/vue3";
  import { Button } from "../components/ui/button";
  import Heading from "../components/Heading.vue";

  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: "UI Showcase",
      href: "/showcase",
    },
  ];

  const buttonVariants = ["default", "secondary", "outline", "destructive", "ghost", "link"] as const;
</script>

<template>
  <Head title="UI Showcase" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
      <div class="grid w-full auto-rows-min gap-4 md:grid-cols-3">
        <div class="relative flex-1 p-6 w-full h-full overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
          <Heading class="mb-6" title="Button Variants" description="Button variants available in the UI." />
          <div class="space-y-0.5 flex items-center justify-center">
            <Button class="m-4" v-for="(buttonVariant, index) in buttonVariants" :key="index" :variant="buttonVariant">
              {{ buttonVariant.charAt(0).toUpperCase() + buttonVariant.slice(1) }}
            </Button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
