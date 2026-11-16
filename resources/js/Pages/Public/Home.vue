<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProgramCard from '@/Components/Common/ProgramCard.vue';
import ProductCard from '@/Components/Common/ProductCard.vue';
import PartnerCard from '@/Components/Common/PartnerCard.vue';
import { ArrowRight, CheckCircle2, Cpu, Sparkles, Building, Box, ShieldCheck } from 'lucide-vue-next';

const props = defineProps({
  hero: Object,
  programs: Array,
  featuredProducts: Array,
  featuredPartners: Array,
  stats: Object,
});

const jsonLd = {
  '@context': 'https://schema.org',
  '@type': 'EducationalOrganization',
  'name': 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi (PUSKOR) UNSOED',
  'alternateName': 'PUSKOR Universitas Jenderal Soedirman',
  'url': typeof window !== 'undefined' ? window.location.origin : 'https://puskor.unsoed.ac.id',
  'parentOrganization': {
    '@type': 'CollegeOrUniversity',
    'name': 'Universitas Jenderal Soedirman',
    'url': 'https://unsoed.ac.id',
  },
  'address': {
    '@type': 'PostalAddress',
    'streetAddress': 'Jl. Prof. Dr. HR. Boenyamin No. 708, Grendeng',
    'addressLocality': 'Purwokerto',
    'addressRegion': 'Jawa Tengah',
    'postalCode': '53122',
    'addressCountry': 'ID',
  },
  'contactPoint': {
    '@type': 'ContactPoint',
    'email': 'p3t.lppm@unsoed.ac.id',
    'contactType': 'Support & Partnership',
  },
};
</script>

