import { inject, type InjectionKey, type Ref } from "vue";

export interface SheetContextValue {
  open: Ref<boolean>;
  setOpen: (value: boolean) => void;
}

export const sheetContextKey: InjectionKey<SheetContextValue> = Symbol("SheetContext");

export function useSheetContext(component: string): SheetContextValue {
  const context = inject(sheetContextKey, null);

  if (!context) {
    throw new Error(`${component} must be used within a Sheet component.`);
  }

  return context;
}
