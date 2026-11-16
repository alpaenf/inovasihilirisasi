# DOKUMEN ARSITEKTUR SISTEM & SPESIFIKASI TEKNIS
# WEBSITE PUSKOR (PUSAT KOORDINASI PENGEMBANGAN DAN PENERAPAN TEKNOLOGI)
### Universitas Jenderal Soedirman

**Versi:** 1.0  
**Status:** Approved  
**Referensi:** `docs/prd.md`  
**Target Pengguna:** Engineering Team, DevOps, Technical Lead

---

## 1. PENDAHULUAN

Dokumen ini mendefinisikan arsitektur sistem, komponen perangkat lunak, aliran data (data flow), standar keamanan, serta pola pengembangan teknis untuk **Website PUSKOR Universitas Jenderal Soedirman**. Dokumen ini menjadi acuan utama implementasi teknis dari spesifikasi yang tertuang pada Product Requirements Document (PRD).

---

## 2. ARSITEKTUR SISTEM TINGKAT TINGGI (HIGH-LEVEL ARCHITECTURE)

Sistem dibangun menggunakan pendekatan **Monolithic Modern Architecture** berbasis **Laravel** dan **Vue.js 3** yang dihubungkan secara mulus menggunakan **Inertia.js**, tanpa perlu membangun REST API publik yang terpisah untuk fungsionalitas internal website.

```mermaid
flowchart TD
    subgraph Client["Klien (Web Browser)"]
        Browser["Desktop / Mobile Browser"]
        VueApp["Vue 3 SPA (Inertia Client)"]
        HeadMeta["Inertia Head (SEO Metadata)"]
    end

    subgraph WebServer["Web Server Layer (Nginx / Apache)"]
        HTTPHandler["Nginx Reverse Proxy & Static Asset Server"]
    end

    subgraph AppServer["Application Layer (Laravel 11.x)"]
        Route["Routing (routes/web.php)"]
        Middleware["Security & Auth Middleware (CSRF, Session, Authenticated)"]
        Controller["Laravel Controllers"]
        FormReq["Form Requests (Validation)"]
        Services["Domain Services (Upload, SEO, Caching)"]
        Eloquent["Eloquent ORM Models"]
    end

    subgraph StorageLayer["Data & File Storage"]
        MySQL[("MySQL 8.0 Database")]
        FileStorage["Laravel Local/Public Storage (Symlink)"]
    end

    Browser -->|HTTP Request / Inertia Visit| HTTPHandler
    HTTPHandler -->|Static Files / CSS / JS / Media| Browser
    HTTPHandler -->|PHP-FPM| Route
    Route --> Middleware
    Middleware --> Controller
    Controller --> FormReq
    Controller --> Services
    Controller --> Eloquent
    Eloquent --> MySQL
    Services --> FileStorage
    Controller -->|Inertia::render(Component, Props)| VueApp
    VueApp --> HeadMeta
```

### 2.1 Alasan Pemilihan Arsitektur
1. **Developer Productivity & Konsistensi**: Inertia.js menghilangkan boilerplate API (serializer, state management rumit, token refresh manual) seraya tetap memberikan pengalaman *Single Page Application (SPA)* yang cepat bagi pengguna.
2. **Server-Side Security**: Autentikasi menggunakan session-based cookies bawaan Laravel yang kebal terhadap serangan XSS token extraction jika dibandingkan dengan penyimpanan JWT di `localStorage`.
3. **Penyimpanan Terpusat**: Satu database MySQL melayani seluruh kebutuhan 4 program (SINERGI, AJAKAN INDUSTRI, PMUPUD, DORTEK), katalog produk, profil mitra, dan CMS halaman.

---

## 3. SPESIFIKASI STACK TEKNOLOGI

