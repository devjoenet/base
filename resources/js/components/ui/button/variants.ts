export type ButtonVariant = "primary" | "secondary" | "destructive" | "ghost" | "link";
export type ButtonDensity = "compact" | "comfortable" | "standard";

export const buttonStyles = {
  base: "inline-flex items-center justify-center whitespace-nowrap rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 disabled:pointer-events-none disabled:opacity-50",
  variants: {
    primary: "bg-teal-600 text-white hover:bg-teal-700 dark:bg-teal-600 dark:hover:bg-teal-500 shadow-sm focus-visible:ring-teal-500",
    secondary: "bg-zinc-100 text-zinc-900 hover:bg-zinc-200/80 dark:bg-zinc-800 dark:text-zinc-50 dark:hover:bg-zinc-700 shadow-sm focus-visible:ring-zinc-500 border border-zinc-200 dark:border-zinc-700",
    destructive: "bg-red-600 text-white hover:bg-red-700 dark:bg-red-900 dark:text-red-50 dark:hover:bg-red-900/90 shadow-sm focus-visible:ring-red-500",
    ghost: "hover:bg-zinc-100 hover:text-zinc-900 dark:hover:bg-zinc-800 dark:hover:text-zinc-50 text-zinc-600 dark:text-zinc-400",
    link: "text-teal-600 underline-offset-4 hover:underline dark:text-teal-400 h-auto p-0",
  },
  density: {
    compact: "h-8 px-3 text-xs",
    comfortable: "h-11 px-6 text-base",
    standard: "h-9 px-4 py-2 text-sm",
  },
};
