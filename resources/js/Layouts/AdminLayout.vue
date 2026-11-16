<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Topbar from '@/Components/Admin/Topbar.vue';
import { CheckCircle2, AlertCircle } from 'lucide-vue-next';

defineProps({
  title: String,
});

const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);
const flashError = computed(() => page.props.flash?.error);
</script>

<template>
  <div class="min-h-screen flex bg-[#F7FAF7] text-[#17231C]">
    <!-- Left Admin Sidebar -->
    <Sidebar />

    <!-- Right Main Column -->
    <div class="flex-1 min-w-0 flex flex-col">
      <Topbar :title="title" />

      <!-- Flash Notification Alerts -->
      <div v-if="flashSuccess" class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl bg-emerald-50 border border-[#22C55E]/40 text-[#14532D] flex items-center gap-3 text-sm font-semibold shadow-sm">
        <CheckCircle2 class="w-5 h-5 text-[#22C55E] shrink-0" />
        <span>{{ flashSuccess }}</span>
      </div>

      <div v-if="flashError" class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-center gap-3 text-sm font-semibold shadow-sm">
        <AlertCircle class="w-5 h-5 text-red-600 shrink-0" />
        <span>{{ flashError }}</span>
      </div>

      <!-- Main Content Slot -->
      <main class="flex-grow p-6 sm:p-8">
        <slot />
      </main>
    </div>
  </div>
</template>

