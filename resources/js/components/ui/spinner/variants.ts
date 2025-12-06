import { cva, type VariantProps } from "class-variance-authority";

export const spinnerVariants = cva(
  "inline-flex animate-spin items-center justify-center text-current",
  {
    variants: {
      size: {
        xs: "size-3",
        sm: "size-4",
        md: "size-5",
        lg: "size-6",
      },
      color: {
        primary: "text-indigo-600 drop-shadow-[0_0_0_2px_rgba(79,70,229,0.12)] dark:text-indigo-400 dark:drop-shadow-[0_0_0_2px_rgba(129,140,248,0.18)]",
        muted: "text-gray-500 dark:text-gray-300",
        contrast: "text-white",
      },
    },
    defaultVariants: {
      size: "md",
      color: "primary",
    },
  },
);

export type SpinnerVariants = VariantProps<typeof spinnerVariants>;

export const spinnerRingVariants: Record<NonNullable<SpinnerVariants["color"]>, string> = {
  primary: "border-indigo-200/80 border-t-indigo-600 dark:border-indigo-500/25 dark:border-t-indigo-400",
  muted: "border-gray-200/80 border-t-gray-600 dark:border-gray-700 dark:border-t-gray-200",
  contrast: "border-white/40 border-t-white",
};
