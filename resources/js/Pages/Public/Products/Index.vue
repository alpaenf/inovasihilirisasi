<script setup>
import { ref, watch } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProductCard from '@/Components/Common/ProductCard.vue';
import Pagination from '@/Components/Common/Pagination.vue';
import { Search, SlidersHorizontal, Box } from 'lucide-vue-next';

const props = defineProps({
  products: Object,
  programs: Array,
  filters: Object,
});

const search = ref(props.filters.search || '');
const selectedProgram = ref(props.filters.program || 'all');
const selectedSort = ref(props.filters.sort || 'latest');

let searchTimeout = null;

const applyFilter = () => {
  router.get(
    '/produk',
    {
      search: search.value || undefined,
      program: selectedProgram.value !== 'all' ? selectedProgram.value : undefined,
      sort: selectedSort.value !== 'latest' ? selectedSort.value : undefined,
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

const selectProgram = (slug) => {
  selectedProgram.value = slug;
  applyFilter();
};

const onSortChange = () => {
  applyFilter();
};
</script>

<template>
  <Head>
    <title>Katalog Produk & Inovasi Teknologi - PUSKOR UNSOED</title>
    <meta name="description" content="Katalog produk inovasi teknologi tepat guna hasil riset program SINERGI, AJAKAN INDUSTRI, PMUPUD, dan DORTEK Universitas Jenderal Soedirman." />
    <meta property="og:title" content="Katalog Inovasi Teknologi - PUSKOR UNSOED" />
  </Head>

  <PublicLayout>
    <!-- Page Header -->
    <section class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-12 sm:py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-3">
          <span class="text-xs font-extrabold text-[#22C55E] uppercase tracking-widest block">
            KATALOG TERPADU
          </span>
          <h1 class="text-3xl sm:text-5xl font-extrabold text-[#14532D] tracking-tight">
            Produk Inovasi & Teknologi
          </h1>
          <p class="text-base text-[#647067] leading-relaxed">
            Eksplorasi seluruh prototipe, alat tepat guna, dan teknologi siap terap hasil inovasi sivitas akademika Universitas Jenderal Soedirman.
          </p>
        </div>
      </div>
    </section>

    <!-- Filters & Search Bar Section -->
    <section class="py-8 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Top bar: Search input + Sorting select -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
          <!-- Search box -->
          <div class="relative flex-grow max-w-md">
            <Search class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#647067]" />
            <input
              type="text"
              v-model="search"
              @input="onSearchInput"
              placeholder="Cari inovasi atau kata kunci teknologi..."
              class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-[#E5EAE5] bg-[#F7FAF7] text-sm text-[#17231C] placeholder-[#647067]/70 focus:outline-none focus:border-[#22C55E] focus:bg-white transition-all"
            />
          </div>

          <!-- Sort Dropdown -->
          <div class="flex items-center gap-2 shrink-0">
            <SlidersHorizontal class="w-4 h-4 text-[#647067]" />
            <span class="text-xs font-semibold text-[#647067]">Urutkan:</span>
            <select
              v-model="selectedSort"
              @change="onSortChange"
              class="py-2 px-3 rounded-lg border border-[#E5EAE5] bg-white text-xs font-semibold text-[#14532D] focus:outline-none focus:border-[#22C55E]"
            >
              <option value="latest">Terbaru</option>
              <option value="oldest">Terlama</option>
              <option value="name_asc">Nama (A - Z)</option>
              <option value="name_desc">Nama (Z - A)</option>
            </select>
          </div>
        </div>

        <!-- Program Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
          <button
            type="button"
            @click="selectProgram('all')"
            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all duration-200"
            :class="selectedProgram === 'all'
              ? 'bg-[#14532D] text-white shadow-sm'
              : 'bg-[#F7FAF7] text-[#647067] hover:bg-[#DCFCE7]/60 hover:text-[#14532D] border border-[#E5EAE5]'"
          >
            Semua Program
          </button>

          <button
            v-for="prog in programs"
            :key="prog.id"
            type="button"
            @click="selectProgram(prog.slug)"
            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all duration-200"
            :class="selectedProgram === prog.slug
              ? 'bg-[#14532D] text-white shadow-sm'
              : 'bg-[#F7FAF7] text-[#647067] hover:bg-[#DCFCE7]/60 hover:text-[#14532D] border border-[#E5EAE5]'"
          >
            {{ prog.name }}
          </button>
        </div>
      </div>
    </section>

    <!-- Product Grid & Results -->
    <section class="py-12 sm:py-16 bg-white min-h-[400px]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Results count indicator -->
        <div class="mb-6 flex items-center justify-between text-xs text-[#647067]">
          <span>Menampilkan <strong>{{ products.total }}</strong> produk inovasi</span>
        </div>

        <!-- Products Grid -->
        <div v-if="products.data && products.data.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          <ProductCard
            v-for="prod in products.data"
            :key="prod.id"
            :product="prod"
          />
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-16 px-4 bg-[#F7FAF7] rounded-3xl border border-[#E5EAE5] space-y-3">
          <Box class="w-12 h-12 text-[#647067]/40 mx-auto" />
          <h3 class="text-lg font-bold text-[#14532D]">Tidak ada produk ditemukan</h3>
          <p class="text-sm text-[#647067] max-w-sm mx-auto">
            Coba ubah kata kunci pencarian atau pilih filter program lainnya.
          </p>
        </div>

        <!-- Server-side Pagination -->
        <Pagination :links="products.links" />
      </div>
    </section>
  </PublicLayout>
</template>

