import { usePage } from "@inertiajs/vue3";
import { SharedData } from "@/types/globals";

export function usePermissions() {
  const page = usePage<SharedData>();

  const hasRole = (name: string | string[]): boolean => {
    const userRoles = page.props.auth.roles || [];

    if (Array.isArray(name)) {
      return name.some((r) => userRoles.includes(r));
    }

    return userRoles.includes(name);
  };

  const can = (name: string | string[]): boolean => {
    const userPermissions = page.props.auth.permissions || [];
    const userRoles = page.props.auth.roles || [];

    // Super admins usually can do everything
    if (userRoles.includes("super-admin")) {
      return true;
    }

    if (Array.isArray(name)) {
      return name.some((p) => userPermissions.includes(p));
    }

    return userPermissions.includes(name);
  };

  return { hasRole, can };
}
