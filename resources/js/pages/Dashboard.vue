<script setup lang="ts">
  import ActionTile from "@/components/ActionTile.vue";
  import ActivityItem from "@/components/ActivityItem.vue";
  import StatCard from "@/components/StatCard.vue";
  import AppLayout from "@/layouts/AppLayout.vue";
  import { dashboard } from "@/routes";
  import { Head } from "@inertiajs/vue3";
  import { ArrowTrendingUpIcon, BoltIcon, CalendarDaysIcon, CheckCircleIcon, ClockIcon, CubeTransparentIcon, InboxIcon, PlusIcon, SparklesIcon, Squares2X2Icon, UserGroupIcon } from "@heroicons/vue/24/outline";
  import { computed, defineOptions } from "vue";

  type Trend = "up" | "down" | "neutral";

  type Stat = {
    title: string;
    value: string;
    change?: {
      value?: string;
      label?: string;
      trend?: Trend;
    };
    icon?: typeof ArrowTrendingUpIcon;
  };

  type Activity = {
    title: string;
    description?: string;
    timestamp?: string;
    icon?: typeof ArrowTrendingUpIcon;
  };

  type Shortcut = {
    title: string;
    description?: string;
    href: string;
    icon?: typeof ArrowTrendingUpIcon;
  };

  const defaultStats: Stat[] = [
    {
      title: "Active subscribers",
      value: "18,245",
      change: { value: "+4.6%", label: "vs last month", trend: "up" },
      icon: UserGroupIcon,
    },
    {
      title: "Monthly revenue",
      value: "$46.2k",
      change: { value: "+12%", label: "recurring", trend: "up" },
      icon: SparklesIcon,
    },
    {
      title: "Avg. response time",
      value: "2m 14s",
      change: { value: "-18s", label: "support", trend: "up" },
      icon: ClockIcon,
    },
    {
      title: "Open tickets",
      value: "36",
      change: { value: "2 new", label: "today", trend: "neutral" },
      icon: InboxIcon,
    },
  ];

  const defaultActivity: Activity[] = [
    {
      title: "New team member added",
      description: "Drew Hansen joined the product team",
      timestamp: "2 hours ago",
      icon: UserGroupIcon,
    },
    {
      title: "Weekly release shipped",
      description: "Dashboard polish and billing updates",
      timestamp: "Yesterday",
      icon: CheckCircleIcon,
    },
    {
      title: "Live training session",
      description: "30 attendees joined for onboarding",
      timestamp: "Monday, 10:00 AM",
      icon: CalendarDaysIcon,
    },
  ];

  const defaultShortcuts: Shortcut[] = [
    {
      title: "Create project",
      description: "Start a new workspace for your team",
      href: dashboard().url,
      icon: Squares2X2Icon,
    },
    {
      title: "Schedule sync",
      description: "Plan your next product review",
      href: dashboard().url,
      icon: CalendarDaysIcon,
    },
    {
      title: "Automations",
      description: "Create rules and hand-offs",
      href: dashboard().url,
      icon: BoltIcon,
    },
  ];

  const props = withDefaults(
    defineProps<{
      stats?: Stat[];
      recentActivity?: Activity[];
      shortcuts?: Shortcut[];
      loading?: boolean;
    }>(),
    {
      stats: () => defaultStats,
      recentActivity: () => defaultActivity,
      shortcuts: () => defaultShortcuts,
      loading: false,
    },
  );

  defineOptions({ layout: AppLayout });

  const showEmptyActivity = computed(() => !props.loading && props.recentActivity.length === 0);
  const showEmptyShortcuts = computed(() => !props.loading && props.shortcuts.length === 0);
</script>

