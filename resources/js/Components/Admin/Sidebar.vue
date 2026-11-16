<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';
import {
  LayoutDashboard,
  Layers,
  Box,
  Building2,
  FileText,
  Settings,
  UserCog,
  LogOut,
  ExternalLink,
  X,
  PanelLeftClose
} from 'lucide-vue-next';

defineProps({
  isOpen: {
    type: Boolean,
    default: true,
  },
  isMobile: {
    type: Boolean,
    default: false,
  },
});

defineEmits(['close', 'toggle']);

const page = usePage();

const menuItems = [
  { name: 'Dashboard', href: '/admin/dashboard', icon: LayoutDashboard },
  { name: 'Manajemen Program', href: '/admin/programs', icon: Layers },
  { name: 'Manajemen Produk', href: '/admin/products', icon: Box },
  { name: 'Manajemen Mitra', href: '/admin/partners', icon: Building2 },
  { name: 'Manajemen Halaman', href: '/admin/pages', icon: FileText },
  { name: 'Pengaturan Website', href: '/admin/settings', icon: Settings },
  { name: 'Profil & Keamanan', href: '/admin/profile', icon: UserCog },
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
      v-if="isMobile && isOpen"
      @click="$emit('close')"
      class="fixed inset-0 bg-black/50 backdrop-blur-xs z-40 lg:hidden"
      aria-hidden="true"
    ></div>
  </transition>

  <!-- Sidebar (Desktop: Collapsible w-64, Mobile: Slide-over Drawer) -->
  <aside
    class="fixed inset-y-0 left-0 z-50 bg-white text-[#17231C] flex flex-col justify-between shrink-0 overflow-hidden select-none border-r border-[#E5EAE5] transition-all duration-300 ease-in-out lg:sticky lg:top-0 lg:h-screen"
    :class="[
      isMobile
        ? (isOpen ? 'w-72 max-w-[85vw] translate-x-0 shadow-2xl' : 'w-72 max-w-[85vw] -translate-x-full shadow-none')
        : (isOpen ? 'w-64 translate-x-0 opacity-100' : 'w-0 -translate-x-full opacity-0 pointer-events-none border-r-0')
    ]"
  >
    <!-- Inner fixed-width container to prevent horizontal content jumping during slide animation -->
    <div class="w-64 flex flex-col justify-between h-full">
      <div class="overflow-y-auto flex-1">
        <!-- Brand Header (Light Theme with Primary Logo) -->
        <div class="h-20 flex items-center justify-between px-5 sm:px-6 border-b border-[#E5EAE5] gap-3">
          <Link href="/admin/dashboard" class="flex items-center gap-3 group min-w-0">
            <div class="h-10 w-auto flex items-center justify-center shrink-0">
              <img src="/images/logo-puskor.png" alt="Logo Inovasi Hilirisasi UNSOED" class="h-10 w-auto object-contain" />
            </div>
            <div class="min-w-0">
              <span class="font-extrabold text-sm sm:text-base tracking-tight text-[#14532D] block leading-none truncate group-hover:text-[#22C55E] transition-colors">INOVASI HILIRISASI</span>
              <span class="text-[10px] text-[#647067] uppercase font-bold tracking-wider block mt-1">UNSOED Terpusat</span>
            </div>
          </Link>

          <!-- Toggle / Close Button in Header -->
          <button
            type="button"
            @click="$emit('close')"
            class="p-2 rounded-xl text-[#647067] hover:text-[#14532D] hover:bg-[#F7FAF7] border border-[#E5EAE5] min-w-[36px] min-h-[36px] flex items-center justify-center transition-colors shrink-0"
            :title="isMobile ? 'Tutup Menu' : 'Sembunyikan Sidebar'"
            aria-label="Tutup Menu"
          >
            <X v-if="isMobile" class="w-4 h-4" />
            <PanelLeftClose v-else class="w-4 h-4" />
          </button>
        </div>

        <!-- Navigation Links (White Sidebar with Deep Green Active Pill) -->
        <nav class="p-4 space-y-1.5">
          <Link
            v-for="item in menuItems"
            :key="item.name"
            :href="item.href"
            @click="isMobile && $emit('close')"
            class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 min-h-[44px]"
            :class="isActive(item.href)
              ? 'bg-[#14532D] text-white font-bold shadow-md shadow-emerald-950/20'
              : 'text-[#647067] hover:bg-[#F7FAF7] hover:text-[#14532D]'"
          >
            <component
              :is="item.icon"
              class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110"
              :class="isActive(item.href) ? 'text-[#22C55E]' : 'text-[#647067] group-hover:text-[#14532D]'"
            />
            <span>{{ item.name }}</span>
          </Link>
        </nav>
      </div>

      <!-- Bottom Actions: Public Site Link & Logout -->
      <div class="p-4 border-t border-[#E5EAE5] space-y-2 shrink-0 bg-white">
        <Link
          href="/"
          target="_blank"
          class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-[#647067] hover:text-[#14532D] hover:bg-[#F7FAF7] border border-transparent hover:border-[#E5EAE5] transition-all min-h-[40px]"
        >
          <span class="flex items-center gap-2">
            <ExternalLink class="w-4 h-4 text-[#14532D]" />
            <span>Lihat Website Publik</span>
          </span>
        </Link>

        <button
          type="button"
          @click="handleLogout"
          class="w-full flex items-center gap-2 px-3.5 py-2.5 rounded-xl text-xs font-bold text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors text-left min-h-[40px]"
        >
          <LogOut class="w-4 h-4" />
          <span>Keluar (Logout)</span>
        </button>
      </div>
    </div>
  </aside>
</template>
