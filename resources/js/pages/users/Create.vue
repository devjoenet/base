<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { SelectRoot, SelectContent, SelectItem } from "@/components/ui/select";
  import { Spinner } from "@/components/ui/spinner";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft } from "lucide-vue-next";
  import { index, store } from "@/routes/users";
  import { Head, Link, Form, useForm } from "@inertiajs/vue3";
  import type { UserData } from "@/types/generated";
  import { kebabToTitle } from "@/lib/utils";

  const props = defineProps<{
    user: UserData;
    roles: string[];
  }>();

  const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: "",
    password_confirmation: "",
    role: props.user.role || "",
  });
</script>

<template>
  <Head title="Create User" />

  <AppLayout
    :breadcrumbs="[
      { title: 'Users', href: index().url },
      { title: 'Create', href: '#' },
    ]"
  >
    <div class="max-w-2xl mx-auto px-4 py-8">
      <Link :href="index().url" class="inline-flex items-center text-sm text-zinc-500 hover:text-zinc-700 mb-6">
        <ChevronLeft class="w-4 h-4 mr-1" />
        Back to Users
      </Link>

      <Heading title="Create User" description="Enter details to add a new user." class="mb-8" />
      <Form :action="store().url" method="post" :data="form" @success="form.reset('password', 'password_confirmation')" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm" v-slot="{ processing, errors }">
        <div class="grid gap-2">
          <Input id="name" v-model="form.name" type="text" label="Name" required :error="errors.name" />
        </div>

        <div class="grid gap-2">
          <Input id="email" v-model="form.email" type="email" label="Email" required :error="errors.email" />
        </div>

        <div class="grid gap-2">
          <SelectRoot v-model="form.role" placeholder="Select a role">
            <SelectContent>
              <SelectItem value="" disabled>Select a role</SelectItem>
              <SelectItem v-for="role in props.roles" :key="role" :value="role" :label="kebabToTitle(role)" class="capitalize">
                {{ kebabToTitle(role) }}
              </SelectItem>
            </SelectContent>
          </SelectRoot>
          <p v-if="errors.role" class="text-sm text-error">{{ errors.role }}</p>
        </div>

        <div class="border-t pt-6 mt-6">
          <h3 class="text-sm font-medium mb-4">Password</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="grid gap-2">
              <Input id="password" v-model="form.password" type="password" label="Password" required :error="errors.password" />
            </div>

            <div class="grid gap-2">
              <Input id="password_confirmation" v-model="form.password_confirmation" type="password" label="Confirm Password" required :error="errors.password_confirmation" />
            </div>
          </div>
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="processing">
            <Spinner v-if="processing" />
            {{ processing ? "Creating..." : "Create User" }}
          </Button>
        </div>
      </Form>
    </div>
  </AppLayout>
</template>
