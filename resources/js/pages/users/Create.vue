<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Head, Link, useForm } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Label } from "@/components/ui/label";
  import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"; // Assuming this exists or I'll provide fallback
  import InputError from "@/components/InputError.vue";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft } from "lucide-vue-next";

  defineProps<{
    roles: string[];
  }>();

  const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "",
  });

  const submit = () => {
    form.post(route("users.store"));
  };
</script>

<template>
  <Head title="Create User" />

  <AppLayout
    :breadcrumbs="[
      { title: 'Users', href: route('users.index') },
      { title: 'Create', href: '#' },
    ]"
  >
    <div class="max-w-2xl mx-auto px-4 py-8">
      <Link :href="route('users.index')" class="inline-flex items-center text-sm text-zinc-500 hover:text-zinc-700 mb-6">
        <ChevronLeft class="w-4 h-4 mr-1" />
        Back to Users
      </Link>

      <Heading title="Create New User" description="Add a new user to the system." class="mb-8" />

      <form @submit.prevent="submit" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <div class="grid gap-2">
          <Label for="name">Name</Label>
          <Input id="name" v-model="form.name" type="text" placeholder="John Doe" required autofocus />
          <InputError :message="form.errors.name" />
        </div>

        <div class="grid gap-2">
          <Label for="email">Email</Label>
          <Input id="email" v-model="form.email" type="email" placeholder="john@example.com" required />
          <InputError :message="form.errors.email" />
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="grid gap-2">
            <Label for="password">Password</Label>
            <Input id="password" v-model="form.password" type="password" required />
            <InputError :message="form.errors.password" />
          </div>

          <div class="grid gap-2">
            <Label for="password_confirmation">Confirm Password</Label>
            <Input id="password_confirmation" v-model="form.password_confirmation" type="password" required />
          </div>
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="form.processing"> Create User </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
