import { cva, type VariantProps } from "class-variance-authority";

export const badgeVariants = cva("inline-flex items-center rounded-md text-xs font-medium", {
  variants: {
    variant: {
      gray: "bg-gray-100 text-gray-600 dark:bg-gray-400/10 dark:text-gray-400",
      red: "bg-red-100 text-red-700 dark:bg-red-400/10 dark:text-red-400",
      yellow: "bg-yellow-100 text-yellow-800 dark:bg-yellow-400/10 dark:text-yellow-500",
      green: "bg-green-100 text-green-700 dark:bg-green-400/10 dark:text-green-400",
      blue: "bg-blue-100 text-blue-700 dark:bg-blue-400/10 dark:text-blue-400",
      indigo: "bg-indigo-100 text-indigo-700 dark:bg-indigo-400/10 dark:text-indigo-400",
      purple: "bg-purple-100 text-purple-700 dark:bg-purple-400/10 dark:text-purple-400",
      pink: "bg-pink-100 text-pink-700 dark:bg-pink-400/10 dark:text-pink-400",
    },
    size: {
      sm: "px-1.5 py-0.5",
      md: "px-2 py-1",
    },
  },
  defaultVariants: {
    variant: "gray",
    size: "md",
  },
});

export type BadgeVariants = VariantProps<typeof badgeVariants>;
