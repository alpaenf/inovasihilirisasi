<script setup>
import { usePage } from '@inertiajs/vue3';
import { PanelLeftOpen, PanelLeftClose } from 'lucide-vue-next';

defineProps({
  title: String,
  sidebarOpen: {
    type: Boolean,
    default: true,
  },
});

defineEmits(['toggle-sidebar']);

const page = usePage();
const user = page.props.auth?.user;
</script>

<template>
  <header class="sticky top-0 z-30 h-16 sm:h-20 bg-white/95 backdrop-blur-md border-b border-[#E5EAE5] px-4 sm:px-6 lg:px-8 flex items-center justify-between">
    <div class="flex items-center gap-3 sm:gap-4">
      <!-- Sidebar Toggle Button (Buka/Tutup Sidebar untuk Desktop & Mobile) -->
      <button
        type="button"
        @click="$emit('toggle-sidebar')"
        class="p-2 sm:p-2.5 rounded-xl text-[#14532D] hover:bg-[#F7FAF7] border border-[#E5EAE5] hover:border-[#14532D]/30 min-w-[42px] min-h-[42px] flex items-center justify-center transition-all cursor-pointer shadow-xs active:scale-95"
        :title="sidebarOpen ? 'Tutup Sidebar' : 'Buka Sidebar'"
        aria-label="Buka atau Tutup Menu Sidebar"
      >
        <component :is="sidebarOpen ? PanelLeftClose : PanelLeftOpen" class="w-5 h-5 text-[#14532D]" />
      </button>

      <div>
        <h1 class="text-base sm:text-xl font-bold text-[#14532D] leading-tight line-clamp-1">
          {{ title || 'Dashboard Admin' }}
        </h1>
        <span class="text-[11px] sm:text-xs text-[#647067] hidden sm:block">Pusat Kontrol Informasi Website Inovasi Hilirisasi</span>
      </div>
    </div>

    <!-- Admin Profile Badge -->
    <div class="flex items-center gap-2.5 sm:gap-3 shrink-0">
      <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#DCFCE7] text-[#14532D] flex items-center justify-center font-bold text-sm shrink-0 shadow-xs border border-[#22C55E]/30">
        {{ user?.name ? user.name.charAt(0) : 'A' }}
      </div>
      <div class="hidden sm:block text-left">
        <span class="text-sm font-bold text-[#17231C] block leading-tight">{{ user?.name || 'Administrator' }}</span>
        <span class="text-[11px] text-[#647067] block">{{ user?.email || 'admin@unsoed.ac.id' }}</span>
      </div>
    </div>
  </header>
</template>
