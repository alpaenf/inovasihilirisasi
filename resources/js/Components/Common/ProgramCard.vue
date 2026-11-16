<script setup>
import { Link } from '@inertiajs/vue3';
import { ArrowRight, Layers, Factory, Store, Sparkles } from 'lucide-vue-next';

const props = defineProps({
  program: {
    type: Object,
    required: true,
  },
});

const getIcon = (slug) => {
  switch (slug) {
    case 'sinergi':
      return Layers;
    case 'ajakan-industri':
      return Factory;
    case 'pmupud':
      return Store;
    case 'dortek':
    default:
      return Sparkles;
  }
};
</script>

<template>
  <div class="group bg-white rounded-2xl border border-[#E5EAE5] p-6 sm:p-8 flex flex-col justify-between hover:border-[#22C55E]/60 hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300">
    <div>
      <div class="flex items-center justify-between mb-5">
        <div class="w-12 h-12 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center group-hover:bg-[#14532D] group-hover:text-white transition-colors duration-200">
          <component :is="getIcon(program.slug)" class="w-6 h-6" />
        </div>
        <span v-if="program.code" class="text-xs font-bold px-2.5 py-1 rounded-md bg-[#F7FAF7] text-[#647067] border border-[#E5EAE5]">
          {{ program.code }}
        </span>
      </div>

      <h3 class="text-xl font-bold text-[#14532D] mb-3 group-hover:text-[#22C55E] transition-colors">
        {{ program.name }}
      </h3>

      <p class="text-sm text-[#647067] leading-relaxed line-clamp-3">
        {{ program.short_description }}
      </p>
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

