<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Save, FileText } from 'lucide-vue-next';

const props = defineProps({
  homeHero: Object,
  aboutProfile: Object,
});

const homeForm = useForm({
  section_key: 'hero',
  eyebrow: props.homeHero?.metadata?.eyebrow || 'UNIVERSITAS JENDERAL SOEDIRMAN',
  title: props.homeHero?.title || 'Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak.',
  content: props.homeHero?.content || 'Inovasi Hilirisasi Universitas Jenderal Soedirman menjadi wadah koordinasi pengembangan dan penerapan teknologi.',
});

const aboutForm = useForm({
  section_key: 'profile',
  title: props.aboutProfile?.title || 'Profil Inovasi Hilirisasi Universitas Jenderal Soedirman',
  content: props.aboutProfile?.content || 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi LPPM UNSOED.',
});

const submitHome = () => {
  homeForm.put('/admin/pages/home');
};

const submitAbout = () => {
  aboutForm.put('/admin/pages/about');
};
</script>

<template>
  <Head title="Manajemen Konten Halaman - Inovasi Hilirisasi Admin" />

  <AdminLayout title="Manajemen Konten Halaman">
    <div class="max-w-4xl space-y-8">
      <!-- Section 1: Halaman Beranda (Hero) -->
      <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-sm space-y-6">
        <div class="flex items-center gap-3 pb-4 border-b border-[#E5EAE5]">
          <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
            <FileText class="w-5 h-5" />
          </div>
          <div>
            <h3 class="text-base font-bold text-[#14532D]">Konten Hero Beranda</h3>
            <span class="text-xs text-[#647067]">Teks utama yang tampil di bagian atas halaman beranda publik.</span>
          </div>
        </div>

        <form @submit.prevent="submitHome" class="space-y-5">
          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Eyebrow / Sub-heading Atas</label>
            <input
              type="text"
              v-model="homeForm.eyebrow"
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Headline Utama</label>
            <input
              type="text"
              v-model="homeForm.title"
              required
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Hero</label>
            <textarea
              v-model="homeForm.content"
              rows="3"
              required
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
          </div>

          <div class="flex justify-end">
            <button
              type="submit"
              :disabled="homeForm.processing"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm"
            >
              <Save class="w-4 h-4" />
              <span>{{ homeForm.processing ? 'Menyimpan...' : 'Perbarui Beranda' }}</span>
            </button>
          </div>
        </form>
      </div>

      <!-- Section 2: Halaman Tentang Inovasi Hilirisasi -->
      <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-sm space-y-6">
        <div class="flex items-center gap-3 pb-4 border-b border-[#E5EAE5]">
          <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
            <FileText class="w-5 h-5" />
          </div>
          <div>
            <h3 class="text-base font-bold text-[#14532D]">Konten Tentang Inovasi Hilirisasi</h3>
            <span class="text-xs text-[#647067]">Profil dan peran organisasi di halaman Tentang Inovasi Hilirisasi.</span>
          </div>
        </div>

        <form @submit.prevent="submitAbout" class="space-y-5">
          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Judul Profil</label>
            <input
              type="text"
              v-model="aboutForm.title"
              required
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Profil Organisasi</label>
            <textarea
              v-model="aboutForm.content"
              rows="5"
              required
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
          </div>

          <div class="flex justify-end">
            <button
              type="submit"
              :disabled="aboutForm.processing"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm"
            >
              <Save class="w-4 h-4" />
              <span>{{ aboutForm.processing ? 'Menyimpan...' : 'Perbarui Tentang Kami' }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

