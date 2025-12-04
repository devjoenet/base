<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { logout } from "@/routes";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps<{
  status?: string;
}>();

const form = useForm({});

const resent = computed(() => props.status === "verification-link-sent");

const submit = () => {
  form.post("/email/verification-notification");
};
</script>

<template>
  <AppLayout>
    <Head title="Verify Email" />

    <div class="mx-auto max-w-3xl space-y-8 rounded-2xl border border-indigo-200/60 bg-indigo-50/60 p-8 text-indigo-900 shadow-sm dark:border-indigo-500/30 dark:bg-indigo-950/30 dark:text-indigo-50">
      <div class="space-y-3">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-300">Verify email</p>
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Check your inbox</h1>
        <p class="text-sm text-gray-700 dark:text-gray-200">
          Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn’t receive the email, we will gladly send you another.
        </p>
        <p v-if="resent" class="rounded-lg bg-white/60 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm ring-1 ring-emerald-100 dark:bg-emerald-500/20 dark:text-emerald-100 dark:ring-emerald-400/40">
          A new verification link has been sent to the email address you provided during registration.
        </p>
      </div>

      <div class="flex flex-wrap gap-4">
        <button
          type="button"
          :disabled="form.processing"
          class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
          @click="submit"
        >
          Resend verification email
        </button>
        <Link
          method="post"
          :href="logout()"
          as="button"
          class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm transition hover:border-gray-400 hover:text-gray-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 dark:border-white/10 dark:bg-gray-900 dark:text-white dark:hover:border-white/20"
        >
          Log out
        </Link>
      </div>
    </div>
  </AppLayout>
</template>
