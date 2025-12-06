<script setup lang="ts">
  import { computed } from "vue";
  import { Link } from "@inertiajs/vue3";
  import { ArrowPathIcon } from "@heroicons/vue/20/solid";
  import { buttonStyles, type ButtonVariant, type ButtonDensity } from "@/components/ui/button/variants";

  interface Props {
    as?: string | object;
    variant?: ButtonVariant;
    density?: ButtonDensity;
    type?: "button" | "submit" | "reset";
    loading?: boolean;
    disabled?: boolean;
    href?: string;
  }

  const props = withDefaults(defineProps<Props>(), {
    as: "button",
    variant: "primary",
    density: "standard",
    type: "button",
    loading: false,
    disabled: false,
  });

  const classes = computed(() => {
    const densityClass = props.variant === "link" ? "" : buttonStyles.density[props.density] || buttonStyles.density.standard;

    return [buttonStyles.base, densityClass, buttonStyles.variants[props.variant]];
  });
</script>

<template>
  <component :is="href ? Link : as" :href="href" :type="as === 'button' ? type : undefined" :disabled="disabled || loading" :class="classes">
    <ArrowPathIcon v-if="loading" class="mr-2 h-4 w-4 animate-spin" aria-hidden="true" />

    <div v-if="$slots.leading && !loading" class="mr-2 inline-flex shrink-0">
      <slot name="leading" />
    </div>

    <slot />

    <div v-if="$slots.trailing" class="ml-2 inline-flex shrink-0">
      <slot name="trailing" />
    </div>
  </component>
</template>
