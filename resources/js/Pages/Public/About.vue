<script setup>
import { ref, computed } from 'vue';
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
  ArrowRight,
  GraduationCap,
  Sparkles,
  Layers,
  ChevronRight
} from 'lucide-vue-next';

const props = defineProps({
  about: Object,
  organization: Object,
  programs: Array,
  stats: Object,
});

// Selected Program tab for Students section
const activeProgramTab = ref('all');

// Compute students list based on active tab
const filteredStudents = computed(() => {
  const students = props.organization?.students || [];
  if (activeProgramTab.value === 'all') {
    return students;
  }
  return students.filter((s) => s.program_slug === activeProgramTab.value || (activeProgramTab.value === 'pm-upud' && s.program_slug === 'pmupud') || (activeProgramTab.value === 'dorongan-teknologi' && s.program_slug === 'dortek'));
});

// Program icons map
const getProgramIcon = (slug) => {
  switch (slug) {
    case 'sinergi':
      return Sprout;
    case 'ajakan-industri':
      return Handshake;
    case 'pm-upud':
    case 'pmupud':
      return Lightbulb;
    case 'dorongan-teknologi':
    case 'dortek':
    default:
      return Cpu;
  }
};

// Count students per program
const countStudents = (slug) => {
  const students = props.organization?.students || [];
  if (slug === 'all') return students.length;
  return students.filter((s) => s.program_slug === slug || (slug === 'pm-upud' && s.program_slug === 'pmupud') || (slug === 'dorongan-teknologi' && s.program_slug === 'dortek')).length;
};
</script>

