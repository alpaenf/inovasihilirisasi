<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { ArrowRight, Layers, Factory, Store, Sparkles, MapPin, Building2, Users } from 'lucide-vue-next';

defineProps({
  programs: Array,
});

const getIcon = (slug) => {
  switch (slug) {
    case 'sinergi':
      return Layers;
    case 'ajakan-industri':
      return Factory;
    case 'pm-upud':
    case 'pmupud':
      return Store;
    case 'dorongan-teknologi':
    case 'dortek':
    default:
      return Sparkles;
  }
};
</script>

<template>
  <Head>
    <title>4 Program Utama - Inovasi Hilirisasi UNSOED</title>
    <meta name="description" content="Jelajahi 4 pilar program utama Inovasi Hilirisasi Universitas Jenderal Soedirman: PM-UPUD, SINERGI, Dorongan Teknologi, dan Ajakan Industri untuk percepatan hilirisasi riset." />
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
          class="rounded-3xl border border-[#E5EAE5] p-8 sm:p-12 hover:border-[#22C55E]/60 hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start"
          :class="index % 2 === 1 ? 'bg-[#F7FAF7]' : 'bg-white'"
        >
          <!-- Left Column: Details, Description & Commodities -->
          <div class="lg:col-span-8 space-y-5">
            <div class="flex items-start gap-4">
              <div class="w-12 h-12 rounded-2xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0 mt-1">
                <component :is="getIcon(program.slug)" class="w-6 h-6" />
              </div>
              <div>
                <div class="flex items-center gap-2 flex-wrap mb-1">
                  <span v-if="program.code" class="text-xs font-bold text-[#22C55E] uppercase tracking-wider block">
                    Program {{ program.code }}
                  </span>
                  <span v-if="program.location" class="inline-flex items-center gap-1 text-[11px] font-semibold text-[#647067]">
                    • <MapPin class="w-3 h-3 text-[#22C55E]" /> {{ program.location }}
                  </span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D] leading-tight">
                  {{ program.name }}
                </h2>
                <p v-if="program.full_name" class="text-xs font-semibold text-[#14532D]/80 mt-1 italic leading-snug">
                  "{{ program.full_name }}"
                </p>
              </div>
            </div>

            <p class="text-base text-[#17231C]/90 font-medium leading-relaxed">
              {{ program.short_description }}
            </p>

            <p class="text-sm text-[#647067] leading-relaxed">
              {{ program.description }}
            </p>

            <!-- Komoditas Utama Badges -->
            <div v-if="program.commodities && program.commodities.length > 0" class="pt-2 space-y-2">
              <span class="text-xs font-extrabold text-[#14532D] uppercase tracking-wider block">
                Komoditas Utama:
              </span>
              <div class="flex flex-wrap gap-2">
                <span
                  v-for="com in program.commodities"
                  :key="com"
                  class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-[#DCFCE7] text-[#14532D] border border-[#22C55E]/30 shadow-2xs"
                >
                  {{ com }}
                </span>
              </div>
            </div>

            <div class="pt-3 flex flex-wrap items-center gap-4">
              <Link
                :href="`/program/${program.slug}`"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all"
              >
                <span>Lihat Detail Program & Produk</span>
                <ArrowRight class="w-4 h-4" />
              </Link>
            </div>
          </div>

          <!-- Right Column: Sidebar info, Partners & Stats -->
          <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-[#E5EAE5] space-y-4 shadow-sm">
            <h4 class="text-xs font-bold text-[#647067] uppercase tracking-wider">Informasi Pelaksanaan & Mitra</h4>
            
            <!-- Lokasi -->
            <div v-if="program.location" class="py-2.5 border-b border-[#E5EAE5]/60 space-y-1">
              <span class="text-xs font-bold text-[#647067] uppercase tracking-wider block">Lokasi Pelaksanaan</span>
              <span class="text-xs font-semibold text-[#14532D] flex items-center gap-1.5">
                <MapPin class="w-3.5 h-3.5 text-[#22C55E] shrink-0" />
                <span>{{ program.location }}</span>
              </span>
            </div>

            <!-- Mitra Industri Resmi -->
            <div class="py-2.5 border-b border-[#E5EAE5]/60 space-y-2">
              <span class="text-xs font-bold text-[#647067] uppercase tracking-wider block">Mitra Industri Terkait</span>
              <div v-if="program.partners && program.partners.length > 0" class="flex flex-col gap-1.5">
                <Link
                  v-for="partner in program.partners"
                  :key="partner.id"
                  :href="`/mitra/${partner.slug}`"
                  class="inline-flex items-center justify-between p-2 rounded-xl bg-[#F7FAF7] hover:bg-[#DCFCE7]/60 border border-[#E5EAE5] hover:border-[#22C55E]/60 text-xs font-bold text-[#14532D] transition-colors group"
                >
                  <span class="flex items-center gap-1.5">
                    <Building2 class="w-3.5 h-3.5 text-[#22C55E]" />
                    <span>{{ partner.name }}</span>
                  </span>
                  <ArrowRight class="w-3 h-3 text-[#647067] group-hover:text-[#14532D] group-hover:translate-x-0.5 transition-transform" />
                </Link>
              </div>
              <span v-else class="text-xs text-[#647067] italic">Mitra industri sedang dikonfigurasi</span>
            </div>

            <!-- Produk Inovasi Count -->
            <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]/60">
              <span class="text-xs font-medium text-[#17231C]">Produk Inovasi</span>
              <span class="text-sm font-bold text-[#14532D]">{{ program.products_count || 0 }} Produk</span>
            </div>

            <!-- Status Program -->
            <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]/60">
              <span class="text-xs font-medium text-[#17231C]">Status Program</span>
              <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-[#DCFCE7] text-[#14532D]">
                Aktif Berjalan
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

