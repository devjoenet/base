import { cva } from "class-variance-authority";

export const switchVariants = cva("group relative inline-flex shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2", {
  variants: {
    size: {
      sm: "h-5 w-9",
      md: "h-6 w-11",
      lg: "h-7 w-14",
    },
    checked: {
      true: "bg-primary",
      false: "bg-gray-200 dark:bg-gray-700",
    },
  },
  defaultVariants: {
    size: "md",
    checked: false,
  },
});

export const thumbVariants = cva("pointer-events-none inline-block transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out", {
  variants: {
    size: {
      sm: "size-4",
      md: "size-5",
      lg: "size-6",
    },
    checked: {
      true: "translate-x-full",
      false: "translate-x-0",
    },
  },
  defaultVariants: {
    size: "md",
    checked: false,
  },
});
