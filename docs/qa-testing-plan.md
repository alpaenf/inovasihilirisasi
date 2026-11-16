# RENCANA PENGUJIAN KUALITAS (QA TESTING PLAN) & UAT
# WEBSITE PUSKOR (PUSAT KOORDINASI PENGEMBANGAN DAN PENERAPAN TEKNOLOGI)
### Universitas Jenderal Soedirman

**Versi:** 1.0  
**Framework Pengujian:** PHPUnit / Pest (Backend) & Manual Verification Matrix  
**Kriteria Lolos:** 100% fungsionalitas inti berhasil tanpa error blocking

---

## 1. TUJUAN & RUANG LINGKUP PENGUJIAN

Dokumen ini menjamin keandalan sistem Website PUSKOR UNSOED sebelum diluncurkan ke publik. Pengujian mencakup:
1. **Pengujian Fungsionalitas Publik**: Navigasi, filtering produk, pencarian mitra, dan halaman detail.
2. **Pengujian Fungsionalitas Admin**: Otentikasi, otorisasi, operasi CRUD (Program, Produk, Mitra, Konten), dan upload media.
3. **Pengujian Keamanan**: Proteksi CSRF, sanitasi upload file, pencegahan IDOR dan injeksi database.
4. **Pengujian Responsivitas & Tampilan**: Resolusi Desktop, Tablet, dan Mobile (Android/iOS).
5. **User Acceptance Testing (UAT)**: Validasi kesesuaian dengan stakeholder LPPM UNSOED.

---

## 2. MATRIKS SKENARIO PENGUJIAN (TEST MATRIX)

### 2.1 Halaman Publik (Public Web Features)

| ID Tes | Skenario Pengujian | Langkah Pengujian | Hasil yang Diharapkan | Status |
|---|---|---|---|---|
| **TC-PUB-01** | Akses Beranda | Buka URL `/` pada browser | Halaman beranda termuat cepat; Hero, 4 Program Unggulan, Produk Unggulan, dan Mitra tampil rapi | PASS |
| **TC-PUB-02** | Filter Produk Berdasarkan Program | Pilih tab "SINERGI" di katalog produk `/produk` | Daftar produk terfilter secara reaktif hanya menampilkan produk dari program SINERGI tanpa full page reload | PASS |
| **TC-PUB-03** | Pencarian Produk | Ketik kata kunci (misal "gabah") pada input search | Grid produk menampilkan inovasi yang relevan sesuai nama dan deskripsi | PASS |
| **TC-PUB-04** | Pagination Produk | Klik tombol halaman 2 pada katalog | URL diperbarui dengan parameter `?page=2`, produk halaman 2 dimuat secara halus via Inertia | PASS |
| **TC-PUB-05** | Halaman Detail Produk | Klik salah satu card produk | Halaman detail `/produk/{slug}` memuat foto utama, galeri dokumentasi, spesifikasi manfaat, nama program asal, dan mitra kolaborator | PASS |
| **TC-PUB-06** | Filter & Pencarian Mitra | Masuk ke `/mitra` dan cari nama industri/instansi | Profil mitra yang dicari muncul dengan logo resmi dan kategori | PASS |
| **TC-PUB-07** | Detail Program | Buka `/program/ajakan-industri` | Halaman menampilkan latar belakang, tujuan, daftar produk turunan dari program, dan mitra terkait | PASS |
| **TC-PUB-08** | CTA Hubungi Kami | Klik tombol "Hubungi Kami" di navbar | Navigasi mengarah ke kontak resmi atau membuka mailto ke `p3t.lppm@unsoed.ac.id` | PASS |

---

### 2.2 Dashboard Admin (Admin & Management Features)

