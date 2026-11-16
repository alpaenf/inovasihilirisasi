<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ArrowLeft, Save } from 'lucide-vue-next';

const props = defineProps({
  program: Object,
});

const isEditing = !!props.program;

const form = useForm({
  name: props.program?.name || '',
  code: props.program?.code || '',
  short_description: props.program?.short_description || '',
  description: props.program?.description || '',
  status: props.program?.status || 'published',
  sort_order: props.program?.sort_order ?? 0,
});

const submit = () => {
  if (isEditing) {
    form.put(`/admin/programs/${props.program.id}`);
  } else {
    form.post('/admin/programs');
  }
};
</script>

<template>
  <Head :title="(isEditing ? 'Edit Program' : 'Tambah Program') + ' - Inovasi Hilirisasi Admin'" />

  <AdminLayout :title="isEditing ? 'Edit Program' : 'Tambah Program Baru'">
    <div class="max-w-4xl space-y-6">
      <Link href="/admin/programs" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#647067] hover:text-[#14532D]">
        <ArrowLeft class="w-4 h-4" />
        <span>Kembali ke Daftar Program</span>
      </Link>

      <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-sm">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="sm:col-span-2">
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Nama Program</label>
              <input
                type="text"
                v-model="form.name"
                required
                placeholder="Contoh: SINERGI"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
              <p v-if="form.errors.name" class="mt-1 text-xs text-red-600">{{ form.errors.name }}</p>
            </div>

            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Kode Singkatan</label>
              <input
                type="text"
                v-model="form.code"
                placeholder="Contoh: SIN"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Ringkas</label>
            <textarea
              v-model="form.short_description"
              rows="2"
              required
              placeholder="Deskripsi singkat untuk kartu dan preview..."
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
            <p v-if="form.errors.short_description" class="mt-1 text-xs text-red-600">{{ form.errors.short_description }}</p>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Lengkap & Latar Belakang</label>
            <textarea
              v-model="form.description"
              rows="6"
              required
              placeholder="Jelaskan tujuan, latar belakang, dan cakupan program..."
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
            <p v-if="form.errors.description" class="mt-1 text-xs text-red-600">{{ form.errors.description }}</p>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Status Publikasi</label>
              <select
                v-model="form.status"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              >
                <option value="published">Published (Tayang)</option>
                <option value="draft">Draft (Disembunyikan)</option>
              </select>
            </div>

            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Urutan Tampilan</label>
              <input
                type="number"
                v-model="form.sort_order"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
          </div>

          <div class="pt-4 border-t border-[#E5EAE5] flex items-center justify-end gap-3">
            <Link href="/admin/programs" class="px-5 py-2.5 rounded-xl border border-[#E5EAE5] text-sm font-semibold text-[#647067] hover:bg-[#F7FAF7]">
              Batal
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm"
            >
              <Save class="w-4 h-4" />
              <span>{{ form.processing ? 'Menyimpan...' : 'Simpan Program' }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

