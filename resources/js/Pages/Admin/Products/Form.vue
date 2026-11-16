<script setup>
import { ref } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ArrowLeft, Save, Upload, Image } from 'lucide-vue-next';

const props = defineProps({
  product: Object,
  programs: Array,
  partners: Array,
});

const isEditing = !!props.product;
const imagePreview = ref(props.product?.main_image || null);

const form = useForm({
  _method: isEditing ? 'PUT' : 'POST',
  program_id: props.product?.program_id || (props.programs[0]?.id ?? ''),
  name: props.product?.name || '',
  short_description: props.product?.short_description || '',
  description: props.product?.description || '',
  benefits: props.product?.benefits || '',
  external_url: props.product?.external_url || '',
  is_featured: props.product?.is_featured ?? false,
  status: props.product?.status || 'published',
  partner_ids: props.product?.partner_ids || [],
  main_image: null,
});

const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.main_image = file;
    imagePreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  if (isEditing) {
    form.post(`/admin/products/${props.product.id}`);
  } else {
    form.post('/admin/products');
  }
};
</script>

<template>
  <Head :title="(isEditing ? 'Edit Produk Inovasi' : 'Tambah Produk Baru') + ' - PUSKOR Admin'" />

  <AdminLayout :title="isEditing ? 'Edit Produk Inovasi' : 'Tambah Produk Baru'">
    <div class="max-w-4xl space-y-6">
      <Link href="/admin/products" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#647067] hover:text-[#14532D]">
        <ArrowLeft class="w-4 h-4" />
        <span>Kembali ke Katalog Produk Admin</span>
      </Link>

      <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-sm">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Program Asal *</label>
              <select
                v-model="form.program_id"
                required
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              >
                <option v-for="prog in programs" :key="prog.id" :value="prog.id">
                  {{ prog.name }}
                </option>
              </select>
              <p v-if="form.errors.program_id" class="mt-1 text-xs text-red-600">{{ form.errors.program_id }}</p>
            </div>

            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Status Publikasi</label>
              <select
                v-model="form.status"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              >
                <option value="published">Published (Tampil di Publik)</option>
                <option value="draft">Draft (Arsip)</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Nama Produk Inovasi *</label>
            <input
              type="text"
              v-model="form.name"
              required
              placeholder="Contoh: Alat Pengering Gabah Tenaga Surya"
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            />
            <p v-if="form.errors.name" class="mt-1 text-xs text-red-600">{{ form.errors.name }}</p>
          </div>

          <!-- Main Image Upload -->
          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Foto Utama Produk</label>
            <div class="flex items-start gap-4">
              <div v-if="imagePreview" class="w-24 h-24 rounded-xl border border-[#E5EAE5] overflow-hidden bg-[#F7FAF7] shrink-0">
                <img :src="imagePreview" alt="Preview" class="w-full h-full object-cover" />
              </div>
              <div class="flex-grow">
                <input
                  type="file"
                  @change="handleImageChange"
                  accept="image/jpeg,image/png,image/webp,image/jpg"
                  class="w-full text-xs text-[#647067] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#DCFCE7] file:text-[#14532D] hover:file:bg-[#14532D] hover:file:text-white file:transition-colors cursor-pointer"
                />
                <span class="text-[11px] text-[#647067] block mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</span>
                <p v-if="form.errors.main_image" class="mt-1 text-xs text-red-600">{{ form.errors.main_image }}</p>
              </div>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Ringkas *</label>
            <textarea
              v-model="form.short_description"
              rows="2"
              required
              placeholder="Ringkasan singkat fungsi dan penerapan teknologi..."
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
            <p v-if="form.errors.short_description" class="mt-1 text-xs text-red-600">{{ form.errors.short_description }}</p>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Lengkap & Spesifikasi *</label>
            <textarea
              v-model="form.description"
              rows="6"
              required
              placeholder="Jelaskan secara mendalam tentang teknologi, metode, dan kapasitas produksi..."
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
            <p v-if="form.errors.description" class="mt-1 text-xs text-red-600">{{ form.errors.description }}</p>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Fungsi & Keunggulan Produk</label>
            <textarea
              v-model="form.benefits"
              rows="4"
              placeholder="1. Mencegah susut hasil panen&#10;2. Hemat energi 65%&#10;3. Mudah dirawat kelompok tani"
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Tautan Eksternal (Opsional)</label>
            <input
              type="url"
              v-model="form.external_url"
              placeholder="https://lppm.unsoed.ac.id/dokumen-paten"
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            />
          </div>

          <!-- Partner Association Checkboxes -->
          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Hubungkan dengan Mitra Kolaborasi</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-48 overflow-y-auto p-3 rounded-xl border border-[#E5EAE5] bg-[#F7FAF7]">
              <label v-for="pt in partners" :key="pt.id" class="flex items-center gap-2 text-xs text-[#17231C] cursor-pointer">
                <input
                  type="checkbox"
                  :value="pt.id"
                  v-model="form.partner_ids"
                  class="rounded border-[#E5EAE5] text-[#14532D] focus:ring-[#22C55E]"
                />
                <span>{{ pt.name }}</span>
              </label>
            </div>
          </div>

          <!-- Featured Switch -->
          <div class="pt-2">
            <label class="flex items-center gap-2 cursor-pointer">
              <input
                type="checkbox"
                v-model="form.is_featured"
                class="rounded border-[#E5EAE5] text-[#14532D] focus:ring-[#22C55E]"
              />
              <span class="text-sm font-semibold text-[#14532D]">Tampilkan sebagai Produk Unggulan di Halaman Beranda</span>
            </label>
          </div>

          <!-- Submit Buttons -->
          <div class="pt-6 border-t border-[#E5EAE5] flex items-center justify-end gap-3">
            <Link href="/admin/products" class="px-5 py-2.5 rounded-xl border border-[#E5EAE5] text-sm font-semibold text-[#647067] hover:bg-[#F7FAF7]">
              Batal
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm"
            >
              <Save class="w-4 h-4" />
              <span>{{ form.processing ? 'Menyimpan...' : 'Simpan Produk' }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

