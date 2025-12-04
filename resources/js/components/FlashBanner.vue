<script setup lang="ts">
import { TransitionRoot } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { CheckCircleIcon, ExclamationTriangleIcon, InformationCircleIcon } from "@heroicons/vue/24/solid";
import { computed, ref, watch } from "vue";

type FlashPayload = Partial<Record<"success" | "error" | "status" | "message" | "warning", string>>;

const props = defineProps<{
  flash?: FlashPayload;
}>();

const open = ref(true);

const tone = computed(() => {
  if (props.flash?.error) return "error" as const;
  if (props.flash?.warning) return "warning" as const;
  if (props.flash?.success) return "success" as const;
  if (props.flash?.status || props.flash?.message) return "info" as const;
  return null;
});

const message = computed(() => {
  if (tone.value === "error") return props.flash?.error;
  if (tone.value === "warning") return props.flash?.warning;
  if (tone.value === "success") return props.flash?.success;
  return props.flash?.status ?? props.flash?.message ?? "";
});

watch(
  () => props.flash,
  () => {
    open.value = true;
  },
  { deep: true },
);

const styles = computed(() => {
  switch (tone.value) {
    case "error":
      return {
        container: "bg-rose-50 text-rose-900 ring-1 ring-rose-200 dark:bg-rose-950/60 dark:text-rose-100 dark:ring-rose-500/40",
        icon: ExclamationTriangleIcon,
      } as const;
    case "warning":
      return {
        container: "bg-amber-50 text-amber-900 ring-1 ring-amber-200 dark:bg-amber-950/60 dark:text-amber-100 dark:ring-amber-500/40",
        icon: ExclamationTriangleIcon,
      } as const;
    case "success":
      return {
        container: "bg-emerald-50 text-emerald-900 ring-1 ring-emerald-200 dark:bg-emerald-950/60 dark:text-emerald-100 dark:ring-emerald-500/40",
        icon: CheckCircleIcon,
      } as const;
    case "info":
      return {
        container: "bg-sky-50 text-sky-900 ring-1 ring-sky-200 dark:bg-sky-950/60 dark:text-sky-100 dark:ring-sky-500/40",
        icon: InformationCircleIcon,
      } as const;
    default:
      return null;
  }
});
</script>

<template>
  <TransitionRoot
    as="template"
    :show="Boolean(message) && Boolean(tone) && open"
    enter="transition ease-out duration-200"
    enter-from="opacity-0 -translate-y-1"
    enter-to="opacity-100 translate-y-0"
    leave="transition ease-in duration-150"
    leave-from="opacity-100 translate-y-0"
    leave-to="opacity-0 -translate-y-1"
  >
    <div :class="['relative isolate overflow-hidden rounded-xl p-4 shadow-sm', styles?.container]">
      <div class="flex items-start gap-3">
        <component :is="styles?.icon" class="size-6 shrink-0" aria-hidden="true" />
        <div class="flex-1 text-sm leading-6">
          <slot>
            <p class="font-medium" v-text="message" />
          </slot>
        </div>
        <button
          type="button"
          class="inline-flex size-8 items-center justify-center rounded-lg text-sm font-medium ring-1 ring-inset ring-black/5 transition hover:bg-black/5 dark:ring-white/10 dark:hover:bg-white/5"
          @click="open = false"
          aria-label="Dismiss notification"
        >
          <XMarkIcon class="size-5" aria-hidden="true" />
        </button>
      </div>
    </div>
  </TransitionRoot>
</template>
