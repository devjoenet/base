<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Head, Link, useForm } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { SelectRoot, SelectContent, SelectItem } from "@/components/ui/select";
  import { Spinner } from "@/components/ui/spinner";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft } from "lucide-vue-next";
  import { index, store } from "@/routes/users";
  import { UserData } from "@/types/generated";
  import { kebabToTitle } from "@/lib/utils";

  const props = defineProps<{
    user: UserData;
    roles: string[];
  }>();

  const form = useForm({
    name: props.user.name,
    email: props.user.email,
    profile_photo_url: props.user.profile_photo_url,
    email_verrified_at: props.user.email_verified_at,
    password: "",
    password_confirmation: "",
    two_factor_secret: props.user.two_factor_secret,
    two_factor_confirmed_at: props.user.two_factor_confirmed_at,
    remember_token: props.user.remember_token,
    created_at: props.user.created_at,
    updated_at: props.user.updated_at,
    role: props.user.role,
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

      <Heading title="Create User" description="Enter detials to add a new user." class="mb-8" />
      <form @submit="store()" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <div class="grid gap-2">
          <Input id="name" v-model="form.name" type="text" label="Name" required :error="form.errors.name" />
        </div>

        <div class="grid gap-2">
          <Input id="email" v-model="form.email" type="email" label="Email" required :error="form.errors.email" />
        </div>

        <div class="grid gap-2">
          <SelectRoot v-model="form.role" :error="form.errors.role" placeholder="Select a role">
            <SelectContent>
              <SelectItem value="" disabled>Select a role</SelectItem>
              <SelectItem v-for="role in props.roles" :key="role" :value="role" :label="kebabToTitle(role)" class="capitalize">
                {{ kebabToTitle(role) }}
              </SelectItem>
            </SelectContent>
          </SelectRoot>
        </div>

        <div class="border-t pt-6 mt-6">
          <h3 class="text-sm font-medium mb-4">Change Password <span class="text-zinc-500 font-normal">(Optional)</span></h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="grid gap-2">
              <Input id="password" v-model="form.password" type="password" label="New Password" :error="form.errors.password" />
            </div>

            <div class="grid gap-2">
              <Input id="password_confirmation" v-model="form.password_confirmation" type="password" label="Confirm Password" :error="form.errors.password_confirmation" />
            </div>
          </div>
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="form.processing">
            <Spinner v-if="form.processing" />
            {{ form.processing ? "Updating..." : "Update User" }}
          </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
