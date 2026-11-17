<script setup>
import { ref, computed } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {
  Save,
  Plus,
  Trash2,
  Upload,
  User,
  Users,
  CheckCircle2,
  Home,
  FileText,
  Building2,
  GraduationCap,
  Sparkles,
  Layers,
  X,
  Loader2,
  AlertCircle,
  Image as ImageIcon,
  Newspaper,
  Phone,
  Mail,
  MapPin,
  Clock,
  MessageCircle,
  ExternalLink
} from 'lucide-vue-next';

const props = defineProps({
  homeHero: Object,
  homeGallery: Array,
  homeNews: Array,
  homeContact: Object,
  aboutProfile: Object,
  aboutOrg: Object,
  programs: Array,
});

// Active Main Tab: 'home' | 'about'
const activeMainTab = ref('home');

// Active Sub-Tab in Home: 'hero' | 'gallery' | 'news' | 'contact'
const activeHomeTab = ref('gallery');

// Active Sub-Tab in About: 'organization' | 'students' | 'profile'
const activeAboutTab = ref('organization');

// Active Program filter for students management
const selectedProgramFilter = ref('all');

// Photo upload states map: { [itemId]: boolean }
const uploadingStates = ref({});

// ==========================================
// 1. HOME: HERO FORM
// ==========================================
const homeHeroForm = useForm({
  section_key: 'hero',
  eyebrow: props.homeHero?.metadata?.eyebrow || 'UNIVERSITAS JENDERAL SOEDIRMAN',
  title: props.homeHero?.title || 'Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak.',
  content: props.homeHero?.content || 'Inovasi Hilirisasi Universitas Jenderal Soedirman menjadi wadah koordinasi pengembangan dan penerapan teknologi.',
});

const submitHomeHero = () => {
  homeHeroForm.put('/admin/pages/home', {
    preserveScroll: true,
  });
};

// ==========================================
// 2. HOME: GALLERY FORM
// ==========================================
const galleryForm = useForm({
  section_key: 'gallery',
  items: JSON.parse(JSON.stringify(props.homeGallery || [])),
});

const addGalleryItem = () => {
  galleryForm.items.unshift({
    id: `gal_${Date.now()}`,
    title: '',
    category: 'Dokumentasi Lapangan',
    tag: 'SINERGI',
    image: '',
    date: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }),
    location: 'LPPM UNSOED Purwokerto',
    description: '',
  });
};

const removeGalleryItem = (index) => {
  if (confirm('Apakah Anda yakin ingin menghapus foto kegiatan ini?')) {
    galleryForm.items.splice(index, 1);
  }
};

const submitGallery = () => {
  // Validate that all items have at least title, category, tag, and image
  const missingImage = galleryForm.items.find(i => !i.image);
  if (missingImage) {
    alert(`Mohon unggah foto untuk item "${missingImage.title || 'Foto Baru'}" sebelum menyimpan.`);
    return;
  }
  galleryForm.put('/admin/pages/home', {
    preserveScroll: true,
  });
};

// ==========================================
// 3. HOME: NEWS & PUBLICATION FORM
// ==========================================
const newsForm = useForm({
  section_key: 'news',
  items: JSON.parse(JSON.stringify(props.homeNews || [])),
});

const addNewsItem = () => {
  newsForm.items.unshift({
    id: `news_${Date.now()}`,
    slug: `berita-${Date.now()}`,
    title: '',
    category: 'Kemitraan DUDI',
    tag: 'SINERGI',
    image: '',
    date: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }),
    author: 'Tim Media Inovasi Hilirisasi',
    read_time: '3 menit baca',
    excerpt: '',
    content: '',
  });
};

const removeNewsItem = (index) => {
  if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
    newsForm.items.splice(index, 1);
  }
};

const submitNews = () => {
  const missingImage = newsForm.items.find(i => !i.image);
  if (missingImage) {
    alert(`Mohon unggah foto sampul untuk berita "${missingImage.title || 'Berita Baru'}" sebelum menyimpan.`);
    return;
  }
  newsForm.put('/admin/pages/home', {
    preserveScroll: true,
  });
};

// ==========================================
// 4. HOME: CONTACT & SERVICE FORM
// ==========================================
const contactForm = useForm({
  section_key: 'contact',
  email: props.homeContact?.email || 'p3t.lppm@unsoed.ac.id',
  phone: props.homeContact?.phone || '+62 281 635292',
  whatsapp: props.homeContact?.whatsapp || '+62 812-3456-7890',
  address: props.homeContact?.address || 'Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto, Jawa Tengah 53122',
  hours: props.homeContact?.hours || 'Senin - Jumat: 08.00 - 16.00 WIB',
});

const submitContact = () => {
  contactForm.put('/admin/pages/home', {
    preserveScroll: true,
  });
};

// ==========================================
// 5. ABOUT: PROFILE FORM
// ==========================================
const aboutProfileForm = useForm({
  section_key: 'profile',
  title: props.aboutProfile?.title || 'Profil Inovasi Hilirisasi Universitas Jenderal Soedirman',
  content: props.aboutProfile?.content || 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi LPPM UNSOED.',
  vision: props.aboutProfile?.metadata?.vision || 'Menjadi pusat unggulan koordinasi dan penerapan teknologi tepat guna yang berakar pada kearifan lokal dan berdaya saing global.',
  mission: props.aboutProfile?.metadata?.mission || [
    'Memfasilitasi hilirisasi hasil riset teknologi civitas akademika UNSOED.',
    'Membangun kemitraan strategis dengan industri, pemerintah daerah, dan komunitas.',
    'Mendorong diseminasi teknologi tepat guna untuk pengentasan kemiskinan dan kemandirian desa.',
  ],
});

const addMissionItem = () => {
  aboutProfileForm.mission.push('');
};

const removeMissionItem = (index) => {
  aboutProfileForm.mission.splice(index, 1);
};

const submitAboutProfile = () => {
  aboutProfileForm.put('/admin/pages/about', {
    preserveScroll: true,
  });
};

// ==========================================
// 6. ABOUT: ORGANIZATION FORM
// ==========================================
const orgForm = useForm({
  section_key: 'organization',
  title: props.aboutOrg?.title || 'Struktur Organisasi Inovasi Hilirisasi',
  content: props.aboutOrg?.content || 'Struktur kepemimpinan dan pembagian divisi operasional dalam mengoordinasikan hilirisasi riset, alih teknologi, dan kemitraan industri di lingkungan LPPM UNSOED.',
  leaders: JSON.parse(JSON.stringify(props.aboutOrg?.leaders || [])),
  divisions: JSON.parse(JSON.stringify(props.aboutOrg?.divisions || [])),
  students: JSON.parse(JSON.stringify(props.aboutOrg?.students || [])),
});

