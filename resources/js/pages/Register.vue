<script setup lang="ts">
import AuthLayout from "@/layouts/AuthLayout.vue";
import { login } from "@/routes";
import registerStore from "@/routes/register";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps<{
  terms?: boolean;
}>();

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: props.terms ?? false,
});

const submit = () => {
  form.post(registerStore.store.url(), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <AuthLayout>
    <Head title="Register" />

    <div class="mx-auto max-w-4xl space-y-8">
      <div class="space-y-3 text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">Get started</p>
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white sm:text-4xl">Create your account</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Join the team and start building with us.</p>
      </div>

      <div class="grid gap-6 lg:grid-cols-5">
        <div class="rounded-2xl border border-gray-200 bg-white/90 p-6 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/90 lg:col-span-3 lg:p-8">
          <form class="space-y-6" @submit.prevent="submit">
            <div class="space-y-2">
              <label for="name" class="text-sm font-medium text-gray-900 dark:text-gray-100">Full name</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                autocomplete="name"
                required
                class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
              />
              <p v-if="form.errors.name" class="text-sm text-rose-600 dark:text-rose-400">{{ form.errors.name }}</p>
            </div>

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

            <div class="grid gap-4 sm:grid-cols-2">
              <div class="space-y-2">
                <label for="password" class="text-sm font-medium text-gray-900 dark:text-gray-100">Password</label>
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
            </div>

            <label class="flex items-start gap-3 text-sm text-gray-700 dark:text-gray-300">
              <input
                v-model="form.terms"
                type="checkbox"
                class="mt-1 h-5 w-5 rounded-lg border border-gray-300 bg-white text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500 dark:border-white/10 dark:bg-gray-950"
              />
              <span class="leading-6">
                I agree to the
                <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">Terms &amp; Conditions</a>
              </span>
            </label>
            <p v-if="form.errors.terms" class="text-sm text-rose-600 dark:text-rose-400">{{ form.errors.terms }}</p>

            <button
              type="submit"
              :disabled="form.processing"
              class="group relative inline-flex w-full items-center justify-center overflow-hidden rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
            >
              <span class="absolute inset-0 -z-10 bg-gradient-to-r from-indigo-500 to-sky-500 opacity-0 transition group-hover:opacity-100" />
              Create account
            </button>
          </form>
        </div>

        <div class="rounded-2xl border border-dashed border-indigo-200 bg-indigo-50/70 p-6 text-sm shadow-sm dark:border-indigo-500/40 dark:bg-indigo-500/10 lg:col-span-2 lg:p-8">
          <h2 class="text-lg font-semibold text-indigo-900 dark:text-indigo-100">Already onboard?</h2>
          <p class="mt-2 text-indigo-800/80 dark:text-indigo-100/80">
            If you already have an account you can sign in instead.
          </p>
          <Link
            :href="login()"
            class="mt-4 inline-flex w-full items-center justify-center rounded-xl bg-white px-4 py-3 font-semibold text-indigo-700 shadow-sm ring-1 ring-indigo-200 transition hover:ring-indigo-300 dark:bg-indigo-500/20 dark:text-indigo-50 dark:ring-white/10"
          >
            Go to login
          </Link>
        </div>
      </div>
    </div>
  </AuthLayout>
</template>
