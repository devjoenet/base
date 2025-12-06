import { inject, type InjectionKey, type Ref } from "vue";
import type { Placement } from "@floating-ui/vue";

export interface TooltipProviderContextValue {
  delayDuration: Ref<number>;
}

export interface TooltipContextValue {
  open: Ref<boolean>;
  placement: Ref<Placement>;
  triggerRef: Ref<HTMLElement | null>;
  contentId: string;
  openWithDelay: () => void;
  closeWithDelay: () => void;
  closeNow: () => void;
  setTrigger: (element: HTMLElement | null) => void;
}

export const tooltipProviderContextKey: InjectionKey<TooltipProviderContextValue> = Symbol("TooltipProviderContext");

export const tooltipContextKey: InjectionKey<TooltipContextValue> = Symbol("TooltipContext");

export function useTooltipProviderContext() {
  return inject(tooltipProviderContextKey, null);
}

export function useTooltipContext(component: string): TooltipContextValue {
  const context = inject(tooltipContextKey, null);

  if (!context) {
    throw new Error(`${component} must be used within a Tooltip component.`);
  }

  return context;
}