// Photo upload function with modern WebP compression
const uploadPhotoForItem = async (event, item, folder = 'organization', photoField = 'photo') => {
  const file = event.target.files?.[0];
  if (!file) return;

  const tempId = item.id || `temp_${Math.random().toString(36).substr(2, 9)}`;
  if (!item.id) item.id = tempId;

  uploadingStates.value[tempId] = true;

  try {
    const formData = new FormData();
    formData.append('photo', file);
    formData.append('folder', folder);

    const xsrfCookie = document.cookie
      .split('; ')
      .find((row) => row.startsWith('XSRF-TOKEN='));
    const token = xsrfCookie ? decodeURIComponent(xsrfCookie.split('=')[1]) : '';

    const res = await fetch('/admin/pages/upload-photo', {
      method: 'POST',
      body: formData,
      headers: {
        'X-XSRF-TOKEN': token,
        Accept: 'application/json',
      },
    });

    const data = await res.json();
    if (res.ok && data.url) {
      item[photoField] = data.url;
    } else {
      alert(data.message || 'Gagal mengunggah foto.');
    }
  } catch (err) {
    alert('Terjadi kesalahan saat mengunggah foto: ' + err.message);
  } finally {
    uploadingStates.value[tempId] = false;
    event.target.value = '';
  }
};

const removePhotoForItem = (item, photoField = 'photo') => {
  item[photoField] = null;
};

// Leaders Actions
const addLeader = () => {
  orgForm.leaders.push({
    id: `leader_${Date.now()}`,
    name: '',
    position: '',
    category: 'Pimpinan Eksekutif',
    description: '',
    photo: null,
  });
};

const removeLeader = (index) => {
  if (confirm('Apakah Anda yakin ingin menghapus pengurus ini?')) {
    orgForm.leaders.splice(index, 1);
  }
};

// Students Actions
const addStudent = (programSlug = null) => {
  const targetSlug = programSlug || (selectedProgramFilter.value !== 'all' ? selectedProgramFilter.value : (props.programs?.[0]?.slug || 'sinergi'));
  const targetProgram = props.programs?.find((p) => p.slug === targetSlug);

  orgForm.students.push({
    id: `std_${Date.now()}`,
    name: '',
    identifier: '',
    role: '',
    program_slug: targetSlug,
    program_name: targetProgram ? targetProgram.name : targetSlug.toUpperCase(),
    photo: null,
  });
};

const removeStudent = (index) => {
  if (confirm('Apakah Anda yakin ingin menghapus mahasiswa/anggota ini?')) {
    orgForm.students.splice(index, 1);
  }
};

const onStudentProgramChange = (student) => {
  const prog = props.programs?.find((p) => p.slug === student.program_slug);
  if (prog) {
    student.program_name = prog.name;
  }
};

const filteredStudents = computed(() => {
  if (selectedProgramFilter.value === 'all') {
    return orgForm.students;
  }
  return orgForm.students.filter((s) => s.program_slug === selectedProgramFilter.value);
});

const getStudentCountByProgram = (slug) => {
  if (slug === 'all') return orgForm.students.length;
  return orgForm.students.filter((s) => s.program_slug === slug).length;
};

const submitOrganization = () => {
  orgForm.put('/admin/pages/about', {
    preserveScroll: true,
  });
};
</script>

