<script setup lang="ts">
  import NavFooter from "@/components/NavFooter.vue";
  import NavPlatform from "./NavPlatform.vue";
  import NavSystem from "./NavSystem.vue";
  import NavUser from "@/components/NavUser.vue";
  import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from "@/components/ui/sidebar";
  import { dashboard } from "@/routes";
  import { index as UsersIndex } from "@/routes/users";
  import { index as RolesIndex } from "@/routes/roles";
  import { type NavItem } from "@/types";
  import { Link } from "@inertiajs/vue3";
  import { BookOpen, Folder, LayoutGrid, UserRoundCog, ShieldUser } from "lucide-vue-next";
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

    if (can("manage roles")) {
      items.push({
        title: "Roles & Permissions",
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
      <NavPlatform :items="platformNavItems" />
      <NavSystem :items="systemNavItems" />
    </SidebarContent>

    <SidebarFooter>
      <NavFooter :items="footerNavItems" />
      <NavUser />
    </SidebarFooter>
  </Sidebar>
  <slot />
</template>
