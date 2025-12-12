<script setup lang="ts">
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Spinner } from "@/components/ui/spinner";
  import AuthLayout from "@/layouts/AuthLayout.vue";
  import { update } from "@/routes/password";
  import { Form, Head } from "@inertiajs/vue3";
  import { ref } from "vue";

  const props = defineProps<{
    token: string;
    email: string;
  }>();

  const inputEmail = ref(props.email);
</script>

<template>
  <AuthLayout title="Reset password" description="Please enter your new password below">
    <Head title="Reset password" />

    <Form v-bind="update.form()" :transform="(data) => ({ ...data, token, email })" :reset-on-success="['password', 'password_confirmation']" v-slot="{ errors, processing }">
      <div class="grid gap-6">
        <div class="grid gap-2">
          <Input id="email" v-model="inputEmail" type="email" name="email" label="Email" autocomplete="email" readonly :error="errors.email" />
        </div>

        <div class="grid gap-2">
          <Input id="password" type="password" name="password" label="Password" autocomplete="new-password" autofocus placeholder="Password" :error="errors.password" />
        </div>

        <div class="grid gap-2">
          <Input id="password_confirmation" type="password" name="password_confirmation" label="Confirm Password" autocomplete="new-password" placeholder="Confirm password" :error="errors.password_confirmation" />
        </div>

        <Button type="submit" class="mt-4 w-full" :disabled="processing" data-test="reset-password-button">
          <Spinner v-if="processing" />
          Reset password
        </Button>
      </div>
    </Form>
  </AuthLayout>
</template>
