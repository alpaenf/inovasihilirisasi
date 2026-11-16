# PRODUCT REQUIREMENTS DOCUMENT (PRD)
# WEBSITE PUSKOR
### Pusat Koordinasi Pengembangan dan Penerapan Teknologi
Universitas Jenderal Soedirman

**Versi:** 1.1  
**Platform:** Web Application  
**Design Tool:** Google Stitch  
**Design Direction:** Modern, Professional, Minimalist, Aesthetic

---

# 1. TECHNOLOGY STACK

Pengembangan website PUSKOR menggunakan teknologi berikut:

| Teknologi | Penggunaan |
|---|---|
| Laravel | Backend framework dan application logic |
| Vue.js 3 | Frontend framework |
| Inertia.js | Integrasi Laravel dengan Vue.js |
| MySQL | Relational database |
| Plus Jakarta Sans | Typography |
| Tailwind CSS | Styling dan responsive layout |
| Lucide Icons | Icon system |

## 1.1 Architecture

Gunakan pendekatan **Monolithic Application Architecture** dengan Laravel sebagai backend utama dan Vue.js sebagai frontend.

Inertia.js digunakan sebagai penghubung antara Laravel dan Vue.js sehingga tidak memerlukan REST API terpisah untuk komunikasi internal antara frontend dan backend.

Struktur teknologi:

- Laravel menangani routing, controller, business logic, autentikasi, validasi, dan database interaction.
- Vue.js 3 menangani rendering antarmuka dan interaksi pengguna.
- Inertia.js menghubungkan Laravel dengan komponen Vue.js.
- MySQL menyimpan data program, produk, mitra, dan konten website.
- Tailwind CSS digunakan untuk membangun desain UI yang konsisten dan responsif.

## 1.2 Development Requirements

- Gunakan Laravel sebagai fondasi aplikasi.
- Gunakan Vue.js 3 Composition API.
- Gunakan Inertia.js untuk komunikasi frontend dan backend.
- Gunakan MySQL sebagai database utama.
- Gunakan Tailwind CSS untuk styling.
- Gunakan komponen Vue.js yang reusable.
- Pisahkan komponen berdasarkan fungsi dan tanggung jawab.
- Terapkan validasi pada seluruh form.
- Gunakan Laravel Eloquent ORM untuk pengelolaan data.
- Terapkan autentikasi pada dashboard admin.
- Gunakan Laravel Storage untuk pengelolaan gambar dan file.
- Terapkan pagination server-side untuk katalog produk dan mitra.

## 1.3 Recommended Project Structure

```text
puskor/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Requests/
│   ├── Models/
│   └── Services/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── js/
│   │   ├── Components/
│   │   ├── Layouts/
│   │   │   ├── PublicLayout.vue
│   │   │   └── AdminLayout.vue
│   │   └── Pages/
│   │       ├── Public/
│   │       │   ├── Home.vue
│   │       │   ├── Programs/
│   │       │   ├── Products/
│   │       │   ├── Partners/
│   │       │   └── About.vue
│   │       └── Admin/
│   │           ├── Dashboard.vue
│   │           ├── Programs/
│   │           ├── Products/
│   │           ├── Partners/
│   │           └── Settings/
│   └── css/
├── routes/
│   └── web.php
└── public/
```

---

# 2. DESIGN SYSTEM

## 2.1 Design Direction

Website harus memiliki karakter visual modern, profesional, minimalis, aesthetic, dan clean.

## 2.2 Color Palette

| Penggunaan | Warna | Hex |
|---|---|---|
| Primary Background | White | #FFFFFF |
| Secondary Color | Dark Green | #14532D |
| Primary Text | Deep Charcoal | #17231C |
| Secondary Text | Muted Gray | #647067 |
| Accent Green | Green | #22C55E |
| Soft Green | Light Green | #DCFCE7 |
| Section Background | Off White | #F7FAF7 |
| Border | Light Gray | #E5EAE5 |

Putih menjadi warna dominan dan hijau tua menjadi identitas visual utama.

## 2.3 Typography

Gunakan **Plus Jakarta Sans** untuk seluruh elemen website.

- Hero Heading: 48–60 px.
- Section Heading: 32–40 px.
- Page Heading: 36–44 px.
- Card Heading: 18–22 px.
- Body Text: 14–16 px.
- Navigation: 14–15 px.
- Caption: 12–13 px.

