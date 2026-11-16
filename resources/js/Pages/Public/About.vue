<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Cpu, Target, Award, CheckCircle2, Mail, Phone, MapPin, Building } from 'lucide-vue-next';

defineProps({
  about: Object,
  programs: Array,
  stats: Object,
});
</script>

<template>
  <Head>
    <title>Tentang Inovasi Hilirisasi - Universitas Jenderal Soedirman</title>
    <meta name="description" content="Profil Pusat Koordinasi Pengembangan dan Penerapan Teknologi (Inovasi Hilirisasi) LPPM Universitas Jenderal Soedirman. Mendorong hilirisasi riset, inovasi, dan transfer teknologi." />
    <meta property="og:title" content="Tentang Inovasi Hilirisasi UNSOED" />
  </Head>

  <PublicLayout>
    <!-- Page Header -->
    <section class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-16 sm:py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            PROFIL INSTITUSI
          </span>
          <h1 class="text-3xl sm:text-5xl font-extrabold text-[#14532D] tracking-tight">
            Pusat Koordinasi Pengembangan dan Penerapan Teknologi
          </h1>
          <p class="text-base sm:text-lg text-[#647067] leading-relaxed">
            Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) Universitas Jenderal Soedirman.
          </p>
        </div>
      </div>
    </section>

    <!-- Main Profile & Mission Section -->
    <section class="py-16 sm:py-20 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
          <div class="lg:col-span-7 space-y-6">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D]">
              Menghubungkan Gagasan Riset Menjadi Solusi Nyata
            </h2>
            <p class="text-base text-[#17231C]/90 leading-relaxed">
              {{ about.content }}
            </p>

            <div class="pt-4 space-y-4">
              <h3 class="text-lg font-bold text-[#14532D]">Misi Strategis:</h3>
              <div class="space-y-3">
                <div v-for="(m, idx) in about.mission" :key="idx" class="flex items-start gap-3">
                  <CheckCircle2 class="w-5 h-5 text-[#22C55E] shrink-0 mt-0.5" />
                  <span class="text-sm text-[#17231C]">{{ m }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Highlight Box -->
          <div class="lg:col-span-5 bg-[#F7FAF7] p-8 rounded-3xl border border-[#E5EAE5] space-y-6">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded-2xl bg-[#14532D] text-[#22C55E] flex items-center justify-center">
                <Target class="w-6 h-6" />
              </div>
              <div>
                <h3 class="text-base font-bold text-[#14532D]">Visi Organisasi</h3>
                <span class="text-xs text-[#647067]">Inovasi Hilirisasi UNSOED</span>
              </div>
            </div>

            <p class="text-sm text-[#17231C]/90 leading-relaxed font-medium italic">
              "{{ about.vision || 'Menjadi pusat koordinasi dan hilirisasi teknologi terapan terkemuka yang berdampak nyata bagi kesejahteraan masyarakat dan industri.' }}"
            </p>

            <div class="pt-4 border-t border-[#E5EAE5] space-y-3 text-xs text-[#647067]">
              <div class="flex items-center gap-2">
                <MapPin class="w-4 h-4 text-[#22C55E] shrink-0" />
                <span>Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto</span>
              </div>
              <div class="flex items-center gap-2">
                <Mail class="w-4 h-4 text-[#22C55E] shrink-0" />
                <a href="mailto:p3t.lppm@unsoed.ac.id" class="hover:text-[#14532D] font-semibold">p3t.lppm@unsoed.ac.id</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