| Lapisan (Layer) | Teknologi | Versi | Peran & Tanggung Jawab |
|---|---|---|---|
| **Backend Framework** | Laravel | 11.x | Routing, Middleware, Controller, Eloquent ORM, Session, Auth, Validation, File Storage |
| **Frontend Framework** | Vue.js | 3.4+ (Composition API) | Antarmuka pengguna reaktif, komponen UI modular, State internal halaman |
| **Monolith Adapter** | Inertia.js | 1.x / 2.x | Penghubung Laravel & Vue 3 via protokol XHR Inertia tanpa REST overhead |
| **Database** | MySQL | 8.0+ | Basis data relasional terstruktur dengan foreign keys, indexing, dan ACID transaction |
| **CSS Framework** | Tailwind CSS | 3.4+ | Utility-first CSS styling, responsivitas grid/flex, sistem desain token |
| **Icons** | Lucide Icons (lucide-vue-next) | Latest | Sistem ikonografi outline konsisten |
| **Typography** | Plus Jakarta Sans | Google Fonts / Self-hosted | Tipografi utama seluruh web dan dashboard |
| **Build Tool** | Vite | 5.x | HMR (Hot Module Replacement) cepat dan asset bundling teroptimasi |

---

## 4. SIKLUS HIDUP REQUEST (REQUEST LIFECYCLE)

### 4.1 First Page Load (Initial Visit)
1. Browser mengirim permintaan HTTP GET pertama (misal: `GET /produk`).
2. Nginx meneruskan request ke PHP-FPM Laravel `public/index.php`.
3. Middleware Laravel memproses session, CSRF cookie, dan state pengguna.
4. `ProductController@index` mengambil data produk dari MySQL melalui Eloquent dengan pagination server-side.
5. Laravel mengeksekusi `Inertia::render('Public/Products/Index', $props)`.
6. Laravel merender view root Blade (`app.blade.php`), menyuntikkan payload JSON awal di atribut `data-page`, serta merender meta tag SEO server-side di `<head>`.
7. Browser mem-parsing HTML, menjalankan bundle JavaScript Vue 3, dan me-mount aplikasi Inertia ke DOM.

### 4.2 Subsequent Navigation (Client-side Visit)
1. Pengguna mengklik tautan `<Link href="/produk/traktor-rotari">`.
2. Inertia mencegah browser full-reload dan mengirimkan request AJAX dengan header khusus `X-Inertia: true`.
3. Laravel mendeteksi header Inertia dan hanya mengembalikan response JSON berisi komponen tujuan dan props data baru.
4. Vue 3 menukar komponen halaman secara reaktif dan memperbarui `<title>` serta `<meta>` melalui komponen `<Head>`.

---

## 5. STRUKTUR DIREKTORI PROYEK

Struktur folder terstandarisasi untuk memisahkan domain publik dan administrasi:

```text
puskor/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Public/
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── ProgramController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── PartnerController.php
│   │   │   │   └── PageController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── ProgramManagementController.php
│   │   │       ├── ProductManagementController.php
│   │   │       ├── PartnerManagementController.php
│   │   │       └── SettingController.php
│   │   ├── Middleware/
│   │   │   └── HandleInertiaRequests.php
│   │   └── Requests/
│   │       ├── ProgramStoreRequest.php
│   │       ├── ProductStoreRequest.php
│   │       └── PartnerStoreRequest.php
│   ├── Models/
│   │   ├── Program.php
│   │   ├── Product.php
│   │   ├── Partner.php
│   │   ├── PageContent.php
│   │   ├── Setting.php
│   │   └── User.php
│   └── Services/
│       ├── FileUploadService.php
│       └── SeoMetadataService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── js/
│   │   ├── app.js
│   │   ├── Components/
│   │   │   ├── Common/          # Button, Modal, Card, Badge, Pagination
│   │   │   ├── Public/          # Navbar, Footer, Hero, SearchFilter
│   │   │   └── Admin/           # Sidebar, Topbar, DataTable, ImageUploader
│   │   ├── Layouts/
│   │   │   ├── PublicLayout.vue # Layout utama website publik
│   │   │   └── AdminLayout.vue  # Layout dashboard admin
│   │   └── Pages/
│   │       ├── Public/
│   │       │   ├── Home.vue
│   │       │   ├── Programs/
│   │       │   │   ├── Index.vue
│   │       │   │   └── Show.vue
│   │       │   ├── Products/
│   │       │   │   ├── Index.vue
│   │       │   │   └── Show.vue
│   │       │   ├── Partners/
│   │       │   │   ├── Index.vue
│   │       │   │   └── Show.vue
│   │       │   └── About.vue
│   │       └── Admin/
│   │           ├── Dashboard.vue
│   │           ├── Programs/
│   │           ├── Products/
│   │           ├── Partners/
│   │           └── Settings/
│   └── css/
│       └── app.css              # Konfigurasi Tailwind & Font Plus Jakarta Sans
├── routes/
│   ├── web.php                  # Seluruh routing aplikasi
│   └── auth.php                 # Routing autentikasi Breeze/Fortify
└── storage/
    └── app/public/              # Upload folder publik (symlinked ke public/storage)
```

