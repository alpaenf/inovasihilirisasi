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
  Cpu
} from 'lucide-vue-next';

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
  <aside class="sticky top-0 h-screen w-64 bg-[#14532D] text-white flex flex-col justify-between shrink-0 overflow-y-auto z-40 select-none border-r border-[#14532D]">
    <div>
      <!-- Brand Header -->
      <div class="h-20 flex items-center px-6 border-b border-white/10 gap-3">
        <div class="h-11 w-auto flex items-center justify-center">
          <img src="/images/logo-puskor-white.png" alt="Logo Inovasi Hilirisasi UNSOED" class="h-11 w-auto object-contain" />
        </div>
        <div>
          <span class="font-extrabold text-base tracking-tight text-white block leading-none">INOVASI HILIRISASI ADMIN</span>
          <span class="text-[10px] text-emerald-200 uppercase font-semibold tracking-wider block mt-1">UNSOED Terpusat</span>
        </div>
      </div>

      <!-- Navigation Links -->
      <nav class="p-4 space-y-1.5">
        <Link
          v-for="item in menuItems"
          :key="item.name"
          :href="item.href"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200"
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
        class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-semibold text-emerald-200 hover:text-white hover:bg-white/10 transition-colors"
      >
        <span class="flex items-center gap-2">
          <ExternalLink class="w-4 h-4" />
          <span>Lihat Website Publik</span>
        </span>
      </Link>

      <button
        type="button"
        @click="handleLogout"
        class="w-full flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold text-red-200 hover:bg-red-500/20 hover:text-red-100 transition-colors text-left"
      >
        <LogOut class="w-4 h-4" />
        <span>Keluar (Logout)</span>
      </button>
    </div>
  </aside>
</template>

