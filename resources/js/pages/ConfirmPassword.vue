<script setup lang="ts">
import AuthLayout from "@/layouts/AuthLayout.vue";
import confirmPassword from "@/routes/password/confirm";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
  password: "",
});

const submit = () => {
  form.post(confirmPassword.store.url(), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <AuthLayout>
    <Head title="Confirm Password" />

    <div class="mx-auto max-w-2xl space-y-8">
      <div class="space-y-2 text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">Security check</p>
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Confirm your password</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">For your security, please confirm your password to continue.</p>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white/90 p-8 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/90">
        <form class="space-y-6" @submit.prevent="submit">
          <div class="space-y-2">
            <label for="password" class="text-sm font-medium text-gray-900 dark:text-gray-100">Password</label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              autocomplete="current-password"
              required
              class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
            />
            <p v-if="form.errors.password" class="text-sm text-rose-600 dark:text-rose-400">{{ form.errors.password }}</p>
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="group relative inline-flex w-full items-center justify-center overflow-hidden rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
          >
            <span class="absolute inset-0 -z-10 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-0 transition group-hover:opacity-100" />
            Confirm password
          </button>
        </form>
      </div>
    </div>
  </AuthLayout>
</template>
