<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import PartnerCard from '@/Components/Common/PartnerCard.vue';
import Pagination from '@/Components/Common/Pagination.vue';
import { Search, Building2 } from 'lucide-vue-next';

const props = defineProps({
  partners: Object,
  categories: Array,
  filters: Object,
});

const search = ref(props.filters.search || '');
const selectedCategory = ref(props.filters.category || 'all');

let searchTimeout = null;

const applyFilter = () => {
  router.get(
    '/mitra',
    {
      search: search.value || undefined,
      category: selectedCategory.value !== 'all' ? selectedCategory.value : undefined,
    },
    {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    }
  );
};

const onSearchInput = () => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    applyFilter();
  }, 350);
};

const selectCategory = (cat) => {
  selectedCategory.value = cat;
  applyFilter();
};
</script>

<template>
  <Head>
    <title>Mitra Kolaborasi - PUSKOR UNSOED</title>
    <meta name="description" content="Jaringan kemitraan industri, BUMN, pemerintah daerah, dan UMKM yang bersinergi dalam pengembangan teknologi terapan bersama Universitas Jenderal Soedirman." />
    <meta property="og:title" content="Mitra Kolaborasi Riset & Industri - PUSKOR UNSOED" />
  </Head>

  <PublicLayout>
    <!-- Page Header -->
    <section class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-12 sm:py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-3">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            JARINGAN KEMITRAAN
          </span>
          <h1 class="text-3xl sm:text-5xl font-extrabold text-[#14532D] tracking-tight">
            Mitra Kolaborasi PUSKOR
          </h1>
          <p class="text-base text-[#647067] leading-relaxed">
            Menghubungkan keunggulan riset sivitas akademika Universitas Jenderal Soedirman dengan sektor industri komersial, badan pemerintah, dan pelaku usaha lokal.
          </p>
        </div>
      </div>
    </section>

    <!-- Search & Filters -->
    <section class="py-8 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
          <div class="relative flex-grow max-w-md">
            <Search class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#647067]" />
            <input
              type="text"
              v-model="search"
              @input="onSearchInput"
              placeholder="Cari nama institusi atau instansi mitra..."
              class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-[#E5EAE5] bg-[#F7FAF7] text-sm text-[#17231C] placeholder-[#647067]/70 focus:outline-none focus:border-[#22C55E] focus:bg-white transition-all"
            />
          </div>

          <!-- Category Filter Pills -->
          <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
            <button
              type="button"
              @click="selectCategory('all')"
              class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all"
              :class="selectedCategory === 'all'
                ? 'bg-[#14532D] text-white shadow-sm'
                : 'bg-[#F7FAF7] text-[#647067] hover:bg-[#DCFCE7]/60 hover:text-[#14532D] border border-[#E5EAE5]'"
            >
              Semua Kategori
            </button>
            <button
              v-for="cat in categories"
              :key="cat"
              type="button"
              @click="selectCategory(cat)"
              class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all"
              :class="selectedCategory === cat
                ? 'bg-[#14532D] text-white shadow-sm'
                : 'bg-[#F7FAF7] text-[#647067] hover:bg-[#DCFCE7]/60 hover:text-[#14532D] border border-[#E5EAE5]'"
            >
              {{ cat }}
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Partner Grid -->
    <section class="py-12 sm:py-16 bg-white min-h-[400px]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 text-xs text-[#647067]">
          <span>Menampilkan <strong>{{ partners.total }}</strong> mitra terdaftar</span>
        </div>

        <div v-if="partners.data && partners.data.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
          <PartnerCard
            v-for="pt in partners.data"
            :key="pt.id"
            :partner="pt"
          />
        </div>

        <div v-else class="text-center py-16 bg-[#F7FAF7] rounded-3xl border border-[#E5EAE5] space-y-3">
          <Building2 class="w-12 h-12 text-[#647067]/40 mx-auto" />
          <h3 class="text-lg font-bold text-[#14532D]">Tidak ada mitra ditemukan</h3>
          <p class="text-sm text-[#647067] max-w-sm mx-auto">
            Silakan sesuaikan kata kunci pencarian atau kategori mitra.
          </p>
        </div>

        <Pagination :links="partners.links" />
      </div>
    </section>
  </PublicLayout>
</template>

