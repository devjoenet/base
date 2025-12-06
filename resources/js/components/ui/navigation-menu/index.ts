import { cva } from "class-variance-authority";

export { default as NavigationMenu } from "./NavigationMenu.vue";
export { default as NavigationMenuContent } from "./NavigationMenuContent.vue";
export { default as NavigationMenuIndicator } from "./NavigationMenuIndicator.vue";
export { default as NavigationMenuItem } from "./NavigationMenuItem.vue";
export { default as NavigationMenuLink } from "./NavigationMenuLink.vue";
export { default as NavigationMenuList } from "./NavigationMenuList.vue";
export { default as NavigationMenuTrigger } from "./NavigationMenuTrigger.vue";
export { default as NavigationMenuViewport } from "./NavigationMenuViewport.vue";

export const navigationMenuTriggerStyle = cva(
  [
    "group inline-flex h-9 w-max items-center justify-center gap-2 rounded-md",
    "bg-background px-4 py-2 text-sm font-medium text-foreground transition-[color,box-shadow]",
    "hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground",
    "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ring/70",
    "disabled:pointer-events-none disabled:opacity-60 data-[state=open]:bg-accent/70 data-[state=open]:text-accent-foreground",
  ].join(" "),
  {
    variants: {
      active: {
        true: "bg-accent/60 text-accent-foreground shadow-inner shadow-accent/40",
        false: "",
      },
    },
    defaultVariants: {
      active: false,
    },
  },
);
