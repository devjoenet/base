<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Head, Link, Form, useForm } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft, ShieldCheck } from "lucide-vue-next";
  import { index, update } from "@/routes/permissions";

  const props = defineProps<{
    permission: {
      id: number;
      name: string;
      guard_name: string;
    };
    default_guard: string;
  }>();

  const form = useForm({
    name: props.permission.name,
    guard_name: props.permission.guard_name || props.default_guard,
  });
</script>

<template>
  <Head title="Edit Permission" />

  <AppLayout
    :breadcrumbs="[
      { title: 'Permissions', href: index().url },
      { title: 'Edit', href: '#' },
    ]"
  >
    <div class="max-w-2xl mx-auto px-4 py-8">
      <Link :href="index().url" class="inline-flex items-center text-sm text-zinc-500 hover:text-zinc-700 mb-6">
        <ChevronLeft class="w-4 h-4 mr-1" />
        Back to Permissions
      </Link>

      <Heading title="Edit Permission" :description="`Update ${permission.name}`" class="mb-8" />

      <Form :action="update(props.permission.id)" method="post" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm" #default="{ processing, errors }">
        <div class="grid gap-2">
          <Input id="name" v-model="form.name" type="text" label="Permission Name" required :error="errors.name">
            <template #leading>
              <ShieldCheck class="h-5 w-5 text-muted-foreground" />
            </template>
          </Input>
        </div>

        <div class="grid gap-2">
          <Input id="guard_name" v-model="form.guard_name" type="text" label="Guard" :error="errors.guard_name" />
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="processing">
            {{ processing ? "Updating Permission" : "Update Permission" }}
          </Button>
        </div>
      </Form>
    </div>
  </AppLayout>
</template>
