<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Head, Link, router } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
  import { Badge } from "@/components/ui/badge";
  import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
  import { Plus, Pencil, Trash2, MoreHorizontal } from "lucide-vue-next";
  import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";
  import Heading from "@/components/Heading.vue";
  import { index, edit, create, destroy } from "@/routes/users/index";

  defineProps<{
    users: {
      data: Array<{
        id: number;
        name: string;
        email: string;
        role: string;
        created_at: string;
        profile_photo_url: string;
      }>;
      links: any[]; // Simple pagination for now
    };
  }>();

  const deleteUser = (id: number) => {
    if (confirm("Are you sure you want to delete this user?")) {
      destroy(id);
    }
  };
</script>

<template>
  <Head title="Users" />

  <AppLayout :breadcrumbs="[{ title: 'Users', href: index.url() }]">
    <div class="px-4 py-6">
      <div class="flex items-center justify-between mb-6">
        <Heading title="User Management" description="Manage users, roles, and permissions." />

        <Link :href="create()">
          <Button>
            <Plus class="w-4 h-4 mr-2" />
            Add User
          </Button>
        </Link>
      </div>

      <div class="border rounded-lg overflow-hidden bg-white dark:bg-zinc-900 shadow-sm">
        <Table>
          <TableHeader class="bg-zinc-50 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border-b">
            <TableRow>
              <TableHead class="px-6 py-3 font-medium">User</TableHead>
              <TableHead class="px-6 py-3 font-medium">Role</TableHead>
              <TableHead class="px-6 py-3 font-medium">Joined</TableHead>
              <TableHead class="px-6 py-3 text-right">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody class="divide-y divide-zinc-200 dark:divide-zinc-800">
            <TableRow v-for="user in users.data" :key="user.id" class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50 transition-colors">
              <TableCell class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <Avatar>
                    <AvatarImage :src="user.profile_photo_url" />
                    <AvatarFallback>{{ user.name.charAt(0) }}</AvatarFallback>
                  </Avatar>
                  <div>
                    <div class="font-medium text-zinc-900 dark:text-zinc-100">{{ user.name }}</div>
                    <div class="text-zinc-500 dark:text-zinc-400 text-xs">{{ user.email }}</div>
                  </div>
                </div>
              </TableCell>
              <TableCell class="px-6 py-4">
                <Badge variant="secondary" class="capitalize">
                  {{ user.role }}
                </Badge>
              </TableCell>
              <TableCell class="px-6 py-4 text-zinc-500 dark:text-zinc-400">
                {{ user.created_at }}
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
                    <Link :href="edit(user.id)">
                      <DropdownMenuItem>
                        <Pencil class="mr-2 h-4 w-4" />
                        Edit
                      </DropdownMenuItem>
                    </Link>
                    <DropdownMenuItem @click="deleteUser(user.id)" class="text-red-600 focus:text-red-600">
                      <Trash2 class="mr-2 h-4 w-4" />
                      Delete
                    </DropdownMenuItem>
                  </DropdownMenuContent>
                </DropdownMenu>
              </TableCell>
            </TableRow>
            <TableRow v-if="users.data.length === 0">
              <TableCell colspan="4" class="px-6 py-12 text-center text-zinc-500"> No users found. </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