<template>
  <Head title="Dashboard" />
  <section class="space-y-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div class="space-y-1">
        <p class="text-sm font-medium text-indigo-600 dark:text-indigo-300">Welcome back</p>
        <h1 class="text-3xl font-semibold text-gray-900 sm:text-4xl dark:text-white">Dashboard</h1>
        <p class="text-base text-gray-600 dark:text-gray-300">Monitor performance, review activity, and jump into common actions.</p>
      </div>
      <div class="flex flex-wrap gap-3">
        <a class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md" :href="dashboard().url">
          <ArrowTrendingUpIcon class="size-4" aria-hidden="true" />
          View reports
        </a>
        <a class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-white/10 dark:bg-gray-900 dark:text-white" :href="dashboard().url">
          <CubeTransparentIcon class="size-4" aria-hidden="true" />
          Customize
        </a>
      </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
      <StatCard v-for="stat in props.stats" :key="stat.title" :title="stat.title" :value="stat.value" :change="stat.change" :icon="stat.icon" :loading="props.loading" />
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
      <section class="col-span-2 space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-white/5 dark:bg-gray-900">
        <div class="flex items-center justify-between gap-2">
          <div>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">Recent activity</p>
            <p class="text-sm text-gray-600 dark:text-gray-300">Stay up to date with what changed.</p>
          </div>
          <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-200 dark:ring-indigo-500/30">
            <ClockIcon class="size-4" aria-hidden="true" />
            Live
          </span>
        </div>
        <div class="space-y-3">
          <ul v-if="!showEmptyActivity" class="space-y-3">
            <ActivityItem v-for="item in props.recentActivity" :key="item.title + item.timestamp" :title="item.title" :description="item.description" :timestamp="item.timestamp" :icon="item.icon" :loading="props.loading" />
          </ul>
          <div v-else class="flex flex-col items-center justify-center gap-3 rounded-xl border border-dashed border-gray-200 p-6 text-center dark:border-white/10">
            <InboxIcon class="size-10 text-gray-300 dark:text-gray-600" aria-hidden="true" />
            <div class="space-y-1">
              <p class="text-sm font-semibold text-gray-900 dark:text-white">No activity yet</p>
              <p class="text-sm text-gray-600 dark:text-gray-300">New updates will appear here once your team gets moving.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-white/5 dark:bg-gray-900">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">Shortcuts</p>
            <p class="text-sm text-gray-600 dark:text-gray-300">Launch the actions you use most.</p>
          </div>
          <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600 ring-1 ring-gray-200 dark:bg-white/5 dark:text-gray-300 dark:ring-white/10"> Quickstart </span>
        </div>
        <div class="space-y-3">
          <div v-if="showEmptyShortcuts" class="flex flex-col items-center justify-center gap-3 rounded-xl border border-dashed border-gray-200 p-6 text-center dark:border-white/10">
            <CubeTransparentIcon class="size-10 text-gray-300 dark:text-gray-600" aria-hidden="true" />
            <div class="space-y-1">
              <p class="text-sm font-semibold text-gray-900 dark:text-white">No shortcuts configured</p>
              <p class="text-sm text-gray-600 dark:text-gray-300">Add links to your favorite workflows to speed up your day.</p>
            </div>
          </div>
          <div v-else class="space-y-3">
            <ActionTile v-for="shortcut in props.shortcuts" :key="shortcut.title" :title="shortcut.title" :description="shortcut.description" :href="shortcut.href" :icon="shortcut.icon" :loading="props.loading" />
          </div>
        </div>
        <button
          type="button"
          class="flex w-full items-center justify-center gap-2 rounded-xl border border-dashed border-gray-200 bg-gray-50 px-4 py-3 text-sm font-semibold text-gray-700 transition hover:border-indigo-200 hover:text-indigo-700 dark:border-white/10 dark:bg-white/5 dark:text-gray-200 dark:hover:border-indigo-500/50 dark:hover:text-indigo-200"
        >
          <PlusIcon class="size-4" aria-hidden="true" />
          Add shortcut
        </button>
      </section>
    </div>
  </section>
</template>
