<script setup lang="ts">
import AuthLayout from "@/layouts/AuthLayout.vue";
import twoFactorLogin from "@/routes/two-factor/login";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
  code: "",
  recovery_code: "",
});

const recovery = ref(false);

const submit = () => {
  form.post(twoFactorLogin.store.url(), {
    onFinish: () => form.reset("code", "recovery_code"),
  });
};
</script>

<template>
  <AuthLayout>
    <Head title="Two-Factor Challenge" />

    <div class="mx-auto max-w-2xl space-y-8">
      <div class="space-y-2 text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">Multi-factor</p>
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Two-factor authentication</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          {{ recovery ? "Enter one of your recovery codes to sign in." : "Please confirm access to your account by entering the authentication code provided by your authenticator app." }}
        </p>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white/90 p-8 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/90">
        <form class="space-y-6" @submit.prevent="submit">
          <div class="space-y-2">
            <label
              :for="recovery ? 'recovery_code' : 'code'"
              class="text-sm font-medium text-gray-900 dark:text-gray-100"
            >
              {{ recovery ? "Recovery code" : "Authentication code" }}
            </label>
            <input
              v-if="!recovery"
              id="code"
              v-model="form.code"
              type="text"
              inputmode="numeric"
              autocomplete="one-time-code"
              required
              class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
            />
            <input
              v-else
              id="recovery_code"
              v-model="form.recovery_code"
              type="text"
              autocomplete="one-time-code"
              required
              class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
            />
            <p v-if="form.errors.code || form.errors.recovery_code" class="text-sm text-rose-600 dark:text-rose-400">
              {{ form.errors.code ?? form.errors.recovery_code }}
            </p>
          </div>

          <div class="flex flex-wrap gap-3 text-sm text-gray-700 dark:text-gray-300">
            <button
              type="button"
              class="rounded-lg bg-gray-100 px-3 py-2 font-semibold text-gray-900 shadow-sm transition hover:bg-gray-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700"
              @click="recovery = !recovery; form.clearErrors(); form.reset('code', 'recovery_code');"
            >
              {{ recovery ? "Use authentication code" : "Use recovery code" }}
            </button>
            <Link :href="twoFactorLogin.store.url()" class="inline-flex items-center font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
              Having trouble?
            </Link>
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="group relative inline-flex w-full items-center justify-center overflow-hidden rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
          >
            <span class="absolute inset-0 -z-10 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-0 transition group-hover:opacity-100" />
            Verify
          </button>
        </form>
      </div>
    </div>
  </AuthLayout>
</template>
