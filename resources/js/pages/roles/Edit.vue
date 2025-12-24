<script setup lang="ts">
  import { computed } from "vue";
  import AppLayout from "@/layouts/AppLayout.vue";
  import { update, index } from "@/routes/roles";
  import { Head, Link, Form, useForm } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Label } from "@/components/ui/label";
  import { Checkbox } from "@/components/ui/checkbox";
  import InputError from "@/components/InputError.vue";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft } from "lucide-vue-next";
  import Spinner from "@/components/ui/spinner/Spinner.vue";

  import type { RoleData } from "@/types/generated";

  const props = defineProps<{
    role: RoleData;
    permissions: string[];
  }>();

  const form = useForm({
    name: props.role.name,
    permissions: [...(props.role.permissions as unknown as string[])] as string[],
  });

  const selected = computed(() => new Set(form.permissions));

  function togglePermission(permission: string, checked: boolean) {
    if (checked) {
      form.permissions.push(permission);
    } else {
      form.permissions = form.permissions.filter((p) => p !== permission);
    }
  }
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

      <Heading title="Edit Role" :description="`Update permissions for ${props.role.name}`" class="mb-8" />

      <Form :action="update(props.role.id!).url" method="put" :data="form" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm" v-slot="{ processing, errors }">
        <div class="grid gap-2">
          <Input id="name" v-model="form.name" type="text" label="Role Name" required :error="errors.name" />
        </div>

        <div class="grid gap-4">
          <Label class="text-base font-medium">Permissions</Label>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border rounded-md p-4 max-h-100 overflow-y-auto">
            <div v-for="permission in props.permissions" :key="permission" class="flex items-center space-x-2">
              <Checkbox :id="permission" :checked="selected.has(permission)" @update:checked="togglePermission(permission, $event)" />
              <Label :for="permission" class="cursor-pointer">{{ permission }}</Label>
            </div>
          </div>
          <InputError :message="errors.permissions" />
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="processing">
            <Spinner v-if="processing" class="mr-2" />
            {{ processing ? "Updating..." : "Update Role" }}
          </Button>
        </div>
      </Form>
    </div>
  </AppLayout>
</template>
