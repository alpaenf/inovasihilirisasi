<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import {
  Cpu,
  Target,
  Award,
  CheckCircle2,
  Mail,
  MapPin,
  Building,
  Users,
  Network,
  ShieldCheck,
  Sprout,
  Handshake,
  Lightbulb,
  ArrowRight
} from 'lucide-vue-next';

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

    <!-- SECTION STRUKTUR ORGANISASI -->
    <section class="py-16 sm:py-24 bg-[#F7FAF7] border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-14 sm:mb-16 space-y-3">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#DCFCE7] text-[#14532D] uppercase tracking-wider">
            <Network class="w-3.5 h-3.5 text-[#22C55E]" />
            Tata Kelola Institusi
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
            Struktur Organisasi Inovasi Hilirisasi
          </h2>
          <p class="text-sm sm:text-base text-[#647067] leading-relaxed">
            Struktur kepemimpinan dan pembagian divisi operasional dalam mengoordinasikan hilirisasi riset, alih teknologi, dan kemitraan industri di lingkungan LPPM UNSOED.
          </p>
        </div>

        <!-- Hierarchical Organizational Chart -->
        <div class="space-y-8 sm:space-y-10">
          <!-- Level 1: Pengarah & Pelindung (Advisory Level) -->
          <div>
            <div class="flex items-center justify-center gap-3 mb-5">
              <span class="h-px w-10 sm:w-16 bg-[#E5EAE5]"></span>
              <span class="text-[11px] font-extrabold uppercase tracking-widest text-[#647067]">
                Pengarah & Pelindung Utama
              </span>
              <span class="h-px w-10 sm:w-16 bg-[#E5EAE5]"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 max-w-3xl mx-auto">
              <!-- Rektor -->
              <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-xs hover:border-[#22C55E]/40 hover:shadow-md transition-all flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                  <Building class="w-6 h-6" />
                </div>
                <div>
                  <span class="inline-block text-[11px] font-bold text-[#22C55E] uppercase tracking-wider">Pelindung</span>
                  <h3 class="text-base font-bold text-[#14532D]">Rektor Universitas Jenderal Soedirman</h3>
                  <p class="text-xs text-[#647067] mt-1 leading-relaxed">
                    Pengarah kebijakan tertinggi institusi dan fasilitasi ekosistem hilirisasi riset terpadu.
                  </p>
                </div>
              </div>

              <!-- Ketua LPPM -->
              <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-xs hover:border-[#22C55E]/40 hover:shadow-md transition-all flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                  <Award class="w-6 h-6" />
                </div>
                <div>
                  <span class="inline-block text-[11px] font-bold text-[#22C55E] uppercase tracking-wider">Pengarah Operasional</span>
                  <h3 class="text-base font-bold text-[#14532D]">Ketua LPPM UNSOED</h3>
                  <p class="text-xs text-[#647067] mt-1 leading-relaxed">
                    Pengarah operasional pelaksanaan riset terapan dan pengabdian masyarakat inovatif.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Vertical Connector Line -->
          <div class="flex justify-center -my-3">
            <div class="w-0.5 h-6 bg-[#22C55E]/40"></div>
          </div>

          <!-- Level 2: Pimpinan Pusat (Executive Leadership) -->
          <div>
            <div class="flex items-center justify-center gap-3 mb-5">
              <span class="h-px w-10 sm:w-16 bg-[#E5EAE5]"></span>
              <span class="text-[11px] font-extrabold uppercase tracking-widest text-[#647067]">
                Pimpinan Pusat Inovasi Hilirisasi
              </span>
              <span class="h-px w-10 sm:w-16 bg-[#E5EAE5]"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 max-w-3xl mx-auto">
              <!-- Koordinator Pusat -->
              <div class="bg-white p-6 rounded-2xl border-2 border-[#14532D]/30 shadow-md flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#14532D] text-white flex items-center justify-center shrink-0 shadow-sm">
                  <Users class="w-6 h-6 text-[#22C55E]" />
                </div>
                <div>
                  <span class="inline-block text-[11px] font-extrabold text-[#14532D] uppercase tracking-wider">Pimpinan Eksekutif</span>
                  <h3 class="text-base font-bold text-[#14532D]">Koordinator Pusat Inovasi Hilirisasi</h3>
                  <p class="text-xs text-[#647067] mt-1 leading-relaxed">
                    Penanggung jawab program, orkestrasi alih teknologi, dan kemitraan strategis dengan DUDI & Pemerintah.
                  </p>
                </div>
              </div>

              <!-- Sekretaris Pusat -->
              <div class="bg-white p-6 rounded-2xl border-2 border-[#14532D]/30 shadow-md flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#14532D] text-white flex items-center justify-center shrink-0 shadow-sm">
                  <ShieldCheck class="w-6 h-6 text-[#22C55E]" />
                </div>
                <div>
                  <span class="inline-block text-[11px] font-extrabold text-[#14532D] uppercase tracking-wider">Tata Kelola & HKI</span>
                  <h3 class="text-base font-bold text-[#14532D]">Sekretaris & Penjaminan Mutu</h3>
                  <p class="text-xs text-[#647067] mt-1 leading-relaxed">
                    Pengelolaan administrasi legal, pendaftaran paten/HKI, monitoring evaluasi, dan akuntabilitas program.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Vertical Connector Line -->
          <div class="flex justify-center -my-3">
            <div class="w-0.5 h-6 bg-[#22C55E]/40"></div>
          </div>

          <!-- Level 3: 4 Divisi Pelaksana Program Utama -->
          <div>
            <div class="flex items-center justify-center gap-3 mb-6">
              <span class="h-px w-10 sm:w-16 bg-[#E5EAE5]"></span>
              <span class="text-[11px] font-extrabold uppercase tracking-widest text-[#647067]">
                Divisi Kerja Pelaksana 4 Program Unggulan
              </span>
              <span class="h-px w-10 sm:w-16 bg-[#E5EAE5]"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
              <!-- Divisi 1: SINERGI -->
              <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/60 hover:shadow-lg transition-all flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
                      <Sprout class="w-5 h-5" />
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[#14532D] text-white">
                      SINERGI
                    </span>
                  </div>
                  <h4 class="text-sm font-bold text-[#14532D] mb-2 leading-snug">
                    Divisi Riset Terapan & Formulasi
                  </h4>
                  <p class="text-xs text-[#647067] leading-relaxed">
                    Fasilitasi uji formulasi pupuk organik hayati, pakan ternak hibrida, dan bioteknologi berbasis sumber daya lokal.
                  </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#E5EAE5] text-[11px] font-semibold text-[#22C55E] flex items-center justify-between">
                  <span>Riset Kolaboratif</span>
                  <Link href="/program/sinergi" class="text-[#14532D] hover:underline font-bold">Detail →</Link>
                </div>
              </div>

              <!-- Divisi 2: AJAKAN INDUSTRI -->
              <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/60 hover:shadow-lg transition-all flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
                      <Handshake class="w-5 h-5" />
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[#14532D] text-white">
                      INDUSTRI
                    </span>
                  </div>
                  <h4 class="text-sm font-bold text-[#14532D] mb-2 leading-snug">
                    Divisi Kemitraan & Komersialisasi
                  </h4>
                  <p class="text-xs text-[#647067] leading-relaxed">
                    Menjembatani kerja sama industri manufaktur, lisensi paten, dan komersialisasi teknologi skala industri.
                  </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#E5EAE5] text-[11px] font-semibold text-[#22C55E] flex items-center justify-between">
                  <span>Alih Teknologi DUDI</span>
                  <Link href="/program/ajakan-industri" class="text-[#14532D] hover:underline font-bold">Detail →</Link>
                </div>
              </div>

              <!-- Divisi 3: PMUPUD -->
              <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/60 hover:shadow-lg transition-all flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
                      <Lightbulb class="w-5 h-5" />
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[#14532D] text-white">
                      PMUPUD
                    </span>
                  </div>
                  <h4 class="text-sm font-bold text-[#14532D] mb-2 leading-snug">
                    Divisi Inkubasi Produk & UMKM
                  </h4>
                  <p class="text-xs text-[#647067] leading-relaxed">
                    Pengembangan produk unggulan desa, sertifikasi organik/halal, standardisasi mutu ekspor, dan kemasan higienis.
                  </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#E5EAE5] text-[11px] font-semibold text-[#22C55E] flex items-center justify-between">
                  <span>Inkubasi Klaster Desa</span>
                  <Link href="/program/pmupud" class="text-[#14532D] hover:underline font-bold">Detail →</Link>
                </div>
              </div>

              <!-- Divisi 4: DORTEK -->
              <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/60 hover:shadow-lg transition-all flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
                      <Cpu class="w-5 h-5" />
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[#14532D] text-white">
                      DORTEK
                    </span>
                  </div>
                  <h4 class="text-sm font-bold text-[#14532D] mb-2 leading-snug">
                    Divisi Diseminasi Alat Tepat Guna
                  </h4>
                  <p class="text-xs text-[#647067] leading-relaxed">
                    Perekayasaan mesin pascapanen, pengering gabah hibrida, monitoring IoT, dan pelatihan operator pedesaan.
                  </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#E5EAE5] text-[11px] font-semibold text-[#22C55E] flex items-center justify-between">
                  <span>Teknologi Aplikatif</span>
                  <Link href="/program/dortek" class="text-[#14532D] hover:underline font-bold">Detail →</Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Bottom Institutional CTA -->
    <section class="py-16 sm:py-20 bg-gradient-to-r from-[#14532D] to-emerald-950 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
          Mari Berkolaborasi Mengembangkan Inovasi Tepat Guna
        </h2>
        <p class="text-sm sm:text-base text-emerald-100 max-w-2xl mx-auto leading-relaxed">
          Pusat Koordinasi Pengembangan dan Penerapan Teknologi UNSOED membuka pintu kemitraan seluas-luasnya bagi kalangan industri, instansi pemerintah, dan kelompok masyarakat desa.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
          <Link
            href="/program"
            class="w-full sm:w-auto px-7 py-3.5 rounded-xl font-bold text-sm bg-white text-[#14532D] hover:bg-emerald-50 shadow-md transition-all inline-flex items-center justify-center gap-2"
          >
            <span>Jelajahi 4 Program Utama</span>
            <ArrowRight class="w-4 h-4" />
          </Link>
          <Link
            href="/mitra"
            class="w-full sm:w-auto px-7 py-3.5 rounded-xl font-bold text-sm bg-white/10 hover:bg-white/20 text-white border border-white/20 transition-all inline-flex items-center justify-center"
          >
            <span>Daftar Mitra Kolaborasi</span>
          </Link>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>
