import { cva, type VariantProps } from "class-variance-authority";

export const buttonVariants = cva(
  "inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-full text-sm font-medium tracking-wide transition-colors transition-shadow focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500/60 ring-offset-white dark:ring-offset-gray-950 disabled:pointer-events-none disabled:opacity-60 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-5 [&_svg]:shrink-0",
  {
    variants: {
      variant: {
        default:
          "bg-indigo-600 text-white shadow-[0_4px_10px_rgba(79,70,229,0.35)] hover:bg-indigo-500 focus-visible:ring-indigo-400/60 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:shadow-[0_4px_10px_rgba(99,102,241,0.25)]",
        secondary:
          "bg-indigo-50 text-indigo-900 shadow-[0_2px_6px_rgba(63,81,181,0.2)] hover:bg-indigo-100 border border-indigo-100 focus-visible:ring-indigo-300/60 dark:bg-indigo-500/15 dark:text-indigo-100 dark:border-indigo-500/30 dark:hover:bg-indigo-500/25",
        outline:
          "border border-gray-300 bg-transparent text-gray-900 hover:bg-gray-50 focus-visible:ring-gray-400/50 dark:border-gray-700 dark:text-gray-100 dark:hover:bg-gray-800",
        ghost:
          "text-indigo-700 hover:bg-indigo-50 focus-visible:ring-indigo-300/60 dark:text-indigo-200 dark:hover:bg-indigo-500/15",
        destructive:
          "bg-red-600 text-white shadow-[0_4px_10px_rgba(239,68,68,0.35)] hover:bg-red-500 focus-visible:ring-red-400/60 dark:bg-red-500 dark:hover:bg-red-400 dark:shadow-[0_4px_10px_rgba(239,68,68,0.25)]",
        link: "text-indigo-700 underline underline-offset-4 hover:text-indigo-600 focus-visible:ring-indigo-300/60 dark:text-indigo-200 dark:hover:text-indigo-100",
      },
      size: {
        sm: "h-9 px-4 py-2 text-sm",
        default: "h-10 px-5 py-2.5",
        lg: "h-11 px-6 py-3 text-base",
        icon: "size-10",
      },
    },
    defaultVariants: {
      variant: "default",
      size: "default",
    },
  },
);

export type ButtonVariants = VariantProps<typeof buttonVariants>;