<template>
  <Head>
    <title>PUSKOR UNSOED - Pusat Inovasi & Penerapan Teknologi</title>
    <meta name="description" content="Platform terpadu koordinasi inovasi, alih teknologi, dan hilirisasi riset Universitas Jenderal Soedirman melalui 4 program utama kolaborasi industri." />
    <meta property="og:title" content="PUSKOR UNSOED - Pusat Inovasi & Penerapan Teknologi" />
    <meta property="og:description" content="Wadah koordinasi pengembangan dan penerapan teknologi Universitas Jenderal Soedirman melalui SINERGI, AJAKAN INDUSTRI, PMUPUD, dan DORTEK." />
    <meta property="og:type" content="website" />
    <component :is="'script'" type="application/ld+json">
      {{ JSON.stringify(jsonLd) }}
    </component>
  </Head>

  <PublicLayout>
    <!-- HERO SECTION -->
    <section class="relative overflow-hidden bg-gradient-to-b from-[#F7FAF7] to-white pt-12 pb-20 sm:pt-20 sm:pb-28 border-b border-[#E5EAE5]">
      <!-- Background Ambient Glow -->
      <div class="absolute top-0 right-1/4 w-96 h-96 bg-emerald-100/60 rounded-full blur-3xl -z-10 pointer-events-none"></div>
      <div class="absolute bottom-0 left-10 w-80 h-80 bg-green-50/50 rounded-full blur-2xl -z-10 pointer-events-none"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
          <!-- Left Column: Copywriting & CTAs -->
          <div class="lg:col-span-7 space-y-6 sm:space-y-8">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#DCFCE7] border border-[#22C55E]/20 text-[#14532D] text-xs font-extrabold tracking-wider uppercase">
              <span class="w-2 h-2 rounded-full bg-[#22C55E] animate-pulse"></span>
              {{ hero.eyebrow }}
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#14532D] tracking-tight leading-[1.12]">
              {{ hero.headline }}
            </h1>

            <p class="text-base sm:text-lg text-[#647067] leading-relaxed max-w-2xl font-normal">
              {{ hero.description }}
            </p>

            <div class="flex flex-wrap items-center gap-4 pt-2">
              <Link
                :href="hero.cta_primary.url"
                class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl font-bold text-sm bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-lg shadow-emerald-950/15 hover:shadow-xl transition-all duration-200 group"
              >
                <span>{{ hero.cta_primary.label }}</span>
                <ArrowRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
              </Link>

              <Link
                :href="hero.cta_secondary.url"
                class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl font-bold text-sm bg-white text-[#14532D] border border-[#E5EAE5] hover:border-[#14532D]/40 hover:bg-[#F7FAF7] shadow-sm transition-all duration-200"
              >
                <span>{{ hero.cta_secondary.label }}</span>
              </Link>
            </div>

            <!-- Value Highlights -->
            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-[#E5EAE5]">
              <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-[#14532D]">
                <CheckCircle2 class="w-4 h-4 text-[#22C55E] shrink-0" />
                <span>4 Program Terpadu</span>
              </div>
              <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-[#14532D]">
                <CheckCircle2 class="w-4 h-4 text-[#22C55E] shrink-0" />
                <span>Komersialisasi Inovasi</span>
              </div>
              <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-[#14532D]">
                <CheckCircle2 class="w-4 h-4 text-[#22C55E] shrink-0" />
                <span>Kemitraan Industri</span>
              </div>
            </div>
          </div>

          <!-- Right Column: Institutional Graphic Card -->
          <div class="lg:col-span-5 relative">
            <div class="relative mx-auto max-w-md lg:max-w-none rounded-3xl bg-white border border-[#E5EAE5] p-6 sm:p-8 shadow-2xl shadow-emerald-950/10">
              <div class="flex items-center justify-between pb-6 border-b border-[#E5EAE5]">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-2xl bg-[#14532D] text-[#22C55E] flex items-center justify-center shadow-md">
                    <Cpu class="w-7 h-7" />
                  </div>
                  <div>
                    <h3 class="font-bold text-[#14532D] text-base">Pusat Teknologi Terpadu</h3>
                    <p class="text-xs text-[#647067]">LPPM UNSOED Purwokerto</p>
                  </div>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-[#DCFCE7] text-[#14532D]">
                  Terverifikasi
                </span>
              </div>

              <!-- Metrics inside Card -->
              <div class="grid grid-cols-2 gap-4 my-6">
                <div class="p-4 rounded-xl bg-[#F7FAF7] border border-[#E5EAE5]/60">
                  <span class="text-xs text-[#647067] font-medium block">Program Utama</span>
                  <span class="text-2xl font-extrabold text-[#14532D] mt-1 block">{{ stats.total_programs }} Program</span>
                  <span class="text-[11px] text-[#22C55E] font-semibold mt-0.5 block">SINERGI • AI • PMUPUD • DORTEK</span>
                </div>
                <div class="p-4 rounded-xl bg-[#F7FAF7] border border-[#E5EAE5]/60">
                  <span class="text-xs text-[#647067] font-medium block">Inovasi Tepat Guna</span>
                  <span class="text-2xl font-extrabold text-[#14532D] mt-1 block">{{ stats.total_products }}+ Produk</span>
                  <span class="text-[11px] text-[#22C55E] font-semibold mt-0.5 block">Katalog Terpusat</span>
                </div>
              </div>

              <!-- Institutional Callout -->
              <div class="p-4 rounded-xl bg-gradient-to-r from-[#14532D] to-emerald-900 text-white flex items-center justify-between">
                <div>
                  <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-200">Kemitraan Aktif</h4>
                  <p class="text-sm font-semibold mt-0.5">{{ stats.total_partners }} Mitra Kolaborasi</p>
                </div>
                <Link href="/mitra" class="px-3 py-1.5 rounded-lg bg-white/20 hover:bg-white/30 text-xs font-bold text-white transition-colors">
                  Eksplor
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 4 PROGRAM UNGGULAN SECTION -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            PILAR PENGEMBANGAN TEKNOLOGI
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
            4 Program Utama PUSKOR
          </h2>
          <p class="text-base text-[#647067] leading-relaxed">
            Seluruh inisiatif inovasi diwadahi dalam 4 pilar program terpadu untuk percepatan hilirisasi riset kampus.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
          <ProgramCard
            v-for="prog in programs"
            :key="prog.id"
            :program="prog"
          />
        </div>
      </div>
    </section>

    <!-- PRODUK UNGGULAN SECTION -->
    <section class="py-20 bg-[#F7FAF7] border-y border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
          <div class="space-y-2">
            <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
              KATALOG TERINTEGRASI
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
              Produk Inovasi Unggulan
            </h2>
            <p class="text-sm sm:text-base text-[#647067]">
              Solusi teknologi tepat guna hasil kolaborasi dosen, peneliti, dan mitra industri.
            </p>
          </div>
          <Link
            href="/produk"
            class="inline-flex items-center gap-2 text-sm font-bold text-[#14532D] hover:text-[#22C55E] transition-colors"
          >
            <span>Lihat Semua Produk ({{ stats.total_products }})</span>
            <ArrowRight class="w-4 h-4" />
          </Link>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          <ProductCard
            v-for="prod in featuredProducts"
            :key="prod.id"
            :product="prod"
          />
        </div>
      </div>
    </section>

    <!-- MITRA KOLABORASI SECTION -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
          <div class="space-y-2">
            <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
              JARINGAN KEMITRAAN STRATEGIS
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
              Mitra Kolaborasi
            </h2>
            <p class="text-sm sm:text-base text-[#647067]">
              Bersinergi bersama BUMN, korporasi industri, pemerintah daerah, dan kelompok UMKM.
            </p>
          </div>
          <Link
            href="/mitra"
            class="inline-flex items-center gap-2 text-sm font-bold text-[#14532D] hover:text-[#22C55E] transition-colors"
          >
            <span>Lihat Semua Mitra</span>
            <ArrowRight class="w-4 h-4" />
          </Link>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
          <PartnerCard
            v-for="partner in featuredPartners"
            :key="partner.id"
            :partner="partner"
          />
        </div>
      </div>
    </section>

    <!-- CTA BANNER SECTION -->
    <section class="py-16 bg-[#14532D] text-white">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
          Tertarik Berkolaborasi atau Mengadopsi Teknologi?
        </h2>
        <p class="text-base sm:text-lg text-emerald-100/80 max-w-2xl mx-auto leading-relaxed">
          Tim PUSKOR Universitas Jenderal Soedirman siap memfasilitasi kebutuhan kemitraan riset terapan, uji prototipe, maupun transfer teknologi.
        </p>
        <div class="pt-4 flex flex-wrap justify-center gap-4">
          <a
            href="mailto:p3t.lppm@unsoed.ac.id"
            class="px-8 py-3.5 rounded-xl font-bold text-sm bg-white text-[#14532D] hover:bg-emerald-50 shadow-lg transition-all"
          >
            Hubungi Tim PUSKOR
          </a>
          <Link
            href="/tentang-puskor"
            class="px-8 py-3.5 rounded-xl font-bold text-sm bg-[#14532D] text-white border border-white/20 hover:bg-white/10 transition-all"
          >
            Pelajari Profil Kami
          </Link>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

