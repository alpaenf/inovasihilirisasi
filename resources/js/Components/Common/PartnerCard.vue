<script setup>
import { Link } from '@inertiajs/vue3';
import { Building2 } from 'lucide-vue-next';

defineProps({
  partner: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <Link
    :href="`/mitra/${partner.slug}`"
    class="group relative bg-white rounded-2xl border border-[#E5EAE5] p-5 h-32 sm:h-36 flex flex-col items-center justify-center hover:border-[#22C55E] hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300"
    :title="partner.name"
  >
    <!-- Logo Container -->
    <div class="w-full h-full flex items-center justify-center p-2">
      <img
        v-if="partner.logo && !partner.logo.includes('placeholder')"
        :src="partner.logo"
        :alt="partner.name"
        class="max-h-16 sm:max-h-20 max-w-[85%] object-contain group-hover:scale-110 transition-transform duration-300"
        @error="$event.target.style.display = 'none'"
      />
      <!-- Fallback when logo not available -->
      <div v-else class="flex flex-col items-center justify-center text-center">
        <Building2 class="w-8 h-8 text-[#14532D]/40 group-hover:text-[#22C55E] transition-colors mb-1" />
        <span class="text-[11px] font-bold text-[#14532D] line-clamp-1 px-1">{{ partner.name }}</span>
      </div>
    </div>

    <!-- Subtle Name Pill on Hover -->
    <div class="absolute -bottom-2 opacity-0 group-hover:opacity-100 group-hover:bottom-2 transition-all duration-200 pointer-events-none z-10 max-w-[90%]">
      <span class="px-2.5 py-1 rounded-md text-[11px] font-bold bg-[#14532D] text-white shadow-md truncate block text-center">
        {{ partner.name }}
      </span>
    </div>
  </Link>
</template>
