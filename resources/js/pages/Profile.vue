<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import userPassword from "@/routes/user-password";
  import userProfileInformation from "@/routes/user-profile-information";
  import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
  import { computed } from "vue";
  import type { AppPageProps } from "@/types";

  const page = usePage<AppPageProps<{ mustVerifyEmail?: boolean; status?: string }>>();
  const user = computed(() => page.props.auth.user);

  const profileForm = useForm({
    name: user.value.name,
    email: user.value.email,
  });

  const passwordForm = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
  });

  const submitProfile = () => {
    profileForm.put(userProfileInformation.update.url(), {
      preserveScroll: true,
    });
  };

  const submitPassword = () => {
    passwordForm.put(userPassword.update.url(), {
      preserveScroll: true,
      onSuccess: () => passwordForm.reset(),
      onFinish: () => passwordForm.reset("current_password"),
    });
  };
</script>

<template>
  <AppLayout>
    <Head title="Profile" />

    <div class="space-y-10">
      <div class="rounded-2xl border border-gray-200 bg-white/90 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/90">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-200 px-6 py-4 dark:border-white/10">
          <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">Profile</p>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Personal information</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Update your name and email address.</p>
          </div>
          <p v-if="profileForm.recentlySuccessful" class="rounded-lg bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700 ring-1 ring-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-100 dark:ring-emerald-500/30">Saved</p>
        </div>

        <form class="space-y-6 p-6" @submit.prevent="submitProfile">
          <div class="grid gap-6 sm:grid-cols-2">
            <div class="space-y-2">
              <label for="name" class="text-sm font-medium text-gray-900 dark:text-gray-100">Name</label>
              <input
                id="name"
                v-model="profileForm.name"
                type="text"
                autocomplete="name"
                required
                class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
              />
              <p v-if="profileForm.errors.name" class="text-sm text-rose-600 dark:text-rose-400">{{ profileForm.errors.name }}</p>
            </div>
            <div class="space-y-2">
              <label for="email" class="text-sm font-medium text-gray-900 dark:text-gray-100">Email</label>
              <input
                id="email"
                v-model="profileForm.email"
                type="email"
                autocomplete="email"
                required
                class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
              />
              <p v-if="profileForm.errors.email" class="text-sm text-rose-600 dark:text-rose-400">{{ profileForm.errors.email }}</p>
              <p v-else-if="page.props.mustVerifyEmail && !user.email_verified_at" class="text-sm text-gray-600 dark:text-gray-400">
                Your email address is unverified.
                <Link method="post" href="/email/verification-notification" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"> Click here to resend verification. </Link>
                <span v-if="page.props.status === 'verification-link-sent'" class="block text-emerald-600 dark:text-emerald-400"> A new verification link has been sent to your email address. </span>
              </p>
            </div>
          </div>

          <div class="flex justify-end">
            <button
              type="submit"
              :disabled="profileForm.processing"
              class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
            >
              Save changes
            </button>
          </div>
        </form>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white/90 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-900/90">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-200 px-6 py-4 dark:border-white/10">
          <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">Security</p>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Update password</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Ensure your account stays protected.</p>
          </div>
          <p v-if="passwordForm.recentlySuccessful" class="rounded-lg bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700 ring-1 ring-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-100 dark:ring-emerald-500/30">Updated</p>
        </div>

        <form class="space-y-6 p-6" @submit.prevent="submitPassword">
          <div class="space-y-2">
            <label for="current_password" class="text-sm font-medium text-gray-900 dark:text-gray-100">Current password</label>
            <input
              id="current_password"
              v-model="passwordForm.current_password"
              type="password"
              autocomplete="current-password"
              required
              class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
            />
            <p v-if="passwordForm.errors.current_password" class="text-sm text-rose-600 dark:text-rose-400">{{ passwordForm.errors.current_password }}</p>
          </div>

          <div class="grid gap-6 sm:grid-cols-2">
            <div class="space-y-2">
              <label for="password" class="text-sm font-medium text-gray-900 dark:text-gray-100">New password</label>
              <input
                id="password"
                v-model="passwordForm.password"
                type="password"
                autocomplete="new-password"
                required
                class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
              />
              <p v-if="passwordForm.errors.password" class="text-sm text-rose-600 dark:text-rose-400">{{ passwordForm.errors.password }}</p>
            </div>
            <div class="space-y-2">
              <label for="password_confirmation" class="text-sm font-medium text-gray-900 dark:text-gray-100">Confirm new password</label>
              <input
                id="password_confirmation"
                v-model="passwordForm.password_confirmation"
                type="password"
                autocomplete="new-password"
                required
                class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-900 shadow-sm transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70 dark:border-white/10 dark:bg-gray-950 dark:text-white"
              />
              <p v-if="passwordForm.errors.password_confirmation" class="text-sm text-rose-600 dark:text-rose-400">{{ passwordForm.errors.password_confirmation }}</p>
            </div>
          </div>

          <div class="flex justify-end gap-3">
            <button
              type="button"
              class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm transition hover:border-gray-300 hover:text-gray-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 dark:border-white/10 dark:bg-gray-950 dark:text-white dark:hover:border-white/20"
              @click="passwordForm.reset()"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="passwordForm.processing"
              class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
            >
              Update password
            </button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>
