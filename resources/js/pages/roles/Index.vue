<script setup lang="ts">
  import { create, destroy, edit, index } from "@/routes/roles";
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Head, Link } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
  import { Badge } from "@/components/ui/badge";
  import { Plus, Pencil, Trash2, MoreHorizontal, Shield } from "lucide-vue-next";
  import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";
  import Heading from "@/components/Heading.vue";

  import type { RoleData } from "@/types/generated";

  defineProps<{
    roles: {
      data: RoleData[];
      links: any[];
    };
  }>();

  const deleteRole = (id: number) => {
    if (confirm("Are you sure you want to delete this role?")) {
      destroy(id);
    }
  };
</script>

<template>
  <Head title="Roles" />

  <AppLayout :breadcrumbs="[{ title: 'Roles', href: index().url }]">
    <div class="px-4 py-6">
      <div class="flex items-center justify-between mb-6">
        <Heading title="Role Management" description="Define roles and assign permissions." />

        <Link :href="create().url">
          <Button>
            <Plus class="w-4 h-4 mr-2" />
            Add Role
          </Button>
        </Link>
      </div>

      <div class="border rounded-lg overflow-hidden bg-white dark:bg-zinc-900 shadow-sm">
        <Table>
          <TableHeader class="bg-zinc-50 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border-b">
            <TableRow>
              <TableHead class="px-6 py-3 font-medium">Role Name</TableHead>
              <TableHead class="px-6 py-3 font-medium">Permissions</TableHead>
              <TableHead class="px-6 py-3 font-medium">Created At</TableHead>
              <TableHead class="px-6 py-3 text-right">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody class="divide-y divide-zinc-200 dark:divide-zinc-800">
            <TableRow v-for="role in roles.data" :key="role.id" class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50 transition-colors">
              <TableCell class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="p-2 bg-zinc-100 dark:bg-zinc-800 rounded-lg">
                    <Shield class="w-4 h-4 text-zinc-500" />
                  </div>
                  <span class="font-medium capitalize text-zinc-900 dark:text-zinc-100">{{ role.name }}</span>
                </div>
              </TableCell>
              <TableCell class="px-6 py-4">
                <Badge variant="outline"> {{ role.permissions_count }} Permissions </Badge>
              </TableCell>
              <TableCell class="px-6 py-4 text-zinc-500 dark:text-zinc-400">
                {{ role.created_at }}
              </TableCell>
              <TableCell class="px-6 py-4 text-right">
                <DropdownMenu>
                  <DropdownMenuTrigger as-child>
                    <Button variant="ghost" size="icon" class="h-8 w-8">
                      <MoreHorizontal class="h-4 w-4" />
                    </Button>
                  </DropdownMenuTrigger>
                  <DropdownMenuContent align="end">
                    <DropdownMenuLabel>Actions</DropdownMenuLabel>
                    <Link :href="edit(role.id!)">
                      <DropdownMenuItem>
                        <Pencil class="mr-2 h-4 w-4" />
                        Edit
                      </DropdownMenuItem>
                    </Link>
                    <!-- Prevent deleting core roles -->
                    <DropdownMenuItem v-if="!['admin', 'user', 'super-admin'].includes(role.name)" @click="deleteRole(role.id!)" class="text-red-600 focus:text-red-600">
                      <Trash2 class="mr-2 h-4 w-4" />
                      Delete
                    </DropdownMenuItem>
                  </DropdownMenuContent>
                </DropdownMenu>
              </TableCell>
            </TableRow>
            <TableRow v-if="roles.data.length === 0">
              <TableCell colspan="4" class="px-6 py-12 text-center text-zinc-500"> No roles found. </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
