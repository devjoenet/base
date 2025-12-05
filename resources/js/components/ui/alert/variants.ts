import { cva, type VariantProps } from "class-variance-authority";
import { computed, type Component, type ComputedRef, type InjectionKey } from "vue";
import { InformationCircleIcon, CheckCircleIcon, ExclamationTriangleIcon, XCircleIcon } from "@heroicons/vue/20/solid";

export interface AlertVisuals {
  titleClass: string;
  descriptionClass: string;
  iconClass: string;
  icon: Component | null;
}

export const alertVariantKey: InjectionKey<ComputedRef<AlertVisuals>> = Symbol("alert-variant");

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
});

export const defaultAlertVisuals = computed<AlertVisuals>(() => ({
  titleClass: "text-gray-900 dark:text-white",
  descriptionClass: "text-gray-700 dark:text-gray-300",
  iconClass: "text-gray-400",
  icon: null,
}));

export const variantVisuals: Record<NonNullable<AlertVariants["variant"]>, AlertVisuals> = {
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
};

export type AlertVariants = VariantProps<typeof alertVariants>;
