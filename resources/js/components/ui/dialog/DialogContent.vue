// resources/js/components/ui/dialog/DialogContent.vue
<script setup lang="ts">
  import type { DialogContentEmits, DialogContentProps } from "reka-ui";
  import type { HTMLAttributes } from "vue";
  import { reactiveOmit } from "@vueuse/core";
  import { X } from "lucide-vue-next";
  import { DialogClose, DialogContent, DialogPortal, useForwardPropsEmits } from "reka-ui";
  import { cn } from "@/lib/utils";
  import DialogOverlay from "./DialogOverlay.vue";

  defineOptions({
    inheritAttrs: false,
  });

  const props = withDefaults(defineProps<DialogContentProps & { class?: HTMLAttributes["class"]; showCloseButton?: boolean }>(), {
    showCloseButton: true,
  });
  const emits = defineEmits<DialogContentEmits>();

  const delegatedProps = reactiveOmit(props, "class");

  const forwarded = useForwardPropsEmits(delegatedProps, emits);
</script>

<template>
  <DialogPortal>
    <DialogOverlay />
    <DialogContent data-slot="dialog-content" v-bind="{ ...$attrs, ...forwarded }" :class="cn('modal-box fixed top-[50%] left-[50%] z-50 translate-x-[-50%] translate-y-[-50%] shadow-lg duration-200', props.class)">
      <slot />

      <DialogClose v-if="showCloseButton" data-slot="dialog-close" class="btn btn-ghost btn-sm btn-circle absolute right-2 top-2">
        <X class="size-4" />
        <span class="sr-only">Close</span>
      </DialogClose>
    </DialogContent>
  </DialogPortal>
</template>
