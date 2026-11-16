<script setup>
import { Link } from '@inertiajs/vue3';
import { Cpu, Mail, MapPin, Phone, ArrowUpRight } from 'lucide-vue-next';
</script>

<template>
  <footer class="bg-[#14532D] text-white pt-16 pb-12 border-t border-[#14532D]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-white/10">
        <!-- Col 1: Identity & Description (2 cols on lg) -->
        <div class="lg:col-span-2 space-y-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/20">
              <Cpu class="w-5 h-5 text-[#22C55E]" />
            </div>
            <div>
              <span class="font-extrabold text-xl tracking-tight text-white block leading-none">PUSKOR</span>
              <span class="text-xs font-semibold text-emerald-200 uppercase tracking-wider block mt-1">
                Universitas Jenderal Soedirman
              </span>
            </div>
          </div>
          <p class="text-sm text-emerald-100/80 leading-relaxed max-w-sm">
            Pusat Koordinasi Pengembangan dan Penerapan Teknologi LPPM UNSOED. Mendorong hilirisasi riset, inovasi tepat guna, dan kemitraan strategis dengan industri serta masyarakat.
          </p>
          <div class="pt-2">
            <a
              href="https://unsoed.ac.id"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#22C55E] hover:text-emerald-300 transition-colors"
            >
              <span>Portal Resmi unsoed.ac.id</span>
              <ArrowUpRight class="w-3.5 h-3.5" />
            </a>
          </div>
        </div>

        <!-- Col 2: 4 Program Utama -->
        <div>
          <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">4 Program Utama</h4>
          <ul class="space-y-2.5 text-sm text-emerald-100/80">
            <li>
              <Link href="/program/sinergi" class="hover:text-white transition-colors">SINERGI</Link>
            </li>
            <li>
              <Link href="/program/ajakan-industri" class="hover:text-white transition-colors">AJAKAN INDUSTRI</Link>
            </li>
            <li>
              <Link href="/program/pmupud" class="hover:text-white transition-colors">PMUPUD</Link>
            </li>
            <li>
              <Link href="/program/dortek" class="hover:text-white transition-colors">DORTEK</Link>
            </li>
          </ul>
        </div>

        <!-- Col 3: Navigasi Cepat -->
        <div>
          <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Navigasi</h4>
          <ul class="space-y-2.5 text-sm text-emerald-100/80">
            <li>
              <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
            </li>
            <li>
              <Link href="/produk" class="hover:text-white transition-colors">Katalog Produk</Link>
            </li>
            <li>
              <Link href="/mitra" class="hover:text-white transition-colors">Mitra Kolaborasi</Link>
            </li>
            <li>
              <Link href="/tentang-puskor" class="hover:text-white transition-colors">Tentang PUSKOR</Link>
            </li>
            <li>
              <Link href="/login" class="text-emerald-200/60 hover:text-white transition-colors">Login Admin</Link>
            </li>
          </ul>
        </div>

        <!-- Col 4: Kontak & Alamat -->
        <div>
          <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Kontak Kami</h4>
          <ul class="space-y-3 text-sm text-emerald-100/80">
            <li class="flex items-start gap-2.5">
              <MapPin class="w-4 h-4 text-[#22C55E] shrink-0 mt-0.5" />
              <span class="text-xs leading-relaxed">
                Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto 53122
              </span>
            </li>
            <li class="flex items-center gap-2.5">
              <Mail class="w-4 h-4 text-[#22C55E] shrink-0" />
              <a href="mailto:p3t.lppm@unsoed.ac.id" class="text-xs hover:text-white transition-colors">
                p3t.lppm@unsoed.ac.id
              </a>
            </li>
            <li class="flex items-center gap-2.5">
              <Phone class="w-4 h-4 text-[#22C55E] shrink-0" />
              <span class="text-xs">+62 281 635292</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-emerald-100/60 gap-4">
        <p>© 2026 PUSKOR Universitas Jenderal Soedirman. Hak Cipta Dilindungi.</p>
        <p class="flex items-center gap-2">
          <span>Pusat Koordinasi Pengembangan dan Penerapan Teknologi</span>
        </p>
      </div>
    </div>
  </footer>
</template>

