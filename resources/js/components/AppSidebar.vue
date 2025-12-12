<script setup lang="ts">
  import NavGroup from "./NavGroup.vue";
  import NavUser from "@/components/NavUser.vue";
  import NavFooter from "./NavFooter.vue";
  import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from "@/components/ui/sidebar";
  import { dashboard } from "@/routes";
  import { index as UsersIndex } from "@/routes/users";
  import { index as RolesIndex } from "@/routes/roles";
  import { index as PermissionsIndex } from "@/routes/permissions";
  import { type NavItem } from "@/types";
  import { Link } from "@inertiajs/vue3";
  import { BookOpen, Folder, KeyRound, LayoutGrid, Shield, ShieldUser, UserRoundCog } from "lucide-vue-next";
  import { computed } from "vue";
  import AppLogo from "./AppLogo.vue";
  import { usePermissions } from "@/composables/usePermissions";

  const { can } = usePermissions();

  const platformNavItems: NavItem[] = [
    {
      title: "Dashboard",
      href: dashboard(),
      icon: LayoutGrid,
    },
  ];

  const systemNavItems = computed<NavItem[]>(() => {
    const items: NavItem[] = [];

    if (can("manage users")) {
      items.push({
        title: "Users",
        href: UsersIndex(),
        icon: UserRoundCog,
      });
    }

    if (can("manage permissions")) {
      items.push({
        title: "Permissions",
        href: PermissionsIndex(),
        icon: Shield,
      });
    }

    if (can("manage roles")) {
      items.push({
        title: "Roles",
        href: RolesIndex(),
        icon: ShieldUser,
      });
    }

    return items;
  });

  const footerNavItems: NavItem[] = [
    {
      title: "Github Repo",
      href: "https://github.com/devjoenet/base",
      icon: Folder,
    },
    {
      title: "Documentation",
      href: "https://laravel.com/docs/starter-kits#vue",
      icon: BookOpen,
    },
  ];
</script>

<template>
  <Sidebar collapsible="icon" variant="inset">
    <SidebarHeader>
      <SidebarMenu>
        <SidebarMenuItem>
          <SidebarMenuButton size="lg" as-child>
            <Link :href="dashboard()">
              <AppLogo />
            </Link>
          </SidebarMenuButton>
        </SidebarMenuItem>
      </SidebarMenu>
    </SidebarHeader>

    <SidebarContent>
      <NavGroup label="Platform" :items="platformNavItems" />
      <NavGroup label="System" :items="systemNavItems" />
    </SidebarContent>

    <SidebarFooter>
      <NavFooter :items="footerNavItems" />
      <NavUser />
    </SidebarFooter>
  </Sidebar>
  <slot />
</template>