## 2.4 UI Components

- Rounded card radius 12–20 px.
- Button radius 8–12 px.
- Border tipis dan shadow lembut.
- Lucide Icons.
- Whitespace yang cukup.
- Hover transition 200–300 ms.
- Responsive grid dan layout.

---

# 3. PRODUCT OVERVIEW

Website PUSKOR merupakan platform informasi terpusat untuk menampilkan profil, program, produk, dan mitra kolaborasi Pusat Koordinasi Pengembangan dan Penerapan Teknologi Universitas Jenderal Soedirman.

Empat program utama:

1. SINERGI.
2. AJAKAN INDUSTRI.
3. PMUPUD.
4. DORTEK.

Seluruh program, produk, dan mitra dikelola melalui satu dashboard admin dan satu database MySQL.

**Konsep utama:**
- Satu website.
- Satu halaman utama.
- Empat program dalam satu platform.
- Satu katalog seluruh produk.
- Profil setiap mitra.
- Satu dashboard admin terpusat.

---

# 4. PUBLIC WEBSITE

## 4.1 Struktur Navigasi

Menu utama:
- Beranda.
- Program.
- Produk.
- Mitra.
- Tentang PUSKOR.

CTA: Hubungi Kami.

## 4.2 Halaman Beranda

### Navbar
- Logo dan identitas PUSKOR.
- Identitas Universitas Jenderal Soedirman.
- Menu navigasi.
- CTA Hubungi Kami.
- Sticky navbar.

### Hero Section

Eyebrow: UNIVERSITAS JENDERAL SOEDIRMAN

Headline:

"Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak."

Deskripsi:

"PUSKOR Universitas Jenderal Soedirman menjadi wadah koordinasi pengembangan dan penerapan teknologi melalui kolaborasi, inovasi, serta pemberdayaan berbagai sektor."

CTA:
- Jelajahi Program.
- Lihat Produk.

Gunakan visual gedung Universitas Jenderal Soedirman dengan komposisi split layout.

### Overview Section

Tampilkan tiga highlight:
- 4 Program Utama.
- Katalog Produk Terintegrasi.
- Mitra Kolaborasi.

Hindari statistik yang belum memiliki data resmi.

### Program Unggulan

Tampilkan empat kartu:
- SINERGI.
- AJAKAN INDUSTRI.
- PMUPUD.
- DORTEK.

Setiap kartu memiliki nama, deskripsi resmi, icon, dan tombol Lihat Detail.

### Produk Unggulan

Tampilkan produk pilihan dari seluruh program dalam satu grid.

Informasi:
- Foto produk.
- Nama produk.
- Program asal.
- Deskripsi singkat.
- Tombol Lihat Detail.

CTA: Lihat Semua Produk.

### Mitra Kolaborasi

Tampilkan logo, nama, kategori jika tersedia, dan tombol Lihat Profil.

CTA: Lihat Semua Mitra.

### About PUSKOR

Tampilkan profil singkat, peran organisasi, dan visual institusi.

### Footer

- Identitas PUSKOR.
- Universitas Jenderal Soedirman.
- Navigasi.
- Kontak.
- Email: p3t.lppm@unsoed.ac.id.
- Copyright.

## 4.3 Halaman Program

Menampilkan empat program dalam grid card.

Setiap program memiliki:
- Nama.
- Logo jika tersedia.
- Deskripsi.
- Gambar.
- Tombol Lihat Detail.

## 4.4 Detail Program

Setiap program memiliki halaman detail tersendiri.

Contoh URL:
- /program/sinergi
- /program/ajakan-industri
- /program/pmupud
- /program/dortek

Konten:
- Hero program.
- Profil program.
- Latar belakang.
- Tujuan.
- Informasi kegiatan jika tersedia.
- Produk terkait.
- Mitra terkait.

## 4.5 Halaman Produk

Katalog seluruh produk dari empat program.

Fitur:
- Search produk.
- Filter berdasarkan program.
- Filter kategori jika tersedia.
- Sorting.
- Pagination.

Filter:
- Semua Program.
- SINERGI.
- AJAKAN INDUSTRI.
- PMUPUD.
- DORTEK.

Card produk:
- Gambar.
- Nama produk.
- Program asal.
- Deskripsi.
- Tombol Detail.

## 4.6 Detail Produk

