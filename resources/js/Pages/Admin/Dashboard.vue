<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {
  Layers,
  Box,
  Building2,
  CheckCircle2,
  Plus,
  ArrowRight,
  TrendingUp,
  Cpu
} from 'lucide-vue-next';

defineProps({
  stats: Object,
  recentProducts: Array,
  recentPartners: Array,
  programs: Array,
});
</script>

<template>
  <Head title="Dashboard Overview - PUSKOR Admin" />

  <AdminLayout title="Dashboard Overview">
    <div class="space-y-8">
      <!-- Quick Action Bar -->
      <div class="flex flex-wrap items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-[#E5EAE5]">
        <div>
          <h2 class="text-lg font-bold text-[#14532D]">Selamat Datang di Portal Admin PUSKOR</h2>
          <p class="text-xs sm:text-sm text-[#647067]">Kelola seluruh program, produk inovasi, dan mitra kolaborasi dalam satu kendali terpusat.</p>
        </div>
        <div class="flex items-center gap-3">
          <Link
            href="/admin/products/create"
            class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold bg-[#14532D] text-white hover:bg-[#14532D]/90 shadow-sm transition-all"
          >
            <Plus class="w-4 h-4" />
            <span>Tambah Produk</span>
          </Link>
          <Link
            href="/admin/partners/create"
            class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold bg-white text-[#14532D] border border-[#E5EAE5] hover:bg-[#F7FAF7] transition-all"
          >
            <Plus class="w-4 h-4" />
            <span>Tambah Mitra</span>
          </Link>
        </div>
      </div>

      <!-- Stats Metrics Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold text-[#647067] uppercase tracking-wider">Total Program</span>
            <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
              <Layers class="w-5 h-5" />
            </div>
          </div>
          <span class="text-3xl font-extrabold text-[#14532D]">{{ stats.total_programs }}</span>
          <span class="text-xs text-[#647067] block mt-1">4 Pilar Terintegrasi</span>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold text-[#647067] uppercase tracking-wider">Total Produk</span>
            <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
              <Box class="w-5 h-5" />
            </div>
          </div>
          <span class="text-3xl font-extrabold text-[#14532D]">{{ stats.total_products }}</span>
          <span class="text-xs text-[#22C55E] font-semibold block mt-1">{{ stats.published_products }} Dipublikasikan</span>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold text-[#647067] uppercase tracking-wider">Mitra Kolaborasi</span>
            <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
              <Building2 class="w-5 h-5" />
            </div>
          </div>
          <span class="text-3xl font-extrabold text-[#14532D]">{{ stats.total_partners }}</span>
          <span class="text-xs text-[#647067] block mt-1">BUMN, Industri & UMKM</span>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-[#E5EAE5] shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold text-[#647067] uppercase tracking-wider">Produk Unggulan</span>
            <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#14532D] flex items-center justify-center">
              <TrendingUp class="w-5 h-5" />
            </div>
          </div>
          <span class="text-3xl font-extrabold text-[#14532D]">{{ stats.featured_products }}</span>
          <span class="text-xs text-[#647067] block mt-1">Tampil di Beranda</span>
        </div>
      </div>

      <!-- Two Column Layout: Programs Overview & Recent Products -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- 4 Programs Overview (Col 5) -->
        <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-[#E5EAE5] space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-[#14532D]">4 Program Utama</h3>
            <Link href="/admin/programs" class="text-xs font-bold text-[#22C55E] hover:underline">Kelola</Link>
          </div>
          <div class="space-y-3">
            <div
              v-for="prog in programs"
              :key="prog.id"
              class="p-3.5 rounded-xl bg-[#F7FAF7] border border-[#E5EAE5]/60 flex items-center justify-between"
            >
              <div>
                <span class="text-sm font-bold text-[#14532D] block">{{ prog.name }}</span>
                <span class="text-xs text-[#647067]">{{ prog.products_count }} Produk Terkait</span>
              </div>
              <span class="text-xs font-bold px-2 py-0.5 rounded bg-[#DCFCE7] text-[#14532D]">
                {{ prog.status }}
              </span>
            </div>
          </div>
        </div>

        <!-- Recent Products (Col 7) -->
        <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-[#E5EAE5] space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-[#14532D]">Produk Terbaru Ditambahkan</h3>
            <Link href="/admin/products" class="text-xs font-bold text-[#22C55E] hover:underline">Lihat Semua</Link>
          </div>
          <div class="divide-y divide-[#E5EAE5]">
            <div
              v-for="prod in recentProducts"
              :key="prod.id"
              class="py-3 flex items-center justify-between"
            >
              <div>
                <span class="text-sm font-bold text-[#17231C] block hover:text-[#22C55E] transition-colors">
                  {{ prod.name }}
                </span>
                <span class="text-xs text-[#647067]">
                  {{ prod.program ? prod.program.name : 'Tanpa Program' }}
                </span>
              </div>
              <Link
                :href="`/admin/products/${prod.id}/edit`"
                class="text-xs font-bold text-[#14532D] hover:text-[#22C55E] px-3 py-1.5 rounded-lg border border-[#E5EAE5] hover:bg-[#F7FAF7]"
              >
                Edit
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

