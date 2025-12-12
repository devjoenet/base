<script setup lang="ts">
  import { computed, watch } from "vue";
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
  import Spinner from "@/components/ui/spinner/Spinner.vue";

  type Role = { id: number; name: string; permissions: string[] };

  const props = defineProps<{
    role: Role;
    permissions: string[];
  }>();

  const form = useForm({
    permissions: [...props.role.permissions] as string[],
  });

  watch(
    () => props.role.permissions,
    (next) => {
      form.permissions = [...next];
    },
    { deep: true },
  );

  const selected = computed(() => new Set(form.permissions));

  function togglePermission(permission: string, checked: boolean) {
    const idx = form.permissions.indexOf(permission);

    if (checked) {
      if (idx === -1) form.permissions.push(permission);
    } else {
      if (idx !== -1) form.permissions.splice(idx, 1);
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

      <Heading title="Edit Role" :description="`Update permissions for ${role.name}`" class="mb-8" />

      <Form v-bind="store.form()" v-slot="{ errors, processing }" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <div class="grid gap-2">
          <Input id="name" :v-model="role.name" type="text" label="Role Name" required :error="errors.name" />
        </div>

        <div class="grid gap-4">
          <Label class="text-base font-medium">Permissions</Label>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border rounded-md p-4 max-h-100 overflow-y-auto">
            <div v-for="permission in props.permissions" :key="permission" class="flex items-center space-x-2">
              <Checkbox :id="permission" :checked="selected.has(permission)" @change="togglePermission(permission, ($event.target as HTMLInputElement).checked)" />
            </div>
          </div>
          <InputError :message="errors.permissions" />
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="processing"> <Spinner v-if="processing" /> Role </Button>
        </div>
      </Form>
    </div>
  </AppLayout>
</template>
