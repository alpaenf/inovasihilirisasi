<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Models\Program;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function index(): Response
    {
        $homeHero = PageContent::where('page_key', 'home')->where('section_key', 'hero')->first();
        $homeGallery = PageContent::where('page_key', 'home')->where('section_key', 'gallery')->first();
        $homeNews = PageContent::where('page_key', 'home')->where('section_key', 'news')->first();
        $homeContact = PageContent::where('page_key', 'home')->where('section_key', 'contact')->first();

        $aboutProfile = PageContent::where('page_key', 'about')->where('section_key', 'profile')->first();
        $aboutOrg = PageContent::where('page_key', 'about')->where('section_key', 'organization')->first();
        $programs = Program::where('status', 'published')->orderBy('sort_order', 'asc')->get(['id', 'name', 'slug', 'code']);

        $settings = Setting::pluck('value', 'key')->toArray();

        // Default Gallery Items
        $defaultGallery = [
            [
                'id' => 1,
                'title' => 'Produksi Skala Pilot Mi Bebas Gluten Berbasis Tepung Singkong Termodifikasi',
                'category' => 'Uji Skala Pilot',
                'tag' => 'DORTEK',
                'image' => '/images/gallery/galeri-1.jpg',
                'date' => '12 November 2026',
                'location' => 'UD Usaha Mandiri, Banjarnegara',
                'description' => 'Pelaksanaan produksi skala pilot dan pra-komersial mi fungsional bebas gluten berbahan baku singkong termodifikasi.',
            ],
            [
                'id' => 2,
                'title' => 'Penerapan Teknologi Produksi MOcaf dan Pangan Pokok Alternatif',
                'category' => 'Penerapan Teknologi',
                'tag' => 'PMUPUD',
                'image' => '/images/gallery/galeri-2.jpg',
                'date' => '05 November 2026',
                'location' => 'KWT Sinar Tani & UD Usaha Mandiri, Banjarnegara',
                'description' => 'Pengujian alat produksi MOcaf dan pengolahan aneka produk pangan pokok alternatif substitusi beras dan terigu.',
            ],
            [
                'id' => 3,
                'title' => 'Peningkatan Kapasitas Produksi Pangan Fungsional Buah Carica Dieng',
                'category' => 'Optimalisasi Produksi',
                'tag' => 'SINERGI',
                'image' => '/images/gallery/galeri-3.jpg',
                'date' => '28 Oktober 2026',
                'location' => 'CV Gemilang Kencana, Wonosobo',
                'description' => 'Pendampingan optimalisasi proses produksi pangan fungsional buah carica dan implementasi digitalisasi pemasaran.',
            ],
            [
                'id' => 4,
                'title' => 'Hilirisasi Teknologi Pengolahan Buah Nanas Berbasis Zero Waste',
                'category' => 'Alih Teknologi',
                'tag' => 'AJAKAN INDUSTRI',
                'image' => '/images/gallery/galeri-4.jpg',
                'date' => '19 Oktober 2026',
                'location' => 'Koperasi Desa Merah Putih Penampi, Bengkalis',
                'description' => 'Implementasi teknologi pengolahan nanas modern dan pemanfaatan hasil samping berprinsip zero waste.',
            ],
            [
                'id' => 5,
                'title' => 'Pendampingan Branding & Manajemen Usaha Produk Pangan Lokal',
                'category' => 'Pemberdayaan Usaha',
                'tag' => 'PMUPUD',
                'image' => '/images/gallery/galeri-5.jpg',
                'date' => '08 Oktober 2026',
                'location' => 'Sentra Olahan Pangan Banjarnegara',
                'description' => 'Penguatan pengelolaan usaha, manajemen bisnis, dan branding produk pangan pokok alternatif binaan LPPM UNSOED.',
            ],
            [
                'id' => 6,
                'title' => 'Peningkatan TKT & Akselerasi Komersialisasi Mi Singkong Termodifikasi',
                'category' => 'Akselerasi Industri',
                'tag' => 'DORTEK',
                'image' => '/images/gallery/galeri-6.jpg',
                'date' => '25 September 2026',
                'location' => 'Fasilitas Pilot UD Usaha Mandiri, Banjarnegara',
                'description' => 'Evaluasi Tingkat Kesiapterapan Teknologi (TKT) menuju komersialisasi produk mi bebas gluten skala industri.',
            ],
        ];

        // Default News Items
        $defaultNews = [
            [
                'id' => 1,
                'slug' => 'hilirisasi-olahan-carica-dieng-program-sinergi-wonosobo',
                'title' => 'Hilirisasi Pangan Fungsional Carica Dieng Melalui Program SINERGI di Wonosobo',
                'category' => 'Pangan Fungsional',
                'tag' => 'SINERGI',
                'date' => '14 November 2026',
                'author' => 'Tim Media Inovasi Hilirisasi',
                'image' => '/images/news/berita-1.jpg',
                'excerpt' => 'Program SINERGI berfokus meningkatkan kapasitas produksi dan digitalisasi pemasaran pangan fungsional buah carica bersama mitra CV Gemilang Kencana di Wonosobo.',
                'read_time' => '3 menit baca',
                'content' => 'Wonosobo — Program SINERGI Inovasi Hilirisasi LPPM UNSOED resmi mengoptimalkan daya saing komoditas indikasi geografis buah carica Dieng. Bekerja sama dengan CV Gemilang Kencana, program ini memadukan peningkatan kapasitas pengolahan pangan fungsional bernilai gizi tinggi dengan akselerasi digitalisasi pemasaran untuk menembus pasar nasional.',
            ],
            [
                'id' => 2,
                'slug' => 'dorongan-teknologi-produksi-pilot-mi-bebas-gluten-banjarnegara',
                'title' => 'Program Dorongan Teknologi Sukses Uji Skala Pilot Mi Bebas Gluten di Banjarnegara',
                'category' => 'Dorongan Teknologi',
                'tag' => 'DORTEK',
                'date' => '02 November 2026',
                'author' => 'Divisi Dorongan Teknologi',
                'image' => '/images/news/berita-2.jpg',
                'excerpt' => 'Kolaborasi LPPM UNSOED dan UD Usaha Mandiri merealisasikan produksi skala pilot mi fungsional bebas gluten berbasis tepung singkong termodifikasi guna meningkatkan TKT dan komersialisasi industri.',
                'read_time' => '4 menit baca',
                'content' => 'Banjarnegara — Melalui Program Dorongan Teknologi, tim peneliti UNSOED bersama UD Usaha Mandiri berhasil mengembangkan lini produksi skala pilot mi fungsional bebas gluten berbahan baku tepung singkong termodifikasi. Program ini mempercepat kesiapterapan teknologi (TKT) menuju adopsi komersial skala penuh di industri pangan.',
            ],
            [
                'id' => 3,
                'slug' => 'program-pm-upud-kuatkan-daya-saing-mocaf-pangan-pokok-alternatif',
                'title' => 'Program PM-UPUD Kuatkan Daya Saing Usaha MOcaf dan Pangan Pokok Alternatif Banjarnegara',
                'category' => 'PM-UPUD',
                'tag' => 'PMUPUD',
                'date' => '20 Oktober 2026',
                'author' => 'Divisi PM-UPUD',
                'image' => '/images/news/berita-3.jpg',
                'excerpt' => 'Program PM-UPUD memperkuat kapasitas produksi MOcaf serta produk pangan alternatif pengganti beras dan terigu bersama UD Usaha Mandiri dan KWT Sinar Tani.',
                'read_time' => '3 menit baca',
                'content' => 'Banjarnegara — Program PM-UPUD Inovasi Hilirisasi UNSOED menguatkan daya saing usaha masyarakat berbasis potensi lokal Kabupaten Banjarnegara. Bermitra dengan UD Usaha Mandiri dan KWT Sinar Tani, program ini mengimplementasikan teknologi produksi tepung singkong termodifikasi (MOcaf), pengembangan aneka pangan pokok alternatif pengganti beras dan terigu, serta penguatan manajemen usaha.',
            ],
        ];

        $defaultLeaders = [
            [
                'id' => 'leader_1',
                'name' => 'Prof. Dr. Ir. Akhmad Sodiq, M.Sc., Agr., IPU',
                'position' => 'Rektor Universitas Jenderal Soedirman',
                'category' => 'Pelindung',
                'description' => 'Pengarah kebijakan tertinggi institusi dan fasilitasi ekosistem hilirisasi riset terpadu.',
                'photo' => null,
            ],
            [
                'id' => 'leader_2',
                'name' => 'Prof. Dr. Elly Tugiyanti, S.Pt., M.P.',
                'position' => 'Ketua LPPM UNSOED',
                'category' => 'Pengarah Operasional',
                'description' => 'Pengarah operasional pelaksanaan riset terapan dan pengabdian masyarakat inovatif.',
                'photo' => null,
            ],
            [
                'id' => 'leader_3',
                'name' => 'Dr. Ing. Ridwan, S.T., M.T.',
                'position' => 'Koordinator Pusat Inovasi Hilirisasi',
                'category' => 'Pimpinan Eksekutif',
                'description' => 'Penanggung jawab program, orkestrasi alih teknologi, dan kemitraan strategis dengan DUDI & Pemerintah.',
                'photo' => null,
            ],
            [
                'id' => 'leader_4',
                'name' => 'Dr. Hendro Prasetiyo, S.T., M.T.',
                'position' => 'Sekretaris & Penjaminan Mutu',
                'category' => 'Tata Kelola & HKI',
                'description' => 'Pengelolaan administrasi legal, pendaftaran paten/HKI, monitoring evaluasi, dan akuntabilitas program.',
                'photo' => null,
            ],
        ];

        $defaultDivisions = [
            [
                'id' => 'div_1',
                'name' => 'Tim Pengelola Program PM-UPUD',
                'position' => 'Divisi Pelaksana Program PM-UPUD',
                'program_slug' => 'pm-upud',
                'program_name' => 'PM-UPUD',
                'description' => 'Penerapan teknologi produksi MOcaf dan pangan pokok alternatif pengganti beras dan terigu di Kabupaten Banjarnegara bersama UD Usaha Mandiri dan KWT Sinar Tani.',
                'photo' => null,
            ],
            [
                'id' => 'div_2',
                'name' => 'Tim Pengelola Program SINERGI',
                'position' => 'Divisi Pelaksana Program SINERGI',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'description' => 'Peningkatan kapasitas produksi dan digitalisasi pemasaran pangan fungsional buah carica indikasi geografis Dieng di Kabupaten Wonosobo bersama CV Gemilang Kencana.',
                'photo' => null,
            ],
            [
                'id' => 'div_3',
                'name' => 'Tim Pengelola Program Dorongan Teknologi',
                'position' => 'Divisi Pelaksana Program Dorongan Teknologi',
                'program_slug' => 'dorongan-teknologi',
                'program_name' => 'DORTEK',
                'description' => 'Produksi skala pilot dan pra-komersial mi fungsional bebas gluten berbasis tepung singkong termodifikasi di Kabupaten Banjarnegara bersama UD Usaha Mandiri.',
                'photo' => null,
            ],
            [
                'id' => 'div_4',
                'name' => 'Tim Pengelola Program Ajakan Industri',
                'position' => 'Divisi Pelaksana Program Ajakan Industri',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'description' => 'Hilirisasi teknologi pengolahan buah nanas berbasis zero waste di sentra komoditas Kabupaten Bengkalis bersama Koperasi Desa Merah Putih Penampi.',
                'photo' => null,
            ],
        ];

        $defaultStudents = [
            // PM-UPUD (4 Mahasiswa)
            [
                'id' => 'std_pmu_1',
                'program_slug' => 'pm-upud',
                'program_name' => 'PM-UPUD',
                'name' => 'Mahasiswa Agribisnis',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Analisis Usaha Tani Singkong & Rantai Pasok Bahan Baku',
                'photo' => null,
            ],
            [
                'id' => 'std_pmu_2',
                'program_slug' => 'pm-upud',
                'program_name' => 'PM-UPUD',
                'name' => 'Mahasiswa Teknologi Pangan',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Formulasi Produk Pangan Pokok Alternatif & MOcaf',
                'photo' => null,
            ],
            [
                'id' => 'std_pmu_3',
                'program_slug' => 'pm-upud',
                'program_name' => 'PM-UPUD',
                'name' => 'Mahasiswa Manajemen',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Manajemen Operasional & Strategi Pemasaran Produk',
                'photo' => null,
            ],
            [
                'id' => 'std_pmu_4',
                'program_slug' => 'pm-upud',
                'program_name' => 'PM-UPUD',
                'name' => 'Mahasiswa Akuntansi',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Tata Kelola Keuangan & Analisis Biaya Pokok Produksi',
                'photo' => null,
            ],

            // SINERGI (7 Mahasiswa)
            [
                'id' => 'std_sin_1',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Mahasiswa Teknologi Pangan (1)',
                'identifier' => 'Kebutuhan: 2 Orang (Posisi 1)',
                'role' => 'Pengembangan Pangan Fungsional Buah Carica Dieng',
                'photo' => null,
            ],
            [
                'id' => 'std_sin_2',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Mahasiswa Teknologi Pangan (2)',
                'identifier' => 'Kebutuhan: 2 Orang (Posisi 2)',
                'role' => 'Pengujian Parameter Mutu & Stabilitas Nutrisi',
                'photo' => null,
            ],
            [
                'id' => 'std_sin_3',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Mahasiswa Teknik Pertanian',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Optimalisasi Kapasitas & Mesin Pengolahan Carica',
                'photo' => null,
            ],
            [
                'id' => 'std_sin_4',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Mahasiswa Agribisnis',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Kemitraan Petani Carica & Rantai Nilai Indikasi Geografis',
                'photo' => null,
            ],
            [
                'id' => 'std_sin_5',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Mahasiswa Teknik Informatika',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Digitalisasi Pemasaran & Sistem Katalog Produk Online',
                'photo' => null,
            ],
            [
                'id' => 'std_sin_6',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Mahasiswa Ilmu Komunikasi',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Branding Digital, Konten Kreatif & Publikasi',
                'photo' => null,
            ],
            [
                'id' => 'std_sin_7',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Mahasiswa Manajemen / Akuntansi',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Pengelolaan Finansial & Administrasi Kemitraan CV Gemilang Kencana',
                'photo' => null,
            ],

            // Dorongan Teknologi (7 Mahasiswa)
            [
                'id' => 'std_dt_1',
                'program_slug' => 'dorongan-teknologi',
                'program_name' => 'DORTEK',
                'name' => 'Mahasiswa Teknologi Pangan (1)',
                'identifier' => 'Kebutuhan: 2 Orang (Posisi 1)',
                'role' => 'Formulasi Mi Fungsional Bebas Gluten Berbasis Singkong',
                'photo' => null,
            ],
            [
                'id' => 'std_dt_2',
                'program_slug' => 'dorongan-teknologi',
                'program_name' => 'DORTEK',
                'name' => 'Mahasiswa Teknologi Pangan (2)',
                'identifier' => 'Kebutuhan: 2 Orang (Posisi 2)',
                'role' => 'Karakterisasi Tekstur & Uji Sensoris Mi Pra-Komersial',
                'photo' => null,
            ],
            [
                'id' => 'std_dt_3',
                'program_slug' => 'dorongan-teknologi',
                'program_name' => 'DORTEK',
                'name' => 'Mahasiswa Teknik Pertanian',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Rekayasa Lini Ekstruder & Pengeringan Mi Skala Pilot',
                'photo' => null,
            ],
            [
                'id' => 'std_dt_4',
                'program_slug' => 'dorongan-teknologi',
                'program_name' => 'DORTEK',
                'name' => 'Mahasiswa Agribisnis',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Kemitraan Bahan Baku Singkong Termodifikasi UD Usaha Mandiri',
                'photo' => null,
            ],
            [
                'id' => 'std_dt_5',
                'program_slug' => 'dorongan-teknologi',
                'program_name' => 'DORTEK',
                'name' => 'Mahasiswa Teknik Informatika',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Sistem Pemantauan Data Produksi & Kesiapterapan Teknologi (TKT)',
                'photo' => null,
            ],
            [
                'id' => 'std_dt_6',
                'program_slug' => 'dorongan-teknologi',
                'program_name' => 'DORTEK',
                'name' => 'Mahasiswa Ilmu Komunikasi',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Edukasi Produk Sehat Bebas Gluten & Komunikasi Industri',
                'photo' => null,
            ],
            [
                'id' => 'std_dt_7',
                'program_slug' => 'dorongan-teknologi',
                'program_name' => 'DORTEK',
                'name' => 'Mahasiswa Manajemen / Akuntansi',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Kalkulasi Kelayakan Finansial Skala Pilot Menuju Komersialisasi',
                'photo' => null,
            ],

            // Ajakan Industri (7 Mahasiswa)
            [
                'id' => 'std_ai_1',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Mahasiswa Teknologi Pangan (1)',
                'identifier' => 'Kebutuhan: 2 Orang (Posisi 1)',
                'role' => 'Formulasi Produk Olahan Buah Nanas Sentra Bengkalis',
                'photo' => null,
            ],
            [
                'id' => 'std_ai_2',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Mahasiswa Teknologi Pangan (2)',
                'identifier' => 'Kebutuhan: 2 Orang (Posisi 2)',
                'role' => 'Pemanfaatan Hasil Samping Nanas Berbasis Zero Waste',
                'photo' => null,
            ],
            [
                'id' => 'std_ai_3',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Mahasiswa Teknik Pertanian',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Perancangan Mesin Pengolahan Nanas di Koperasi Merah Putih',
                'photo' => null,
            ],
            [
                'id' => 'std_ai_4',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Mahasiswa Agribisnis',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Pengembangan Nilai Tambah Komoditas Nanas & Jejaring Sentra',
                'photo' => null,
            ],
            [
                'id' => 'std_ai_5',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Mahasiswa Teknik Informatika',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Sistem Informasi Inventori & Pemasaran Digital Koperasi',
                'photo' => null,
            ],
            [
                'id' => 'std_ai_6',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Mahasiswa Ilmu Komunikasi',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Promosi Komoditas Unggulan Bengkalis & Relasi Publik',
                'photo' => null,
            ],
            [
                'id' => 'std_ai_7',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Mahasiswa Manajemen / Akuntansi',
                'identifier' => 'Kebutuhan: 1 Orang',
                'role' => 'Penguatan Tata Kelola Usaha & Pembukuan Koperasi Merah Putih',
                'photo' => null,
            ],
        ];

        return Inertia::render('Admin/Pages/Index', [
            'homeHero' => $homeHero,
            'homeGallery' => $homeGallery?->metadata['items'] ?? $defaultGallery,
            'homeNews' => $homeNews?->metadata['items'] ?? $defaultNews,
            'homeContact' => [
                'email' => $homeContact?->metadata['email'] ?? ($settings['contact_email'] ?? 'p3t.lppm@unsoed.ac.id'),
                'phone' => $homeContact?->metadata['phone'] ?? ($settings['contact_phone'] ?? '+62 281 635292'),
                'address' => $homeContact?->metadata['address'] ?? ($settings['contact_address'] ?? 'Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto, Jawa Tengah 53122'),
                'hours' => $homeContact?->metadata['hours'] ?? 'Senin - Jumat: 08.00 - 16.00 WIB',
                'whatsapp' => $homeContact?->metadata['whatsapp'] ?? ($settings['contact_whatsapp'] ?? '+62 812-3456-7890'),
            ],
            'aboutProfile' => $aboutProfile,
            'aboutOrg' => [
                'title' => $aboutOrg?->title ?? 'Struktur Organisasi Inovasi Hilirisasi',
                'content' => $aboutOrg?->content ?? 'Struktur kepemimpinan dan pembagian divisi operasional dalam mengoordinasikan hilirisasi riset, alih teknologi, dan kemitraan industri di lingkungan LPPM UNSOED.',
                'leaders' => $aboutOrg?->metadata['leaders'] ?? $defaultLeaders,
                'divisions' => $aboutOrg?->metadata['divisions'] ?? $defaultDivisions,
                'students' => $aboutOrg?->metadata['students'] ?? $defaultStudents,
            ],
            'programs' => $programs,
        ]);
    }

    public function update(Request $request, string $page_key): RedirectResponse
    {
        if ($page_key === 'home') {
            $section = $request->input('section_key', 'hero');

            if ($section === 'hero') {
                $validated = $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'content' => ['required', 'string'],
                    'eyebrow' => ['nullable', 'string', 'max:150'],
                ]);

                $pageContent = PageContent::firstOrNew([
                    'page_key' => 'home',
                    'section_key' => 'hero',
                ]);

                $pageContent->title = $validated['title'];
                $pageContent->content = $validated['content'];

                $metadata = $pageContent->metadata ?? [];
                if (isset($validated['eyebrow'])) {
                    $metadata['eyebrow'] = $validated['eyebrow'];
                }
                $pageContent->metadata = $metadata;
                $pageContent->save();

                return back()->with('success', 'Konten Hero Beranda berhasil diperbarui.');
            }

            if ($section === 'gallery') {
                $validated = $request->validate([
                    'items' => ['required', 'array'],
                    'items.*.title' => ['required', 'string', 'max:255'],
                    'items.*.category' => ['required', 'string', 'max:100'],
                    'items.*.tag' => ['required', 'string', 'max:50'],
                    'items.*.image' => ['required', 'string'],
                    'items.*.date' => ['nullable', 'string', 'max:100'],
                    'items.*.location' => ['nullable', 'string', 'max:255'],
                    'items.*.description' => ['nullable', 'string'],
                ]);

                $pageContent = PageContent::firstOrNew([
                    'page_key' => 'home',
                    'section_key' => 'gallery',
                ]);

                $pageContent->title = 'Galeri Kegiatan & Dokumentasi Riset';
                $pageContent->metadata = ['items' => $validated['items']];
                $pageContent->save();

                return back()->with('success', 'Galeri Kegiatan berhasil diperbarui.');
            }

            if ($section === 'news') {
                $validated = $request->validate([
                    'items' => ['required', 'array'],
                    'items.*.title' => ['required', 'string', 'max:255'],
                    'items.*.category' => ['required', 'string', 'max:100'],
                    'items.*.tag' => ['required', 'string', 'max:50'],
                    'items.*.image' => ['required', 'string'],
                    'items.*.date' => ['nullable', 'string', 'max:100'],
                    'items.*.author' => ['nullable', 'string', 'max:150'],
                    'items.*.read_time' => ['nullable', 'string', 'max:50'],
                    'items.*.excerpt' => ['required', 'string'],
                    'items.*.content' => ['nullable', 'string'],
                ]);

                $pageContent = PageContent::firstOrNew([
                    'page_key' => 'home',
                    'section_key' => 'news',
                ]);

                $pageContent->title = 'Berita & Publikasi Hilirisasi';
                $pageContent->metadata = ['items' => $validated['items']];
                $pageContent->save();

                return back()->with('success', 'Berita & Publikasi berhasil diperbarui.');
            }

            if ($section === 'contact') {
                $validated = $request->validate([
                    'email' => ['required', 'email', 'max:255'],
                    'phone' => ['required', 'string', 'max:100'],
                    'whatsapp' => ['nullable', 'string', 'max:100'],
                    'address' => ['required', 'string'],
                    'hours' => ['nullable', 'string', 'max:150'],
                ]);

                $pageContent = PageContent::firstOrNew([
                    'page_key' => 'home',
                    'section_key' => 'contact',
                ]);

                $pageContent->title = 'Kontak & Konsultasi Kemitraan';
                $pageContent->metadata = $validated;
                $pageContent->save();

                // Also update in settings table for system-wide sync
                Setting::updateOrCreate(['key' => 'contact_email'], [
                    'display_name' => 'Email Resmi',
                    'value' => $validated['email'],
                    'group' => 'contact',
                ]);
                Setting::updateOrCreate(['key' => 'contact_phone'], [
                    'display_name' => 'Telepon / WhatsApp',
                    'value' => $validated['phone'],
                    'group' => 'contact',
                ]);
                Setting::updateOrCreate(['key' => 'contact_address'], [
                    'display_name' => 'Alamat Kantor',
                    'value' => $validated['address'],
                    'group' => 'contact',
                ]);
                if (!empty($validated['whatsapp'])) {
                    Setting::updateOrCreate(['key' => 'contact_whatsapp'], [
                        'display_name' => 'Hotline WhatsApp',
                        'value' => $validated['whatsapp'],
                        'group' => 'contact',
                    ]);
                }

                return back()->with('success', 'Informasi Kontak berhasil diperbarui.');
            }
        }

        if ($page_key === 'about') {
            $section = $request->input('section_key', 'profile');

            if ($section === 'profile') {
                $validated = $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'content' => ['required', 'string'],
                    'vision' => ['nullable', 'string'],
                    'mission' => ['nullable', 'array'],
                    'mission.*' => ['nullable', 'string'],
                ]);

                $pageContent = PageContent::firstOrNew([
                    'page_key' => 'about',
                    'section_key' => 'profile',
                ]);

                $pageContent->title = $validated['title'];
                $pageContent->content = $validated['content'];

                $metadata = $pageContent->metadata ?? [];
                $metadata['vision'] = $validated['vision'] ?? null;
                $metadata['mission'] = array_values(array_filter($validated['mission'] ?? [], fn($m) => !empty(trim($m))));
                $pageContent->metadata = $metadata;
                $pageContent->save();

                return back()->with('success', 'Profil & Visi Misi Tentang Kami berhasil diperbarui.');
            }

            if ($section === 'organization') {
                $validated = $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'content' => ['nullable', 'string'],
                    'leaders' => ['nullable', 'array'],
                    'divisions' => ['nullable', 'array'],
                    'students' => ['nullable', 'array'],
                ]);

                $pageContent = PageContent::firstOrNew([
                    'page_key' => 'about',
                    'section_key' => 'organization',
                ]);

                $pageContent->title = $validated['title'];
                $pageContent->content = $validated['content'] ?? '';
                $pageContent->metadata = [
                    'leaders' => $validated['leaders'] ?? [],
                    'divisions' => $validated['divisions'] ?? [],
                    'students' => $validated['students'] ?? [],
                ];
                $pageContent->save();

                return back()->with('success', 'Struktur Organisasi & Tim Mahasiswa berhasil disimpan.');
            }
        }

        return back()->with('error', 'Section tidak valid.');
    }

    public function uploadPhoto(Request $request, ImageService $imageService): JsonResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,webp,jpg', 'max:10240'],
            'folder' => ['nullable', 'string', 'in:organization,gallery,news,pages'],
        ]);

        $folder = $request->input('folder', 'gallery');
        $maxWidth = in_array($folder, ['gallery', 'news']) ? 1200 : 800;
        $maxHeight = in_array($folder, ['gallery', 'news']) ? 800 : 800;

        $url = $imageService->compressAndStore(
            $request->file('photo'),
            $folder,
            $maxWidth,
            $maxHeight,
            82
        );

        return response()->json([
            'success' => true,
            'url' => $url,
        ]);
    }
}