| ID Tes | Skenario Pengujian | Langkah Pengujian | Hasil yang Diharapkan | Status |
|---|---|---|---|---|
| **TC-ADM-01** | Proteksi Rute Admin | Akses `/admin/dashboard` tanpa login | Sistem otomatis me-redirect pengunjung ke `/login` | PASS |
| **TC-ADM-02** | Login Sukses | Masukkan email dan password admin valid | Sistem membuat session, redirect ke `/admin/dashboard`, dan menampilkan ringkasan statistik | PASS |
| **TC-ADM-03** | Proteksi Brute Force | Coba login dengan password salah > 5 kali | Sistem menampilkan pesan error throttle dan memblokir upaya login sementara | PASS |
| **TC-ADM-04** | Tambah Produk Baru | Buka form `/admin/products/create`, isi field, unggah gambar, lalu simpan | Produk tersimpan di database MySQL, file terunggah di storage, dan redirect ke daftar produk dengan alert sukses | PASS |
| **TC-ADM-05** | Validasi Upload File | Unggah file non-gambar (misal `.pdf` atau `.exe`) pada field foto produk | Sistem menolak dengan pesan validasi "File harus berformat jpeg, png, webp" | PASS |
| **TC-ADM-06** | Update & Hapus Produk | Lakukan edit deskripsi produk lalu hapus salah satu produk draft | Perubahan data terupdate; produk yang dihapus hilang dari database dan storage terkait dibersihkan | PASS |
| **TC-ADM-07** | Relasi Many-to-Many Mitra | Hubungkan mitra dengan lebih dari satu program | Pivot table `program_partner` terisi dengan benar dan relasi muncul di kedua halaman detail | PASS |
| **TC-ADM-08** | Sinkronisasi Publik | Ubah nama produk di admin dan ubah status ke "published" | Kunjungan baru di halaman publik langsung menampilkan perubahan nama terkini | PASS |

---

### 2.3 Pengujian Keamanan & Non-Fungsional

| ID Tes | Kategori | Skenario | Hasil yang Diharapkan |
|---|---|---|---|
| **TC-SEC-01** | CSRF Token | Kirim request POST palsu tanpa header `X-XSRF-TOKEN` | Laravel memblokir request dengan response status `419 Page Expired` |
| **TC-SEC-02** | XSS Protection | Input script tag `<script>alert(1)</script>` pada form deskripsi | Vue 3 me-render string sebagai teks biasa (escaped), script tidak pernah tereksekusi di browser |
| **TC-SEC-03** | SQL Injection | Input string `' OR 1=1 --` pada input pencarian | Eloquent parameter binding menangani query secara aman tanpa kebocoran data |
| **TC-RSP-01** | Responsivitas | Buka website di viewport Mobile (375px), Tablet (768px), dan Desktop (1440px) | Layout bertransformasi secara fluid; mobile drawer menu berfungsi lancar; card grid menyesuaikan kolom |
| **TC-PRF-01** | Performa Aset | Uji skor Lighthouse pada halaman Beranda | First Contentful Paint (FCP) < 1.5 detik, Cumulative Layout Shift (CLS) < 0.1 |

---

## 3. CHECKLIST USER ACCEPTANCE TESTING (UAT) STAKEHOLDER

Checklist persetujuan resmi Tim PUSKOR LPPM Universitas Jenderal Soedirman:

- [ ] Seluruh identitas visual sesuai brand guideline UNSOED (Hijau Tua `#14532D`, Aksen Hijau `#22C55E`, Font Plus Jakarta Sans).
- [ ] 4 Program Inti (SINERGI, AJAKAN INDUSTRI, PMUPUD, DORTEK) tampil lengkap dengan penjelasan resmi.
- [ ] Single Admin Dashboard mampu mengelola produk dan mitra dari seluruh program tanpa sistem terpisah.
- [ ] Struktur penamaan tautan rapi, mudah dibaca, dan SEO-friendly.
- [ ] Data kontak resmi LPPM UNSOED (`p3t.lppm@unsoed.ac.id`) tercantum jelas di footer dan halaman tentang kami.

