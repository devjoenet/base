import { cva } from "class-variance-authority";

export const comboboxInputVariants = cva("peer w-full border-none bg-transparent px-3 pt-5 pb-2 text-base placeholder-transparent focus:outline-none focus:ring-0 md:text-sm", {
  variants: {
    variant: {
      filled: "text-foreground placeholder:text-muted-foreground",
      outlined: "text-foreground placeholder:text-muted-foreground",
    },
    invalid: {
      true: "text-destructive placeholder:text-destructive/70",
      false: "",
    },
  },
  defaultVariants: {
    variant: "filled",
    invalid: false,
  },
});

export const comboboxContainerVariants = cva("relative flex w-full items-center rounded-md border shadow-xs transition focus-within:ring-2 focus-within:ring-primary/60 focus-within:border-primary", {
  variants: {
    variant: {
      filled: "bg-muted/50 border-transparent shadow-inner dark:bg-white/5",
      outlined: "bg-transparent border-border dark:border-white/15",
    },
    invalid: {
      true: "border-destructive ring-destructive/60",
      false: "border-input",
    },
    disabled: {
      true: "cursor-not-allowed opacity-65 bg-muted/60 dark:bg-white/5",
    },
  },
  defaultVariants: {
    variant: "filled",
    invalid: false,
  },
});
