<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { ArrowUpRight, Building2 } from 'lucide-vue-next';

defineProps({
  partner: {
    type: Object,
    required: true,
  },
});

const imageError = ref(false);
</script>

<template>
  <div class="group bg-white rounded-2xl border border-[#E5EAE5] p-6 flex flex-col justify-between hover:border-[#22C55E]/60 hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300">
    <div>
      <!-- Top: Company Logo & Category Badge -->
      <div class="flex items-start justify-between gap-3 mb-5">
        <!-- Company Logo Box -->
        <div class="w-16 h-16 rounded-xl bg-[#F7FAF7] border border-[#E5EAE5] p-2 flex items-center justify-center shrink-0 group-hover:border-[#22C55E]/40 group-hover:bg-white transition-all overflow-hidden">
          <img
            v-if="partner.logo && !imageError && !partner.logo.includes('placeholder')"
            :src="partner.logo"
            :alt="partner.name"
            class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-200"
            @error="imageError = true"
          />
          <Building2 v-else class="w-7 h-7 text-[#14532D]/40" />
        </div>

        <!-- Category Badge -->
        <span v-if="partner.category" class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-[#DCFCE7] text-[#14532D]">
          {{ partner.category }}
        </span>
      </div>

      <!-- Partner Name -->
      <h3 class="text-base sm:text-lg font-bold text-[#14532D] mb-2 group-hover:text-[#22C55E] transition-colors line-clamp-1">
        {{ partner.name }}
      </h3>

      <!-- Short Description -->
      <p class="text-xs sm:text-sm text-[#647067] leading-relaxed line-clamp-2 mb-4">
        {{ partner.short_description || partner.address || 'Mitra kolaborasi penerapan teknologi Inovasi Hilirisasi UNSOED.' }}
      </p>
    </div>

    <!-- Bottom: Link to Partner Profile -->
    <div class="pt-4 border-t border-[#E5EAE5] flex items-center justify-between">
      <Link
        :href="`/mitra/${partner.slug}`"
        class="inline-flex items-center gap-1.5 text-xs font-bold text-[#14532D] group-hover:text-[#22C55E] transition-colors"
      >
        <span>Lihat Detail Mitra</span>
        <ArrowUpRight class="w-3.5 h-3.5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" />
      </Link>
    </div>
  </div>
</template>
