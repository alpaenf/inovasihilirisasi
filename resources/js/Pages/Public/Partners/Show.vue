<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProductCard from '@/Components/Common/ProductCard.vue';
import ProgramCard from '@/Components/Common/ProgramCard.vue';
import { ArrowLeft, ExternalLink, Mail, Phone, MapPin, Building2 } from 'lucide-vue-next';

defineProps({
  partner: Object,
});
</script>

<template>
  <Head>
    <title>{{ partner.name }} - Mitra Kolaborasi PUSKOR UNSOED</title>
    <meta name="description" :content="partner.short_description || ('Profil kemitraan ' + partner.name + ' bersama PUSKOR UNSOED.')" />
    <meta property="og:title" :content="partner.name + ' - Mitra PUSKOR UNSOED'" />
  </Head>

  <PublicLayout>
    <!-- Breadcrumb & Hero -->
    <section class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-12 sm:py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <Link href="/mitra" class="inline-flex items-center gap-2 text-xs font-bold text-[#647067] hover:text-[#14532D] mb-6 transition-colors">
          <ArrowLeft class="w-4 h-4" />
          <span>Kembali ke Seluruh Mitra</span>
        </Link>

        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
          <div class="w-24 h-24 rounded-2xl bg-white border border-[#E5EAE5] p-3 flex items-center justify-center shrink-0 shadow-sm">
            <img
              v-if="partner.logo && !partner.logo.includes('placeholder')"
              :src="partner.logo"
              :alt="partner.name"
              class="max-w-full max-h-full object-contain"
              @error="$event.target.style.display = 'none'"
            />
            <Building2 class="w-10 h-10 text-[#14532D]/40" />
          </div>

          <div class="space-y-2">
            <div class="flex items-center gap-2">
              <span v-if="partner.category" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-[#DCFCE7] text-[#14532D]">
                {{ partner.category }}
              </span>
              <span class="text-xs text-[#647067]">Mitra Kolaborator</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight">
              {{ partner.name }}
            </h1>
            <p v-if="partner.short_description" class="text-base text-[#647067] max-w-3xl leading-relaxed">
              {{ partner.short_description }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Partner Details Content -->
    <section class="py-16 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
          <!-- Main description -->
          <div class="lg:col-span-8 space-y-6">
            <h2 class="text-2xl font-bold text-[#14532D]">Tentang Mitra & Kolaborasi</h2>
            <div class="prose prose-emerald max-w-none text-[#17231C]/90 text-base leading-relaxed space-y-4">
              <p>{{ partner.description || partner.short_description || 'Mitra kolaborasi aktif dalam riset terapan dan hilirisasi inovasi bersama Universitas Jenderal Soedirman.' }}</p>
            </div>
          </div>

          <!-- Contact & Info Sidebar -->
          <div class="lg:col-span-4">
            <div class="p-6 rounded-2xl bg-[#F7FAF7] border border-[#E5EAE5] space-y-4">
              <h3 class="text-sm font-bold text-[#14532D] uppercase tracking-wider">Informasi Kontak Mitra</h3>
              <ul class="space-y-3 text-sm text-[#17231C]">
                <li v-if="partner.address" class="flex items-start gap-2.5">
                  <MapPin class="w-4 h-4 text-[#22C55E] shrink-0 mt-0.5" />
                  <span class="text-xs text-[#647067]">{{ partner.address }}</span>
                </li>
                <li v-if="partner.email" class="flex items-center gap-2.5">
                  <Mail class="w-4 h-4 text-[#22C55E] shrink-0" />
                  <a :href="`mailto:${partner.email}`" class="text-xs font-medium hover:text-[#22C55E] text-[#14532D]">
                    {{ partner.email }}
                  </a>
                </li>
                <li v-if="partner.phone" class="flex items-center gap-2.5">
                  <Phone class="w-4 h-4 text-[#22C55E] shrink-0" />
                  <span class="text-xs text-[#647067]">{{ partner.phone }}</span>
                </li>
                <li v-if="partner.website" class="flex items-center gap-2.5 pt-2">
                  <ExternalLink class="w-4 h-4 text-[#22C55E] shrink-0" />
                  <a :href="partner.website" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-[#14532D] hover:text-[#22C55E]">
                    Kunjungi Website Resmi
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Program Terkait Mitra -->
    <section v-if="partner.programs && partner.programs.length > 0" class="py-16 bg-[#F7FAF7] border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-extrabold text-[#14532D] mb-8">
          Program Terkait Mitra Ini
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <ProgramCard
            v-for="prog in partner.programs"
            :key="prog.id"
            :program="prog"
          />
        </div>
      </div>
    </section>

    <!-- Produk Terkait Mitra -->
    <section v-if="partner.products && partner.products.length > 0" class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-extrabold text-[#14532D] mb-8">
          Produk Inovasi yang Dikembangkan Bersama
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <ProductCard
            v-for="prod in partner.products"
            :key="prod.id"
            :product="prod"
          />
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

