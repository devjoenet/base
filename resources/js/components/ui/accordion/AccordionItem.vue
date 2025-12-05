<script setup lang="ts">
  import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
  import { MinusSmallIcon, PlusSmallIcon } from "@heroicons/vue/24/outline";
  import { useVModel } from "@vueuse/core";
  import { cn } from "@/lib/utils";
  import { computed, watch, type HTMLAttributes } from "vue";

  const props = withDefaults(
    defineProps<{
      open?: boolean;
      defaultOpen?: boolean;
      disabled?: boolean;
      class?: HTMLAttributes["class"];
      triggerClass?: HTMLAttributes["class"];
      contentClass?: HTMLAttributes["class"];
    }>(),
    {
      defaultOpen: false,
      disabled: false,
    },
  );

  const emit = defineEmits<{
    (e: "update:open", value: boolean): void;
    (e: "open"): void;
    (e: "close"): void;
    (e: "toggle", value: boolean): void;
  }>();

  const openState = useVModel(props, "open", emit, { passive: true, defaultValue: props.defaultOpen });

  watch(openState, (value, previous) => {
    if (value === previous) return;

    emit(value ? "open" : "close");
    emit("toggle", value ?? false);
  });

  const disclosureKey = computed(() => (openState.value ? "open" : "closed"));

  const handleToggle = (current: boolean) => {
    openState.value = !current;
  };
</script>

<template>
  <Disclosure v-slot="{ open }" :default-open="openState ?? false" :key="disclosureKey">
    <div :class="cn('py-6 first:pt-0 last:pb-0', props.class)">
      <dt>
        <DisclosureButton
          class="flex w-full items-start justify-between text-left text-gray-900 dark:text-white"
          :class="props.triggerClass"
          :disabled="props.disabled"
          @click="handleToggle(open)"
        >
          <slot name="trigger" :open="open" />

          <span class="ml-6 flex h-7 items-center">
            <slot name="icon" :open="open">
              <PlusSmallIcon v-if="!open" class="size-6" aria-hidden="true" />
              <MinusSmallIcon v-else class="size-6" aria-hidden="true" />
            </slot>
          </span>
        </DisclosureButton>
      </dt>

      <DisclosurePanel
        as="dd"
        :class="cn('mt-2 pr-12 text-base/7 text-gray-600 dark:text-gray-400', props.contentClass)"
      >
        <slot :open="open" />
      </DisclosurePanel>
    </div>
  </Disclosure>
</template>
