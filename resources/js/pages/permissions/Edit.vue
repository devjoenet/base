<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Head, Link, useForm } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Label } from "@/components/ui/label";
  import InputError from "@/components/InputError.vue";
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

  const submit = () => {
    form.put(update(props.permission.id).url);
  };
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

      <form @submit.prevent="submit" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <div class="grid gap-2">
          <Label for="name">Permission Name</Label>
          <div class="relative">
            <ShieldCheck class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-zinc-400" />
            <Input id="name" v-model="form.name" type="text" class="pl-9" required />
          </div>
          <InputError :message="form.errors.name" />
        </div>

        <div class="grid gap-2">
          <Label for="guard_name">Guard</Label>
          <Input id="guard_name" v-model="form.guard_name" type="text" />
          <InputError :message="form.errors.guard_name" />
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="form.processing"> Update Permission </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
