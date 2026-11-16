<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProductCard from '@/Components/Common/ProductCard.vue';
import { ArrowLeft, ExternalLink, Cpu, CheckCircle2, Building2, Image } from 'lucide-vue-next';

const props = defineProps({
  product: Object,
  relatedProducts: Array,
});

const jsonLd = {
  '@context': 'https://schema.org',
  '@type': 'Product',
  'name': props.product.name,
  'description': props.product.short_description,
  'brand': {
    '@type': 'Brand',
    'name': 'PUSKOR UNSOED',
  },
  'manufacturer': {
    '@type': 'Organization',
    'name': 'Universitas Jenderal Soedirman',
  },
};
</script>

<template>
  <Head>
    <title>{{ product.name }} - Inovasi PUSKOR UNSOED</title>
    <meta name="description" :content="product.short_description" />
    <meta property="og:title" :content="product.name + ' - PUSKOR UNSOED'" />
    <meta property="og:description" :content="product.short_description" />
    <meta property="og:image" :content="product.main_image" />
    <meta property="og:type" content="product" />
    <component :is="'script'" type="application/ld+json">
      {{ JSON.stringify(jsonLd) }}
    </component>
  </Head>

  <PublicLayout>
    <!-- Breadcrumb & Top Bar -->
    <div class="bg-[#F7FAF7] border-b border-[#E5EAE5] py-4">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-xs font-semibold text-[#647067]">
          <Link href="/produk" class="hover:text-[#14532D] transition-colors">Katalog Produk</Link>
          <span>/</span>
          <Link :href="`/program/${product.program.slug}`" class="hover:text-[#14532D] transition-colors">
            Program {{ product.program.name }}
          </Link>
          <span>/</span>
          <span class="text-[#14532D] font-bold truncate max-w-xs">{{ product.name }}</span>
        </div>
      </div>
    </div>

    <!-- Product Details Section -->
    <section class="py-12 sm:py-16 bg-white border-b border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
          <!-- Left Column: Main Media Gallery -->
          <div class="lg:col-span-6 space-y-4">
            <div class="aspect-[4/3] rounded-3xl bg-[#F7FAF7] border border-[#E5EAE5] overflow-hidden relative flex items-center justify-center shadow-sm">
              <img
                v-if="product.main_image && !product.main_image.includes('placeholder')"
                :src="product.main_image"
                :alt="product.name"
                class="w-full h-full object-cover"
                @error="$event.target.style.display = 'none'"
              />
              <div class="w-full h-full flex flex-col items-center justify-center bg-emerald-50/50 p-6 text-center">
                <Cpu class="w-16 h-16 text-[#14532D]/30 mb-3" />
                <span class="text-xs font-bold text-[#14532D]/60 tracking-wider">DOKUMENTASI PRODUK PUSKOR</span>
              </div>
            </div>

            <!-- Galleries preview if exists -->
            <div v-if="product.galleries && product.galleries.length > 0" class="grid grid-cols-4 gap-3">
              <div
                v-for="(gal, idx) in product.galleries"
                :key="idx"
                class="aspect-square rounded-xl border border-[#E5EAE5] overflow-hidden bg-[#F7FAF7]"
              >
                <img :src="gal.image_path" :alt="gal.caption || product.name" class="w-full h-full object-cover" />
              </div>
            </div>
          </div>

          <!-- Right Column: Product Info & Metadata -->
          <div class="lg:col-span-6 space-y-6">
            <!-- Program Badge -->
            <div class="flex items-center gap-3">
              <Link
                :href="`/program/${product.program.slug}`"
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-[#DCFCE7] text-[#14532D] hover:bg-[#14532D] hover:text-white transition-colors"
              >
                <span>Program {{ product.program.name }}</span>
              </Link>
              <span class="text-xs text-[#647067]">Inovasi Terapan</span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#14532D] tracking-tight leading-tight">
              {{ product.name }}
            </h1>

            <p class="text-base sm:text-lg text-[#647067] leading-relaxed">
              {{ product.short_description }}
            </p>

            <!-- Partners In Project -->
            <div v-if="product.partners && product.partners.length > 0" class="p-4 rounded-2xl bg-[#F7FAF7] border border-[#E5EAE5] space-y-2">
              <span class="text-xs font-bold text-[#647067] uppercase tracking-wider block">Mitra Kolaborasi Inovasi:</span>
              <div class="flex flex-wrap gap-2">
                <Link
                  v-for="pt in product.partners"
                  :key="pt.id"
                  :href="`/mitra/${pt.slug}`"
                  class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border border-[#E5EAE5] hover:border-[#22C55E] text-xs font-semibold text-[#14532D] transition-colors"
                >
                  <Building2 class="w-3.5 h-3.5 text-[#22C55E]" />
                  <span>{{ pt.name }}</span>
                </Link>
              </div>
            </div>

            <!-- External Link Button if available -->
            <div v-if="product.external_url" class="pt-2">
              <a
                :href="product.external_url"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all"
              >
                <span>Akses Tautan / Dokumen Terkait</span>
                <ExternalLink class="w-4 h-4" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Deep Description & Benefits Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
          <!-- Left: Full Description -->
          <div class="lg:col-span-7 space-y-6">
            <h2 class="text-2xl font-bold text-[#14532D]">Deskripsi & Latar Belakang Inovasi</h2>
            <div class="prose prose-emerald text-[#17231C]/90 text-base leading-relaxed space-y-4">
              <p>{{ product.description }}</p>
            </div>
          </div>

          <!-- Right: Benefits & Functions -->
          <div class="lg:col-span-5 space-y-6">
            <div class="p-8 rounded-3xl bg-[#F7FAF7] border border-[#E5EAE5] space-y-4">
              <h3 class="text-xl font-bold text-[#14532D] flex items-center gap-2">
                <CheckCircle2 class="w-5 h-5 text-[#22C55E]" />
                <span>Fungsi & Keunggulan Produk</span>
              </h3>
              <div v-if="product.benefits" class="text-sm text-[#17231C]/90 leading-relaxed whitespace-pre-line space-y-2">
                {{ product.benefits }}
              </div>
              <div v-else class="text-sm text-[#647067]">
                Teknologi ramah lingkungan yang dirancang khusus untuk memecahkan persoalan riil di lapangan.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Related Products -->
    <section v-if="relatedProducts && relatedProducts.length > 0" class="py-16 bg-[#F7FAF7] border-t border-[#E5EAE5]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <h2 class="text-2xl font-extrabold text-[#14532D]">
            Inovasi Lainnya dari Program {{ product.program.name }}
          </h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          <ProductCard
            v-for="rel in relatedProducts"
            :key="rel.id"
            :product="rel"
          />
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

