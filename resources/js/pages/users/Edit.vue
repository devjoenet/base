<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Head, Link, useForm } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Label } from "@/components/ui/label";
  import InputError from "@/components/InputError.vue";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft } from "lucide-vue-next";

  const props = defineProps<{
    user: {
      id: number;
      name: string;
      email: string;
      role: string;
    };
    roles: string[];
  }>();

  const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.role,
    password: "",
    password_confirmation: "",
  });

  const submit = () => {
    form.put(route("users.update", props.user.id));
  };
</script>

<template>
  <Head title="Edit User" />

  <AppLayout
    :breadcrumbs="[
      { title: 'Users', href: route('users.index') },
      { title: 'Edit', href: '#' },
    ]"
  >
    <div class="max-w-2xl mx-auto px-4 py-8">
      <Link :href="route('users.index')" class="inline-flex items-center text-sm text-zinc-500 hover:text-zinc-700 mb-6">
        <ChevronLeft class="w-4 h-4 mr-1" />
        Back to Users
      </Link>

      <Heading title="Edit User" :description="`Update details for ${user.name}`" class="mb-8" />

      <form @submit.prevent="submit" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <div class="grid gap-2">
          <Input
            id="name"
            v-model="form.name"
            type="text"
            label="Name"
            required
            :error="form.errors.name"
          />
        </div>

        <div class="grid gap-2">
          <Input
            id="email"
            v-model="form.email"
            type="email"
            label="Email"
            required
            :error="form.errors.email"
          />
        </div>

        <div class="grid gap-2">
          <Label for="role">Role</Label>
          <select
            id="role"
            v-model="form.role"
            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
          >
            <option value="" disabled>Select a role</option>
            <option v-for="role in roles" :key="role" :value="role" class="capitalize">{{ role }}</option>
          </select>
          <InputError :message="form.errors.role" />
        </div>

        <div class="border-t pt-6 mt-6">
          <h3 class="text-sm font-medium mb-4">Change Password <span class="text-zinc-500 font-normal">(Optional)</span></h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="grid gap-2">
              <Input
                id="password"
                v-model="form.password"
                type="password"
                label="New Password"
                :error="form.errors.password"
              />
            </div>

            <div class="grid gap-2">
              <Input
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                label="Confirm Password"
                :error="form.errors.password_confirmation"
              />
            </div>
          </div>
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="form.processing"> Update User </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
