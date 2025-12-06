import { cva } from "class-variance-authority";

export const selectTriggerVariants = cva(
  "peer flex w-full items-center justify-between rounded-md border px-3 pt-5 pb-2 text-base transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60 focus-visible:border-primary shadow-xs disabled:cursor-not-allowed disabled:opacity-65 md:text-sm text-left",
  {
    variants: {
      variant: {
        filled: "bg-muted/50 border-transparent text-foreground shadow-inner data-[state=open]:bg-background dark:bg-white/5 dark:data-[state=open]:bg-white/10",
        outlined: "bg-transparent border-border text-foreground dark:border-white/15 dark:text-white",
      },
      invalid: {
        true: "border-destructive text-destructive focus-visible:border-destructive focus-visible:ring-destructive/60",
        false: "border-input",
      },
    },
    defaultVariants: {
      variant: "filled",
      invalid: false,
    },
  },
);

export const selectLabelVariants = cva("pointer-events-none absolute left-3 select-none text-sm text-muted-foreground transition-all duration-150", {
  variants: {
    float: {
      true: "top-1.5 text-xs",
      false: "top-1/2 -translate-y-1/2",
    },
    invalid: {
      true: "text-destructive",
    },
  },
  defaultVariants: {
    invalid: false,
  },
});
