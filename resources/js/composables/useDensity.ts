import { computed } from "vue";

export type Density = "compact" | "normal" | "loose";

export function useDensity(props: { density?: Density }) {
  // Maps semantic density names to Tailwind padding classes
  // We use px/py classes directly.
  // In Tailwind v4, we can also use dynamic spacing via style props if we really wanted to,
  // but utility classes are still faster for the browser to parse.

  const densityClass = computed(() => {
    switch (props.density) {
      case "compact":
        return "py-1.5 px-2.5 text-sm";
      case "loose":
        return "py-3 px-4 text-base";
      case "normal":
      default:
        return "py-2 px-3 text-sm/6"; // standard "comfortable" touch target
    }
  });

  const iconSizeClass = computed(() => {
    switch (props.density) {
      case "compact":
        return "size-4"; // 16px
      case "loose":
        return "size-6"; // 24px
      case "normal":
      default:
        return "size-5"; // 20px
    }
  });

  return {
    densityClass,
    iconSizeClass,
  };
}
