<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Topbar from '@/Components/Admin/Topbar.vue';
import { CheckCircle2, AlertCircle } from 'lucide-vue-next';

defineProps({
  title: String,
});

const sidebarOpen = ref(true);
const isMobile = ref(false);

const handleResize = () => {
  const mobile = window.innerWidth < 1024;
  isMobile.value = mobile;
  if (mobile) {
    sidebarOpen.value = false;
  } else {
    const saved = localStorage.getItem('admin_sidebar_open');
    sidebarOpen.value = saved !== null ? saved === 'true' : true;
  }
};

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value;
  if (!isMobile.value) {
    localStorage.setItem('admin_sidebar_open', String(sidebarOpen.value));
  }
};

const closeSidebar = () => {
  sidebarOpen.value = false;
  if (!isMobile.value) {
    localStorage.setItem('admin_sidebar_open', 'false');
  }
};

onMounted(() => {
  handleResize();
  window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
  window.removeEventListener('resize', handleResize);
});

const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);
const flashError = computed(() => page.props.flash?.error);
</script>

<template>
  <div class="min-h-screen flex bg-[#F7FAF7] text-[#17231C]">
    <!-- Left Admin Sidebar (White theme with deep green active link, Collapsible) -->
    <Sidebar
      :is-open="sidebarOpen"
      :is-mobile="isMobile"
      @close="closeSidebar"
      @toggle="toggleSidebar"
    />

    <!-- Right Main Column -->
    <div class="flex-1 min-w-0 flex flex-col transition-all duration-300">
      <Topbar
        :title="title"
        :sidebar-open="sidebarOpen"
        @toggle-sidebar="toggleSidebar"
      />

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
