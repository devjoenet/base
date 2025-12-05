<script setup lang="ts">
import { InformationCircleIcon, CheckCircleIcon, ExclamationTriangleIcon, XCircleIcon } from "@heroicons/vue/20/solid"
import { type VariantProps, cva } from "class-variance-authority"
import { computed, provide, useSlots, type Component, type HTMLAttributes } from "vue"

import { cn } from "@/lib/utils"
import { alertVariantKey, type AlertVisuals } from "./context"

export const alertVariants = cva("flex w-full rounded-md p-4", {
  variants: {
    variant: {
      info: "bg-blue-50 dark:bg-blue-500/10 dark:outline dark:outline-blue-500/20",
      success: "bg-green-50 dark:bg-green-500/10 dark:outline dark:outline-green-500/20",
      warning: "bg-yellow-50 dark:bg-yellow-500/10 dark:outline dark:outline-yellow-500/15",
      destructive: "bg-red-50 dark:bg-red-500/15 dark:outline dark:outline-red-500/25",
    },
  },
  defaultVariants: {
    variant: "info",
  },
})

export type AlertVariants = VariantProps<typeof alertVariants>

const variantVisuals: Record<NonNullable<AlertVariants["variant"]>, AlertVisuals> = {
  info: {
    titleClass: "text-blue-800 dark:text-blue-100",
    descriptionClass: "text-blue-700 dark:text-blue-100/80",
    iconClass: "text-blue-400",
    icon: InformationCircleIcon,
  },
  success: {
    titleClass: "text-green-800 dark:text-green-200",
    descriptionClass: "text-green-700 dark:text-green-200/85",
    iconClass: "text-green-400",
    icon: CheckCircleIcon,
  },
  warning: {
    titleClass: "text-yellow-800 dark:text-yellow-100",
    descriptionClass: "text-yellow-700 dark:text-yellow-100/80",
    iconClass: "text-yellow-400 dark:text-yellow-300",
    icon: ExclamationTriangleIcon,
  },
  destructive: {
    titleClass: "text-red-800 dark:text-red-200",
    descriptionClass: "text-red-700 dark:text-red-200/80",
    iconClass: "text-red-400",
    icon: XCircleIcon,
  },
}

const props = defineProps<{
  class?: HTMLAttributes["class"]
  variant?: AlertVariants["variant"]
  icon?: Component | null
  title?: string
}>()

const slots = useSlots()
const variant = computed(() => props.variant ?? "info")
const visuals = computed(() => variantVisuals[variant.value] ?? variantVisuals.info)
const iconComponent = computed(() => props.icon ?? visuals.value.icon)

provide(alertVariantKey, visuals)
</script>

<template>
  <div :class="cn(alertVariants({ variant }), props.class)" role="alert">
    <div v-if="slots.icon || iconComponent" class="shrink-0">
      <slot name="icon">
        <component
          :is="iconComponent"
          v-if="iconComponent"
          class="size-5"
          :class="visuals.iconClass"
          aria-hidden="true"
        />
      </slot>
    </div>

    <div class="ml-3 flex-1">
      <p v-if="slots.title || title" class="text-sm font-medium" :class="visuals.titleClass">
        <slot name="title">{{ title }}</slot>
      </p>
      <div v-if="slots.default" class="mt-2 text-sm" :class="visuals.descriptionClass">
        <slot />
      </div>
      <div v-if="slots.actions" class="mt-4">
        <slot name="actions" />
      </div>
    </div>

    <slot name="dismiss" />
  </div>
</template>
