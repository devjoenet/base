<script setup lang="ts">
  import TextLink from "@/components/TextLink.vue";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Spinner } from "@/components/ui/spinner";
  import AuthBase from "@/layouts/AuthLayout.vue";
  import { login } from "@/routes";
  import { store } from "@/routes/register";
  import { Form, Head } from "@inertiajs/vue3";
</script>

<template>
  <AuthBase title="Create an account" description="Enter your details below to create your account">
    <Head title="Register" />

    <Form v-bind="store.form()" :reset-on-success="['password', 'password_confirmation']" v-slot="{ errors, processing }" class="flex flex-col gap-6">
        <div class="grid gap-6">
          <div class="grid gap-2">
            <Input
              id="name"
              type="text"
              name="name"
              label="Name"
              required
              autofocus
              :tabindex="1"
              autocomplete="name"
              placeholder="Full name"
              :error="errors.name"
            />
          </div>

          <div class="grid gap-2">
            <Input
              id="email"
              type="email"
              name="email"
              label="Email address"
              required
              :tabindex="2"
              autocomplete="email"
              placeholder="email@example.com"
              :error="errors.email"
            />
          </div>

          <div class="grid gap-2">
            <Input
              id="password"
              type="password"
              name="password"
              label="Password"
              required
              :tabindex="3"
              autocomplete="new-password"
              placeholder="Password"
              :error="errors.password"
            />
          </div>

          <div class="grid gap-2">
            <Input
              id="password_confirmation"
              type="password"
              name="password_confirmation"
              label="Confirm password"
              required
              :tabindex="4"
              autocomplete="new-password"
              placeholder="Confirm password"
              :error="errors.password_confirmation"
            />
          </div>

        <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="processing" data-test="register-user-button">
          <Spinner v-if="processing" />
          Create account
        </Button>
      </div>

      <div class="text-center text-sm text-muted-foreground">
        Already have an account?
        <TextLink :href="login()" class="underline underline-offset-4" :tabindex="6">Log in</TextLink>
      </div>
    </Form>
  </AuthBase>
</template>
