import type { VariantProps } from "class-variance-authority";
import { cva } from "class-variance-authority";

export { default as Input } from "./Input.vue";

export const inputFieldVariants = cva("input w-full", {
  variants: {
    variant: {
      filled: "bg-base-200 border-none focus:bg-base-200",
      outlined: "input-bordered",
    },
    invalid: {
      true: "input-error",
      false: "",
    },
    disabled: {
      true: "input-disabled",
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
