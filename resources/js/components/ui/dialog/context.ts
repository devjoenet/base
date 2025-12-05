import { inject, type InjectionKey } from "vue";

export interface DialogContextValue {
  setOpen: (value: boolean) => void;
}

export const dialogContextKey: InjectionKey<DialogContextValue> = Symbol("DialogContext");

export function useDialogContext(component: string): DialogContextValue {
  const context = inject(dialogContextKey, null);

  if (!context) {
    throw new Error(`${component} must be used within a Dialog component.`);
  }

  return context;
}
