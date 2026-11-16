<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Save, Settings as SettingsIcon } from 'lucide-vue-next';

const props = defineProps({
  settings: Array,
});

const settingsMap = {};
props.settings?.forEach((st) => {
  settingsMap[st.key] = st.value;
});

const form = useForm({
  settings: settingsMap,
});

const submit = () => {
  form.put('/admin/settings');
};
</script>

<template>
  <Head title="Pengaturan Website - PUSKOR Admin" />

  <AdminLayout title="Pengaturan Website">
    <div class="max-w-4xl space-y-6">
      <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E5EAE5] shadow-sm space-y-6">
        <div class="flex items-center gap-3 pb-4 border-b border-[#E5EAE5]">
          <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
            <SettingsIcon class="w-5 h-5" />
          </div>
          <div>
            <h3 class="text-base font-bold text-[#14532D]">Konfigurasi Umum & Kontak</h3>
            <span class="text-xs text-[#647067]">Informasi kontak, nama instansi, dan footer yang tampil di website.</span>
          </div>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Nama Website</label>
              <input
                type="text"
                v-model="form.settings.site_name"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Tagline</label>
              <input
                type="text"
                v-model="form.settings.site_tagline"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Email Resmi</label>
              <input
                type="email"
                v-model="form.settings.contact_email"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Telepon / WhatsApp</label>
              <input
                type="text"
                v-model="form.settings.contact_phone"
                class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
              />
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Alamat Kantor / Sekretariat</label>
            <textarea
              v-model="form.settings.contact_address"
              rows="3"
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            ></textarea>
          </div>

          <div>
            <label class="block text-xs font-bold text-[#17231C] uppercase tracking-wider mb-2">Teks Hak Cipta (Footer)</label>
            <input
              type="text"
              v-model="form.settings.footer_copyright"
              class="w-full px-4 py-2.5 rounded-xl border border-[#E5EAE5] text-sm focus:outline-none focus:border-[#22C55E]"
            />
          </div>

          <div class="pt-4 border-t border-[#E5EAE5] flex justify-end">
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm"
            >
              <Save class="w-4 h-4" />
              <span>{{ form.processing ? 'Menyimpan...' : 'Simpan Pengaturan' }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