<template>
  <Head>
    <title>Tentang Inovasi Hilirisasi - Universitas Jenderal Soedirman</title>
    <meta name="description" content="Profil Pusat Koordinasi Pengembangan dan Penerapan Teknologi (Inovasi Hilirisasi) LPPM Universitas Jenderal Soedirman. Mendorong hilirisasi riset, inovasi, dan transfer teknologi." />
    <meta property="og:title" content="Tentang Inovasi Hilirisasi UNSOED" />
  </Head>

  <PublicLayout>
    <!-- Page Header -->
    <section class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-14 sm:py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            PROFIL INSTITUSI
          </span>
          <h1 class="text-3xl sm:text-5xl font-extrabold text-[#14532D] tracking-tight">
            {{ about.title || 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi' }}
          </h1>
          <p class="text-base sm:text-lg text-[#647067] leading-relaxed">
            Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) Universitas Jenderal Soedirman.
          </p>
        </div>
      </div>
    </section>

    <!-- Main Profile & Mission Section -->
    <section class="py-14 sm:py-20 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
          <div class="lg:col-span-7 space-y-6">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D] leading-snug">
              Menghubungkan Gagasan Riset Menjadi Solusi Nyata
            </h2>
            <p class="text-base text-[#17231C]/90 leading-relaxed font-normal">
              {{ about.content }}
            </p>

            <div class="pt-4 space-y-4">
              <h3 class="text-base sm:text-lg font-bold text-[#14532D]">Misi Strategis:</h3>
              <div class="space-y-3">
                <div v-for="(m, idx) in about.mission" :key="idx" class="flex items-start gap-3">
                  <CheckCircle2 class="w-5 h-5 text-[#22C55E] shrink-0 mt-0.5" />
                  <span class="text-sm text-[#17231C] leading-relaxed">{{ m }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Highlight Box: Vision & Contact -->
          <div class="lg:col-span-5 bg-[#F7FAF7] p-6 sm:p-8 rounded-3xl border border-[#E5EAE5] space-y-6 shadow-xs">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded-2xl bg-[#14532D] text-[#22C55E] flex items-center justify-center shrink-0">
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
        <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16 space-y-3">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            TATA KELOLA INSTITUSI
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
            {{ organization?.title || 'Struktur Organisasi Inovasi Hilirisasi' }}
          </h2>
          <p class="text-sm sm:text-base text-[#647067] leading-relaxed">
            {{ organization?.content || 'Struktur kepemimpinan dan pembagian divisi operasional dalam mengoordinasikan hilirisasi riset, alih teknologi, dan kemitraan industri di lingkungan LPPM UNSOED.' }}
          </p>
        </div>

        <!-- Hierarchical Organizational Chart -->
        <div class="space-y-8 sm:space-y-10">
          <!-- Leaders Grid (Advisory & Executive) -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 max-w-5xl mx-auto">
            <div
              v-for="leader in organization?.leaders"
              :key="leader.id || leader.name"
              class="bg-white p-5 sm:p-6 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/50 shadow-xs hover:shadow-md transition-all flex flex-col sm:flex-row items-start sm:items-center gap-4 group"
            >
              <!-- Photo / Avatar -->
              <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden bg-[#F7FAF7] border border-[#E5EAE5] shrink-0 flex items-center justify-center">
                <img
                  v-if="leader.photo"
                  :src="leader.photo"
                  :alt="leader.name"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div v-else class="w-full h-full bg-gradient-to-br from-emerald-100 to-green-50 text-[#14532D] flex items-center justify-center font-extrabold text-sm sm:text-base">
                  {{ leader.name ? leader.name.split(' ').map(n => n[0]).slice(0, 2).join('') : 'UNS' }}
                </div>
              </div>

              <!-- Content -->
              <div class="min-w-0 flex-1 space-y-1">
                <div class="flex items-center gap-2 flex-wrap">
                  <span class="inline-block text-[10px] sm:text-[11px] font-extrabold text-[#22C55E] uppercase tracking-wider">
                    {{ leader.category || 'Pimpinan' }}
                  </span>
                </div>
                <h3 class="text-sm sm:text-base font-bold text-[#14532D] leading-snug group-hover:text-[#22C55E] transition-colors">
                  {{ leader.name }}
                </h3>
                <p class="text-xs font-semibold text-[#17231C]/80">
                  {{ leader.position }}
                </p>
                <p v-if="leader.description" class="text-xs text-[#647067] leading-relaxed pt-1">
                  {{ leader.description }}
                </p>
              </div>
            </div>
          </div>

          <!-- Vertical Connector Line -->
          <div class="flex justify-center -my-2 sm:-my-3">
            <div class="w-0.5 h-6 bg-[#22C55E]/40"></div>
          </div>

          <!-- 4 Divisi Program Utama -->
          <div>
            <div class="flex items-center justify-center gap-3 mb-6">
              <span class="h-px w-10 sm:w-16 bg-[#E5EAE5]"></span>
              <span class="text-[11px] font-extrabold uppercase tracking-widest text-[#647067] text-center">
                Divisi Pelaksana 4 Program Unggulan
              </span>
              <span class="h-px w-10 sm:w-16 bg-[#E5EAE5]"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
              <div
                v-for="div in organization?.divisions"
                :key="div.id || div.program_slug"
                class="bg-white p-5 sm:p-6 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/60 hover:shadow-lg transition-all flex flex-col justify-between group"
              >
                <div>
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
                      <component :is="getProgramIcon(div.program_slug)" class="w-5 h-5 text-[#22C55E]" />
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[#14532D] text-white uppercase tracking-wider">
                      {{ div.program_name }}
                    </span>
                  </div>

                  <h4 class="text-sm font-bold text-[#14532D] mb-1.5 leading-snug group-hover:text-[#22C55E] transition-colors">
                    {{ div.position }}
                  </h4>

                  <p v-if="div.name" class="text-xs font-semibold text-[#14532D]/90 mb-2">
                    {{ div.name }}
                  </p>

                  <p class="text-xs text-[#647067] leading-relaxed">
                    {{ div.description }}
                  </p>
                </div>

                <div class="mt-4 pt-3 border-t border-[#E5EAE5] text-[11px] font-semibold text-[#22C55E] flex items-center justify-between">
                  <span>Divisi Program</span>
                  <Link :href="`/program/${div.program_slug}`" class="text-[#14532D] hover:underline font-bold inline-flex items-center gap-1">
                    <span>Detail</span>
                    <ChevronRight class="w-3.5 h-3.5" />
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION TIM MAHASISWA & PENELITI PER PROGRAM (FLEKSIBEL) -->
    <section class="py-16 sm:py-24 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-10 sm:mb-12 space-y-3">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            GENERASI INOVATOR MUDA
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
            Tim Mahasiswa & Asisten Peneliti
          </h2>
          <p class="text-sm sm:text-base text-[#647067] leading-relaxed">
            Mahasiswa bertalenta Universitas Jenderal Soedirman yang terlibat aktif dalam riset terapan, perancangan prototipe, uji laboratorium, dan kemitraan di setiap program inovasi hilirisasi.
          </p>
        </div>

        <!-- Filter Tabs per Program -->
        <div class="flex items-center justify-center gap-2 mb-10 overflow-x-auto no-scrollbar pb-2">
          <button
            type="button"
            @click="activeProgramTab = 'all'"
            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all whitespace-nowrap min-h-[40px] flex items-center gap-1.5"
            :class="activeProgramTab === 'all'
              ? 'bg-[#14532D] text-white shadow-sm'
              : 'bg-[#F7FAF7] text-[#647067] hover:bg-emerald-50 hover:text-[#14532D] border border-[#E5EAE5]'"
          >
            <span>Semua Mahasiswa</span>
            <span class="px-2 py-0.5 rounded-full text-[10px]" :class="activeProgramTab === 'all' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-[#14532D] font-extrabold'">
              {{ countStudents('all') }}
            </span>
          </button>

          <button
            v-for="prog in programs"
            :key="prog.id"
            type="button"
            @click="activeProgramTab = prog.slug"
            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all whitespace-nowrap min-h-[40px] flex items-center gap-1.5"
            :class="activeProgramTab === prog.slug
              ? 'bg-[#14532D] text-white shadow-sm'
              : 'bg-[#F7FAF7] text-[#647067] hover:bg-emerald-50 hover:text-[#14532D] border border-[#E5EAE5]'"
          >
            <span>{{ prog.name }}</span>
            <span class="px-2 py-0.5 rounded-full text-[10px]" :class="activeProgramTab === prog.slug ? 'bg-white/20 text-white' : 'bg-emerald-100 text-[#14532D] font-extrabold'">
              {{ countStudents(prog.slug) }}
            </span>
          </button>
        </div>

        <!-- Students Grid -->
        <div v-if="filteredStudents.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
          <div
            v-for="student in filteredStudents"
            :key="student.id || student.name"
            class="bg-[#F7FAF7] p-5 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/50 hover:bg-white shadow-xs hover:shadow-md transition-all flex flex-col justify-between group"
          >
            <div>
              <!-- Top Row: Photo + Program Badge -->
              <div class="flex items-start justify-between gap-3 mb-4">
                <div class="relative w-14 h-14 rounded-2xl overflow-hidden bg-white border border-[#E5EAE5] shrink-0 flex items-center justify-center">
                  <img
                    v-if="student.photo"
                    :src="student.photo"
                    :alt="student.name"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                  />
                  <div v-else class="w-full h-full bg-gradient-to-br from-emerald-100 to-green-50 text-[#14532D] flex items-center justify-center font-extrabold text-xs">
                    {{ student.name ? student.name.split(' ').map(n => n[0]).slice(0, 2).join('') : 'MHS' }}
                  </div>
                </div>

                <span class="px-2.5 py-1 rounded-md text-[10px] font-extrabold bg-[#DCFCE7] text-[#14532D] uppercase tracking-wider shrink-0">
                  {{ student.program_name || student.program_slug?.toUpperCase() }}
                </span>
              </div>

              <!-- Name & Identifier -->
              <h3 class="text-sm font-bold text-[#14532D] leading-snug group-hover:text-[#22C55E] transition-colors">
                {{ student.name }}
              </h3>
              <p v-if="student.identifier" class="text-[11px] font-semibold text-[#647067] mt-0.5">
                {{ student.identifier }}
              </p>

              <!-- Role / Task Badge -->
              <div v-if="student.role" class="mt-3 p-2.5 rounded-xl bg-white border border-[#E5EAE5] text-xs text-[#17231C]/90 leading-relaxed font-medium">
                {{ student.role }}
              </div>
            </div>

            <div class="mt-4 pt-3 border-t border-[#E5EAE5] flex items-center justify-between text-[11px] text-[#647067]">
              <span>Asisten Peneliti</span>
              <span class="w-2 h-2 rounded-full bg-[#22C55E] inline-block"></span>
            </div>
          </div>
        </div>

        <div v-else class="text-center py-12 bg-[#F7FAF7] rounded-3xl border border-dashed border-[#E5EAE5] space-y-2">
          <GraduationCap class="w-10 h-10 text-[#647067]/40 mx-auto" />
          <p class="text-sm font-semibold text-[#14532D]">Belum ada data mahasiswa untuk kategori program ini.</p>
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
