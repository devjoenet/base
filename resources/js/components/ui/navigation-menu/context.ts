import { inject, provide, type ComputedRef, type Ref, type ShallowRef } from "vue";

export type NavigationMenuOrientation = "horizontal" | "vertical";

type NavigationMenuContextValue = {
  orientation: ComputedRef<NavigationMenuOrientation>;
  openItem: Ref<string | null>;
  setOpenItem: (id: string | null, trigger?: HTMLElement | null) => void;
  rootRef: ShallowRef<HTMLElement | null>;
  viewportRef: ShallowRef<HTMLElement | null>;
  viewportEnabled: ComputedRef<boolean>;
  activeTrigger: ShallowRef<HTMLElement | null>;
};

export type NavigationMenuItemContextValue = {
  id: ComputedRef<string>;
  isOpen: ComputedRef<boolean>;
  open: (trigger?: HTMLElement | null) => void;
  close: () => void;
  setTrigger: (el: HTMLElement | null) => void;
};

const NAVIGATION_MENU_CONTEXT_KEY = Symbol("NavigationMenuContext");
const NAVIGATION_MENU_ITEM_CONTEXT_KEY = Symbol("NavigationMenuItemContext");

export function provideNavigationMenuContext(value: NavigationMenuContextValue) {
  provide(NAVIGATION_MENU_CONTEXT_KEY, value);
}

export function useNavigationMenuContext(component: string) {
  const context = inject<NavigationMenuContextValue | null>(NAVIGATION_MENU_CONTEXT_KEY, null);

  if (!context) {
    throw new Error(`<${component}> must be used within a <NavigationMenu>.`);
  }

  return context;
}

export function provideNavigationMenuItemContext(value: NavigationMenuItemContextValue) {
  provide(NAVIGATION_MENU_ITEM_CONTEXT_KEY, value);
}

export function useNavigationMenuItemContext(component: string) {
  const context = inject<NavigationMenuItemContextValue | null>(NAVIGATION_MENU_ITEM_CONTEXT_KEY, null);

  if (!context) {
    throw new Error(`<${component}> must be used within a <NavigationMenuItem>.`);
  }

  return context;
}

export function orientationDataAttr(orientation: NavigationMenuOrientation) {
  return orientation === "vertical" ? "vertical" : "horizontal";
}