Menampilkan:
- Foto utama.
- Nama produk.
- Program asal.
- Mitra terkait.
- Deskripsi.
- Fungsi dan manfaat.
- Galeri dokumentasi.
- Informasi tambahan.
- Tautan eksternal jika tersedia.

## 4.7 Halaman Mitra

Menampilkan seluruh mitra PUSKOR.

Fitur:
- Search mitra.
- Filter kategori jika tersedia.
- Grid profil mitra.

Card mitra:
- Logo.
- Nama.
- Deskripsi singkat.
- Tombol Lihat Profil.

## 4.8 Detail Mitra

Menampilkan:
- Logo mitra.
- Nama resmi.
- Profil.
- Deskripsi.
- Alamat jika tersedia.
- Website dan kontak resmi jika tersedia.
- Program terkait.
- Produk terkait.

## 4.9 Tentang PUSKOR

Konten:
- Profil organisasi.
- Visi dan misi jika tersedia.
- Peran dan fungsi.
- Empat program utama.
- Mitra kolaborasi.
- Kontak.

---

# 5. ADMIN DASHBOARD

## 5.1 Konsep Admin

Gunakan satu dashboard admin untuk mengelola seluruh informasi website.

Tidak ada dashboard terpisah untuk masing-masing program.

## 5.2 Admin Layout

- Sidebar kiri.
- Topbar.
- Breadcrumb.
- User profile.
- Area konten utama.

Sidebar:
1. Dashboard.
2. Manajemen Program.
3. Manajemen Produk.
4. Manajemen Mitra.
5. Manajemen Halaman.
6. Pengaturan Website.
7. Logout.

## 5.3 Dashboard Overview

Tampilkan:
- Total Program.
- Total Produk.
- Total Mitra.
- Total Konten.

Tambahkan:
- Produk terbaru.
- Mitra terbaru.
- Aktivitas terbaru.
- Quick action.

Semua statistik harus bersumber dari database.

## 5.4 Manajemen Program

CRUD program:
- Tambah.
- Lihat.
- Edit.
- Hapus.

Field:
- Nama program.
- Slug.
- Deskripsi singkat.
- Deskripsi lengkap.
- Logo.
- Gambar banner.
- Status publikasi.

Empat program awal harus tersedia di database.

## 5.5 Manajemen Produk

CRUD produk.

Field:
- Nama produk.
- Slug.
- Program asal.
- Deskripsi singkat.
- Deskripsi lengkap.
- Gambar utama.
- Galeri.
- Fungsi dan manfaat.
- Mitra terkait.
- Tautan eksternal.
- Status publikasi.

Setiap produk harus terhubung dengan program asalnya.

## 5.6 Manajemen Mitra

CRUD mitra.

Field:
- Nama mitra.
- Slug.
- Logo.
- Deskripsi.
- Alamat.
- Website.
- Email atau kontak.
- Program terkait.
- Produk terkait.
- Status publikasi.

## 5.7 Manajemen Halaman

Kelola:
- Konten beranda.
- Tentang PUSKOR.
- Footer.
- Informasi kontak.
- Banner dan gambar.

---

# 6. DATABASE DESIGN

Gunakan MySQL dengan Laravel Eloquent ORM.

Tabel utama:

### programs
- id.
- name.
- slug.
- short_description.
- description.
- logo.
- banner.
- status.
- timestamps.

### products
- id.
- program_id.
- name.
- slug.
- short_description.
- description.
- main_image.
- benefits.
- external_url.
- status.
- timestamps.

### partners
- id.
- name.
- slug.
- logo.
- description.
- address.
- website.
- email.
- phone.
- status.
- timestamps.

### program_partner
Pivot table untuk relasi many-to-many:
- program_id.
- partner_id.

### partner_product
Pivot table untuk menghubungkan produk dan mitra jika satu produk dapat melibatkan beberapa mitra:
- product_id.
- partner_id.

### page_contents
- id.
- page_key.
- title.
- content.
- image.
- timestamps.

### settings
- id.
- key.
- value.
- timestamps.

### users
Menggunakan sistem autentikasi Laravel untuk admin.

Relasi:
- Program memiliki banyak produk.
- Program dapat memiliki banyak mitra.
- Produk berasal dari satu program.
- Produk dapat terhubung dengan beberapa mitra.
- Mitra dapat terlibat dalam beberapa program.

---

# 7. FUNCTIONAL REQUIREMENTS

