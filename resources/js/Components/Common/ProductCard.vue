<script setup>
import { Link } from '@inertiajs/vue3';
import { ArrowUpRight, Cpu } from 'lucide-vue-next';

defineProps({
  product: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="group bg-white rounded-2xl border border-[#E5EAE5] overflow-hidden flex flex-col hover:border-[#22C55E]/60 hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300">
    <!-- Image Header -->
    <div class="relative aspect-[16/10] bg-[#F7FAF7] overflow-hidden flex items-center justify-center">
      <img
        v-if="product.main_image && !product.main_image.includes('placeholder')"
        :src="product.main_image"
        :alt="product.name"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        loading="lazy"
        @error="$event.target.style.display = 'none'"
      />
      <!-- Fallback illustration when image is missing or placeholder -->
      <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-emerald-50 to-[#DCFCE7]/40 p-4 text-center">
        <Cpu class="w-10 h-10 text-[#14532D]/40 mb-2" />
        <span class="text-xs font-semibold text-[#14532D]/60 tracking-wider">TEKNOLOGI PUSKOR</span>
      </div>

      <!-- Program Tag Badge -->
      <div v-if="product.program" class="absolute top-3 left-3">
        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-[#14532D]/90 text-white backdrop-blur-sm shadow-sm">
          {{ product.program.name }}
        </span>
      </div>
    </div>

    <!-- Content Body -->
    <div class="p-5 sm:p-6 flex-grow flex flex-col justify-between">
      <div>
        <h3 class="text-lg font-bold text-[#14532D] mb-2 group-hover:text-[#22C55E] transition-colors line-clamp-2">
          {{ product.name }}
        </h3>
        <p class="text-xs sm:text-sm text-[#647067] leading-relaxed line-clamp-3 mb-4">
          {{ product.short_description }}
        </p>
      </div>

      <div class="pt-4 border-t border-[#E5EAE5] flex items-center justify-between">
        <Link
          :href="`/produk/${product.slug}`"
          class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#14532D] group-hover:text-[#22C55E] transition-colors"
        >
          <span>Detail Inovasi</span>
          <ArrowUpRight class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" />
        </Link>
      </div>
    </div>
  </div>
</template>

