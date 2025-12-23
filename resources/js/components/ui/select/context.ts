import type { InjectionKey, Ref } from "vue";

export type SelectContext = {
  modelValue: Ref<string | number | undefined>;
  setValue: (v: string | number) => void;
  placeholder?: string;
  disabled?: boolean;
  registerItem: (value: string | number, label: string) => void;
  getLabel: (value: string | number | undefined) => string | undefined;
};

export const SELECT_CTX_KEY: InjectionKey<SelectContext> = Symbol("SELECT_CTX");
