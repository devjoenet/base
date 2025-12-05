<script setup lang="ts">
  import { cn } from "@/lib/utils";
  import { avatarInjectionKey, type AvatarStatus } from "@/components/ui/avatar/context";
  import { computed, provide, ref, type HTMLAttributes } from "vue";

  const avatarSizes = {
    sm: "size-8",
    md: "size-10",
    lg: "size-12",
  } satisfies Record<string, string>;

  const fallbackTextSizes = {
    sm: "text-xs",
    md: "text-sm",
    lg: "text-base",
  } satisfies Record<string, string>;

  const props = defineProps<{
    class?: HTMLAttributes["class"];
    size?: keyof typeof avatarSizes;
  }>();

  const size = computed(() => props.size ?? "md");
  const rootSizeClass = computed(() => avatarSizes[size.value] ?? avatarSizes.md);
  const fallbackTextClass = computed(() => fallbackTextSizes[size.value] ?? fallbackTextSizes.md);

  const altText = ref<string | undefined>();
  const hasImage = ref(false);
  const imageStatus = ref<AvatarStatus>("idle");

  const registerImage = (present: boolean) => {
    hasImage.value = present;
    imageStatus.value = present ? "loading" : "idle";
  };

  const setAltText = (value?: string) => {
    altText.value = value || undefined;
  };

  const onImageLoad = () => {
    imageStatus.value = "loaded";
  };

  const onImageError = () => {
    imageStatus.value = "error";
  };

  provide(avatarInjectionKey, {
    altText,
    fallbackTextClass,
    hasImage,
    imageStatus,
    onImageError,
    onImageLoad,
    registerImage,
    setAltText,
  });
</script>

<template>
  <div data-slot="avatar" :class="cn('relative flex shrink-0 overflow-hidden rounded-full', rootSizeClass, props.class)">
    <slot />
  </div>
</template>
