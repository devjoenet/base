<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Head, Link, router } from "@inertiajs/vue3";
  import Heading from "@/components/Heading.vue";
  import { Button } from "@/components/ui/button";
  import { Badge } from "@/components/ui/badge";
  import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
  import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";
  import { create, destroy, edit, index } from "@/routes/permissions";
  import { KeySquare, MoreHorizontal, Pencil, Plus, Trash2 } from "lucide-vue-next";
  import { usePermissions } from "@/composables/usePermissions";

  defineProps<{
    permissions: {
      data: Array<{
        id: number;
        name: string;
        guard_name: string;
        roles_count: number;
        created_at: string;
      }>;
      links: any[];
    };
  }>();

  const { can } = usePermissions();

  const deletePermission = (id: number) => {
    if (!can("manage permissions")) {
      return;
    }

    if (confirm("Are you sure you want to delete this permission?")) {
      router.delete(destroy(id).url);
    }
  };
</script>

<template>
  <Head title="Permissions" />

  <AppLayout :breadcrumbs="[{ title: 'Permissions', href: index().url }]">
    <div class="px-4 py-6">
      <div class="flex items-center justify-between mb-6">
        <Heading title="Permission Management" description="Control access by defining permissions." />

        <Link v-if="can('manage permissions')" :href="create().url">
          <Button>
            <Plus class="w-4 h-4 mr-2" />
            Add Permission
          </Button>
        </Link>
      </div>

      <div class="border rounded-lg overflow-hidden bg-white dark:bg-zinc-900 shadow-sm">
        <Table>
          <TableHeader class="bg-zinc-50 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border-b">
            <TableRow>
              <TableHead class="px-6 py-3 font-medium">Permission</TableHead>
              <TableHead class="px-6 py-3 font-medium">Guard</TableHead>
              <TableHead class="px-6 py-3 font-medium">Roles</TableHead>
              <TableHead class="px-6 py-3 font-medium">Created At</TableHead>
              <TableHead class="px-6 py-3 text-right">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody class="divide-y divide-zinc-200 dark:divide-zinc-800">
            <TableRow v-for="permission in permissions.data" :key="permission.id" class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50 transition-colors">
              <TableCell class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="p-2 bg-zinc-100 dark:bg-zinc-800 rounded-lg">
                    <KeySquare class="w-4 h-4 text-zinc-500" />
                  </div>
                  <span class="font-medium capitalize text-zinc-900 dark:text-zinc-100">{{ permission.name }}</span>
                </div>
              </TableCell>
              <TableCell class="px-6 py-4 text-zinc-600 dark:text-zinc-300">
                <Badge variant="outline" class="capitalize">{{ permission.guard_name }}</Badge>
              </TableCell>
              <TableCell class="px-6 py-4">
                <Badge variant="secondary">{{ permission.roles_count }} Roles</Badge>
              </TableCell>
              <TableCell class="px-6 py-4 text-zinc-500 dark:text-zinc-400">
                {{ permission.created_at }}
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
                    <Link :href="edit(permission.id).url">
                      <DropdownMenuItem>
                        <Pencil class="mr-2 h-4 w-4" />
                        Edit
                      </DropdownMenuItem>
                    </Link>
                    <DropdownMenuItem v-if="can('manage permissions')" @click="deletePermission(permission.id)" class="text-red-600 focus:text-red-600">
                      <Trash2 class="mr-2 h-4 w-4" />
                      Delete
                    </DropdownMenuItem>
                  </DropdownMenuContent>
                </DropdownMenu>
              </TableCell>
            </TableRow>
            <TableRow v-if="permissions.data.length === 0">
              <TableCell colspan="5" class="px-6 py-12 text-center text-zinc-500"> No permissions found. </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
