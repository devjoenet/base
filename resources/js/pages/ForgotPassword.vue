<script setup lang="ts">
  import AuthLayout from "@/layouts/AuthLayout.vue";
  import { password } from "@/routes";
  import passwordRoutes from "@/routes/password";
  import { Head, Link, useForm } from "@inertiajs/vue3";

  const props = defineProps<{
    status?: string;
  }>();

  const form = useForm({
    email: "",
  });

  const submit = () => {
    form.post(passwordRoutes.email.url(), {
      onFinish: () => form.reset(),
    });
  };
</script>

<template>
  <AuthLayout>
    <Head title="Forgot Password" />

    <div class="mx-auto max-w-2xl space-y-8">
      <div class="space-y-2 text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">Reset access</p>
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Forgot password</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Enter your email address and we will send you a reset link.</p>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white/90 p-8 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/90">
        <form class="space-y-6" @submit.prevent="submit">
          <div class="space-y-2">
            <label for="email" class="text-sm font-medium text-gray-900 dark:text-gray-100">Email address</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              autocomplete="email"
              required
              class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
            />
            <p v-if="form.errors.email" class="text-sm text-rose-600 dark:text-rose-400">{{ form.errors.email }}</p>
          </div>

          <div class="flex items-center justify-between text-sm text-gray-700 dark:text-gray-300">
            <p v-if="status" class="text-emerald-600 dark:text-emerald-400">{{ status }}</p>
            <Link :href="password.request()" class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"> Need a different email? </Link>
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="group relative inline-flex w-full items-center justify-center overflow-hidden rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
          >
            <span class="absolute inset-0 -z-10 bg-gradient-to-r from-indigo-500 to-sky-500 opacity-0 transition group-hover:opacity-100" />
            Email password reset link
          </button>
        </form>
      </div>
    </div>
  </AuthLayout>
</template>
