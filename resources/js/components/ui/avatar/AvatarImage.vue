<script setup lang="ts">
  import { AvatarImage as RekaAvatarImage } from "reka-ui";
  import { computed } from "vue";
  import type { ImgHTMLAttributes } from "vue";

  // Accept null/undefined/empty from callers but never forward invalid values to Reka UI.
  // Reka's AvatarImage requires a string `src` prop at runtime, so we render it
  // only when a valid non-empty src is provided. Otherwise, the AvatarFallback will display.
  interface AvatarProps {
    src?: ImgHTMLAttributes["src"] | null;
    referrerPolicy?: ImgHTMLAttributes["referrerpolicy"];
    crossOrigin?: ImgHTMLAttributes["crossorigin"];
  }

  const props = defineProps<AvatarProps>();

  const normalizedSrc = computed(() => {
    const s = props.src;
    return s == null || s === "" ? undefined : (s as string);
  });

  // Forward only defined, non-null non-src props
  const nonSrcProps = computed(() => {
    const { src, ...rest } = props as Record<string, unknown>;
    return Object.fromEntries(Object.entries(rest).filter(([, v]) => v != null));
  });
</script>

<template>
  <RekaAvatarImage v-if="normalizedSrc" data-slot="avatar-image" v-bind="nonSrcProps" :src="normalizedSrc" class="aspect-square size-full">
    <slot />
  </RekaAvatarImage>
</template>
