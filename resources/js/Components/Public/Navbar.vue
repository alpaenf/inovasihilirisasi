<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Menu, X, ArrowUpRight, Cpu } from 'lucide-vue-next';

const mobileMenuOpen = ref(false);
const page = usePage();

const navLinks = [
  { name: 'Beranda', href: '/' },
  { name: 'Program', href: '/program' },
  { name: 'Produk', href: '/produk' },
  { name: 'Mitra', href: '/mitra' },
  { name: 'Tentang PUSKOR', href: '/tentang-puskor' },
];

const isActive = (href) => {
  const currentUrl = page.url;
  if (href === '/') return currentUrl === '/';
  return currentUrl.startsWith(href);
};
</script>

<template>
  <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-[#E5EAE5] transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <!-- Brand / Identity -->
        <Link href="/" class="flex items-center gap-3.5 group">
          <div class="h-12 w-auto flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
            <img src="/images/logo-puskor.png" alt="Logo PUSKOR UNSOED" class="h-12 w-auto object-contain" />
          </div>
          <div class="flex flex-col">
            <span class="font-extrabold text-lg sm:text-xl tracking-tight text-[#14532D] leading-none">
              PUSKOR
            </span>
            <span class="text-[11px] font-semibold text-[#647067] tracking-wider uppercase mt-1">
              Universitas Jenderal Soedirman
            </span>
          </div>
        </Link>

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
          <Link
            v-for="item in navLinks"
            :key="item.name"
            :href="item.href"
            class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200"
            :class="isActive(item.href)
              ? 'text-[#14532D] bg-[#DCFCE7]/60'
              : 'text-[#647067] hover:text-[#14532D] hover:bg-[#F7FAF7]'"
          >
            {{ item.name }}
          </Link>
        </nav>

        <!-- Desktop Right CTA -->
        <div class="hidden md:flex items-center gap-3">
          <a
            href="mailto:p3t.lppm@unsoed.ac.id"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm hover:shadow transition-all duration-200 group"
          >
            <span>Hubungi Kami</span>
            <ArrowUpRight class="w-4 h-4 text-[#22C55E] group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" />
          </a>
        </div>

        <!-- Mobile Menu Hamburger Button -->
        <div class="flex md:hidden">
          <button
            type="button"
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="p-2 rounded-lg text-[#17231C] hover:bg-[#F7FAF7] focus:outline-none"
            aria-label="Toggle Menu"
          >
            <Menu v-if="!mobileMenuOpen" class="w-6 h-6" />
            <X v-else class="w-6 h-6" />
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div v-show="mobileMenuOpen" class="md:hidden border-b border-[#E5EAE5] bg-white px-4 pt-3 pb-6 space-y-2">
      <Link
        v-for="item in navLinks"
        :key="item.name"
        :href="item.href"
        @click="mobileMenuOpen = false"
        class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors"
        :class="isActive(item.href)
          ? 'text-[#14532D] bg-[#DCFCE7]'
          : 'text-[#647067] hover:bg-[#F7FAF7] hover:text-[#14532D]'"
      >
        {{ item.name }}
      </Link>
      <div class="pt-3 border-t border-[#E5EAE5]">
        <a
          href="mailto:p3t.lppm@unsoed.ac.id"
          class="flex items-center justify-center gap-2 w-full py-3 rounded-lg text-sm font-bold bg-[#14532D] text-white shadow-sm"
        >
          <span>Hubungi Kami</span>
          <ArrowUpRight class="w-4 h-4 text-[#22C55E]" />
        </a>
      </div>
    </div>
  </header>
</template>

