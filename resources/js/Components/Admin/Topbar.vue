<script setup>
import { usePage } from '@inertiajs/vue3';
import { User, Shield } from 'lucide-vue-next';

defineProps({
  title: String,
});

const page = usePage();
const user = page.props.auth?.user;
</script>

<template>
  <header class="h-20 bg-white border-b border-[#E5EAE5] px-6 sm:px-8 flex items-center justify-between">
    <div>
      <h1 class="text-xl font-bold text-[#14532D]">
        {{ title || 'Dashboard Admin' }}
      </h1>
      <span class="text-xs text-[#647067]">Pusat Kontrol Informasi Website PUSKOR</span>
    </div>

    <!-- Admin Profile Badge -->
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-full bg-[#DCFCE7] text-[#14532D] flex items-center justify-center font-bold text-sm">
        {{ user?.name ? user.name.charAt(0) : 'A' }}
      </div>
      <div class="hidden sm:block text-left">
        <span class="text-sm font-bold text-[#17231C] block leading-tight">{{ user?.name || 'Administrator' }}</span>
        <span class="text-[11px] text-[#647067] block">{{ user?.email || 'admin@unsoed.ac.id' }}</span>
      </div>
    </div>
  </header>
</template>

