<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';
import {
  LayoutDashboard,
  Layers,
  Box,
  Building2,
  FileText,
  Settings,
  LogOut,
  ExternalLink,
  X
} from 'lucide-vue-next';

defineProps({
  mobileOpen: {
    type: Boolean,
    default: false,
  },
});

defineEmits(['close']);

const page = usePage();

const menuItems = [
  { name: 'Dashboard', href: '/admin/dashboard', icon: LayoutDashboard },
  { name: 'Manajemen Program', href: '/admin/programs', icon: Layers },
  { name: 'Manajemen Produk', href: '/admin/products', icon: Box },
  { name: 'Manajemen Mitra', href: '/admin/partners', icon: Building2 },
  { name: 'Manajemen Halaman', href: '/admin/pages', icon: FileText },
  { name: 'Pengaturan Website', href: '/admin/settings', icon: Settings },
];

const isActive = (href) => {
  const currentUrl = page.url;
  return currentUrl === href || currentUrl.startsWith(href + '/');
};

const handleLogout = () => {
  router.post('/logout');
};
</script>

<template>
  <!-- Mobile & Tablet Backdrop Overlay -->
  <transition
    enter-active-class="transition-opacity duration-300 ease-out"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition-opacity duration-200 ease-in"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div
      v-if="mobileOpen"
      @click="$emit('close')"
      class="fixed inset-0 bg-black/60 backdrop-blur-xs z-40 lg:hidden"
      aria-hidden="true"
    ></div>
  </transition>

  <!-- Sidebar (Desktop: Sticky w-64, Mobile/Tablet: Slide-over Drawer) -->
  <aside
    class="fixed inset-y-0 left-0 z-50 w-72 max-w-[85vw] bg-[#14532D] text-white flex flex-col justify-between shrink-0 overflow-y-auto select-none border-r border-[#14532D] transition-transform duration-300 ease-in-out lg:sticky lg:top-0 lg:h-screen lg:w-64 lg:translate-x-0"
    :class="mobileOpen ? 'translate-x-0 shadow-2xl' : '-translate-x-full lg:translate-x-0'"
  >
    <div>
      <!-- Brand Header -->
      <div class="h-20 flex items-center justify-between px-5 sm:px-6 border-b border-white/10 gap-3">
        <div class="flex items-center gap-3">
          <div class="h-11 w-auto flex items-center justify-center shrink-0">
            <img src="/images/logo-puskor-white.png" alt="Logo Inovasi Hilirisasi UNSOED" class="h-11 w-auto object-contain" />
          </div>
          <div>
            <span class="font-extrabold text-sm sm:text-base tracking-tight text-white block leading-none">INOVASI HILIRISASI</span>
            <span class="text-[10px] text-emerald-200 uppercase font-semibold tracking-wider block mt-1">UNSOED Terpusat</span>
          </div>
        </div>

        <!-- Close Button (Visible on Mobile & Tablet) -->
        <button
          type="button"
          @click="$emit('close')"
          class="lg:hidden p-2 rounded-xl text-emerald-200 hover:text-white hover:bg-white/10 min-w-[40px] min-h-[40px] flex items-center justify-center transition-colors"
          aria-label="Tutup Menu"
        >
          <X class="w-5 h-5" />
        </button>
      </div>

      <!-- Navigation Links -->
      <nav class="p-4 space-y-1.5">
        <Link
          v-for="item in menuItems"
          :key="item.name"
          :href="item.href"
          @click="$emit('close')"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 min-h-[44px]"
          :class="isActive(item.href)
            ? 'bg-white text-[#14532D] font-bold shadow-md'
            : 'text-emerald-100 hover:bg-white/10 hover:text-white'"
        >
          <component :is="item.icon" class="w-5 h-5 shrink-0" />
          <span>{{ item.name }}</span>
        </Link>
      </nav>
    </div>

    <!-- Bottom Actions: Public Site Link & Logout -->
    <div class="p-4 border-t border-white/10 space-y-2">
      <Link
        href="/"
        target="_blank"
        class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-emerald-200 hover:text-white hover:bg-white/10 transition-colors min-h-[40px]"
      >
        <span class="flex items-center gap-2">
          <ExternalLink class="w-4 h-4" />
          <span>Lihat Website Publik</span>
        </span>
      </Link>

      <button
        type="button"
        @click="handleLogout"
        class="w-full flex items-center gap-2 px-3.5 py-2.5 rounded-xl text-xs font-bold text-red-200 hover:bg-red-500/20 hover:text-red-100 transition-colors text-left min-h-[40px]"
      >
        <LogOut class="w-4 h-4" />
        <span>Keluar (Logout)</span>
      </button>
    </div>
  </aside>
</template>
