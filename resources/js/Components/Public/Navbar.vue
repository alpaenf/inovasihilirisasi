<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Menu, X, ArrowUpRight } from 'lucide-vue-next';

const mobileMenuOpen = ref(false);
const isScrolled = ref(false);
const page = usePage();

const navLinks = [
  { name: 'Beranda', href: '/' },
  { name: 'Program', href: '/program' },
  { name: 'Produk', href: '/produk' },
  { name: 'Mitra', href: '/mitra' },
  { name: 'Tentang Inovasi Hilirisasi', shortName: 'Tentang', href: '/tentang-puskor' },
];

const handleScroll = () => {
  isScrolled.value = window.scrollY > 30;
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});

const isActive = (href) => {
  const currentUrl = page.url;
  if (href === '/') return currentUrl === '/';
  return currentUrl.startsWith(href);
};
</script>

<template>
  <header
    class="sticky top-0 z-50 w-full transition-all duration-500 ease-out pointer-events-none"
    :class="isScrolled ? 'pt-3 sm:pt-4 px-3 sm:px-6' : 'pt-0 px-0'"
  >
    <!-- Main Navbar Container / Capsule -->
    <div
      class="mx-auto transition-all duration-500 ease-out pointer-events-auto"
      :class="[
        isScrolled
          ? 'w-full max-w-5xl rounded-full bg-white/85 backdrop-blur-xl border border-[#E5EAE5]/90 shadow-xl shadow-emerald-950/10 px-4 sm:px-6 h-16'
          : 'w-full max-w-7xl rounded-none bg-white/95 backdrop-blur-md border-b border-[#E5EAE5] shadow-none px-4 sm:px-6 lg:px-8 h-20'
      ]"
    >
      <div class="flex items-center justify-between h-full">
        <!-- Brand / Identity -->
        <Link href="/" class="flex items-center gap-3 group shrink-0">
          <div
            class="flex items-center justify-center transition-all duration-300 group-hover:scale-105"
            :class="isScrolled ? 'h-10 w-auto' : 'h-12 w-auto'"
          >
            <img
              src="/images/logo-puskor.png"
              alt="Logo Inovasi Hilirisasi UNSOED"
              class="h-full w-auto object-contain"
            />
          </div>
          <div class="flex flex-col">
            <span
              class="font-extrabold tracking-tight text-[#14532D] leading-none transition-all duration-300"
              :class="isScrolled ? 'text-base sm:text-lg' : 'text-lg sm:text-xl'"
            >
              Inovasi Hilirisasi
            </span>
            <span
              class="font-semibold text-[#647067] tracking-wider uppercase transition-all duration-300"
              :class="isScrolled ? 'text-[10px] mt-0.5' : 'text-[11px] mt-1'"
            >
              Universitas Jenderal Soedirman
            </span>
          </div>
        </Link>

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex items-center space-x-1 lg:space-x-1.5">
          <Link
            v-for="item in navLinks"
            :key="item.name"
            :href="item.href"
            class="rounded-full font-semibold transition-all duration-200"
            :class="[
              isScrolled ? 'px-3 py-1.5 text-xs lg:text-sm' : 'px-4 py-2 text-sm',
              isActive(item.href)
                ? 'text-[#14532D] bg-[#DCFCE7]'
                : 'text-[#647067] hover:text-[#14532D] hover:bg-[#F7FAF7]'
            ]"
          >
            <span v-if="item.shortName" class="hidden lg:inline">{{ item.name }}</span>
            <span v-if="item.shortName" class="lg:hidden">{{ item.shortName }}</span>
            <span v-else>{{ item.name }}</span>
          </Link>
        </nav>

        <!-- Desktop Right CTA -->
        <div class="hidden md:flex items-center gap-3 shrink-0">
          <a
            href="mailto:p3t.lppm@unsoed.ac.id"
            class="inline-flex items-center gap-2 rounded-full font-semibold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm hover:shadow transition-all duration-200 group"
            :class="isScrolled ? 'px-4 py-2 text-xs sm:text-sm' : 'px-5 py-2.5 text-sm'"
          >
            <span>Hubungi Kami</span>
            <ArrowUpRight class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#22C55E] group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" />
          </a>
        </div>

        <!-- Mobile Menu Hamburger Button -->
        <div class="flex md:hidden">
          <button
            type="button"
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="p-2 rounded-full text-[#17231C] hover:bg-[#F7FAF7] focus:outline-none transition-colors min-w-[44px] min-h-[44px] flex items-center justify-center"
            aria-label="Toggle Menu"
          >
            <Menu v-if="!mobileMenuOpen" class="w-5 h-5 sm:w-6 sm:h-6" />
            <X v-else class="w-5 h-5 sm:w-6 sm:h-6" />
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0 -translate-y-2 scale-95"
      enter-to-class="opacity-100 translate-y-0 scale-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100 translate-y-0 scale-100"
      leave-to-class="opacity-0 -translate-y-2 scale-95"
    >
      <div
        v-show="mobileMenuOpen"
        class="md:hidden pointer-events-auto transition-all duration-300"
        :class="[
          isScrolled
            ? 'w-full max-w-5xl mx-auto mt-2 rounded-2xl border border-[#E5EAE5] bg-white/95 backdrop-blur-xl shadow-2xl p-4 space-y-2'
            : 'w-full border-b border-[#E5EAE5] bg-white px-4 pt-3 pb-6 space-y-2'
        ]"
      >
        <Link
          v-for="item in navLinks"
          :key="item.name"
          :href="item.href"
          @click="mobileMenuOpen = false"
          class="flex items-center px-4 py-3 rounded-xl text-base font-semibold transition-colors min-h-[44px]"
          :class="isActive(item.href)
            ? 'text-[#14532D] bg-[#DCFCE7]'
            : 'text-[#647067] hover:bg-[#F7FAF7] hover:text-[#14532D]'"
        >
          {{ item.name }}
        </Link>
        <div class="pt-3 border-t border-[#E5EAE5]">
          <a
            href="mailto:p3t.lppm@unsoed.ac.id"
            class="flex items-center justify-center gap-2 w-full py-3.5 rounded-xl text-sm font-bold bg-[#14532D] text-white shadow-sm min-h-[44px]"
          >
            <span>Hubungi Kami</span>
            <ArrowUpRight class="w-4 h-4 text-[#22C55E]" />
          </a>
        </div>
      </div>
    </transition>
  </header>
</template>
