<script setup lang="ts">
  import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbPage, BreadcrumbSeparator } from "@/components/ui/breadcrumb";
  import type { BreadcrumbItemType } from "@/types";

  const props = defineProps<{
    breadcrumbs: BreadcrumbItemType[];
  }>();
</script>

<template>
  <Breadcrumb>
    <BreadcrumbList>
      <template v-for="(item, index) in props.breadcrumbs" :key="item.href ?? item.title">
        <BreadcrumbItem>
          <slot name="item" :item="item" :index="index" :is-current="index === props.breadcrumbs.length - 1">
            <BreadcrumbPage v-if="index === props.breadcrumbs.length - 1">{{ item.title }}</BreadcrumbPage>
            <BreadcrumbLink v-else :href="item.href">{{ item.title }}</BreadcrumbLink>
          </slot>
        </BreadcrumbItem>

        <BreadcrumbSeparator v-if="index !== props.breadcrumbs.length - 1">
          <template v-if="$slots.separator">
            <slot name="separator" :index="index" :next="props.breadcrumbs[index + 1]" />
          </template>
        </BreadcrumbSeparator>
      </template>
    </BreadcrumbList>
  </Breadcrumb>
</template>
