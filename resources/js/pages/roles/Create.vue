<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Form, Head, Link, useForm } from "@inertiajs/vue3";
  import { index, store } from "@/routes/roles";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Label } from "@/components/ui/label";
  import { Checkbox } from "@/components/ui/checkbox";
  import InputError from "@/components/InputError.vue";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft } from "lucide-vue-next";

  defineProps<{
    permissions: string[];
  }>();

  const form = useForm({
    name: "",
    permissions: [] as string[],
  });
</script>

<template>
  <Head title="Create Role" />

  <AppLayout
    :breadcrumbs="[
      { title: 'Roles', href: index().url },
      { title: 'Create', href: '#' },
    ]"
  >
    <div class="max-w-2xl mx-auto px-4 py-8">
      <Link :href="index().url" class="inline-flex items-center text-sm text-zinc-500 hover:text-zinc-700 mb-6">
        <ChevronLeft class="w-4 h-4 mr-1" />
        Back to Roles
      </Link>

      <Heading title="Create New Role" description="Define a new role and assign its permissions." class="mb-8" />

      <!-- Used inline wayfinder route helper directly in the submit handler -->
      <Form :action="store()" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <div class="grid gap-2">
          <Label for="name">Role Name</Label>
          <Input id="name" v-model="form.name" type="text" placeholder="e.g. Editor" required autofocus />
          <InputError :message="form.errors.name" />
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
          <Button type="submit" :disabled="form.processing"> Create Role </Button>
        </div>
      </Form>
    </div>
  </AppLayout>
</template>