<template>
  <Head title="Manajemen Halaman - Inovasi Hilirisasi Admin" />

  <AdminLayout title="Manajemen Halaman">
    <div class="space-y-6">
      <!-- Main Page Navigation Tabs -->
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 border-b border-[#E5EAE5] pb-4">
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar">
          <button
            type="button"
            @click="activeMainTab = 'home'"
            class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all whitespace-nowrap min-h-[44px]"
            :class="activeMainTab === 'home'
              ? 'bg-[#14532D] text-white shadow-sm'
              : 'bg-white text-[#647067] hover:text-[#14532D] hover:bg-[#F7FAF7] border border-[#E5EAE5]'"
          >
            <Home class="w-4 h-4" />
            <span>Halaman Beranda</span>
          </button>

          <button
            type="button"
            @click="activeMainTab = 'about'"
            class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all whitespace-nowrap min-h-[44px]"
            :class="activeMainTab === 'about'
              ? 'bg-[#14532D] text-white shadow-sm'
              : 'bg-white text-[#647067] hover:text-[#14532D] hover:bg-[#F7FAF7] border border-[#E5EAE5]'"
          >
            <Building2 class="w-4 h-4" />
            <span>Halaman Tentang Kami</span>
          </button>
        </div>

        <span class="text-xs text-[#647067]">
          Kelola galeri kegiatan, berita, kontak, serta struktur organisasi dengan auto kompresi foto WebP.
        </span>
      </div>

      <!-- ======================================================== -->
      <!-- TAB 1: HALAMAN BERANDA -->
      <!-- ======================================================== -->
      <div v-if="activeMainTab === 'home'" class="space-y-6">
        <!-- Sub-Navigation for Home Section -->
        <div class="flex items-center gap-2 border-b border-[#E5EAE5] pb-3 overflow-x-auto no-scrollbar">
          <button
            type="button"
            @click="activeHomeTab = 'gallery'"
            class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all min-h-[40px] whitespace-nowrap"
            :class="activeHomeTab === 'gallery'
              ? 'bg-[#DCFCE7] text-[#14532D] shadow-xs'
              : 'text-[#647067] hover:bg-[#F7FAF7]'"
          >
            <ImageIcon class="w-4 h-4 text-[#22C55E]" />
            <span>Galeri Kegiatan</span>
            <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-[#14532D] text-white font-extrabold">
              {{ galleryForm.items.length }}
            </span>
          </button>

          <button
            type="button"
            @click="activeHomeTab = 'news'"
            class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all min-h-[40px] whitespace-nowrap"
            :class="activeHomeTab === 'news'
              ? 'bg-[#DCFCE7] text-[#14532D] shadow-xs'
              : 'text-[#647067] hover:bg-[#F7FAF7]'"
          >
            <Newspaper class="w-4 h-4 text-[#22C55E]" />
            <span>Berita & Publikasi</span>
            <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-[#14532D] text-white font-extrabold">
              {{ newsForm.items.length }}
            </span>
          </button>

          <button
            type="button"
            @click="activeHomeTab = 'contact'"
            class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all min-h-[40px] whitespace-nowrap"
            :class="activeHomeTab === 'contact'
              ? 'bg-[#DCFCE7] text-[#14532D] shadow-xs'
              : 'text-[#647067] hover:bg-[#F7FAF7]'"
          >
            <Phone class="w-4 h-4 text-[#22C55E]" />
            <span>Kontak & Layanan</span>
          </button>

          <button
            type="button"
            @click="activeHomeTab = 'hero'"
            class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all min-h-[40px] whitespace-nowrap"
            :class="activeHomeTab === 'hero'
              ? 'bg-[#DCFCE7] text-[#14532D] shadow-xs'
              : 'text-[#647067] hover:bg-[#F7FAF7]'"
          >
            <Sparkles class="w-4 h-4 text-[#22C55E]" />
            <span>Hero Utama Beranda</span>
          </button>
        </div>

        <!-- 1.A: GALERI KEGIATAN -->
        <div v-show="activeHomeTab === 'gallery'" class="space-y-6">
          <form @submit.prevent="submitGallery" class="space-y-6">
            <!-- Header Card -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-[#E5EAE5] shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
              <div>
                <h3 class="text-base sm:text-lg font-bold text-[#14532D] flex items-center gap-2">
                  <ImageIcon class="w-5 h-5 text-[#22C55E]" />
                  <span>Galeri Dokumentasi & Kegiatan Lapangan</span>
                </h3>
                <p class="text-xs text-[#647067] mt-1 leading-relaxed max-w-2xl">
                  Unggah foto dokumentasi kegiatan hilirisasi, uji coba prototipe, expo riset, dan pendampingan UMKM. Foto otomatis dikompresi ke format WebP ringan dan tajam.
                </p>
              </div>

              <div class="flex items-center gap-2 w-full sm:w-auto">
                <button
                  type="button"
                  @click="addGalleryItem"
                  class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#DCFCE7] text-[#14532D] hover:bg-[#DCFCE7]/80 transition-all flex-1 sm:flex-initial min-h-[44px]"
                >
                  <Plus class="w-4 h-4" />
                  <span>Tambah Foto Galeri</span>
                </button>

                <button
                  type="submit"
                  :disabled="galleryForm.processing"
                  class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all flex-1 sm:flex-initial min-h-[44px]"
                >
                  <Save class="w-4 h-4" />
                  <span>{{ galleryForm.processing ? 'Menyimpan...' : 'Simpan Galeri' }}</span>
                </button>
              </div>
            </div>

            <!-- Empty State -->
            <div
              v-if="galleryForm.items.length === 0"
              class="p-8 text-center bg-white rounded-2xl border border-dashed border-[#E5EAE5] space-y-3"
            >
              <ImageIcon class="w-10 h-10 text-[#647067]/40 mx-auto" />
              <h4 class="text-sm font-bold text-[#14532D]">Belum Ada Foto di Galeri</h4>
              <p class="text-xs text-[#647067] max-w-sm mx-auto">
                Klik tombol di bawah untuk menambahkan dokumentasi foto kegiatan pertama Anda.
              </p>
              <button
                type="button"
                @click="addGalleryItem"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-all shadow-xs"
              >
                <Plus class="w-3.5 h-3.5" />
                <span>Tambah Foto Sekarang</span>
              </button>
            </div>

            <!-- Grid of Gallery Items -->
            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
              <div
                v-for="(item, idx) in galleryForm.items"
                :key="item.id || idx"
                class="bg-white p-5 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/40 shadow-xs transition-all relative flex flex-col justify-between space-y-4"
              >
                <!-- Top Row: Photo Upload Box + Delete -->
                <div class="space-y-4">
                  <div class="flex items-start justify-between gap-3">
                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-[#F7FAF7] text-[#14532D] border border-[#E5EAE5]">
                      Dokumentasi #{{ idx + 1 }}
                    </span>

                    <button
                      type="button"
                      @click="removeGalleryItem(idx)"
                      class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors"
                      title="Hapus item galeri ini"
                    >
                      <Trash2 class="w-4 h-4" />
                    </button>
                  </div>

                  <!-- Photo Upload Area -->
                  <div class="relative w-full aspect-video rounded-xl bg-[#F7FAF7] border-2 border-dashed border-[#E5EAE5] overflow-hidden flex items-center justify-center">
                    <img
                      v-if="item.image"
                      :src="item.image"
                      :alt="item.title || 'Foto Galeri'"
                      class="w-full h-full object-cover"
                    />
                    <div v-else class="flex flex-col items-center justify-center text-[#647067] p-4 text-center">
                      <ImageIcon class="w-8 h-8 text-[#647067]/40 mb-1" />
                      <span class="text-xs font-bold text-[#14532D]">Belum ada foto</span>
                      <span class="text-[10px] text-[#647067] mt-0.5">Format JPG, PNG, WEBP (Auto Compress WebP)</span>
                    </div>

                    <!-- Loading Overlay -->
                    <div
                      v-if="uploadingStates[item.id]"
                      class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-xs font-bold gap-2"
                    >
                      <Loader2 class="w-5 h-5 animate-spin" />
                      <span>Mengompresi & Mengunggah...</span>
                    </div>
                  </div>

                  <!-- Upload Controls -->
                  <div class="flex items-center gap-2">
                    <label class="cursor-pointer inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-colors shadow-2xs">
                      <Upload class="w-3.5 h-3.5" />
                      <span>{{ item.image ? 'Ganti Foto' : 'Pilih Foto Kegiatan' }}</span>
                      <input
                        type="file"
                        accept="image/png,image/jpeg,image/webp,image/jpg"
                        class="hidden"
                        @change="uploadPhotoForItem($event, item, 'gallery', 'image')"
                      />
                    </label>

                    <button
                      v-if="item.image"
                      type="button"
                      @click="item.image = ''"
                      class="px-2.5 py-1.5 rounded-lg text-xs text-rose-500 hover:bg-rose-50 transition-colors"
                    >
                      Hapus Foto
                    </button>
                  </div>

                  <!-- Inputs for Gallery Item -->
                  <div class="space-y-3 pt-1">
                    <div>
                      <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                        Judul Kegiatan / Dokumentasi
                      </label>
                      <input
                        type="text"
                        v-model="item.title"
                        placeholder="Contoh: Uji Coba Lapangan Mesin Briket Biomassa"
                        required
                        class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm font-semibold focus:outline-none focus:border-[#22C55E]"
                      />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Tag / Program
                        </label>
                        <select
                          v-model="item.tag"
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs font-bold text-[#14532D] bg-[#F7FAF7] focus:outline-none focus:border-[#22C55E]"
                        >
                          <option value="SINERGI">SINERGI</option>
                          <option value="AJAKAN INDUSTRI">AJAKAN INDUSTRI</option>
                          <option value="PMUPUD">PMUPUD</option>
                          <option value="DORTEK">DORTEK</option>
                          <option value="EXPO RISET">EXPO RISET</option>
                          <option value="KOLABORASI">KOLABORASI</option>
                        </select>
                      </div>

                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Kategori / Topik
                        </label>
                        <input
                          type="text"
                          v-model="item.category"
                          placeholder="Uji Prototipe Mesin / Inkubasi"
                          required
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Tanggal Kegiatan
                        </label>
                        <input
                          type="text"
                          v-model="item.date"
                          placeholder="Contoh: 12 November 2026"
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>

                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Lokasi Kegiatan
                        </label>
                        <input
                          type="text"
                          v-model="item.location"
                          placeholder="Contoh: Pabrik Gula Banyumas"
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>
                    </div>

                    <div>
                      <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                        Deskripsi Singkat Dokumentasi
                      </label>
                      <textarea
                        v-model="item.description"
                        rows="2"
                        placeholder="Keterangan singkat mengenai kegiatan, peserta, dan tujuan pelaksanaan..."
                        class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                      ></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bottom Save Bar -->
            <div class="flex justify-end pt-4 border-t border-[#E5EAE5]">
              <button
                type="submit"
                :disabled="galleryForm.processing"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-md transition-all w-full sm:w-auto justify-center"
              >
                <Save class="w-4 h-4" />
                <span>{{ galleryForm.processing ? 'Menyimpan...' : 'Simpan Seluruh Galeri Kegiatan' }}</span>
              </button>
            </div>
          </form>
        </div>

        <!-- 1.B: BERITA & PUBLIKASI -->
        <div v-show="activeHomeTab === 'news'" class="space-y-6">
          <form @submit.prevent="submitNews" class="space-y-6">
            <!-- Header Card -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-[#E5EAE5] shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
              <div>
                <h3 class="text-base sm:text-lg font-bold text-[#14532D] flex items-center gap-2">
                  <Newspaper class="w-5 h-5 text-[#22C55E]" />
                  <span>Berita & Rilis Publikasi Hilirisasi</span>
                </h3>
                <p class="text-xs text-[#647067] mt-1 leading-relaxed max-w-2xl">
                  Kelola artikel berita hilirisasi, rilis hasil riset bersama industri, serta capaian program. Foto sampul otomatis dikompresi ke format WebP.
                </p>
              </div>

              <div class="flex items-center gap-2 w-full sm:w-auto">
                <button
                  type="button"
                  @click="addNewsItem"
                  class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#DCFCE7] text-[#14532D] hover:bg-[#DCFCE7]/80 transition-all flex-1 sm:flex-initial min-h-[44px]"
                >
                  <Plus class="w-4 h-4" />
                  <span>Tambah Berita Baru</span>
                </button>

                <button
                  type="submit"
                  :disabled="newsForm.processing"
                  class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all flex-1 sm:flex-initial min-h-[44px]"
                >
                  <Save class="w-4 h-4" />
                  <span>{{ newsForm.processing ? 'Menyimpan...' : 'Simpan Berita' }}</span>
                </button>
              </div>
            </div>

            <!-- Empty State -->
            <div
              v-if="newsForm.items.length === 0"
              class="p-8 text-center bg-white rounded-2xl border border-dashed border-[#E5EAE5] space-y-3"
            >
              <Newspaper class="w-10 h-10 text-[#647067]/40 mx-auto" />
              <h4 class="text-sm font-bold text-[#14532D]">Belum Ada Artikel Berita</h4>
              <p class="text-xs text-[#647067] max-w-sm mx-auto">
                Klik tombol di bawah untuk menambahkan artikel berita pertama Anda.
              </p>
              <button
                type="button"
                @click="addNewsItem"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-all shadow-xs"
              >
                <Plus class="w-3.5 h-3.5" />
                <span>Tambah Berita Sekarang</span>
              </button>
            </div>

            <!-- List of News Items -->
            <div v-else class="space-y-6">
              <div
                v-for="(item, idx) in newsForm.items"
                :key="item.id || idx"
                class="bg-white p-5 sm:p-6 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/40 shadow-xs transition-all space-y-5"
              >
                <!-- Top Row: Badge + Delete -->
                <div class="flex items-center justify-between border-b border-[#E5EAE5] pb-3">
                  <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-[#DCFCE7] text-[#14532D]">
                      Artikel Berita #{{ idx + 1 }}
                    </span>
                    <span class="text-xs text-[#647067] font-medium hidden sm:inline">
                      {{ item.date || 'Tanggal belum diatur' }}
                    </span>
                  </div>

                  <button
                    type="button"
                    @click="removeNewsItem(idx)"
                    class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors flex items-center gap-1 text-xs"
                    title="Hapus berita ini"
                  >
                    <Trash2 class="w-4 h-4" />
                    <span>Hapus Berita</span>
                  </button>
                </div>

                <!-- Form Layout: Cover Photo + Core Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                  <!-- Cover Photo Box (4 cols) -->
                  <div class="lg:col-span-4 space-y-2">
                    <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider">
                      Foto Sampul Berita (Cover)
                    </label>

                    <div class="relative w-full aspect-video sm:aspect-4/3 rounded-xl bg-[#F7FAF7] border-2 border-dashed border-[#E5EAE5] overflow-hidden flex items-center justify-center">
                      <img
                        v-if="item.image"
                        :src="item.image"
                        :alt="item.title || 'Sampul Berita'"
                        class="w-full h-full object-cover"
                      />
                      <div v-else class="flex flex-col items-center justify-center text-[#647067] p-3 text-center">
                        <Newspaper class="w-7 h-7 text-[#647067]/40 mb-1" />
                        <span class="text-xs font-bold text-[#14532D]">Belum ada cover</span>
                        <span class="text-[9px] text-[#647067] mt-0.5">Auto Compress WebP</span>
                      </div>

                      <!-- Loading Overlay -->
                      <div
                        v-if="uploadingStates[item.id]"
                        class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-xs font-bold gap-2"
                      >
                        <Loader2 class="w-4 h-4 animate-spin" />
                        <span>Mengompresi...</span>
                      </div>
                    </div>

                    <div class="flex items-center gap-2">
                      <label class="cursor-pointer inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-colors shadow-2xs">
                        <Upload class="w-3 h-3" />
                        <span>{{ item.image ? 'Ganti Cover' : 'Upload Cover' }}</span>
                        <input
                          type="file"
                          accept="image/png,image/jpeg,image/webp,image/jpg"
                          class="hidden"
                          @change="uploadPhotoForItem($event, item, 'news', 'image')"
                        />
                      </label>

                      <button
                        v-if="item.image"
                        type="button"
                        @click="item.image = ''"
                        class="text-xs text-rose-500 hover:underline"
                      >
                        Hapus Foto
                      </button>
                    </div>
                  </div>

                  <!-- Details (8 cols) -->
                  <div class="lg:col-span-8 space-y-3.5">
                    <div>
                      <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                        Judul Berita / Publikasi
                      </label>
                      <input
                        type="text"
                        v-model="item.title"
                        placeholder="Contoh: UNSOED dan Pupuk Indonesia Luncurkan Formula Pupuk Hayati..."
                        required
                        class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm font-semibold focus:outline-none focus:border-[#22C55E]"
                      />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Tag / Program
                        </label>
                        <select
                          v-model="item.tag"
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs font-bold text-[#14532D] bg-[#F7FAF7] focus:outline-none focus:border-[#22C55E]"
                        >
                          <option value="SINERGI">SINERGI</option>
                          <option value="AJAKAN INDUSTRI">AJAKAN INDUSTRI</option>
                          <option value="PMUPUD">PMUPUD</option>
                          <option value="DORTEK">DORTEK</option>
                          <option value="KOLABORASI">KOLABORASI</option>
                        </select>
                      </div>

                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Kategori
                        </label>
                        <input
                          type="text"
                          v-model="item.category"
                          placeholder="Kemitraan DUDI / Riset"
                          required
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>

                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Estimasi Waktu Baca
                        </label>
                        <input
                          type="text"
                          v-model="item.read_time"
                          placeholder="3 menit baca"
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Penulis / Redaksi
                        </label>
                        <input
                          type="text"
                          v-model="item.author"
                          placeholder="Tim Media Inovasi Hilirisasi"
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>

                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Tanggal Publikasi
                        </label>
                        <input
                          type="text"
                          v-model="item.date"
                          placeholder="Contoh: 14 November 2026"
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>
                    </div>

                    <div>
                      <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                        Ringkasan Singkat (Muncul di kartu beranda)
                      </label>
                      <textarea
                        v-model="item.excerpt"
                        rows="2"
                        required
                        placeholder="Ringkasan 1-2 kalimat untuk preview di kartu beranda..."
                        class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                      ></textarea>
                    </div>

                    <div>
                      <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                        Isi Berita Lengkap (Dibaca saat klik baca selengkapnya)
                      </label>
                      <textarea
                        v-model="item.content"
                        rows="4"
                        placeholder="Tuliskan berita lengkap, narasi kerja sama, kutipan narasumber, dan penjelasan program..."
                        class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                      ></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bottom Save Bar -->
            <div class="flex justify-end pt-4 border-t border-[#E5EAE5]">
              <button
                type="submit"
                :disabled="newsForm.processing"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-md transition-all w-full sm:w-auto justify-center"
              >
                <Save class="w-4 h-4" />
                <span>{{ newsForm.processing ? 'Menyimpan...' : 'Simpan Seluruh Artikel Berita' }}</span>
              </button>
            </div>
          </form>
        </div>

        <!-- 1.C: KONTAK & LAYANAN -->
        <div v-show="activeHomeTab === 'contact'" class="max-w-4xl space-y-6">
          <div class="bg-white p-5 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-[#E5EAE5]">
              <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                <Phone class="w-5 h-5 text-[#22C55E]" />
              </div>
              <div>
                <h3 class="text-base font-bold text-[#14532D]">Informasi Kontak, Hotline & Layanan</h3>
                <span class="text-xs text-[#647067]">
                  Disinkronkan otomatis ke halaman Beranda dan data pengaturan website publik.
                </span>
              </div>
            </div>

            <form @submit.prevent="submitContact" class="space-y-5">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                    Email Resmi
                  </label>
                  <input
                    type="email"
                    v-model="contactForm.email"
                    required
                    placeholder="p3t.lppm@unsoed.ac.id"
                    class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                </div>

                <div>
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                    Nomor Telepon Kantor
                  </label>
                  <input
                    type="text"
                    v-model="contactForm.phone"
                    required
                    placeholder="+62 281 635292"
                    class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                    Nomor WhatsApp Hotline (Konsultasi Cepat)
                  </label>
                  <input
                    type="text"
                    v-model="contactForm.whatsapp"
                    placeholder="+62 812-3456-7890"
                    class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                </div>

                <div>
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                    Jam Operasional Kantor
                  </label>
                  <input
                    type="text"
                    v-model="contactForm.hours"
                    placeholder="Senin - Jumat: 08.00 - 16.00 WIB"
                    class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                </div>
              </div>

              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                  Alamat Lengkap Kantor & Gedung
                </label>
                <textarea
                  v-model="contactForm.address"
                  rows="3"
                  required
                  placeholder="Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708..."
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                ></textarea>
              </div>

              <div class="flex justify-end pt-3 border-t border-[#E5EAE5]">
                <button
                  type="submit"
                  :disabled="contactForm.processing"
                  class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all"
                >
                  <Save class="w-4 h-4" />
                  <span>{{ contactForm.processing ? 'Menyimpan...' : 'Perbarui Informasi Kontak' }}</span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- 1.D: HERO UTAMA BERANDA -->
        <div v-show="activeHomeTab === 'hero'" class="max-w-4xl space-y-6">
          <div class="bg-white p-5 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-[#E5EAE5]">
              <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                <Sparkles class="w-5 h-5 text-[#22C55E]" />
              </div>
              <div>
                <h3 class="text-base font-bold text-[#14532D]">Hero Section Beranda</h3>
                <span class="text-xs text-[#647067]">Headline dan teks sambutan paling atas di halaman utama.</span>
              </div>
            </div>

            <form @submit.prevent="submitHomeHero" class="space-y-5">
              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Eyebrow / Sub-heading</label>
                <input
                  type="text"
                  v-model="homeHeroForm.eyebrow"
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                />
              </div>

              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Headline Utama</label>
                <input
                  type="text"
                  v-model="homeHeroForm.title"
                  required
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                />
              </div>

              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Hero</label>
                <textarea
                  v-model="homeHeroForm.content"
                  rows="3"
                  required
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                ></textarea>
              </div>

              <div class="flex justify-end pt-2">
                <button
                  type="submit"
                  :disabled="homeHeroForm.processing"
                  class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all"
                >
                  <Save class="w-4 h-4" />
                  <span>{{ homeHeroForm.processing ? 'Menyimpan...' : 'Perbarui Hero Beranda' }}</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- ======================================================== -->
      <!-- TAB 2: HALAMAN TENTANG KAMI -->
      <!-- ======================================================== -->
      <div v-if="activeMainTab === 'about'" class="space-y-6">
        <!-- Sub-Navigation for About Section -->
        <div class="flex items-center gap-2 border-b border-[#E5EAE5] pb-3 overflow-x-auto no-scrollbar">
          <button
            type="button"
            @click="activeAboutTab = 'organization'"
            class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all min-h-[40px] whitespace-nowrap"
            :class="activeAboutTab === 'organization'
              ? 'bg-[#DCFCE7] text-[#14532D] shadow-xs'
              : 'text-[#647067] hover:bg-[#F7FAF7]'"
          >
            <Users class="w-4 h-4 text-[#22C55E]" />
            <span>Pimpinan & Struktur Organisasi</span>
          </button>

          <button
            type="button"
            @click="activeAboutTab = 'students'"
            class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all min-h-[40px] whitespace-nowrap"
            :class="activeAboutTab === 'students'
              ? 'bg-[#DCFCE7] text-[#14532D] shadow-xs'
              : 'text-[#647067] hover:bg-[#F7FAF7]'"
          >
            <GraduationCap class="w-4 h-4 text-[#22C55E]" />
            <span>Mahasiswa & Tim per Program</span>
            <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] bg-[#14532D] text-white font-extrabold">
              {{ orgForm.students.length }}
            </span>
          </button>

          <button
            type="button"
            @click="activeAboutTab = 'profile'"
            class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all min-h-[40px] whitespace-nowrap"
            :class="activeAboutTab === 'profile'
              ? 'bg-[#DCFCE7] text-[#14532D] shadow-xs'
              : 'text-[#647067] hover:bg-[#F7FAF7]'"
          >
            <FileText class="w-4 h-4 text-[#22C55E]" />
            <span>Profil & Visi Misi</span>
          </button>
        </div>

        <!-- SUB-TAB A: PROFIL & VISI MISI -->
        <div v-show="activeAboutTab === 'profile'" class="max-w-4xl">
          <div class="bg-white p-5 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-[#E5EAE5]">
              <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
                <FileText class="w-5 h-5 text-[#22C55E]" />
              </div>
              <div>
                <h3 class="text-base font-bold text-[#14532D]">Profil Institusi & Visi Misi</h3>
                <span class="text-xs text-[#647067]">Informasi perkenalan institusi, deskripsi tujuan, visi dan misi.</span>
              </div>
            </div>

            <form @submit.prevent="submitAboutProfile" class="space-y-6">
              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Judul Profil</label>
                <input
                  type="text"
                  v-model="aboutProfileForm.title"
                  required
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                />
              </div>

              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Deskripsi Profil Organisasi</label>
                <textarea
                  v-model="aboutProfileForm.content"
                  rows="4"
                  required
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                ></textarea>
              </div>

              <div>
                <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Visi Organisasi</label>
                <textarea
                  v-model="aboutProfileForm.vision"
                  rows="2"
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                ></textarea>
              </div>

              <!-- Misi List Dynamic -->
              <div class="space-y-3">
                <div class="flex items-center justify-between">
                  <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider">Daftar Misi Strategis</label>
                  <button
                    type="button"
                    @click="addMissionItem"
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-[#DCFCE7] text-[#14532D] hover:bg-[#DCFCE7]/80 transition-colors"
                  >
                    <Plus class="w-3.5 h-3.5" />
                    <span>Tambah Misi</span>
                  </button>
                </div>

                <div v-for="(m, idx) in aboutProfileForm.mission" :key="idx" class="flex items-center gap-2">
                  <span class="w-6 text-xs font-bold text-[#647067] text-center">{{ idx + 1 }}.</span>
                  <input
                    type="text"
                    v-model="aboutProfileForm.mission[idx]"
                    placeholder="Tuliskan butir misi..."
                    class="flex-1 px-4 py-2 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
                  />
                  <button
                    type="button"
                    @click="removeMissionItem(idx)"
                    class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors"
                    title="Hapus butir misi"
                  >
                    <Trash2 class="w-4 h-4" />
                  </button>
                </div>
              </div>

              <div class="flex justify-end pt-3 border-t border-[#E5EAE5]">
                <button
                  type="submit"
                  :disabled="aboutProfileForm.processing"
                  class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all"
                >
                  <Save class="w-4 h-4" />
                  <span>{{ aboutProfileForm.processing ? 'Menyimpan...' : 'Perbarui Profil & Visi Misi' }}</span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- SUB-TAB B: PIMPINAN & STRUKTUR ORGANISASI -->
        <div v-show="activeAboutTab === 'organization'" class="space-y-6">
          <form @submit.prevent="submitOrganization" class="space-y-6">
            <!-- Section Header Card -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-[#E5EAE5] shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
              <div>
                <h3 class="text-base sm:text-lg font-bold text-[#14532D]">Pimpinan & Pengurus Inti Organisasi</h3>
                <p class="text-xs text-[#647067] mt-0.5">
                  Tambahkan atau ubah pimpinan institusi, jabatan, foto profil, dan deskripsi tanggung jawab.
                </p>
              </div>

              <div class="flex items-center gap-2 w-full sm:w-auto">
                <button
                  type="button"
                  @click="addLeader"
                  class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#DCFCE7] text-[#14532D] hover:bg-[#DCFCE7]/80 transition-all flex-1 sm:flex-initial min-h-[44px]"
                >
                  <Plus class="w-4 h-4" />
                  <span>Tambah Pengurus Baru</span>
                </button>

                <button
                  type="submit"
                  :disabled="orgForm.processing"
                  class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all flex-1 sm:flex-initial min-h-[44px]"
                >
                  <Save class="w-4 h-4" />
                  <span>{{ orgForm.processing ? 'Menyimpan...' : 'Simpan Struktur' }}</span>
                </button>
              </div>
            </div>

            <!-- List of Leaders Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
              <div
                v-for="(leader, idx) in orgForm.leaders"
                :key="leader.id || idx"
                class="bg-white p-5 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/40 shadow-xs transition-all relative flex flex-col justify-between"
              >
                <!-- Top Row: Photo + Header -->
                <div class="space-y-4">
                  <div class="flex items-start justify-between gap-3">
                    <!-- Photo Upload Thumbnail -->
                    <div class="flex items-center gap-3">
                      <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-[#F7FAF7] border-2 border-dashed border-[#E5EAE5] overflow-hidden flex items-center justify-center shrink-0">
                        <img
                          v-if="leader.photo"
                          :src="leader.photo"
                          :alt="leader.name || 'Foto Pengurus'"
                          class="w-full h-full object-cover"
                        />
                        <div v-else class="flex flex-col items-center justify-center text-[#647067]">
                          <User class="w-6 h-6 text-[#647067]/60" />
                          <span class="text-[9px] mt-0.5">No Foto</span>
                        </div>

                        <!-- Loading Overlay -->
                        <div
                          v-if="uploadingStates[leader.id]"
                          class="absolute inset-0 bg-black/60 flex items-center justify-center text-white"
                        >
                          <Loader2 class="w-5 h-5 animate-spin" />
                        </div>
                      </div>

                      <div class="space-y-1.5">
                        <div class="flex items-center gap-1.5">
                          <label class="cursor-pointer inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-[11px] font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-colors shadow-2xs">
                            <Upload class="w-3 h-3" />
                            <span>{{ leader.photo ? 'Ganti Foto' : 'Upload Foto' }}</span>
                            <input
                              type="file"
                              accept="image/png,image/jpeg,image/webp,image/jpg"
                              class="hidden"
                              @change="uploadPhotoForItem($event, leader, 'organization', 'photo')"
                            />
                          </label>

                          <button
                            v-if="leader.photo"
                            type="button"
                            @click="removePhotoForItem(leader, 'photo')"
                            class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 transition-colors"
                            title="Hapus Foto"
                          >
                            <Trash2 class="w-3.5 h-3.5" />
                          </button>
                        </div>
                        <span class="text-[10px] text-[#647067] block">Auto Compress WebP</span>
                      </div>
                    </div>

                    <!-- Delete Card Button -->
                    <button
                      type="button"
                      @click="removeLeader(idx)"
                      class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition-colors shrink-0"
                      title="Hapus Pengurus Ini"
                    >
                      <Trash2 class="w-4 h-4" />
                    </button>
                  </div>

                  <!-- Inputs for Leader -->
                  <div class="space-y-3 pt-2">
                    <div>
                      <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                        Nama Lengkap & Gelar
                      </label>
                      <input
                        type="text"
                        v-model="leader.name"
                        placeholder="Contoh: Prof. Dr. Ir. ..."
                        required
                        class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm font-semibold focus:outline-none focus:border-[#22C55E]"
                      />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Jabatan
                        </label>
                        <input
                          type="text"
                          v-model="leader.position"
                          placeholder="Contoh: Koordinator Pusat"
                          required
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>

                      <div>
                        <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                          Kategori / Level
                        </label>
                        <input
                          type="text"
                          v-model="leader.category"
                          placeholder="Pimpinan Eksekutif / Pelindung"
                          class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                        />
                      </div>
                    </div>

                    <div>
                      <label class="block text-[11px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                        Deskripsi / Tanggung Jawab Singkat
                      </label>
                      <textarea
                        v-model="leader.description"
                        rows="2"
                        placeholder="Tugas orkestrasi atau pengarah kebijakan..."
                        class="w-full px-3 py-2 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm focus:outline-none focus:border-[#22C55E]"
                      ></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Save Bar at Bottom -->
            <div class="flex justify-end pt-4 border-t border-[#E5EAE5]">
              <button
                type="submit"
                :disabled="orgForm.processing"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-md transition-all w-full sm:w-auto justify-center"
              >
                <Save class="w-4 h-4" />
                <span>{{ orgForm.processing ? 'Menyimpan...' : 'Simpan Seluruh Struktur Organisasi' }}</span>
              </button>
            </div>
          </form>
        </div>

        <!-- SUB-TAB C: MAHASISWA & TIM FLEKSIBEL PER PROGRAM -->
        <div v-show="activeAboutTab === 'students'" class="space-y-6">
          <form @submit.prevent="submitOrganization" class="space-y-6">
            <!-- Instruction & Filter Box -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-[#E5EAE5] shadow-xs space-y-4">
              <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                  <h3 class="text-base sm:text-lg font-bold text-[#14532D] flex items-center gap-2">
                    <GraduationCap class="w-5 h-5 text-[#22C55E]" />
                    <span>Daftar Anggota Mahasiswa Tiap Program</span>
                  </h3>
                  <p class="text-xs text-[#647067] mt-1 leading-relaxed max-w-2xl">
                    Jumlah mahasiswa untuk setiap program dapat ditambahkan secara bebas dan fleksibel sesuai kebutuhan riset/proyek (misal SINERGI 4 mahasiswa, AJAKAN INDUSTRI 2 mahasiswa, dll.).
                  </p>
                </div>

                <div class="flex items-center gap-2 w-full sm:w-auto">
                  <button
                    type="button"
                    @click="addStudent()"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#DCFCE7] text-[#14532D] hover:bg-[#DCFCE7]/80 transition-all flex-1 sm:flex-initial min-h-[44px]"
                  >
                    <Plus class="w-4 h-4" />
                    <span>Tambah Mahasiswa</span>
                  </button>

                  <button
                    type="submit"
                    :disabled="orgForm.processing"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all flex-1 sm:flex-initial min-h-[44px]"
                  >
                    <Save class="w-4 h-4" />
                    <span>{{ orgForm.processing ? 'Menyimpan...' : 'Simpan Data' }}</span>
                  </button>
                </div>
              </div>

              <!-- Filter Pills for Programs -->
              <div class="pt-3 border-t border-[#E5EAE5] flex items-center gap-2 overflow-x-auto no-scrollbar">
                <button
                  type="button"
                  @click="selectedProgramFilter = 'all'"
                  class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all whitespace-nowrap min-h-[36px] flex items-center gap-1.5"
                  :class="selectedProgramFilter === 'all'
                    ? 'bg-[#14532D] text-white shadow-xs'
                    : 'bg-[#F7FAF7] text-[#647067] hover:bg-emerald-50 hover:text-[#14532D]'"
                >
                  <span>Semua Program</span>
                  <span class="px-1.5 py-0.2 rounded-full text-[10px]" :class="selectedProgramFilter === 'all' ? 'bg-white/20 text-white' : 'bg-[#E5EAE5] text-[#17231C]'">
                    {{ orgForm.students.length }}
                  </span>
                </button>

                <button
                  v-for="prog in programs"
                  :key="prog.id"
                  type="button"
                  @click="selectedProgramFilter = prog.slug"
                  class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all whitespace-nowrap min-h-[36px] flex items-center gap-1.5"
                  :class="selectedProgramFilter === prog.slug
                    ? 'bg-[#14532D] text-white shadow-xs'
                    : 'bg-[#F7FAF7] text-[#647067] hover:bg-emerald-50 hover:text-[#14532D]'"
                >
                  <span>{{ prog.name }}</span>
                  <span class="px-1.5 py-0.2 rounded-full text-[10px]" :class="selectedProgramFilter === prog.slug ? 'bg-white/20 text-white' : 'bg-[#E5EAE5] text-[#17231C]'">
                    {{ getStudentCountByProgram(prog.slug) }}
                  </span>
                </button>
              </div>
            </div>

            <!-- Empty State if no students in selected filter -->
            <div
              v-if="filteredStudents.length === 0"
              class="p-8 text-center bg-white rounded-2xl border border-dashed border-[#E5EAE5] space-y-3"
            >
              <GraduationCap class="w-10 h-10 text-[#647067]/40 mx-auto" />
              <h4 class="text-sm font-bold text-[#14532D]">Belum Ada Mahasiswa di Kategori Ini</h4>
              <p class="text-xs text-[#647067] max-w-sm mx-auto">
                Silakan klik tombol di bawah untuk menambahkan mahasiswa pada program ini.
              </p>
              <button
                type="button"
                @click="addStudent(selectedProgramFilter !== 'all' ? selectedProgramFilter : null)"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-all shadow-xs"
              >
                <Plus class="w-3.5 h-3.5" />
                <span>Tambah Mahasiswa Sekarang</span>
              </button>
            </div>

            <!-- Grid of Students Cards -->
            <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              <div
                v-for="(student, idx) in filteredStudents"
                :key="student.id || idx"
                class="bg-white p-4 sm:p-5 rounded-2xl border border-[#E5EAE5] hover:border-[#22C55E]/40 shadow-xs transition-all relative flex flex-col justify-between space-y-4"
              >
                <!-- Card Header: Photo + Program Badge + Delete -->
                <div class="flex items-start justify-between gap-3">
                  <div class="flex items-center gap-3">
                    <!-- Photo Thumbnail -->
                    <div class="relative w-14 h-14 rounded-2xl bg-[#F7FAF7] border border-[#E5EAE5] overflow-hidden flex items-center justify-center shrink-0">
                      <img
                        v-if="student.photo"
                        :src="student.photo"
                        :alt="student.name || 'Foto Mahasiswa'"
                        class="w-full h-full object-cover"
                      />
                      <div v-else class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-100 to-green-50 text-[#14532D] font-extrabold text-xs">
                        {{ student.name ? student.name.split(' ').map(n => n[0]).slice(0, 2).join('') : 'MHS' }}
                      </div>

                      <!-- Loading Overlay -->
                      <div
                        v-if="uploadingStates[student.id]"
                        class="absolute inset-0 bg-black/60 flex items-center justify-center text-white"
                      >
                        <Loader2 class="w-4 h-4 animate-spin" />
                      </div>
                    </div>

                    <!-- Upload / Change Photo -->
                    <div class="space-y-1">
                      <label class="cursor-pointer inline-flex items-center gap-1 px-2 py-1 rounded-lg text-[10px] font-bold bg-[#F7FAF7] hover:bg-emerald-50 text-[#14532D] border border-[#E5EAE5] transition-colors">
                        <Upload class="w-2.5 h-2.5" />
                        <span>{{ student.photo ? 'Ganti' : 'Foto' }}</span>
                        <input
                          type="file"
                          accept="image/png,image/jpeg,image/webp,image/jpg"
                          class="hidden"
                          @change="uploadPhotoForItem($event, student, 'organization', 'photo')"
                        />
                      </label>
                      <button
                        v-if="student.photo"
                        type="button"
                        @click="removePhotoForItem(student, 'photo')"
                        class="text-[10px] text-rose-500 hover:underline block"
                      >
                        Hapus Foto
                      </button>
                    </div>
                  </div>

                  <!-- Delete Student Button -->
                  <button
                    type="button"
                    @click="removeStudent(orgForm.students.indexOf(student))"
                    class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors shrink-0"
                    title="Hapus Mahasiswa"
                  >
                    <Trash2 class="w-4 h-4" />
                  </button>
                </div>

                <!-- Fields -->
                <div class="space-y-2.5">
                  <div>
                    <label class="block text-[10px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                      Pilihan Program
                    </label>
                    <select
                      v-model="student.program_slug"
                      @change="onStudentProgramChange(student)"
                      class="w-full px-3 py-1.5 rounded-xl border border-[#E5EAE5] text-xs font-bold text-[#14532D] bg-[#F7FAF7] focus:outline-none focus:border-[#22C55E]"
                    >
                      <option v-for="p in programs" :key="p.id" :value="p.slug">
                        Program {{ p.name }}
                      </option>
                    </select>
                  </div>

                  <div>
                    <label class="block text-[10px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                      Nama Mahasiswa
                    </label>
                    <input
                      type="text"
                      v-model="student.name"
                      placeholder="Nama lengkap mahasiswa..."
                      required
                      class="w-full px-3 py-1.5 rounded-xl border border-[#E5EAE5] text-xs sm:text-sm font-semibold focus:outline-none focus:border-[#22C55E]"
                    />
                  </div>

                  <div>
                    <label class="block text-[10px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                      NIM / Jurusan / Fakultas
                    </label>
                    <input
                      type="text"
                      v-model="student.identifier"
                      placeholder="Contoh: NIM. H1A021045 - Teknik Elektro"
                      class="w-full px-3 py-1.5 rounded-xl border border-[#E5EAE5] text-xs focus:outline-none focus:border-[#22C55E]"
                    />
                  </div>

                  <div>
                    <label class="block text-[10px] font-bold text-[#17231C] uppercase tracking-wider mb-1">
                      Peran / Tugas di Program
                    </label>
                    <input
                      type="text"
                      v-model="student.role"
                      placeholder="Contoh: Riset Formulasi Hayati & Mikroba"
                      class="w-full px-3 py-1.5 rounded-xl border border-[#E5EAE5] text-xs focus:outline-none focus:border-[#22C55E]"
                    />
                  </div>
                </div>
              </div>
            </div>

            <!-- Save Bar at Bottom -->
            <div class="flex justify-end pt-4 border-t border-[#E5EAE5]">
              <button
                type="submit"
                :disabled="orgForm.processing"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-md transition-all w-full sm:w-auto justify-center"
              >
                <Save class="w-4 h-4" />
                <span>{{ orgForm.processing ? 'Menyimpan...' : 'Simpan Perubahan Mahasiswa & Organisasi' }}</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
