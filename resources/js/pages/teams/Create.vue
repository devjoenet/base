<script setup lang="ts">
  import { Head, Form } from "@inertiajs/vue3";
  import AppLayout from "@/layouts/AppLayout.vue";
  import Heading from "@/components/Heading.vue";
  import InputError from "@/components/InputError.vue";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import { Label } from "@/components/ui/label";
  import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
  import { store } from "@/actions/App/Http/Controllers/TeamController";
  import { Spinner } from "@/components/ui/spinner";
</script>

<template>
  <AppLayout>
    <Head title="Create Team" />

    <div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
      <Heading title="Create Team" description="Create a new team to collaborate with others on projects." />

      <div class="mt-8">
        <Card>
          <CardHeader>
            <CardTitle>Team Details</CardTitle>
            <CardDescription> Give your team a unique name to identify it. </CardDescription>
          </CardHeader>
          <CardContent>
            <Form :action="store()" #default="{ errors, processing }">
              <div class="grid gap-2">
                <Label for="name">Team Name</Label>
                <Input id="name" type="text" required autofocus placeholder="e.g. Acme Corp" />
                <InputError :message="errors.name" />
              </div>

              <div class="flex items-center justify-end">
                <Button type="submit" :disabled="processing"> <Spinner v-if="processing" /> Create Team </Button>
              </div>
            </Form>
          </CardContent>
        </Card>
      </div>
    </div>
  </AppLayout>
</template>
