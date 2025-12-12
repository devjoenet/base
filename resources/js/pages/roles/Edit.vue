<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { index, store } from "@/routes/roles";
  import { Head, Link, Form, useForm } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Label } from "@/components/ui/label";
  import { Checkbox } from "@/components/ui/checkbox";
  import InputError from "@/components/InputError.vue";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft } from "lucide-vue-next";

  const props = defineProps<{
    role: {
      id: number;
      name: string;
      permissions: string[];
    };
    permissions: string[];
  }>();

  const form = useForm({
    name: props.role.name,
    permissions: props.role.permissions,
  });
</script>

<template>
  <Head title="Edit Role" />

  <AppLayout
    :breadcrumbs="[
      { title: 'Roles', href: index().url },
      { title: 'Edit', href: '#' },
    ]"
  >
    <div class="max-w-2xl mx-auto px-4 py-8">
      <Link :href="index().url" class="inline-flex items-center text-sm text-zinc-500 hover:text-zinc-700 mb-6">
        <ChevronLeft class="w-4 h-4 mr-1" />
        Back to Roles
      </Link>

      <Heading title="Edit Role" :description="`Update permissions for ${role.name}`" class="mb-8" />

      <Form :action="store()" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <div class="grid gap-2">
          <Input id="name" v-model="form.name" type="text" label="Role Name" required :error="form.errors.name" />
        </div>

        <div class="grid gap-4">
          <Label class="text-base font-medium">Permissions</Label>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border rounded-md p-4 max-h-[400px] overflow-y-auto">
            <div v-for="permission in permissions" :key="permission" class="flex items-center space-x-2">
              <Checkbox
                :id="permission"
                :checked="form.permissions.includes(permission)"
                @update:checked="
                  (checked: boolean) => {
                    if (checked) form.permissions.push(permission);
                    else form.permissions = form.permissions.filter((p) => p !== permission);
                  }
                "
              />
              <label :for="permission" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 cursor-pointer capitalize">
                {{ permission }}
              </label>
            </div>
          </div>
          <InputError :message="form.errors.permissions" />
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="form.processing"> Update Role </Button>
        </div>
      </Form>
    </div>
  </AppLayout>
</template>
