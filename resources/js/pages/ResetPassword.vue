<script setup lang="ts">
  import AuthLayout from "@/layouts/AuthLayout.vue";
  import passwordRoutes from "@/routes/password";
  import { Head, useForm } from "@inertiajs/vue3";

  const props = defineProps<{
    email: string;
    token: string;
  }>();

  const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
  });

  const submit = () => {
    form.post(passwordRoutes.update.url(), {
      onFinish: () => form.reset("password", "password_confirmation"),
    });
  };
</script>

<template>
  <AuthLayout>
    <Head title="Reset Password" />

    <div class="mx-auto max-w-2xl space-y-8">
      <div class="space-y-2 text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">Create new password</p>
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Reset password</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Securely set a new password for your account.</p>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white/90 p-8 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/90">
        <form class="space-y-6" @submit.prevent="submit">
          <div class="space-y-2">
            <label for="email" class="text-sm font-medium text-gray-900 dark:text-gray-100">Email</label>
            <input id="email" v-model="form.email" type="email" readonly class="block w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 shadow-sm dark:border-white/10 dark:bg-gray-900 dark:text-white" />
            <p v-if="form.errors.email" class="text-sm text-rose-600 dark:text-rose-400">{{ form.errors.email }}</p>
          </div>

          <div class="space-y-2">
            <label for="password" class="text-sm font-medium text-gray-900 dark:text-gray-100">New password</label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              autocomplete="new-password"
              required
              class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
            />
            <p v-if="form.errors.password" class="text-sm text-rose-600 dark:text-rose-400">{{ form.errors.password }}</p>
          </div>

          <div class="space-y-2">
            <label for="password_confirmation" class="text-sm font-medium text-gray-900 dark:text-gray-100">Confirm password</label>
            <input
              id="password_confirmation"
              v-model="form.password_confirmation"
              type="password"
              autocomplete="new-password"
              required
              class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
            />
            <p v-if="form.errors.password_confirmation" class="text-sm text-rose-600 dark:text-rose-400">{{ form.errors.password_confirmation }}</p>
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="group relative inline-flex w-full items-center justify-center overflow-hidden rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
          >
            <span class="absolute inset-0 -z-10 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-0 transition group-hover:opacity-100" />
            Reset password
          </button>
        </form>
      </div>
    </div>
  </AuthLayout>
</template>
