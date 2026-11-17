<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProgramCard from '@/Components/Common/ProgramCard.vue';
import ProductCard from '@/Components/Common/ProductCard.vue';
import PartnerCard from '@/Components/Common/PartnerCard.vue';
import {
  ArrowRight,
  CheckCircle2,
  Cpu,
  Sparkles,
  Building,
  Box,
  ShieldCheck,
  Camera,
  Calendar,
  MapPin,
  Mail,
  Phone,
  Clock,
  MessageSquare,
  Send,
  Newspaper,
  ExternalLink,
  X,
  ChevronRight,
  User,
  Eye,
  Check,
  Sprout,
  Handshake,
  Lightbulb,
  Award,
  Users
} from 'lucide-vue-next';

const props = defineProps({
  hero: Object,
  programs: Array,
  featuredProducts: Array,
  featuredPartners: Array,
  stats: Object,
  gallery: Array,
  news: Array,
  contact: Object,
});

const activePrograms = computed(() => {
  if (props.programs && props.programs.length > 0) {
    return props.programs.map((p) => p.name);
  }
  return ['PM-UPUD', 'SINERGI', 'Dorongan Teknologi', 'Ajakan Industri'];
});

const currentProgramIndex = ref(0);
let programTimer = null;

onMounted(() => {
  programTimer = setInterval(() => {
    currentProgramIndex.value = (currentProgramIndex.value + 1) % activePrograms.value.length;
  }, 2400);
});

onUnmounted(() => {
  if (programTimer) {
    clearInterval(programTimer);
  }
});

// Gallery Filter & Modal
const selectedGalleryTag = ref('all');
const activeGalleryModal = ref(null);

const galleryCategories = computed(() => {
  const tags = new Set((props.gallery || []).map((g) => g.tag));
  return ['all', ...Array.from(tags)];
});

// Category Icon & Label mapping like reference design
const getCategoryIcon = (tag) => {
  switch (tag?.toUpperCase()) {
    case 'ALL':
      return Sparkles;
    case 'SINERGI':
      return Sprout;
    case 'DORTEK':
    case 'DORONGAN TEKNOLOGI':
      return Cpu;
    case 'PMUPUD':
    case 'PM-UPUD':
      return Lightbulb;
    case 'AJAKAN INDUSTRI':
      return Handshake;
    case 'EXPO RISET':
      return Award;
    case 'KOLABORASI':
      return Users;
    default:
      return Sparkles;
  }
};

const getCategoryLabel = (tag) => {
  if (tag === 'all') return 'Semua Foto';
  return tag;
};

const filteredGallery = computed(() => {
  const items = props.gallery || [];
  if (selectedGalleryTag.value === 'all') return items;
  return items.filter((g) => g.tag === selectedGalleryTag.value);
});

const openGalleryModal = (item) => {
  activeGalleryModal.value = item;
};

const closeGalleryModal = () => {
  activeGalleryModal.value = null;
};

// News Reader Modal
const activeNewsModal = ref(null);

const openNewsModal = (article) => {
  activeNewsModal.value = article;
};

const closeNewsModal = () => {
  activeNewsModal.value = null;
};

// Contact Form State
const contactForm = ref({
  name: '',
  institution: '',
  email: '',
  phone: '',
  program: 'SINERGI',
  message: '',
});
const contactSubmitted = ref(false);
const isSubmittingContact = ref(false);

const handleContactSubmit = () => {
  isSubmittingContact.value = true;
  setTimeout(() => {
    isSubmittingContact.value = false;
    contactSubmitted.value = true;
  }, 500);
};

const sendViaWhatsApp = () => {
  const text = `Halo Admin Inovasi Hilirisasi LPPM UNSOED,\n\nNama: ${contactForm.value.name || '-'}\nInstansi: ${contactForm.value.institution || '-'}\nEmail: ${contactForm.value.email || '-'}\nProgram: ${contactForm.value.program}\nPesan: ${contactForm.value.message || '-'}`;
  const targetPhone = (props.contact?.phone || '+62281635292').replace(/[^0-9]/g, '');
  const url = `https://wa.me/${targetPhone}?text=${encodeURIComponent(text)}`;
  window.open(url, '_blank');
};