1. Seluruh halaman publik dapat diakses tanpa login.
2. Admin harus login untuk mengakses dashboard.
3. Admin dapat melakukan CRUD program.
4. Admin dapat melakukan CRUD produk.
5. Admin dapat melakukan CRUD mitra.
6. Admin dapat mengelola konten halaman.
7. Pengunjung dapat mencari produk.
8. Pengunjung dapat memfilter produk berdasarkan program.
9. Pengunjung dapat mencari mitra.
10. Produk dan mitra memiliki halaman detail.
11. Perubahan data admin otomatis tercermin pada website publik setelah dipublikasikan.
12. Gambar dan file disimpan melalui Laravel Storage.

---

# 8. NON-FUNCTIONAL REQUIREMENTS

- Responsive pada desktop, tablet, dan mobile.
- Optimasi gambar.
- SEO-friendly URL dan metadata.
- Validasi form menggunakan Laravel.
- Proteksi CSRF dan autentikasi.
- Database relational dengan foreign key.
- Pagination untuk data berjumlah banyak.
- Kode modular dan reusable.
- Penanganan error dan validasi yang informatif.
- Performa halaman yang baik.

---

# 9. GOOGLE STITCH DESIGN REQUIREMENTS

Buat high-fidelity UI mockup untuk seluruh halaman berikut.

### Public Website
1. Beranda.
2. Daftar Program.
3. Detail Program.
4. Katalog Produk.
5. Detail Produk.
6. Daftar Mitra.
7. Detail Mitra.
8. Tentang PUSKOR.

### Admin Dashboard
9. Login Admin.
10. Dashboard Overview.
11. Manajemen Program.
12. Manajemen Produk.
13. Form Tambah/Edit Produk.
14. Manajemen Mitra.
15. Form Tambah/Edit Mitra.
16. Manajemen Halaman dan Pengaturan.

### Design Guidelines

- Primary background putih.
- Secondary color hijau tua #14532D.
- Accent #22C55E.
- Font Plus Jakarta Sans.
- Modern, professional, minimalist, aesthetic.
- Gunakan whitespace yang proporsional.
- Gunakan icon outline.
- Card dengan border lembut.
- Gunakan komponen reusable.
- Konsistenkan navbar dan footer.
- Gunakan satu design system untuk semua halaman.
- Dashboard admin tetap menggunakan identitas visual PUSKOR.

### Important Instruction

Google Stitch digunakan untuk menghasilkan desain UI/UX dan prototype visual. Implementasi fungsional dilakukan menggunakan Laravel, Vue.js 3, Inertia.js, MySQL, dan Tailwind CSS.

Jangan membuat empat website berbeda untuk empat program. Seluruh program berada dalam satu website PUSKOR.

---

# 10. SUCCESS CRITERIA

Website dinyatakan memenuhi kebutuhan jika:

1. Empat program terintegrasi dalam satu platform.
2. Seluruh produk tampil pada satu katalog.
3. Setiap produk memiliki informasi program asal.
4. Setiap mitra memiliki profil tersendiri.
5. Admin dapat mengelola semua informasi melalui satu dashboard.
6. Perubahan data tersinkronisasi dengan halaman publik.
7. Pencarian dan filter berjalan sesuai kebutuhan.
8. Website responsif.
9. Identitas visual konsisten.
10. Website mudah dikelola dan dikembangkan.

---

# 11. FINAL PROJECT SUMMARY

**Nama:** Website PUSKOR

**Organisasi:** Pusat Koordinasi Pengembangan dan Penerapan Teknologi, Universitas Jenderal Soedirman.

**Konsep:** Centralized Technology & Innovation Information Platform.

**Program:**
- SINERGI.
- AJAKAN INDUSTRI.
- PMUPUD.
- DORTEK.

**Technology Stack:**
- Backend: Laravel.
- Frontend: Vue.js 3.
- Integration: Inertia.js.
- Database: MySQL.
- Styling: Tailwind CSS.
- Typography: Plus Jakarta Sans.
- Icons: Lucide Icons.

**Design Identity:**
- Primary: White #FFFFFF.
- Secondary: Dark Green #14532D.
- Accent: Green #22C55E.
- Style: Modern, Professional, Minimalist, Aesthetic.

**Architecture:** One centralized web application with one admin dashboard and one database.

**Core Principle:** Seluruh informasi program, produk, dan mitra dikelola dalam satu ekosistem digital PUSKOR Universitas Jenderal Soedirman.