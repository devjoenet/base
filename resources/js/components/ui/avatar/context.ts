import type { ComputedRef, InjectionKey, Ref } from "vue";

export type AvatarStatus = "idle" | "loading" | "loaded" | "error";

export type AvatarContext = {
  altText: Ref<string | undefined>;
  fallbackTextClass: ComputedRef<string>;
  hasImage: Ref<boolean>;
  imageStatus: Ref<AvatarStatus>;
  onImageError: () => void;
  onImageLoad: () => void;
  registerImage: (hasImage: boolean) => void;
  setAltText: (value?: string) => void;
};

export const avatarInjectionKey = Symbol("avatar-context") as InjectionKey<AvatarContext>;
