import { cva } from "class-variance-authority";

export const radioGroupItemVariants = cva("aspect-square h-4 w-4 rounded-full border border-primary text-primary shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50", {
  variants: {
    variant: {
      default: "bg-transparent data-[checked]:bg-primary data-[checked]:text-primary-foreground",
    },
  },
  defaultVariants: {
    variant: "default",
  },
});
