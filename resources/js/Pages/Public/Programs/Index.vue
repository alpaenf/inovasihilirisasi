<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { ArrowRight, Layers, Factory, Store, Sparkles, CheckCircle2 } from 'lucide-vue-next';

defineProps({
  programs: Array,
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
  <Head>
    <title>4 Program Utama - Inovasi Hilirisasi UNSOED</title>
    <meta name="description" content="Jelajahi 4 pilar program utama Inovasi Hilirisasi Universitas Jenderal Soedirman: SINERGI, AJAKAN INDUSTRI, PMUPUD, dan DORTEK untuk percepatan hilirisasi riset." />
    <meta property="og:title" content="4 Program Utama Inovasi & Riset - Inovasi Hilirisasi UNSOED" />
  </Head>

  <PublicLayout>
    <!-- Page Header -->
    <section class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-16 sm:py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            PILAR UTAMA INOVASI
          </span>
          <h1 class="text-3xl sm:text-5xl font-extrabold text-[#14532D] tracking-tight">
            4 Program Unggulan Inovasi Hilirisasi
          </h1>
          <p class="text-base sm:text-lg text-[#647067] leading-relaxed">
            Pusat Koordinasi Pengembangan dan Penerapan Teknologi menyatukan inisiatif riset, kemitraan industri, pengembangan produk lokal, dan diseminasi masyarakat dalam satu ekosistem terpadu.
          </p>
        </div>
      </div>
    </section>

    <!-- Program Detailed Cards -->
    <section class="py-16 sm:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div
          v-for="(program, index) in programs"
          :key="program.id"
          class="rounded-3xl border border-[#E5EAE5] p-8 sm:p-12 hover:border-[#22C55E]/60 hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center"
          :class="index % 2 === 1 ? 'bg-[#F7FAF7]' : 'bg-white'"
        >
          <div class="lg:col-span-8 space-y-5">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded-2xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
                <component :is="getIcon(program.slug)" class="w-6 h-6" />
              </div>
              <div>
                <span v-if="program.code" class="text-xs font-bold text-[#22C55E] uppercase tracking-wider block">
                  Program {{ program.code }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D]">
                  {{ program.name }}
                </h2>
              </div>
            </div>

            <p class="text-base text-[#17231C]/90 font-medium leading-relaxed">
              {{ program.short_description }}
            </p>

            <p class="text-sm text-[#647067] leading-relaxed">
              {{ program.description }}
            </p>

            <div class="pt-2 flex flex-wrap items-center gap-4">
              <Link
                :href="`/program/${program.slug}`"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all"
              >
                <span>Lihat Detail Program & Produk</span>
                <ArrowRight class="w-4 h-4" />
              </Link>
            </div>
          </div>

          <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-[#E5EAE5] space-y-4 shadow-sm">
            <h4 class="text-xs font-bold text-[#647067] uppercase tracking-wider">Statistik & Keterlibatan</h4>
            <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]/60">
              <span class="text-sm font-medium text-[#17231C]">Produk Teknologi</span>
              <span class="text-base font-bold text-[#14532D]">{{ program.products_count || 0 }} Inovasi</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]/60">
              <span class="text-sm font-medium text-[#17231C]">Status Program</span>
              <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-[#DCFCE7] text-[#14532D]">
                Aktif
              </span>
            </div>
            <div class="pt-2">
              <Link
                :href="`/produk?program=${program.slug}`"
                class="text-xs font-bold text-[#22C55E] hover:text-[#14532D] flex items-center gap-1 transition-colors"
              >
                <span>Filter Katalog Berdasarkan Program Ini →</span>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

