<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { avatarInjectionKey } from "@/components/ui/avatar/variants";
  import { computed, inject, type HTMLAttributes } from "vue";

  const props = defineProps<{
    alt?: string;
    class?: HTMLAttributes["class"];
    initials?: string;
  }>();

  const context = inject(avatarInjectionKey, null);

  const resolvedAlt = computed(() => props.alt ?? context?.altText.value);

  const generatedInitials = computed(() => {
    const alt = resolvedAlt.value?.trim();

    if (!alt) return "";

    return alt
      .split(/\s+/)
      .filter(Boolean)
      .slice(0, 2)
      .map((word) => word[0]?.toUpperCase() ?? "")
      .join("");
  });

  const fallbackText = computed(() => props.initials ?? generatedInitials.value);
  const fallbackTextClass = computed(() => context?.fallbackTextClass.value ?? "text-sm");

  const shouldShowFallback = computed(() => {
    if (!context) return true;
    if (!context.hasImage.value) return true;

    return context.imageStatus.value === "error";
  });
</script>

<template>
  <div v-if="shouldShowFallback" data-slot="avatar-fallback" :class="cn('bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-200 flex size-full items-center justify-center rounded-full font-medium', fallbackTextClass, props.class)">
    <slot>{{ fallbackText }}</slot>
  </div>
</template>
