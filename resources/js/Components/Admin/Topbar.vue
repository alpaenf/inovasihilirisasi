<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { usePage, Link, router } from '@inertiajs/vue3';
import {
  PanelLeftOpen,
  PanelLeftClose,
  ChevronDown,
  UserCog,
  ExternalLink,
  LogOut,
} from 'lucide-vue-next';

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

const dropdownOpen = ref(false);
const dropdownRef = ref(null);

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value;
};

const closeDropdown = (e) => {
  if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
    dropdownOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', closeDropdown);
});

onUnmounted(() => {
  document.removeEventListener('click', closeDropdown);
});

const handleLogout = () => {
  dropdownOpen.value = false;
  router.post('/logout');
};
</script>

<template>
  <header class="sticky top-0 z-30 h-16 sm:h-20 bg-white/95 backdrop-blur-md border-b border-[#E5EAE5] px-4 sm:px-6 lg:px-8 flex items-center justify-between">
    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
      <!-- Sidebar Toggle Button (Buka/Tutup Sidebar untuk Desktop & Mobile) -->
      <button
        type="button"
        @click="$emit('toggle-sidebar')"
        class="p-2 sm:p-2.5 rounded-xl text-[#14532D] hover:bg-[#F7FAF7] border border-[#E5EAE5] hover:border-[#14532D]/30 min-w-[42px] min-h-[42px] flex items-center justify-center transition-all cursor-pointer shadow-xs active:scale-95 shrink-0"
        :title="sidebarOpen ? 'Tutup Sidebar' : 'Buka Sidebar'"
        aria-label="Buka atau Tutup Menu Sidebar"
      >
        <component :is="sidebarOpen ? PanelLeftClose : PanelLeftOpen" class="w-5 h-5 text-[#14532D]" />
      </button>

      <div class="min-w-0">
        <h1 class="text-base sm:text-xl font-bold text-[#14532D] leading-tight truncate">
          {{ title || 'Dashboard Admin' }}
        </h1>
        <span class="text-[11px] sm:text-xs text-[#647067] hidden sm:block truncate">Pusat Kontrol Informasi Website Inovasi Hilirisasi</span>
      </div>
    </div>

    <!-- Admin Profile Badge & Compact Dropdown -->
    <div class="relative shrink-0" ref="dropdownRef">
      <button
        type="button"
        @click="toggleDropdown"
        class="flex items-center gap-2.5 sm:gap-3 p-1.5 sm:px-3 sm:py-2 rounded-2xl hover:bg-[#F7FAF7] border border-transparent hover:border-[#E5EAE5] transition-all cursor-pointer select-none"
        aria-haspopup="true"
        :aria-expanded="dropdownOpen"
      >
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#DCFCE7] text-[#14532D] flex items-center justify-center font-bold text-sm shrink-0 shadow-xs border border-[#22C55E]/30">
          {{ user?.name ? user.name.charAt(0) : 'A' }}
        </div>
        
        <div class="hidden sm:block text-left max-w-[120px] lg:max-w-[150px]">
          <span class="text-xs font-bold text-[#17231C] block leading-tight truncate">
            {{ user?.name || 'Administrator' }}
          </span>
          <span class="text-[10px] text-[#22C55E] font-semibold block mt-0.5">
            Admin Aktif
          </span>
        </div>

        <ChevronDown
          class="w-4 h-4 text-[#647067] transition-transform duration-200 hidden sm:block"
          :class="{ 'rotate-180': dropdownOpen }"
        />
      </button>

      <!-- Dropdown Popup Card -->
      <transition
        enter-active-class="transition duration-150 ease-out"
        enter-from-class="transform scale-95 opacity-0 -translate-y-1"
        enter-to-class="transform scale-100 opacity-100 translate-y-0"
        leave-active-class="transition duration-100 ease-in"
        leave-from-class="transform scale-100 opacity-100 translate-y-0"
        leave-to-class="transform scale-95 opacity-0 -translate-y-1"
      >
        <div
          v-if="dropdownOpen"
          class="absolute right-0 mt-2 w-64 rounded-2xl bg-white border border-[#E5EAE5] shadow-xl shadow-emerald-950/10 p-2 z-50 text-[#17231C]"
        >
          <!-- User Details Summary in Dropdown -->
          <div class="p-3 bg-[#F7FAF7] rounded-xl border border-[#E5EAE5]/60 mb-2">
            <span class="text-xs font-bold text-[#14532D] block truncate leading-snug">
              {{ user?.name || 'Administrator' }}
            </span>
            <span class="text-[11px] text-[#647067] block truncate mt-0.5">
              {{ user?.email || 'admin@unsoed.ac.id' }}
            </span>
          </div>

          <!-- Links -->
          <div class="space-y-1">
            <Link
              href="/admin/profile"
              @click="dropdownOpen = false"
              class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-[#17231C] hover:bg-[#DCFCE7]/60 hover:text-[#14532D] transition-colors"
            >
              <UserCog class="w-4 h-4 text-[#14532D]" />
              <span>Profil & Ganti Password</span>
            </Link>

            <Link
              href="/"
              target="_blank"
              @click="dropdownOpen = false"
              class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-[#647067] hover:bg-[#F7FAF7] hover:text-[#14532D] transition-colors"
            >
              <ExternalLink class="w-4 h-4 text-[#647067]" />
              <span>Lihat Website Publik</span>
            </Link>
          </div>

          <!-- Divider -->
          <div class="my-2 border-t border-[#E5EAE5]"></div>

          <!-- Logout Button -->
          <button
            type="button"
            @click="handleLogout"
            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors text-left cursor-pointer"
          >
            <LogOut class="w-4 h-4" />
            <span>Keluar (Logout)</span>
          </button>
        </div>
      </transition>
    </div>
  </header>
</template>
