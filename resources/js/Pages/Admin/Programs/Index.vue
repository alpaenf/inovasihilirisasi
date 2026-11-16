<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Plus, Edit2, Trash2, Layers } from 'lucide-vue-next';

defineProps({
  programs: Array,
});

const deleteProgram = (id, name) => {
  if (confirm(`Apakah Anda yakin ingin menghapus program "${name}"?`)) {
    router.delete(`/admin/programs/${id}`);
  }
};
</script>

<template>
  <Head title="Manajemen Program - Inovasi Hilirisasi Admin" />

  <AdminLayout title="Manajemen Program">
    <div class="space-y-6">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-lg font-bold text-[#14532D]">Daftar Program</h2>
          <p class="text-xs text-[#647067]">Kelola 4 pilar program utama serta inisiatif program baru.</p>
        </div>
        <Link
          href="/admin/programs/create"
          class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all"
        >
          <Plus class="w-4 h-4" />
          <span>Tambah Program Baru</span>
        </Link>
      </div>

      <!-- Programs Table -->
      <div class="bg-white rounded-2xl border border-[#E5EAE5] overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm">
          <thead class="bg-[#F7FAF7] text-xs font-bold text-[#647067] uppercase tracking-wider border-b border-[#E5EAE5]">
            <tr>
              <th class="px-6 py-4">Nama Program</th>
              <th class="px-6 py-4">Kode</th>
              <th class="px-6 py-4">Jumlah Produk</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4">Urutan</th>
              <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-[#E5EAE5]">
            <tr v-for="prog in programs" :key="prog.id" class="hover:bg-[#F7FAF7]/60 transition-colors">
              <td class="px-6 py-4">
                <span class="font-bold text-[#14532D] block">{{ prog.name }}</span>
                <span class="text-xs text-[#647067] line-clamp-1 max-w-md">{{ prog.short_description }}</span>
              </td>
              <td class="px-6 py-4 font-semibold text-[#17231C]">
                {{ prog.code || '-' }}
              </td>
              <td class="px-6 py-4 text-[#17231C]">
                {{ prog.products_count }} Produk
              </td>
              <td class="px-6 py-4">
                <span
                  class="px-2.5 py-1 rounded-full text-xs font-semibold"
                  :class="prog.status === 'published' ? 'bg-[#DCFCE7] text-[#14532D]' : 'bg-gray-100 text-gray-700'"
                >
                  {{ prog.status }}
                </span>
              </td>
              <td class="px-6 py-4 text-[#647067]">
                {{ prog.sort_order }}
              </td>
              <td class="px-6 py-4 text-right space-x-2">
                <Link
                  :href="`/admin/programs/${prog.id}/edit`"
                  class="inline-flex items-center gap-1 text-xs font-bold text-[#14532D] hover:text-[#22C55E] px-2.5 py-1.5 rounded-lg border border-[#E5EAE5] hover:bg-[#F7FAF7]"
                >
                  <Edit2 class="w-3.5 h-3.5" />
                  <span>Edit</span>
                </Link>
                <button
                  type="button"
                  @click="deleteProgram(prog.id, prog.name)"
                  class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-700 px-2.5 py-1.5 rounded-lg border border-red-200 hover:bg-red-50"
                >
                  <Trash2 class="w-3.5 h-3.5" />
                  <span>Hapus</span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AdminLayout>
</template>

