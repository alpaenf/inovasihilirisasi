<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { User, Lock, Mail, KeyRound, ShieldCheck, Save, CheckCircle2 } from 'lucide-vue-next';

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
});

// Form 1: Update Name & Email
const profileForm = useForm({
  name: props.user.name,
  email: props.user.email,
});

const submitProfile = () => {
  profileForm.put('/admin/profile', {
    preserveScroll: true,
  });
};

// Form 2: Update Password
const passwordForm = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
});

const submitPassword = () => {
  passwordForm.put('/admin/profile/password', {
    preserveScroll: true,
    onSuccess: () => passwordForm.reset(),
  });
};
</script>

<template>
  <Head title="Profil & Keamanan Akun - Admin Inovasi Hilirisasi" />

  <AdminLayout title="Profil & Keamanan Akun">
    <div class="max-w-4xl space-y-8">
      <!-- Section 1: Informasi Profil & Email -->
      <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-sm space-y-6">
        <div class="flex items-center gap-3.5 pb-4 border-b border-[#E5EAE5]">
          <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center shrink-0">
            <User class="w-5 h-5" />
          </div>
          <div>
            <h3 class="text-base font-bold text-[#14532D]">Informasi Akun Admin</h3>
            <span class="text-xs text-[#647067]">Perbarui nama tampilan dan alamat email login Anda.</span>
          </div>
        </div>

        <form @submit.prevent="submitProfile" class="space-y-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                Nama Lengkap <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <input
                  type="text"
                  v-model="profileForm.name"
                  required
                  placeholder="Contoh: Admin Inovasi"
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E]"
                  :class="{ 'border-red-500': profileForm.errors.name }"
                />
              </div>
              <p v-if="profileForm.errors.name" class="mt-1 text-xs text-red-600 font-medium">
                {{ profileForm.errors.name }}
              </p>
            </div>

            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                Alamat Email <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <input
                  type="email"
                  v-model="profileForm.email"
                  required
                  placeholder="admin@unsoed.ac.id"
                  class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E]"
                  :class="{ 'border-red-500': profileForm.errors.email }"
                />
              </div>
              <p v-if="profileForm.errors.email" class="mt-1 text-xs text-red-600 font-medium">
                {{ profileForm.errors.email }}
              </p>
            </div>
          </div>

          <div class="flex items-center justify-end pt-2">
            <button
              type="submit"
              :disabled="profileForm.processing"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-md shadow-emerald-950/15 transition-all disabled:opacity-50 cursor-pointer"
            >
              <Save class="w-4 h-4" />
              <span>{{ profileForm.processing ? 'Menyimpan...' : 'Simpan Perubahan Profil' }}</span>
            </button>
          </div>
        </form>
      </div>

      <!-- Section 2: Ganti Password -->
      <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-sm space-y-6">
        <div class="flex items-center gap-3.5 pb-4 border-b border-[#E5EAE5]">
          <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0 border border-amber-200/60">
            <KeyRound class="w-5 h-5" />
          </div>
          <div>
            <h3 class="text-base font-bold text-[#14532D]">Ubah Password</h3>
            <span class="text-xs text-[#647067]">Pastikan akun Anda menggunakan password yang aman dan tidak mudah ditebak.</span>
          </div>
        </div>

        <form @submit.prevent="submitPassword" class="space-y-6">
          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
              Password Saat Ini <span class="text-red-500">*</span>
            </label>
            <input
              type="password"
              v-model="passwordForm.current_password"
              required
              autocomplete="current-password"
              placeholder="Masukkan password yang aktif saat ini"
              class="w-full sm:max-w-md px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E]"
              :class="{ 'border-red-500': passwordForm.errors.current_password }"
            />
            <p v-if="passwordForm.errors.current_password" class="mt-1 text-xs text-red-600 font-medium">
              {{ passwordForm.errors.current_password }}
            </p>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2 border-t border-[#E5EAE5]/60">
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                Password Baru <span class="text-red-500">*</span>
              </label>
              <input
                type="password"
                v-model="passwordForm.password"
                required
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E]"
                :class="{ 'border-red-500': passwordForm.errors.password }"
              />
              <p v-if="passwordForm.errors.password" class="mt-1 text-xs text-red-600 font-medium">
                {{ passwordForm.errors.password }}
              </p>
            </div>

            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
                Konfirmasi Password Baru <span class="text-red-500">*</span>
              </label>
              <input
                type="password"
                v-model="passwordForm.password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi password baru"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E] focus:ring-1 focus:ring-[#22C55E]"
                :class="{ 'border-red-500': passwordForm.errors.password_confirmation }"
              />
              <p v-if="passwordForm.errors.password_confirmation" class="mt-1 text-xs text-red-600 font-medium">
                {{ passwordForm.errors.password_confirmation }}
              </p>
            </div>
          </div>

          <div class="flex items-center justify-end pt-2">
            <button
              type="submit"
              :disabled="passwordForm.processing"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-md shadow-emerald-950/15 transition-all disabled:opacity-50 cursor-pointer"
            >
              <ShieldCheck class="w-4 h-4" />
              <span>{{ passwordForm.processing ? 'Memperbarui...' : 'Perbarui Password' }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

