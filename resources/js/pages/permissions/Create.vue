<script setup lang="ts">
  import AppLayout from "@/layouts/AppLayout.vue";
  import { Form, Head, Link, useForm } from "@inertiajs/vue3";
  import { Button } from "@/components/ui/button";
  import { Input } from "@/components/ui/input";
  import Heading from "@/components/Heading.vue";
  import { ChevronLeft, ShieldCheck } from "lucide-vue-next";
  import { index, store } from "@/routes/permissions";

  const props = defineProps<{
    name: string;
    default_guard: string;
  }>();

  const form = useForm({
    name: "",
    guard_name: props.default_guard,
  });
</script>

<template>
  <Head title="Create Permission" />

  <AppLayout
    :breadcrumbs="[
      { title: 'Permissions', href: index().url },
      { title: 'Create', href: '#' },
    ]"
  >
    <div class="max-w-2xl mx-auto px-4 py-8">
      <Link :href="index().url" class="inline-flex items-center text-sm text-zinc-500 hover:text-zinc-700 mb-6">
        <ChevronLeft class="w-4 h-4 mr-1" />
        Back to Permissions
      </Link>

      <Heading title="Create Permission" description="Add a new permission for access control." class="mb-8" />

      <Form :action="store()" method="post" #default="{ processing, errors }" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <Input id="name" v-model="form.name" label="Permission Name" :error="errors.name" />
        <Input id="guard_name" v-model="form.guard_name" label="Guard" :error="errors.guard_name" />
        <Button type="submit" :disabled="processing">Create Permission</Button>
      </Form>

      <Form :action="store()" #default="{ processing, errors }">
        <div class="grid gap-2">
          <Input id="name" v-model="props.name" type="text" label="Permission Name" placeholder="e.g. manage posts" required autofocus :error="errors.name">
            <template #leading>
              <ShieldCheck class="h-5 w-5 text-muted-foreground" />
            </template>
          </Input>
        </div>

        <div class="grid gap-2">
          <Input id="guard_name" v-model="guard_name" type="text" label="Guard" placeholder="web" :error="errors.guard_name" />
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="processing"> Create Permission </Button>
        </div>
      </Form>

      <form @submit.prevent="submit" class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-lg border shadow-sm">
        <div class="grid gap-2">
          <Input id="name" v-model="name" type="text" label="Permission Name" placeholder="e.g. manage posts" required autofocus :error="errors.name">
            <template #leading>
              <ShieldCheck class="h-5 w-5 text-muted-foreground" />
            </template>
          </Input>
        </div>

        <div class="grid gap-2">
          <Input id="guard_name" v-model="guard_name" type="text" label="Guard" placeholder="web" :error="errors.guard_name" />
        </div>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="processing"> Create Permission </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
