import { InertiaLinkProps } from "@inertiajs/vue3";
import type { LucideIcon } from "lucide-vue-next";

export interface Auth {
  user: User;
}

/**
 * Breadcrumb items follow the Tailwind Plus navigation examples: `title` renders the label and
 * `href` is used for intermediate links, with the final item treated as the current page
 * (aria-current="page"). Separators default to an inline slash SVG so no external icon
 * dependency is required.
 */
export interface BreadcrumbItem {
  title: string;
  href: string;
}

export interface NavItem {
  title: string;
  href: NonNullable<InertiaLinkProps["href"]>;
  icon?: LucideIcon;
  isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  name: string;
  quote: { message: string; author: string };
  auth: Auth;
  sidebarOpen: boolean;
};

export interface User {
  id: number;
  name: string;
  email: string;
  avatar?: string;
  email_verified_at: string | null;
  created_at: string;
  updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
