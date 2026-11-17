<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProductCard from '@/Components/Common/ProductCard.vue';
import PartnerCard from '@/Components/Common/PartnerCard.vue';
import {
  ArrowLeft,
  Layers,
  Factory,
  Store,
  Sparkles,
  Building2,
  Box,
  GraduationCap,
  MapPin,
  Target,
  CheckCircle2,
  ListOrdered,
  Users
} from 'lucide-vue-next';

const props = defineProps({
  program: Object,
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
    <title>{{ program.name }} - Program Inovasi Hilirisasi UNSOED</title>
    <meta name="description" :content="program.short_description" />
    <meta property="og:title" :content="program.name + ' - Inovasi Hilirisasi UNSOED'" />
    <meta property="og:description" :content="program.short_description" />
  </Head>

  <PublicLayout>
    <!-- Breadcrumb & Hero -->
    <section class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-12 sm:py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <Link href="/program" class="inline-flex items-center gap-2 text-xs font-bold text-[#647067] hover:text-[#14532D] mb-6 transition-colors">
          <ArrowLeft class="w-4 h-4" />
          <span>Kembali ke Seluruh Program</span>
        </Link>

        <div class="max-w-4xl space-y-4">
          <div class="flex items-center gap-2 flex-wrap">
            <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
              PROGRAM {{ program.code || 'INOVASI HILIRISASI' }}
            </span>
            <span v-if="program.location" class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-[#DCFCE7] text-[#14532D] border border-[#22C55E]/30">
              <MapPin class="w-3.5 h-3.5 text-[#22C55E]" />
              <span>{{ program.location }}</span>
            </span>
          </div>

          <h1 class="text-3xl sm:text-5xl font-extrabold text-[#14532D] tracking-tight">
            {{ program.name }}
          </h1>

          <!-- Nama Lengkap Resmi Program -->
          <div v-if="program.full_name" class="p-4 sm:p-5 rounded-2xl bg-white border border-[#E5EAE5] shadow-2xs">
            <span class="text-[11px] font-extrabold uppercase tracking-wider text-[#22C55E] block mb-1">
              Nama Lengkap Resmi Program:
            </span>
            <p class="text-sm sm:text-base font-semibold text-[#14532D] leading-snug">
              {{ program.full_name }}
            </p>
          </div>

          <p class="text-base sm:text-lg text-[#647067] leading-relaxed font-normal">
            {{ program.short_description }}
          </p>
        </div>
      </div>
    </section>

    <!-- Program Overview & Detail Content -->
    <section class="py-16 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
          <!-- Main description -->
          <div class="lg:col-span-8 space-y-8">
            <!-- Deskripsi & Latar Belakang -->
            <div class="space-y-4">
              <h2 class="text-2xl font-extrabold text-[#14532D] flex items-center gap-2">
                <span>Deskripsi & Gambaran Program</span>
              </h2>
              <div class="prose prose-emerald max-w-none text-[#17231C]/90 text-base leading-relaxed">
                <p>{{ program.description }}</p>
              </div>
            </div>

            <!-- Tujuan Program -->
            <div v-if="program.objectives" class="space-y-3 pt-4 border-t border-[#E5EAE5]">
              <h3 class="text-xl font-bold text-[#14532D] flex items-center gap-2">
                <Target class="w-5 h-5 text-[#22C55E]" />
                <span>Tujuan Program</span>
              </h3>
              <div class="p-5 rounded-2xl bg-[#F7FAF7] border border-[#E5EAE5] text-[#17231C]/90 text-sm sm:text-base leading-relaxed">
                <p>{{ program.objectives }}</p>
              </div>
            </div>

            <!-- Komoditas Utama -->
            <div v-if="program.commodities && program.commodities.length > 0" class="space-y-3 pt-4 border-t border-[#E5EAE5]">
              <h3 class="text-xl font-bold text-[#14532D] flex items-center gap-2">
                <Box class="w-5 h-5 text-[#22C55E]" />
                <span>Komoditas Utama yang Dikembangkan</span>
              </h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div
                  v-for="commodity in program.commodities"
                  :key="commodity"
                  class="p-4 rounded-xl bg-[#F7FAF7] border border-[#E5EAE5] flex items-center gap-3"
                >
                  <div class="w-8 h-8 rounded-lg bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                    <CheckCircle2 class="w-4 h-4 text-[#22C55E]" />
                  </div>
                  <span class="text-sm font-bold text-[#14532D]">{{ commodity }}</span>
                </div>
              </div>
            </div>

            <!-- Fokus & Ruang Lingkup Kegiatan -->
            <div v-if="program.focus_activities && program.focus_activities.length > 0" class="space-y-3 pt-4 border-t border-[#E5EAE5]">
              <h3 class="text-xl font-bold text-[#14532D] flex items-center gap-2">
                <ListOrdered class="w-5 h-5 text-[#22C55E]" />
                <span>Fokus & Ruang Lingkup Kegiatan</span>
              </h3>
              <div class="space-y-2.5">
                <div
                  v-for="(activity, idx) in program.focus_activities"
                  :key="activity"
                  class="p-4 rounded-xl bg-white border border-[#E5EAE5] hover:border-[#22C55E]/60 shadow-2xs transition-all flex items-start gap-3.5"
                >
                  <span class="w-6 h-6 rounded-full bg-[#14532D] text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
                    {{ idx + 1 }}
                  </span>
                  <p class="text-sm text-[#17231C]/90 font-medium leading-relaxed">
                    {{ activity }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Kebutuhan Mahasiswa pada Poster -->
            <div v-if="program.student_needs && program.student_needs.length > 0" class="space-y-3 pt-4 border-t border-[#E5EAE5]">
              <h3 class="text-xl font-bold text-[#14532D] flex items-center gap-2">
                <GraduationCap class="w-5 h-5 text-[#22C55E]" />
                <span>Kebutuhan Mahasiswa (Berdasarkan Poster Resmi)</span>
              </h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                <div
                  v-for="need in program.student_needs"
                  :key="need.major"
                  class="p-3.5 rounded-xl bg-[#F7FAF7] border border-[#E5EAE5] flex items-center justify-between"
                >
                  <span class="text-xs font-bold text-[#14532D]">{{ need.major }}</span>
                  <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-[#DCFCE7] text-[#14532D]">
                    {{ need.quota }}
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Side Information card -->
          <div class="lg:col-span-4 space-y-6">
            <div class="p-6 rounded-2xl bg-[#F7FAF7] border border-[#E5EAE5] space-y-4 shadow-sm">
              <h3 class="text-sm font-bold text-[#14532D] uppercase tracking-wider">Ringkasan & Kemitraan</h3>
              
              <div class="space-y-3 text-sm">
                <!-- Unit Pengelola -->
                <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]">
                  <span class="text-xs text-[#647067]">Unit Pengelola</span>
                  <span class="text-xs font-semibold text-[#14532D]">Inovasi Hilirisasi LPPM UNSOED</span>
                </div>

                <!-- Lokasi -->
                <div v-if="program.location" class="py-2 border-b border-[#E5EAE5] space-y-1">
                  <span class="text-xs text-[#647067] block">Lokasi Pelaksanaan</span>
                  <span class="text-xs font-bold text-[#14532D] flex items-center gap-1.5">
                    <MapPin class="w-3.5 h-3.5 text-[#22C55E] shrink-0" />
                    <span>{{ program.location }}</span>
                  </span>
                </div>

                <!-- Mitra Industri Resmi -->
                <div class="py-2 border-b border-[#E5EAE5] space-y-2">
                  <span class="text-xs text-[#647067] block">Mitra Industri Resmi:</span>
                  <div v-if="program.partners && program.partners.length > 0" class="flex flex-col gap-1.5">
                    <Link
                      v-for="partner in program.partners"
                      :key="partner.id"
                      :href="`/mitra/${partner.slug}`"
                      class="inline-flex items-center gap-2 p-2 rounded-xl bg-white border border-[#E5EAE5] hover:border-[#22C55E] text-xs font-bold text-[#14532D] transition-colors"
                    >
                      <Building2 class="w-3.5 h-3.5 text-[#22C55E] shrink-0" />
                      <span class="truncate">{{ partner.name }}</span>
                    </Link>
                  </div>
                  <span v-else class="text-xs text-[#647067] italic">Mitra industri sedang dikonfigurasi</span>
                </div>

                <!-- Produk Terkait -->
                <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]">
                  <span class="text-xs text-[#647067]">Jumlah Produk</span>
                  <span class="text-xs font-bold text-[#14532D]">{{ program.products?.length || 0 }} Produk</span>
                </div>

                <!-- Status -->
                <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]">
                  <span class="text-xs text-[#647067]">Status Program</span>
                  <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-[#DCFCE7] text-[#14532D]">
                    Aktif
                  </span>
                </div>
              </div>

              <div class="pt-3">
                <a
                  href="mailto:p3t.lppm@unsoed.ac.id"
                  class="block w-full py-2.5 px-4 rounded-xl text-center text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-colors shadow-sm"
                >
                  Ajukan Kolaborasi Program
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Produk Terkait -->
    <section class="py-16 bg-[#F7FAF7]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
          <div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D]">
              Produk Inovasi Terkait Program
            </h2>
            <p class="text-sm text-[#647067] mt-1">
              Daftar teknologi dan produk terapan yang dihasilkan melalui program {{ program.name }}.
            </p>
          </div>
        </div>

        <div v-if="program.products && program.products.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          <ProductCard
            v-for="prod in program.products"
            :key="prod.id"
            :product="{ ...prod, program: { name: program.name, slug: program.slug } }"
          />
        </div>
        <div v-else class="text-center py-12 bg-white rounded-2xl border border-[#E5EAE5] text-[#647067] text-sm">
          Belum ada produk yang dipublikasikan pada program ini.
        </div>
      </div>
    </section>

    <!-- Tim Mahasiswa & Asisten Peneliti Program -->
    <section v-if="program.students && program.students.length > 0" class="py-16 bg-white border-t border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block mb-2">
            TIM PELAKSANA
          </span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D]">
            Mahasiswa & Peneliti Program {{ program.name }}
          </h2>
          <p class="text-sm text-[#647067] mt-1">
            Talenta mahasiswa yang terlibat aktif dalam riset, perancangan prototipe, dan penerapan teknologi pada program {{ program.name }}.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
          <div
            v-for="student in program.students"
            :key="student.id || student.name"
            class="bg-[#F7FAF7] p-5 rounded-2xl border border-[#E5EAE5] shadow-2xs hover:shadow-md transition-all flex flex-col justify-between"
          >
            <div>
              <div class="relative w-14 h-14 rounded-2xl overflow-hidden bg-white border border-[#E5EAE5] mb-3 flex items-center justify-center">
                <img
                  v-if="student.photo"
                  :src="student.photo"
                  :alt="student.name"
                  class="w-full h-full object-cover"
                />
                <div v-else class="w-full h-full bg-gradient-to-br from-emerald-100 to-green-50 text-[#14532D] flex items-center justify-center font-extrabold text-xs">
                  {{ student.name ? student.name.split(' ').map(n => n[0]).slice(0, 2).join('') : 'MHS' }}
                </div>
              </div>

              <h4 class="text-sm font-bold text-[#14532D] leading-snug">
                {{ student.name }}
              </h4>
              <p v-if="student.identifier" class="text-[11px] font-semibold text-[#647067] mt-0.5">
                {{ student.identifier }}
              </p>
              <div v-if="student.role" class="mt-2.5 p-2 rounded-xl bg-white border border-[#E5EAE5] text-xs text-[#17231C]/90 font-medium">
                {{ student.role }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Mitra Terkait -->
    <section v-if="program.partners && program.partners.length > 0" class="py-16 bg-[#F7FAF7] border-t border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D]">
            Mitra Kolaborator Program
          </h2>
          <p class="text-sm text-[#647067] mt-1">
            Instansi dan industri yang bekerjasama dalam pelaksanaan program {{ program.name }}.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <PartnerCard
            v-for="partner in program.partners"
            :key="partner.id"
            :partner="partner"
          />
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

