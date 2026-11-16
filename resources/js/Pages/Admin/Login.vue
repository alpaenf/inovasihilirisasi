<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import { Cpu, Lock, Mail, ArrowRight } from 'lucide-vue-next';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <Head title="Masuk Admin - Inovasi Hilirisasi UNSOED" />

  <div class="min-h-screen bg-[#F7FAF7] flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center space-y-3">
      <div class="inline-flex h-20 w-auto items-center justify-center">
        <img src="/images/logo-puskor.png" alt="Logo Inovasi Hilirisasi UNSOED" class="h-20 w-auto object-contain drop-shadow" />
      </div>
      <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D] tracking-tight">
        Masuk Admin Inovasi Hilirisasi
      </h2>
      <p class="text-xs sm:text-sm text-[#647067]">
        Pusat Koordinasi Pengembangan dan Penerapan Teknologi UNSOED
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-6 sm:px-10 shadow-xl shadow-emerald-950/5 rounded-3xl border border-[#E5EAE5]">
        <form @submit.prevent="submit" class="space-y-5">
          <!-- Email Field -->
          <div>
            <label for="email" class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
              Email Administrator
            </label>
            <div class="relative">
              <Mail class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#647067]" />
              <input
                id="email"
                type="email"
                v-model="form.email"
                required
                autofocus
                placeholder="admin.puskor@unsoed.ac.id"
                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-[#E5EAE5] bg-[#F7FAF7] text-sm text-[#17231C] focus:outline-none focus:border-[#22C55E] focus:bg-white transition-all"
                :class="{ 'border-red-500': form.errors.email }"
              />
            </div>
            <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-600 font-semibold">
              {{ form.errors.email }}
            </p>
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">
              Kata Sandi
            </label>
            <div class="relative">
              <Lock class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#647067]" />
              <input
                id="password"
                type="password"
                v-model="form.password"
                required
                placeholder="••••••••"
                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-[#E5EAE5] bg-[#F7FAF7] text-sm text-[#17231C] focus:outline-none focus:border-[#22C55E] focus:bg-white transition-all"
                :class="{ 'border-red-500': form.errors.password }"
              />
            </div>
            <p v-if="form.errors.password" class="mt-1.5 text-xs text-red-600 font-semibold">
              {{ form.errors.password }}
            </p>
          </div>

          <!-- Remember me checkbox -->
          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
              <input
                type="checkbox"
                v-model="form.remember"
                class="rounded border-[#E5EAE5] text-[#14532D] focus:ring-[#22C55E]"
              />
              <span class="text-xs text-[#647067] font-medium">Ingat saya</span>
            </label>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="form.processing"
            class="w-full py-3 px-4 rounded-xl font-bold text-sm bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm hover:shadow transition-all flex items-center justify-center gap-2 group disabled:opacity-50"
          >
            <span>{{ form.processing ? 'Memproses Masuk...' : 'Masuk ke Dashboard' }}</span>
            <ArrowRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
          </button>
        </form>

        <div class="mt-6 pt-6 border-t border-[#E5EAE5] text-center">
          <a href="/" class="text-xs font-bold text-[#22C55E] hover:text-[#14532D] transition-colors">
            ← Kembali ke Website Publik
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

