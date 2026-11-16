<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Topbar from '@/Components/Admin/Topbar.vue';
import { CheckCircle2, AlertCircle } from 'lucide-vue-next';

defineProps({
  title: String,
});

const mobileSidebarOpen = ref(false);
const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);
const flashError = computed(() => page.props.flash?.error);
</script>

<template>
  <div class="min-h-screen flex bg-[#F7FAF7] text-[#17231C]">
    <!-- Left Admin Sidebar (Responsive: Sticky on lg+, Slide-over Drawer on < lg) -->
    <Sidebar :mobile-open="mobileSidebarOpen" @close="mobileSidebarOpen = false" />

    <!-- Right Main Column -->
    <div class="flex-1 min-w-0 flex flex-col">
      <Topbar :title="title" @toggle-sidebar="mobileSidebarOpen = !mobileSidebarOpen" />

      <!-- Flash Notification Alerts -->
      <div v-if="flashSuccess" class="mx-4 sm:mx-6 lg:mx-8 mt-4 sm:mt-6 p-4 rounded-xl bg-emerald-50 border border-[#22C55E]/40 text-[#14532D] flex items-center gap-3 text-sm font-semibold shadow-sm">
        <CheckCircle2 class="w-5 h-5 text-[#22C55E] shrink-0" />
        <span>{{ flashSuccess }}</span>
      </div>

      <div v-if="flashError" class="mx-4 sm:mx-6 lg:mx-8 mt-4 sm:mt-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-center gap-3 text-sm font-semibold shadow-sm">
        <AlertCircle class="w-5 h-5 text-red-600 shrink-0" />
        <span>{{ flashError }}</span>
      </div>

      <!-- Main Content Slot -->
      <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <slot />
      </main>
    </div>
  </div>
</template>
