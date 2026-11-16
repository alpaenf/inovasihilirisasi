# DOKUMENTASI PROYEK WEBSITE PUSKOR
### Pusat Koordinasi Pengembangan dan Penerapan Teknologi
### Universitas Jenderal Soedirman (UNSOED)

Selamat datang di repositori dokumentasi resmi untuk pengembangan **Website PUSKOR Universitas Jenderal Soedirman**. Seluruh pedoman teknis, perancangan sistem, basis data, pengujian, serta strategi optimasi mesin pencari (SEO) diorganisasikan secara terstruktur di dalam direktori `docs/` ini.

---

## 📚 INDEKS DOKUMEN (DOCUMENTATION INDEX)

| Dokumen | Deskripsi & Isi Utama | Audiens Utama |
|---|---|---|
| [**1. PRD (Product Requirements Document)**](file:///c:/laragon/www/puskor/docs/prd.md) | Visi produk, profil 4 program utama (SINERGI, AJAKAN INDUSTRI, PMUPUD, DORTEK), arsitektur monolitik, design system (Google Stitch, warna `#14532D`), kebutuhan fungsional & non-fungsional. | Product Owner, Lead Dev, UI/UX Designer |
| [**2. Arsitektur Sistem & Spesifikasi Teknis**](file:///c:/laragon/www/puskor/docs/system-architecture.md) | High-level architecture, request lifecycle Laravel-Inertia-Vue 3, sistem keamanan (CSRF, XSS, upload sanitasi), struktur folder, dan optimasi performa. | Technical Lead, Backend & Frontend Dev |
| [**3. Desain Database & Kamus Data**](file:///c:/laragon/www/puskor/docs/database-schema.md) | Diagram ERD Mermaid, kamus data lengkap seluruh tabel (`programs`, `products`, `partners`, `page_contents`, pivot tables), migrasi Laravel, dan data seeder awal. | Database Engineer, Backend Developer |
| [**4. Spesifikasi Routing & Controller**](file:///c:/laragon/www/puskor/docs/routes-and-controllers.md) | Pemetaan rute publik & admin, kontrak props Inertia.js TypeScript untuk setiap halaman Vue 3, serta aturan validasi FormRequest Laravel. | Backend & Frontend Developer |
| [**5. Panduan Instalasi & Deployment**](file:///c:/laragon/www/puskor/docs/setup-and-deployment.md) | Panduan instalasi lokal di Laragon (Windows), konfigurasi `.env`, template virtual host Nginx Linux, script deployment otomatis, dan strategi backup. | DevOps, System Administrator, Pengembang |
| [**6. Rencana Pengujian (QA & UAT Plan)**](file:///c:/laragon/www/puskor/docs/qa-testing-plan.md) | Matriks skenario pengujian fungsional publik & admin, pengujian keamanan, responsivitas multi-device, serta checklist penerimaan pengguna (UAT) LPPM UNSOED. | QA Engineer, Stakeholder LPPM UNSOED |
| [**7. Panduan Strategi SEO Specialist**](file:///c:/laragon/www/puskor/docs/seo-specialist-strategy.md) | Strategi SEO spesialis institusi riset kampus: riset kata kunci, penanganan SEO dinamis pada Inertia.js (`<Head>`), XML Sitemap dinamis, JSON-LD Schema.org, pelacakan GA4 SPA, dan KPI kuartalan. | SEO Specialist, Content Writer, Marketing |

---

## 🛠️ RINGKASAN STACK TEKNOLOGI

- **Backend:** Laravel 11.x (PHP 8.2+)
- **Frontend:** Vue.js 3 (Composition API)
- **Adapter:** Inertia.js 2.x
- **Basis Data:** MySQL 8.0+
- **Styling:** Tailwind CSS 3.4+
- **Font & Icon:** Plus Jakarta Sans & Lucide Icons
- **Brand Colors:** Putih (`#FFFFFF`), Hijau Tua (`#14532D`), Aksen Hijau (`#22C55E`)
- **Pilar Program:** SINERGI, AJAKAN INDUSTRI, PMUPUD, DORTEK

---

## 🚀 PANDUAN CEPAT MEMULAI (QUICK START)

```bash
# 1. Masuk ke direktori
cd c:\laragon\www\puskor

# 2. Pasang dependensi
composer install
npm install

# 3. Konfigurasi env & database
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

# 4. Jalankan server lokal
npm run dev
php artisan serve
```

---
*Dokumentasi ini dikelola oleh Tim Pengembang & Penerapan Teknologi PUSKOR Universitas Jenderal Soedirman.*

