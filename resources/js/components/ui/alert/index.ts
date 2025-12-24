import type { VariantProps } from "class-variance-authority";
import { cva } from "class-variance-authority";

export { default as Alert } from "./Alert.vue";
export { default as AlertDescription } from "./AlertDescription.vue";
export { default as AlertTitle } from "./AlertTitle.vue";

export const alertVariants = cva("alert relative w-full rounded-lg border px-4 py-3 text-sm flex items-start gap-3", {
  variants: {
    variant: {
      default: "bg-base-200",
      destructive: "alert-error",
      info: "alert-info",
      success: "alert-success",
      warning: "alert-warning",
    },
  },
  defaultVariants: {
    variant: "default",
  },
});

export type AlertVariants = VariantProps<typeof alertVariants>;
