<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProductCard from '@/Components/Common/ProductCard.vue';
import PartnerCard from '@/Components/Common/PartnerCard.vue';
import { ArrowLeft, Layers, Factory, Store, Sparkles, Building2, Box } from 'lucide-vue-next';

const props = defineProps({
  program: Object,
});

const getIcon = (slug) => {
  switch (slug) {
    case 'sinergi':
      return Layers;
    case 'ajakan-industri':
      return Factory;
    case 'pmupud':
      return Store;
    case 'dortek':
    default:
      return Sparkles;
  }
};
</script>

<template>
  <Head>
    <title>{{ program.name }} - Program Inovasi PUSKOR UNSOED</title>
    <meta name="description" :content="program.short_description" />
    <meta property="og:title" :content="program.name + ' - PUSKOR UNSOED'" />
    <meta property="og:description" :content="program.short_description" />
  </Head>

  <PublicLayout>
    <!-- Breadcrumb & Hero -->
    <section class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-12 sm:py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <Link href="/program" class="inline-flex items-center gap-2 text-xs font-bold text-[#647067] hover:text-[#14532D] mb-6 transition-colors">
          <ArrowLeft class="w-4 h-4" />
          <span>Kembali ke Seluruh Program</span>
        </Link>

        <div class="max-w-4xl space-y-4">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#DCFCE7] text-[#14532D] text-xs font-bold uppercase tracking-wider">
            <component :is="getIcon(program.slug)" class="w-4 h-4 text-[#22C55E]" />
            <span>Program {{ program.code || 'PUSKOR' }}</span>
          </div>

          <h1 class="text-3xl sm:text-5xl font-extrabold text-[#14532D] tracking-tight">
            Program {{ program.name }}
          </h1>

          <p class="text-base sm:text-xl text-[#647067] leading-relaxed font-normal">
            {{ program.short_description }}
          </p>
        </div>
      </div>
    </section>

    <!-- Program Overview & Detail Content -->
    <section class="py-16 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
          <!-- Main description -->
          <div class="lg:col-span-8 space-y-6">
            <h2 class="text-2xl font-bold text-[#14532D]">Tentang Program & Tujuan</h2>
            <div class="prose prose-emerald max-w-none text-[#17231C]/90 text-base leading-relaxed space-y-4">
              <p>{{ program.description }}</p>
            </div>
          </div>

          <!-- Side Information card -->
          <div class="lg:col-span-4">
            <div class="p-6 rounded-2xl bg-[#F7FAF7] border border-[#E5EAE5] space-y-4">
              <h3 class="text-sm font-bold text-[#14532D] uppercase tracking-wider">Ringkasan Program</h3>
              <div class="space-y-3 text-sm">
                <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]">
                  <span class="text-[#647067]">Unit Pengelola</span>
                  <span class="font-semibold text-[#14532D]">PUSKOR LPPM UNSOED</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]">
                  <span class="text-[#647067]">Jumlah Produk Terkait</span>
                  <span class="font-bold text-[#14532D]">{{ program.products?.length || 0 }} Produk</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-[#E5EAE5]">
                  <span class="text-[#647067]">Mitra Terhubung</span>
                  <span class="font-bold text-[#14532D]">{{ program.partners?.length || 0 }} Mitra</span>
                </div>
              </div>
              <div class="pt-3">
                <a
                  href="mailto:p3t.lppm@unsoed.ac.id"
                  class="block w-full py-2.5 px-4 rounded-xl text-center text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 transition-colors"
                >
                  Ajukan Kolaborasi Program
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Produk Terkait -->
    <section class="py-16 bg-[#F7FAF7]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
          <div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D]">
              Produk Inovasi Terkait Program
            </h2>
            <p class="text-sm text-[#647067] mt-1">
              Daftar teknologi dan produk terapan yang dihasilkan melalui program {{ program.name }}.
            </p>
          </div>
        </div>

        <div v-if="program.products && program.products.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          <ProductCard
            v-for="prod in program.products"
            :key="prod.id"
            :product="{ ...prod, program: { name: program.name, slug: program.slug } }"
          />
        </div>
        <div v-else class="text-center py-12 bg-white rounded-2xl border border-[#E5EAE5] text-[#647067] text-sm">
          Belum ada produk yang dipublikasikan pada program ini.
        </div>
      </div>
    </section>

    <!-- Mitra Terkait -->
    <section v-if="program.partners && program.partners.length > 0" class="py-16 bg-white border-t border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <h2 class="text-2xl sm:text-3xl font-extrabold text-[#14532D]">
            Mitra Kolaborator Program
          </h2>
          <p class="text-sm text-[#647067] mt-1">
            Instansi dan industri yang bekerjasama dalam pelaksanaan program {{ program.name }}.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <PartnerCard
            v-for="partner in program.partners"
            :key="partner.id"
            :partner="partner"
          />
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

