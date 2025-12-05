import { computed, type Component, type ComputedRef, type InjectionKey } from "vue"

export type AlertVisuals = {
  titleClass: string
  descriptionClass: string
  iconClass: string
  icon: Component | null
}

export const alertVariantKey: InjectionKey<ComputedRef<AlertVisuals>> = Symbol("alert-variant")

export const defaultAlertVisuals = computed<AlertVisuals>(() => ({
  titleClass: "text-gray-900 dark:text-white",
  descriptionClass: "text-gray-700 dark:text-gray-300",
  iconClass: "text-gray-400",
  icon: null,
}))
