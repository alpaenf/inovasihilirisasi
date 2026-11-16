<script setup>
import { Link } from '@inertiajs/vue3';
import { ArrowUpRight, Building2 } from 'lucide-vue-next';

defineProps({
  partner: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="group bg-white rounded-2xl border border-[#E5EAE5] p-6 flex flex-col justify-between hover:border-[#22C55E]/60 hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300">
    <div>
      <div class="flex items-start justify-between gap-4 mb-4">
        <!-- Logo / Icon -->
        <div class="w-14 h-14 rounded-xl bg-[#F7FAF7] border border-[#E5EAE5] p-2 flex items-center justify-center shrink-0 group-hover:border-[#22C55E]/40 transition-colors">
          <img
            v-if="partner.logo && !partner.logo.includes('placeholder')"
            :src="partner.logo"
            :alt="partner.name"
            class="max-w-full max-h-full object-contain"
            @error="$event.target.style.display = 'none'"
          />
          <Building2 class="w-7 h-7 text-[#14532D]/40" />
        </div>

        <!-- Category Badge -->
        <span v-if="partner.category" class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-[#DCFCE7] text-[#14532D]">
          {{ partner.category }}
        </span>
      </div>

      <h3 class="text-base sm:text-lg font-bold text-[#14532D] mb-2 group-hover:text-[#22C55E] transition-colors line-clamp-1">
        {{ partner.name }}
      </h3>

      <p class="text-xs sm:text-sm text-[#647067] leading-relaxed line-clamp-2">
        {{ partner.short_description || 'Mitra kolaborasi penerapan teknologi PUSKOR UNSOED.' }}
      </p>
    </div>

    <div class="pt-4 mt-4 border-t border-[#E5EAE5] flex items-center justify-between">
      <Link
        :href="`/mitra/${partner.slug}`"
        class="inline-flex items-center gap-1 text-xs font-bold text-[#14532D] group-hover:text-[#22C55E] transition-colors"
      >
        <span>Lihat Profil Mitra</span>
        <ArrowUpRight class="w-3.5 h-3.5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" />
      </Link>
    </div>
  </div>
</template>

