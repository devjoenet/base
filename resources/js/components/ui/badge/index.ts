import type { VariantProps } from "class-variance-authority";
import { cva } from "class-variance-authority";

export { default as Badge } from "./Badge.vue";

export const badgeVariants = cva("badge inline-flex items-center justify-center border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 [&>svg]:size-3 gap-1 [&>svg]:pointer-events-none transition-all", {
  variants: {
    variant: {
      default: "badge-primary",
      secondary: "badge-secondary",
      destructive: "badge-error",
      outline: "badge-outline",
      ghost: "badge-ghost",
    },
  },
  defaultVariants: {
    variant: "default",
  },
});
export type BadgeVariants = VariantProps<typeof badgeVariants>;
