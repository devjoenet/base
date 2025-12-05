<script setup lang="ts">
import { cn } from "@/lib/utils";
import { avatarInjectionKey } from "./context";
import { computed, inject, onMounted, watch, type HTMLAttributes } from "vue";

const props = defineProps<{
  alt?: string;
  class?: HTMLAttributes["class"];
  src?: string;
}>();

const emit = defineEmits<{ (e: "error", event: Event): void; (e: "load", event: Event): void }>();

const context = inject(avatarInjectionKey, null);

const registerSource = () => {
  context?.registerImage(!!props.src);
};

onMounted(() => {
  registerSource();
  context?.setAltText(props.alt);
});

watch(
  () => props.src,
  () => {
    registerSource();
  }
);

watch(
  () => props.alt,
  (value) => {
    context?.setAltText(value);
  }
);

const showImage = computed(() => {
  if (!props.src) return false;
  if (!context) return true;

  return context.imageStatus.value !== "error";
});

const handleError = (event: Event) => {
  context?.onImageError();
  emit("error", event);
};

const handleLoad = (event: Event) => {
  context?.onImageLoad();
  emit("load", event);
};
</script>

<template>
  <img
    v-if="showImage"
    data-slot="avatar-image"
    :src="props.src"
    :alt="props.alt ?? ''"
    :class="cn('aspect-square size-full object-cover', props.class)"
    @error="handleError"
    @load="handleLoad"
  />
</template>