const jsonLd = {
  '@context': 'https://schema.org',
  '@type': 'EducationalOrganization',
  'name': 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi (Inovasi Hilirisasi) UNSOED',
  'alternateName': 'Inovasi Hilirisasi Universitas Jenderal Soedirman',
  'url': typeof window !== 'undefined' ? window.location.origin : 'https://inovasihilirisasi.techsoe.com',
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
    <title>Inovasi Hilirisasi UNSOED - Pusat Inovasi & Penerapan Teknologi</title>
    <meta name="description" content="Platform terpadu koordinasi inovasi, alih teknologi, dan hilirisasi riset Universitas Jenderal Soedirman melalui 4 program utama kolaborasi industri." />
    <meta property="og:title" content="Inovasi Hilirisasi UNSOED - Pusat Inovasi & Penerapan Teknologi" />
    <meta property="og:description" content="Wadah koordinasi pengembangan dan penerapan teknologi Universitas Jenderal Soedirman melalui SINERGI, AJAKAN INDUSTRI, PMUPUD, dan DORTEK." />
    <meta property="og:type" content="website" />
    <component :is="'script'" type="application/ld+json">
      {{ JSON.stringify(jsonLd) }}
    </component>
  </Head>

  <PublicLayout>
    <!-- HERO SECTION -->
    <section class="relative overflow-hidden bg-gradient-to-b from-[#F7FAF7] to-white pt-6 sm:pt-8 lg:pt-10 pb-16 sm:pb-24 border-b border-[#E5EAE5]">
      <!-- Background Ambient Glow -->
      <div class="absolute top-0 right-1/4 w-96 h-96 bg-emerald-100/60 rounded-full blur-3xl -z-10 pointer-events-none"></div>
      <div class="absolute bottom-0 left-10 w-80 h-80 bg-green-50/50 rounded-full blur-2xl -z-10 pointer-events-none"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
          <!-- Left Column: Copywriting & CTAs -->
          <div class="lg:col-span-7 space-y-5 sm:space-y-6">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#14532D] tracking-tight leading-[1.12]">
              {{ hero.headline }}
            </h1>

            <p class="text-base sm:text-lg text-[#647067] leading-relaxed max-w-2xl font-normal">
              {{ hero.description }}
            </p>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-2">
              <Link
                :href="hero.cta_primary.url"
                class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl font-bold text-sm bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-lg shadow-emerald-950/15 hover:shadow-xl transition-all duration-200 group w-full sm:w-auto"
              >
                <span>{{ hero.cta_primary.label }}</span>
                <ArrowRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
              </Link>

              <Link
                :href="hero.cta_secondary.url"
                class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl font-bold text-sm bg-white text-[#14532D] border border-[#E5EAE5] hover:border-[#14532D]/40 hover:bg-[#F7FAF7] shadow-sm transition-all duration-200 w-full sm:w-auto"
              >
                <span>{{ hero.cta_secondary.label }}</span>
              </Link>
            </div>

            <!-- Value Highlights -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 pt-4 border-t border-[#E5EAE5]">
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
            <div class="relative mx-auto max-w-md lg:max-w-none rounded-3xl bg-white border border-[#E5EAE5] p-4 sm:p-6 lg:p-8 shadow-2xl shadow-emerald-950/10">
              <div class="flex items-center justify-between pb-4 sm:pb-6 border-b border-[#E5EAE5] gap-2 sm:gap-3">
                <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0">
                  <div class="h-8 sm:h-10 md:h-11 w-auto flex items-center justify-center shrink-0">
                    <img src="/images/logo-lppm.png" alt="Logo LPPM UNSOED" class="h-7 sm:h-9 md:h-10 w-auto object-contain" />
                  </div>
                  <div class="min-w-0">
                    <h3 class="font-bold text-[#14532D] text-xs sm:text-sm md:text-base leading-tight truncate">Pusat Teknologi Terpadu</h3>
                    <p class="text-[10px] sm:text-xs text-[#647067] mt-0.5 truncate">LPPM UNSOED Purwokerto</p>
                  </div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-md text-[10px] sm:text-[11px] font-bold bg-[#DCFCE7] text-[#14532D] shrink-0">
                  Terverifikasi
                </span>
              </div>

              <!-- Metrics inside Card -->
              <div class="grid grid-cols-2 gap-2.5 sm:gap-4 my-4 sm:my-6">
                <!-- Program Utama -->
                <div class="p-3 sm:p-4 lg:p-5 rounded-2xl bg-[#F7FAF7] border border-[#E5EAE5] flex flex-col justify-between min-h-[105px] sm:min-h-[115px]">
                  <div>
                    <span class="text-[11px] sm:text-xs text-[#647067] font-semibold block leading-tight truncate">Program Utama</span>
                    <span class="text-xl sm:text-2xl md:text-3xl font-extrabold text-[#14532D] mt-1 sm:mt-1.5 block tracking-tight">
                      {{ stats.total_programs }} Program
                    </span>
                  </div>
                  <div class="mt-2.5 sm:mt-3 h-7 flex items-center overflow-hidden">
                    <Transition name="program-fade" mode="out-in">
                      <span
                        :key="currentProgramIndex"
                        class="inline-flex items-center gap-1 sm:gap-1.5 px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-lg bg-[#DCFCE7] border border-[#22C55E]/30 text-[#14532D] text-[9.5px] sm:text-[11px] font-bold shadow-xs max-w-full"
                      >
                        <span class="w-1.5 h-1.5 rounded-full bg-[#22C55E] animate-pulse shrink-0"></span>
                        <span class="truncate">{{ activePrograms[currentProgramIndex] }}</span>
                      </span>
                    </Transition>
                  </div>
                </div>

                <!-- Inovasi Tepat Guna -->
                <div class="p-3 sm:p-4 lg:p-5 rounded-2xl bg-[#F7FAF7] border border-[#E5EAE5] flex flex-col justify-between min-h-[105px] sm:min-h-[115px]">
                  <div>
                    <span class="text-[11px] sm:text-xs text-[#647067] font-semibold block leading-tight truncate">Inovasi Tepat Guna</span>
                    <span class="text-xl sm:text-2xl md:text-3xl font-extrabold text-[#14532D] mt-1 sm:mt-1.5 block tracking-tight">
                      {{ stats.total_products }}+ Produk
                    </span>
                  </div>
                  <div class="mt-2.5 sm:mt-3 h-7 flex items-center overflow-hidden">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-lg bg-white border border-[#E5EAE5] text-[#14532D] text-[9.5px] sm:text-[11px] font-bold shadow-xs max-w-full">
                      <span class="truncate">Katalog Terpadu</span>
                    </span>
                  </div>
                </div>
              </div>

              <!-- Institutional Callout -->
              <div class="p-3 sm:p-4 rounded-xl bg-gradient-to-r from-[#14532D] to-emerald-900 text-white flex items-center justify-between gap-2">
                <div class="min-w-0">
                  <h4 class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-emerald-200 truncate">Kemitraan Aktif</h4>
                  <p class="text-xs sm:text-sm font-semibold mt-0.5 truncate">{{ stats.total_partners }} Mitra Kolaborasi</p>
                </div>
                <Link href="/mitra" class="px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg bg-white/20 hover:bg-white/30 text-xs font-bold text-white transition-colors shrink-0">
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
            4 Program Utama Inovasi Hilirisasi
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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <PartnerCard
            v-for="partner in featuredPartners"
            :key="partner.id"
            :partner="partner"
          />
        </div>
      </div>
    </section>

    <!-- SECTION 1: GALERI KEGIATAN & DOKUMENTASI RISET -->
    <section id="galeri" class="py-16 sm:py-20 bg-[#F7FAF7] border-t border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header (Centered) -->
        <div class="max-w-3xl mx-auto text-center mb-6 sm:mb-8 space-y-2">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            DOKUMENTASI LAPANGAN & RISET
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
            Galeri Kegiatan Hilirisasi Teknologi
          </h2>
          <p class="text-sm sm:text-base text-[#647067] leading-relaxed">
            Dokumentasi visual pengujian prototipe, pendampingan UMKM, dan aktivitas hilirisasi riset di lapangan.
          </p>
        </div>

        <!-- Category Filter Pills (Wrapped & Centered Sesuai Desain Referensi, Tidak Nyamping) -->
        <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-2.5 max-w-3xl mx-auto mb-8 sm:mb-10 px-2">
          <button
            v-for="tag in galleryCategories"
            :key="tag"
            type="button"
            @click="selectedGalleryTag = tag"
            class="inline-flex items-center gap-1.5 sm:gap-2 px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-200 select-none shadow-2xs"
            :class="selectedGalleryTag === tag
              ? 'bg-[#14532D] text-white shadow-md shadow-emerald-950/20 ring-2 ring-[#22C55E]/40'
              : 'bg-white text-[#647067] hover:text-[#14532D] hover:bg-[#F7FAF7] border border-[#E5EAE5]'"
          >
            <component
              :is="getCategoryIcon(tag)"
              class="w-3.5 h-3.5 sm:w-4 sm:h-4 shrink-0 transition-colors"
              :class="selectedGalleryTag === tag ? 'text-emerald-300' : 'text-[#22C55E]'"
            />
            <span>{{ getCategoryLabel(tag) }}</span>
          </button>
        </div>

        <!-- Gallery Grid (100% Full Foto Bersih Tanpa Penjelasan Teks Apapun) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
          <div
            v-for="item in filteredGallery"
            :key="item.id"
            @click="openGalleryModal(item)"
            class="group relative aspect-4/3 rounded-xl sm:rounded-2xl md:rounded-3xl overflow-hidden bg-[#E5EAE5] border border-[#E5EAE5] hover:border-[#22C55E] shadow-2xs hover:shadow-xl transition-all duration-300 cursor-pointer"
          >
            <!-- Foto Asli Tanpa Gelap/Gradient -->
            <img
              :src="item.image"
              :alt="item.title || 'Foto Kegiatan'"
              class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500 ease-out"
              loading="lazy"
            />

            <!-- Hover Zoom Icon Saja (Tanpa Teks) -->
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition-colors flex items-center justify-center">
              <div class="w-10 h-10 rounded-full bg-white/90 text-[#14532D] flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 scale-90 group-hover:scale-100 shadow-md">
                <Eye class="w-5 h-5" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 2: BERITA & PUBLIKASI HILIRISASI -->
    <section id="berita" class="py-20 bg-white border-t border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-14 space-y-3">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            KABAR TERKINI & PUBLIKASI
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
            Berita & Inovasi Terkini
          </h2>
          <p class="text-sm sm:text-base text-[#647067] leading-relaxed">
            Perkembangan terbaru kerja sama hilirisasi, uji coba inovasi teknologi tepat guna, dan dampak program di tengah masyarakat.
          </p>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
          <article
            v-for="article in news"
            :key="article.id"
            class="bg-[#F7FAF7] rounded-3xl border border-[#E5EAE5] overflow-hidden shadow-xs hover:shadow-xl hover:border-[#22C55E]/40 hover:bg-white transition-all duration-300 flex flex-col justify-between group"
          >
            <div>
              <!-- Banner Image -->
              <div class="relative aspect-16/10 overflow-hidden bg-[#E5EAE5]">
                <img
                  :src="article.image"
                  :alt="article.title"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  loading="lazy"
                />
                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-extrabold uppercase tracking-wider bg-[#14532D] text-white shadow-xs">
                  {{ article.tag }}
                </span>
              </div>

              <!-- Article Content -->
              <div class="p-5 sm:p-6 space-y-3">
                <div class="flex items-center gap-2 text-xs text-[#647067]">
                  <span class="font-semibold text-[#22C55E]">{{ article.category }}</span>
                  <span>•</span>
                  <span>{{ article.read_time }}</span>
                </div>

                <h3 class="text-base sm:text-lg font-bold text-[#14532D] leading-snug group-hover:text-[#22C55E] transition-colors">
                  {{ article.title }}
                </h3>

                <p class="text-xs sm:text-sm text-[#647067] leading-relaxed line-clamp-3">
                  {{ article.excerpt }}
                </p>
              </div>
            </div>

            <div class="p-5 sm:p-6 pt-0 border-t border-[#E5EAE5]/60 flex items-center justify-between text-xs">
              <span class="text-[#647067] flex items-center gap-1.5">
                <Calendar class="w-3.5 h-3.5 text-[#22C55E]" />
                <span>{{ article.date }}</span>
              </span>

              <button
                type="button"
                @click="openNewsModal(article)"
                class="inline-flex items-center gap-1 font-bold text-[#14532D] hover:text-[#22C55E] transition-colors"
              >
                <span>Baca Berita</span>
                <ChevronRight class="w-4 h-4" />
              </button>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- CTA BANNER SECTION (Sebelum Kontak) -->
    <section class="py-16 sm:py-20 bg-gradient-to-r from-[#14532D] to-emerald-950 text-white">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
          Mari Berkolaborasi Mengembangkan Inovasi Tepat Guna
        </h2>
        <p class="text-sm sm:text-base text-emerald-100/90 max-w-2xl mx-auto leading-relaxed">
          Pusat Koordinasi Pengembangan dan Penerapan Teknologi UNSOED membuka pintu kemitraan seluas-luasnya bagi kalangan industri, instansi pemerintah, dan kelompok masyarakat desa.
        </p>
        <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
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

    <!-- SECTION 3: KONTAK & KONSULTASI KEMITRAAN -->
    <section id="kontak" class="py-20 bg-gradient-to-b from-white to-[#F7FAF7] border-t border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-14 space-y-3">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            LAYANAN INFORMASI & KEMITRAAN
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
            Hubungi Tim Inovasi Hilirisasi
          </h2>
          <p class="text-sm sm:text-base text-[#647067] leading-relaxed">
            Tertarik mengadopsi teknologi terapan, menjalin kemitraan riset kampus, atau konsultasi formulasi produk? Tim LPPM UNSOED siap berdiskusi.
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
          <!-- Left Column: Contact Cards -->
          <div class="lg:col-span-5 space-y-5">
            <!-- Office Address Card -->
            <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-xs flex items-start gap-4">
              <div class="w-12 h-12 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                <MapPin class="w-6 h-6 text-[#22C55E]" />
              </div>
              <div class="space-y-1">
                <h4 class="text-sm font-bold text-[#14532D]">Kantor Sekretariat</h4>
                <p class="text-xs text-[#647067] leading-relaxed">
                  {{ contact?.address || 'Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto, Jawa Tengah 53122' }}
                </p>
                <a
                  href="https://maps.google.com/?q=LPPM+Universitas+Jenderal+Soedirman"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-flex items-center gap-1 text-[11px] font-bold text-[#22C55E] hover:underline pt-1"
                >
                  <span>Buka di Google Maps</span>
                  <ExternalLink class="w-3 h-3" />
                </a>
              </div>
            </div>

            <!-- Email Card -->
            <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-xs flex items-start gap-4">
              <div class="w-12 h-12 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                <Mail class="w-6 h-6 text-[#22C55E]" />
              </div>
              <div class="space-y-1">
                <h4 class="text-sm font-bold text-[#14532D]">Email Resmi Kemitraan</h4>
                <p class="text-xs text-[#647067]">
                  Konsultasi proposal riset terapan, HKI paten, dan permohonan narasumber:
                </p>
                <a
                  :href="`mailto:${contact?.email || 'p3t.lppm@unsoed.ac.id'}`"
                  class="text-sm font-bold text-[#14532D] hover:text-[#22C55E] transition-colors block pt-0.5"
                >
                  {{ contact?.email || 'p3t.lppm@unsoed.ac.id' }}
                </a>
              </div>
            </div>

            <!-- Phone & Hours Card -->
            <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-xs flex items-start gap-4">
              <div class="w-12 h-12 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                <Phone class="w-6 h-6 text-[#22C55E]" />
              </div>
              <div class="space-y-1">
                <h4 class="text-sm font-bold text-[#14532D]">Telepon & Jam Layanan</h4>
                <p class="text-xs text-[#647067]">
                  {{ contact?.hours || 'Senin - Jumat: 08.00 - 16.00 WIB' }}
                </p>
                <p class="text-sm font-bold text-[#14532D] pt-0.5">
                  {{ contact?.phone || '+62 281 635292' }}
                </p>
              </div>
            </div>
          </div>

          <!-- Right Column: Interactive Consultation Form -->
          <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-3xl border border-[#E5EAE5] shadow-md space-y-6">
            <div class="border-b border-[#E5EAE5] pb-4">
              <h3 class="text-lg font-bold text-[#14532D]">Formulir Penjajakan Kerja Sama</h3>
              <p class="text-xs text-[#647067] mt-0.5">
                Kirim pesan langsung kepada tim manajemen Inovasi Hilirisasi UNSOED.
              </p>
            </div>

            <!-- Success State Banner -->
            <div
              v-if="contactSubmitted"
              class="p-5 rounded-2xl bg-[#DCFCE7] border border-[#22C55E]/40 text-[#14532D] space-y-3"
            >
              <div class="flex items-center gap-2">
                <Check class="w-5 h-5 text-[#22C55E] shrink-0" />
                <h4 class="font-bold text-sm">Pesan Berhasil Terkirim!</h4>
              </div>
              <p class="text-xs text-[#14532D]/90 leading-relaxed">
                Terima kasih telah menghubungi Pusat Teknologi Terpadu LPPM UNSOED. Tim kami akan meninjau kebutuhan kemitraan Anda dan segera merespons via email atau WhatsApp.
              </p>
              <div class="pt-2 flex items-center gap-3">
                <button
                  type="button"
                  @click="contactSubmitted = false"
                  class="text-xs font-bold underline hover:text-[#22C55E]"
                >
                  Kirim Pesan Lain
                </button>
                <span>•</span>
                <button
                  type="button"
                  @click="sendViaWhatsApp"
                  class="text-xs font-bold text-[#14532D] bg-white px-3 py-1.5 rounded-lg shadow-2xs hover:bg-emerald-50 transition-colors"
                >
                  Hubungi via WhatsApp Langsung →
                </button>
              </div>
            </div>

            <!-- The Form -->
            <form v-else @submit.prevent="handleContactSubmit" class="space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-1.5">
                    Nama Lengkap *
                  </label>
                  <input
                    type="text"
                    v-model="contactForm.name"
                    required
                    placeholder="Nama Anda..."
                    class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                </div>

                <div>
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-1.5">
                    Instansi / Perusahaan / UMKM
                  </label>
                  <input
                    type="text"
                    v-model="contactForm.institution"
                    placeholder="Nama institusi atau usaha..."
                    class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-1.5">
                    Email Kontak *
                  </label>
                  <input
                    type="email"
                    v-model="contactForm.email"
                    required
                    placeholder="email@instansi.com"
                    class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                </div>

                <div>
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-1.5">
                    Nomor WhatsApp / Telepon
                  </label>
                  <input
                    type="tel"
                    v-model="contactForm.phone"
                    placeholder="08xxxxxxxxxx"
                    class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                </div>
              </div>

              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-1.5">
                  Fokus Program Kemitraan
                </label>
                <select
                  v-model="contactForm.program"
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm font-semibold text-[#14532D] bg-[#F7FAF7] focus:outline-none focus:border-[#22C55E]"
                >
                  <option value="SINERGI">SINERGI — Riset Formulasi & Pupuk Organik Hayati</option>
                  <option value="AJAKAN INDUSTRI">AJAKAN INDUSTRI — Kemitraan Komersial Korporasi DUDI</option>
                  <option value="PMUPUD">PMUPUD — Inkubasi Mutu & Standardisasi Ekspor UMKM</option>
                  <option value="DORTEK">DORTEK — Perekayasaan Alat & Mesin Tepat Guna</option>
                  <option value="KONSULTASI_UMUM">Konsultasi Umum Alih Teknologi & Fasilitasi LPPM</option>
                </select>
              </div>

              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-1.5">
                  Uraian Singkat Kebutuhan / Pesan *
                </label>
                <textarea
                  v-model="contactForm.message"
                  required
                  rows="3"
                  placeholder="Ceritakan gambaran singkat kebutuhan teknologi, uji prototipe, atau potensi kemitraan yang ingin dijajaki..."
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                ></textarea>
              </div>

              <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <button
                  type="submit"
                  :disabled="isSubmittingContact"
                  class="inline-flex items-center justify-center gap-2 px-7 py-3 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-md transition-all min-h-[44px]"
                >
                  <Send class="w-4 h-4" />
                  <span>{{ isSubmittingContact ? 'Mengirim Pesan...' : 'Kirim Pesan Kolaborasi' }}</span>
                </button>

                <button
                  type="button"
                  @click="sendViaWhatsApp"
                  class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-xs font-bold text-[#14532D] bg-[#DCFCE7] hover:bg-[#DCFCE7]/80 transition-all min-h-[44px]"
                >
                  <span>Chat WhatsApp Langsung</span>
                  <ExternalLink class="w-3.5 h-3.5" />
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- MODAL: PREVIEW FOTO GALERI (FULL GAMBAR MURNI) -->
    <div
      v-if="activeGalleryModal"
      class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-3 sm:p-6"
      @click.self="closeGalleryModal"
    >
      <div class="relative max-w-5xl w-full flex flex-col items-center justify-center animate-in fade-in zoom-in-95 duration-200">
        <!-- Close Button -->
        <button
          type="button"
          @click="closeGalleryModal"
          class="absolute -top-12 right-0 sm:-top-12 sm:right-0 z-10 w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 text-white flex items-center justify-center transition-colors backdrop-blur-sm"
          title="Tutup"
        >
          <X class="w-6 h-6" />
        </button>

        <!-- Full Photo Container (Pure Image, No Explanation) -->
        <div class="w-full max-h-[85vh] flex items-center justify-center overflow-hidden rounded-2xl shadow-2xl">
          <img
            :src="activeGalleryModal.image"
            :alt="activeGalleryModal.title || 'Foto Kegiatan'"
            class="max-h-[85vh] w-auto max-w-full object-contain rounded-2xl"
          />
        </div>
      </div>
    </div>

    <!-- MODAL: BACA BERITA DETAIL -->
    <div
      v-if="activeNewsModal"
      class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6"
      @click.self="closeNewsModal"
    >
      <div class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl relative animate-in fade-in zoom-in-95 duration-200">
        <button
          type="button"
          @click="closeNewsModal"
          class="sticky top-4 float-right mr-4 z-10 w-9 h-9 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-black transition-colors"
          title="Tutup"
        >
          <X class="w-5 h-5" />
        </button>

        <div class="relative aspect-16/9 bg-[#E5EAE5]">
          <img
            :src="activeNewsModal.image"
            :alt="activeNewsModal.title"
            class="w-full h-full object-cover"
          />
        </div>

        <div class="p-6 sm:p-8 space-y-4">
          <div class="flex items-center gap-2 text-xs text-[#647067]">
            <span class="px-2 py-0.5 rounded bg-[#DCFCE7] text-[#14532D] font-extrabold uppercase text-[10px]">
              {{ activeNewsModal.tag }}
            </span>
            <span>•</span>
            <span class="font-semibold text-[#22C55E]">{{ activeNewsModal.category }}</span>
            <span>•</span>
            <span>{{ activeNewsModal.date }}</span>
          </div>

          <h2 class="text-xl sm:text-2xl font-extrabold text-[#14532D] leading-snug">
            {{ activeNewsModal.title }}
          </h2>

          <div class="flex items-center gap-2 text-xs text-[#647067] pb-3 border-b border-[#E5EAE5]">
            <User class="w-3.5 h-3.5 text-[#22C55E]" />
            <span>Penulis: <strong>{{ activeNewsModal.author }}</strong></span>
          </div>

          <div class="space-y-3 text-sm text-[#17231C]/90 leading-relaxed">
            <p class="font-medium text-[#14532D] italic">
              {{ activeNewsModal.excerpt }}
            </p>
            <p>
              {{ activeNewsModal.content }}
            </p>
          </div>

          <div class="pt-4 border-t border-[#E5EAE5] flex justify-end">
            <button
              type="button"
              @click="closeNewsModal"
              class="px-5 py-2 rounded-xl text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-colors"
            >
              Tutup Berita
            </button>
          </div>
        </div>
      </div>
    </div>
  </PublicLayout>
</template>

<style scoped>
.program-fade-enter-active,
.program-fade-leave-active {
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}

.program-fade-enter-from {
  opacity: 0;
  transform: translateY(8px);
}

.program-fade-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}
</style>
