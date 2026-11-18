<script setup>
import { Link } from '@inertiajs/vue3';
import { ArrowRight } from 'lucide-vue-next';

defineProps({
  program: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="group bg-white rounded-2xl border border-[#E5EAE5] p-6 sm:p-8 flex flex-col justify-between hover:border-[#22C55E]/60 hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300">
    <div>
      <div v-if="program.code" class="mb-4">
        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-extrabold bg-[#DCFCE7] text-[#14532D] border border-[#22C55E]/30 tracking-wider">
          {{ program.code }}
        </span>
      </div>

      <h3 class="text-xl font-bold text-[#14532D] mb-3 group-hover:text-[#22C55E] transition-colors">
        {{ program.name }}
      </h3>

      <p class="text-sm text-[#647067] leading-relaxed line-clamp-3">
        {{ program.short_description }}
      </p>

      <div v-if="program.location || (program.commodities && program.commodities.length > 0)" class="mt-4 pt-3 border-t border-[#E5EAE5]/40 flex flex-wrap gap-1.5">
        <span v-if="program.location" class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-[#F7FAF7] text-[#14532D] border border-[#E5EAE5]">
          {{ program.location.split(',')[0] }}
        </span>
        <span
          v-for="c in (program.commodities || []).slice(0, 2)"
          :key="c"
          class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-800"
        >
          {{ c }}
        </span>
      </div>
    </div>

    <div class="pt-6 mt-6 border-t border-[#E5EAE5]/60">
      <Link
        :href="`/program/${program.slug}`"
        class="inline-flex items-center gap-2 text-sm font-bold text-[#14532D] group-hover:text-[#22C55E] transition-colors"
      >
        <span>Lihat Detail Program</span>
        <ArrowRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
      </Link>
    </div>
  </div>
</template>

