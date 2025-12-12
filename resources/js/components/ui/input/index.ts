import type { VariantProps } from "class-variance-authority";
import { cva } from "class-variance-authority";

export { default as Input } from "./Input.vue";

export const inputFieldVariants = cva("relative flex min-h-12 w-full items-center gap-3 rounded-lg border text-sm transition-[background-color,border-color,box-shadow] focus-within:border-ring focus-within:ring-ring/60 focus-within:ring-[3px]", {
  variants: {
    variant: {
      filled: "border-transparent bg-[oklch(0.97_0.01_255)] shadow-[0_1px_2px_0_rgba(0,0,0,0.05)] focus-within:border-transparent focus-within:ring-[oklch(0.69_0.16_264)/45] dark:bg-[oklch(0.26_0.03_255)] dark:focus-within:ring-[oklch(0.77_0.12_255)/35]",
      outlined: "border-input bg-background shadow-xs focus-within:border-primary focus-within:ring-[oklch(0.69_0.16_264)/40] dark:bg-input/30 dark:border-input",
    },
    invalid: {
      true: "border-destructive focus-within:border-destructive focus-within:ring-destructive/45",
      false: "",
    },
    disabled: {
      true: "cursor-not-allowed opacity-60",
      false: "",
    },
  },
  defaultVariants: {
    variant: "filled",
    invalid: false,
    disabled: false,
  },
});

export type InputVariants = VariantProps<typeof inputFieldVariants>;
