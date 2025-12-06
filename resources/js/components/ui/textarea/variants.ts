import { cva } from "class-variance-authority";

export const textareaVariants = cva(
  "peer block w-full rounded-md border px-3 pt-5 pb-2 text-base transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60 focus-visible:border-primary shadow-xs placeholder:text-transparent disabled:cursor-not-allowed disabled:opacity-65 md:text-sm min-h-[80px]",
  {
    variants: {
      variant: {
        filled: "bg-muted/50 border-transparent text-foreground shadow-inner focus:bg-background dark:bg-white/5 dark:focus:bg-white/10",
        outlined: "bg-transparent border-border text-foreground dark:border-white/15 dark:text-white",
      },
      invalid: {
        true: "border-destructive text-destructive placeholder:text-destructive/70 focus-visible:border-destructive focus-visible:ring-destructive/60",
        false: "border-input",
      },
      disabled: {
        true: "bg-muted/60 dark:bg-white/5",
      },
    },
    defaultVariants: {
      variant: "filled",
      invalid: false,
    },
  },
);

export const labelVariants = cva("pointer-events-none absolute left-3 select-none text-sm text-muted-foreground transition-all duration-150", {
  variants: {
    invalid: {
      true: "text-destructive",
    },
    disabled: {
      true: "text-muted-foreground/70",
    },
    float: {
      true: "top-1.5 text-xs",
      false: "top-4", // Distinct from Input because it anchors to the top
    },
  },
  defaultVariants: {
    invalid: false,
    disabled: false,
  },
});