---

## 6. SISTEM KEAMANAN (SECURITY ARCHITECTURE)

1. **Proteksi Autentikasi Admin**:
   - Area `/admin/*` diproteksi ketat menggunakan middleware `auth` Laravel.
   - Menggunakan hashing kata sandi `Bcrypt` atau `Argon2id`.
   - Rate limiting pada rute login untuk mencegah serangan brute-force (`throttle:6,1`).
2. **Proteksi Cross-Site Request Forgery (CSRF)**:
   - Inertia.js secara otomatis menyertakan header token `X-XSRF-TOKEN` pada setiap request POST, PUT, PATCH, dan DELETE.
3. **Validasi & Sanitasi Data**:
   - Seluruh mutasi data wajib melewati kelas `FormRequest` terdedikasi.
   - Pencegahan XSS: Vue 3 secara default me-render data sebagai safe-string text. Konten WYSIWYG (rich text) harus disanitasi menggunakan library HTMLPurifier sebelum disimpan atau dirender dengan `v-html`.
4. **Penyimpanan Berkas yang Aman (File Upload Security)**:
   - Validasi ketat format MIME type gambar: `jpeg, png, webp, jpg`.
   - Ukuran maksimal gambar dibatasi (misal: max 2MB per gambar).
   - Berkas di-rename secara acak menggunakan UUID / Hash unik (`$file->hashName()`) untuk mencegah eksekusi arbitrary script via filename traversal.
5. **Database Security**:
   - Eloquent ORM menggunakan PDO prepared statements secara default untuk mencegah SQL Injection.

---

## 7. STRATEGI FILE STORAGE & MEDIA MANAGEMENT

- Penyimpanan aset dinamis menggunakan disk `'public'` bawaan Laravel (`storage/app/public/`).
- Perintah CLI `php artisan storage:link` mengekspos folder tersebut ke `public/storage/`.
- Struktur folder media:
  - `storage/app/public/programs/logos/`
  - `storage/app/public/programs/banners/`
  - `storage/app/public/products/main/`
  - `storage/app/public/products/gallery/`
  - `storage/app/public/partners/logos/`
  - `storage/app/public/pages/banners/`
- Helper terpusat mengembalikan URL publik aman dengan fallback gambar placeholder institusi jika berkas tidak ditemukan.

---

## 8. STRATEGI PERFORMA & OPTIMASI

1. **Pagination Server-Side**:
   - Katalog produk dan mitra menggunakan Eloquent `paginate(12)` server-side.
   - Mencegah loading ribuan rekaman sekaligus ke memory browser.
2. **Eager Loading Relasi**:
   - Menggunakan `with(['program', 'partners'])` untuk menyelesaikan masalah *N+1 query problem*.
3. **Inertia Partial Reloads**:
   - Pencarian dan filter produk hanya meminta prop data tabel tanpa perlu mengirim ulang data layout atau menu navigasi.
4. **Optimasi Aset Frontend**:
   - Vite Code Splitting otomatis memecah bundle JavaScript per-halaman.
   - Pemanfaatan cache browser untuk static bundle via hashing file (`app.[hash].js`).
5. **Database Indexing**:
   - Indeks dibuat pada kolom `slug`, `status`, `program_id`, dan kolom pencarian `name`.

