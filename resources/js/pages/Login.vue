<script setup lang="ts">
  import AuthLayout from "@/layouts/AuthLayout.vue";
  import { register, password } from "@/routes";
  import loginStore from "@/routes/login";
  import { Head, Link, useForm } from "@inertiajs/vue3";
  import { computed } from "vue";

  const props = defineProps<{
    canResetPassword?: boolean;
    status?: string;
  }>();

  const form = useForm({
    email: "",
    password: "",
    remember: false,
  });

  const hasStatus = computed(() => Boolean(props.status));

  const submit = () => {
    form.post(loginStore.store.url(), {
      onFinish: () => form.reset("password"),
    });
  };
</script>

<template>
  <AuthLayout>
    <Head title="Log in" />

    <div class="mx-auto max-w-3xl space-y-8">
      <div class="space-y-3 text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">Welcome back</p>
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white sm:text-4xl">Sign in to your account</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Use your email and password to access your dashboard.</p>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white/90 p-8 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/90">
        <form class="space-y-6" @submit.prevent="submit">
          <div class="space-y-2">
            <div class="flex items-center justify-between text-sm font-medium text-gray-900 dark:text-gray-100">
              <label for="email">Email address</label>
              <Link :href="register()" class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"> Create account </Link>
            </div>
            <input
              id="email"
              v-model="form.email"
              type="email"
              autocomplete="username"
              required
              class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
            />
            <p v-if="form.errors.email" class="text-sm text-rose-600 dark:text-rose-400">{{ form.errors.email }}</p>
          </div>

          <div class="space-y-2">
            <div class="flex items-center justify-between text-sm font-medium text-gray-900 dark:text-gray-100">
              <label for="password">Password</label>
              <Link v-if="canResetPassword" :href="password.request()" class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"> Forgot password? </Link>
            </div>
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

          <div class="flex items-center justify-between text-sm text-gray-700 dark:text-gray-300">
            <label class="inline-flex items-center gap-3">
              <input v-model="form.remember" type="checkbox" class="h-5 w-5 rounded-lg border border-gray-300 bg-white text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500 dark:border-white/10 dark:bg-gray-950" />
              <span class="font-medium">Remember me</span>
            </label>
            <span v-if="hasStatus" class="text-sm text-emerald-600 dark:text-emerald-400">{{ status }}</span>
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="group relative inline-flex w-full items-center justify-center overflow-hidden rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
          >
            <span class="absolute inset-0 -z-10 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-0 transition group-hover:opacity-100" />
            Sign in
          </button>
        </form>
      </div>
    </div>
  </AuthLayout>
</template>
