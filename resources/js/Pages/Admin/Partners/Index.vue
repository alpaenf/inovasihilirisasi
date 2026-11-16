<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Common/Pagination.vue';
import { Plus, Edit2, Trash2, Search, Building2 } from 'lucide-vue-next';

const props = defineProps({
  partners: Object,
  categories: Array,
  filters: Object,
});

const search = ref(props.filters.search || '');
const category = ref(props.filters.category || 'all');

let searchTimeout = null;

const applyFilter = () => {
  router.get(
    '/admin/partners',
    {
      search: search.value || undefined,
      category: category.value !== 'all' ? category.value : undefined,
    },
    { preserveState: true, replace: true }
  );
};

const onSearchInput = () => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(applyFilter, 350);
};

const deletePartner = (id, name) => {
  if (confirm(`Apakah Anda yakin ingin menghapus mitra "${name}"?`)) {
    router.delete(`/admin/partners/${id}`);
  }
};
</script>

<template>
  <Head title="Manajemen Mitra - PUSKOR Admin" />

  <AdminLayout title="Manajemen Mitra Kolaborasi">
    <div class="space-y-6">
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-3 flex-grow max-w-lg">
          <div class="relative flex-grow">
            <Search class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#647067]" />
            <input
              type="text"
              v-model="search"
              @input="onSearchInput"
              placeholder="Cari nama institusi atau kategori..."
              class="w-full pl-10 pr-4 py-2 rounded-xl border border-[#E5EAE5] bg-white text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
            />
          </div>
          <select
            v-model="category"
            @change="applyFilter"
            class="py-2 px-3 rounded-xl border border-[#E5EAE5] bg-white text-xs sm:text-sm font-semibold text-[#14532D] focus:outline-none focus:border-[#22C55E]"
          >
            <option value="all">Semua Kategori</option>
            <option v-for="cat in categories" :key="cat" :value="cat">
              {{ cat }}
            </option>
          </select>
        </div>

        <Link
          href="/admin/partners/create"
          class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm shrink-0"
        >
          <Plus class="w-4 h-4" />
          <span>Tambah Mitra Baru</span>
        </Link>
      </div>

      <!-- Partners Table -->
      <div class="bg-white rounded-2xl border border-[#E5EAE5] overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm">
          <thead class="bg-[#F7FAF7] text-xs font-bold text-[#647067] uppercase tracking-wider border-b border-[#E5EAE5]">
            <tr>
              <th class="px-6 py-4">Nama Mitra</th>
              <th class="px-6 py-4">Kategori</th>
              <th class="px-6 py-4">Program Terkait</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-[#E5EAE5]">
            <tr v-for="pt in partners.data" :key="pt.id" class="hover:bg-[#F7FAF7]/60 transition-colors">
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-xl bg-[#F7FAF7] border border-[#E5EAE5] p-1.5 flex items-center justify-center shrink-0">
                    <img
                      v-if="pt.logo && !pt.logo.includes('placeholder')"
                      :src="pt.logo"
                      :alt="pt.name"
                      class="max-w-full max-h-full object-contain"
                      @error="$event.target.style.display = 'none'"
                    />
                    <Building2 class="w-5 h-5 text-[#14532D]/40" />
                  </div>
                  <div>
                    <span class="font-bold text-[#14532D] block">{{ pt.name }}</span>
                    <span class="text-xs text-[#647067] line-clamp-1 max-w-xs">{{ pt.short_description || pt.address }}</span>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4">
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-[#DCFCE7] text-[#14532D]">
                  {{ pt.category || 'Umum' }}
                </span>
              </td>
              <td class="px-6 py-4 text-[#17231C]">
                {{ pt.programs_count }} Program
              </td>
              <td class="px-6 py-4">
                <span
                  class="px-2.5 py-1 rounded-full text-xs font-semibold"
                  :class="pt.status === 'published' ? 'bg-[#DCFCE7] text-[#14532D]' : 'bg-gray-100 text-gray-700'"
                >
                  {{ pt.status }}
                </span>
              </td>
              <td class="px-6 py-4 text-right space-x-2">
                <Link
                  :href="`/admin/partners/${pt.id}/edit`"
                  class="inline-flex items-center gap-1 text-xs font-bold text-[#14532D] hover:text-[#22C55E] px-2.5 py-1.5 rounded-lg border border-[#E5EAE5] hover:bg-[#F7FAF7]"
                >
                  <Edit2 class="w-3.5 h-3.5" />
                  <span>Edit</span>
                </Link>
                <button
                  type="button"
                  @click="deletePartner(pt.id, pt.name)"
                  class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-700 px-2.5 py-1.5 rounded-lg border border-red-200 hover:bg-red-50"
                >
                  <Trash2 class="w-3.5 h-3.5" />
                  <span>Hapus</span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="p-4 border-t border-[#E5EAE5]">
          <Pagination :links="partners.links" />
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

