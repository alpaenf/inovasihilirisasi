<script setup>
import { ref } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ArrowLeft, Save, Upload, Building2 } from 'lucide-vue-next';

const props = defineProps({
  partner: Object,
  programs: Array,
});

const isEditing = !!props.partner;
const logoPreview = ref(props.partner?.logo || null);

const form = useForm({
  _method: isEditing ? 'PUT' : 'POST',
  name: props.partner?.name || '',
  category: props.partner?.category || 'Industri',
  short_description: props.partner?.short_description || '',
  description: props.partner?.description || '',
  address: props.partner?.address || '',
  website: props.partner?.website || '',
  email: props.partner?.email || '',
  phone: props.partner?.phone || '',
  is_featured: props.partner?.is_featured ?? false,
  status: props.partner?.status || 'published',
  program_ids: props.partner?.program_ids || [],
  logo: null,
});

const handleLogoChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.logo = file;
    logoPreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  if (isEditing) {
    form.post(`/admin/partners/${props.partner.id}`);
  } else {
    form.post('/admin/partners');
  }
};
</script>

<template>
  <Head :title="(isEditing ? 'Edit Mitra' : 'Tambah Mitra Baru') + ' - Inovasi Hilirisasi Admin'" />

  <AdminLayout :title="isEditing ? 'Edit Mitra Kolaborasi' : 'Tambah Mitra Baru'">
    <div class="max-w-4xl space-y-6">
      <Link href="/admin/partners" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#647067] hover:text-[#14532D]">
        <ArrowLeft class="w-4 h-4" />
        <span>Kembali ke Daftar Mitra</span>
      </Link>

      <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-sm">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="sm:col-span-2">
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Nama Instansi / Perusahaan *</label>
              <input
                type="text"
                v-model="form.name"
                required
                placeholder="Contoh: PT Pupuk Indonesia (Persero)"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
              <p v-if="form.errors.name" class="mt-1 text-xs text-red-600">{{ form.errors.name }}</p>
            </div>

            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Kategori Mitra</label>
              <select
                v-model="form.category"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              >
                <option value="Industri">Industri</option>
                <option value="BUMN">BUMN</option>
                <option value="Pemerintah">Pemerintah</option>
                <option value="UMKM">UMKM</option>
                <option value="Lembaga Riset">Lembaga Riset</option>
                <option value="Komunitas">Komunitas</option>
              </select>
            </div>
          </div>

          <!-- Logo Upload -->
          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
              Logo Resmi Mitra
              <span class="text-[11px] font-normal text-[#22C55E] normal-case ml-1.5">(Auto-compressed & dioptimasi)</span>
            </label>
            <div class="flex items-start gap-4">
              <div v-if="logoPreview" class="w-20 h-20 rounded-xl border border-[#E5EAE5] p-2 bg-[#F7FAF7] flex items-center justify-center shrink-0">
                <img :src="logoPreview" alt="Logo Preview" class="max-w-full max-h-full object-contain" />
              </div>
              <div class="flex-grow">
                <input
                  type="file"
                  @change="handleLogoChange"
                  accept="image/jpeg,image/png,image/webp,image/jpg,image/svg+xml"
                  class="w-full text-xs text-[#647067] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#DCFCE7] file:text-[#14532D] hover:file:bg-[#14532D] hover:file:text-white file:transition-colors cursor-pointer"
                />
                <span class="text-[11px] text-[#647067] block mt-1">Format: PNG, JPG, SVG, WEBP (otomatis dikompresi & disesuaikan rasio).</span>
                <p v-if="form.errors.logo" class="mt-1 text-xs text-red-600">{{ form.errors.logo }}</p>
              </div>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Ringkas</label>
            <textarea
              v-model="form.short_description"
              rows="2"
              placeholder="Peran atau fokus utama kemitraan..."
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Profil Lengkap</label>
            <textarea
              v-model="form.description"
              rows="5"
              placeholder="Deskripsi mendalam mengenai kemitraan strategis..."
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Alamat Website</label>
              <input
                type="url"
                v-model="form.website"
                placeholder="https://perusahaan.co.id"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Email Kontak</label>
              <input
                type="email"
                v-model="form.email"
                placeholder="kontak@perusahaan.co.id"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Telepon / Kontak</label>
              <input
                type="text"
                v-model="form.phone"
                placeholder="+62 21 123456"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
          </div>

          <!-- Programs multi-select -->
          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Program yang Melibatkan Mitra Ini</label>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 p-3 rounded-xl border border-[#E5EAE5] bg-[#F7FAF7]">
              <label v-for="prog in programs" :key="prog.id" class="flex items-center gap-2 text-xs font-semibold text-[#14532D] cursor-pointer">
                <input
                  type="checkbox"
                  :value="prog.id"
                  v-model="form.program_ids"
                  class="rounded border-[#E5EAE5] text-[#14532D] focus:ring-[#22C55E]"
                />
                <span>{{ prog.name }}</span>
              </label>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Status Publikasi</label>
              <select
                v-model="form.status"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              >
                <option value="published">Published</option>
                <option value="draft">Draft</option>
              </select>
            </div>

            <div class="flex items-center pt-6">
              <label class="flex items-center gap-2 cursor-pointer">
                <input
                  type="checkbox"
                  v-model="form.is_featured"
                  class="rounded border-[#E5EAE5] text-[#14532D] focus:ring-[#22C55E]"
                />
                <span class="text-sm font-semibold text-[#14532D]">Tampilkan di Beranda</span>
              </label>
            </div>
          </div>

          <div class="pt-4 border-t border-[#E5EAE5] flex items-center justify-end gap-3">
            <Link href="/admin/partners" class="px-5 py-2.5 rounded-xl border border-[#E5EAE5] text-sm font-semibold text-[#647067] hover:bg-[#F7FAF7]">
              Batal
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm"
            >
              <Save class="w-4 h-4" />
              <span>{{ form.processing ? 'Menyimpan...' : 'Simpan Mitra' }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

