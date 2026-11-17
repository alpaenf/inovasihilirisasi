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
                'title' => 'Uji Coba Lapangan Mesin Briket Biomassa Kapasitas Tinggi',
                'category' => 'Uji Prototipe Mesin',
                'tag' => 'DORTEK',
                'image' => '/images/gallery/galeri-1.jpg',
                'date' => '12 November 2026',
                'location' => 'Pabrik Gula & Sentra Pertanian Banyumas',
                'description' => 'Pengujian performa kompresi hidrolik briket limbah tongkol jagung bersama tim teknisi dan peneliti LPPM UNSOED.',
            ],
            [
                'id' => 2,
                'title' => 'Workshop Sertifikasi Organik & Mutu Produk Ekspor UMKM',
                'category' => 'Inkubasi Klaster Desa',
                'tag' => 'PMUPUD',
                'image' => '/images/gallery/galeri-2.jpg',
                'date' => '05 November 2026',
                'location' => 'Sentra Industri Nira Satria, Cilongok',
                'description' => 'Pendampingan standardisasi mutu internasional dan teknik pengemasan higienis kedap udara bagi kelompok produsen.',
            ],
            [
                'id' => 3,
                'title' => 'Kunjungan Industri & Validasi Pupuk Bersama Mitra DUDI',
                'category' => 'Riset Kolaboratif',
                'tag' => 'SINERGI',
                'image' => '/images/gallery/galeri-3.jpg',
                'date' => '28 Oktober 2026',
                'location' => 'Fasilitas Riset PT Pupuk Indonesia',
                'description' => 'Pertemuan teknis evaluasi efektivitas mikroba dekomposer tanah pasca pengujian demplot seluas 5 hektar.',
            ],
            [
                'id' => 4,
                'title' => 'Implementasi Greenhouse Smart IoT Pertanian Presisi',
                'category' => 'Alih Teknologi Komersial',
                'tag' => 'AJAKAN INDUSTRI',
                'image' => '/images/gallery/galeri-4.jpg',
                'date' => '19 Oktober 2026',
                'location' => 'Agro-Technology Park UNSOED',
                'description' => 'Instalasi sensor kelembapan tanah, solar tracker cerdas, dan otomasi penyiraman berbasis mikrokontroler hemat daya.',
            ],
            [
                'id' => 5,
                'title' => 'Gelar Inovasi & Pameran Produk Tepat Guna LPPM UNSOED',
                'category' => 'Diseminasi Publik',
                'tag' => 'EXPO RISET',
                'image' => '/images/gallery/galeri-5.jpg',
                'date' => '08 Oktober 2026',
                'location' => 'Auditorium Graha Widyatama UNSOED',
                'description' => 'Pameran terbuka memperkenalkan 15+ prototipe terapan kepada ratusan perwakilan asosiasi industri dan dinas terkait.',
            ],
            [
                'id' => 6,
                'title' => 'Pelatihan Mahasiswa & Asisten Peneliti Lapangan',
                'category' => 'Pengembangan Talenta',
                'tag' => 'KOLABORASI',
                'image' => '/images/gallery/galeri-6.jpg',
                'date' => '25 September 2026',
                'location' => 'Laboratorium Terpadu LPPM UNSOED',
                'description' => 'Pembekalan metodologi pengukuran TRL/TKT dan kepatuhan keselamatan kerja industri bagi tim mahasiswa.',
            ],
        ];

        // Default News Items
        $defaultNews = [
            [
                'id' => 1,
                'slug' => 'unsoed-dan-pupuk-indonesia-luncurkan-formula-pupuk-hayati-tahap-ii',
                'title' => 'UNSOED dan Pupuk Indonesia Luncurkan Formula Pupuk Hayati Unggulan Tahap II',
                'category' => 'Kemitraan DUDI',
                'tag' => 'SINERGI',
                'date' => '14 November 2026',
                'author' => 'Tim Media Inovasi Hilirisasi',
                'image' => '/images/news/berita-1.jpg',
                'excerpt' => 'Kolaborasi riset terapan antara Pusat Teknologi Terpadu LPPM UNSOED bersama PT Pupuk Indonesia resmi memasuki fase hilirisasi komersial dengan kapasitas produksi percontohan 50 ton per bulan.',
                'read_time' => '3 menit baca',
                'content' => 'Purwokerto — Universitas Jenderal Soedirman (UNSOED) melalui Pusat Koordinasi Pengembangan dan Penerapan Teknologi (Inovasi Hilirisasi) LPPM mengumumkan pencapaian strategis dalam pengembangan pupuk hayati berbasis konsorsium mikroba lokal. Melalui program SINERGI yang didukung oleh PT Pupuk Indonesia, formula tahap kedua ini terbukti mampu menekan pemakaian pupuk kimia sintetis hingga 35% tanpa mengurangi produktivitas panen padi dan hortikultura.',
            ],
            [
                'id' => 2,
                'slug' => 'mesin-briket-biomassa-buatan-lppm-mulai-diuji-coba-di-pabrik-gula',
                'title' => 'Mesin Briket Biomassa Buatan Inovasi Hilirisasi Mulai Diuji Coba di Pabrik Gula',
                'category' => 'Teknologi Terapan',
                'tag' => 'DORTEK',
                'date' => '02 November 2026',
                'author' => 'Divisi Rekayasa Alat',
                'image' => '/images/news/berita-2.jpg',
                'excerpt' => 'Mesin ekstruder hidrolik bertekanan tinggi hasil rancang bangun tim dosen teknik dan mahasiswa asisten peneliti berhasil mencetak briket limbah pertanian dengan nilai kalor mencapai 4.800 kcal/kg.',
                'read_time' => '4 menit baca',
                'content' => 'Banyumas — Menjawab kebutuhan dekarbonisasi industri boiler, tim Program DORTEK Inovasi Hilirisasi LPPM UNSOED merampungkan prototipe mesin briket biomassa skala komersial. Alat ini memanfaatkan limbah tongkol jagung dan serbuk gergaji yang melimpah di pedesaan Banyumas menjadi sumber energi terbarukan pengganti batu bara.',
            ],
            [
                'id' => 3,
                'slug' => 'klaster-umkm-binaan-inovasi-hilirisasi-raih-sertifikasi-mutu-ekspor',
                'title' => 'Klaster UMKM Binaan Inovasi Hilirisasi Raih Sertifikasi Mutu Ekspor',
                'category' => 'Pemberdayaan Desa',
                'tag' => 'PMUPUD',
                'date' => '20 Oktober 2026',
                'author' => 'Divisi Inkubasi Produk',
                'image' => '/images/news/berita-3.jpg',
                'excerpt' => 'Kelompok perajin gula semut kelapa Nira Satria binaan LPPM UNSOED resmi mengantongi sertifikat organik internasional dan siap mengekspor perdana 12 ton produk ke Eropa.',
                'read_time' => '3 menit baca',
                'content' => 'Cilongok — Program PMUPUD (Program Pengembangan Produk Unggulan Daerah) membuktikan komitmennya dalam mengangkat ekonomi kerakyatan. Melalui pendampingan menyeluruh dari aspek higienitas pengolahan, uji laboratorium bebas cemaran logam berat, hingga desain kemasan standing pouch berstandar ekspor, UMKM binaan berhasil menembus pasar global.',
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
                'name' => 'Dr. Ir. Budi Dharmawan, M.Sc.',
                'position' => 'Ketua Divisi Riset Terapan & Formulasi',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'description' => 'Fasilitasi uji formulasi pupuk organik hayati, pakan ternak hibrida, dan bioteknologi berbasis sumber daya lokal.',
                'photo' => null,
            ],
            [
                'id' => 'div_2',
                'name' => 'Ir. Teguh Sutarman, M.T.',
                'position' => 'Ketua Divisi Kemitraan & Komersialisasi',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'description' => 'Menjembatani kerja sama industri manufaktur, lisensi paten, dan komersialisasi teknologi skala industri.',
                'photo' => null,
            ],
            [
                'id' => 'div_3',
                'name' => 'Dr. Ratna Setyawati, S.Si., M.Si.',
                'position' => 'Ketua Divisi Inkubasi Produk & UMKM',
                'program_slug' => 'pmupud',
                'program_name' => 'PMUPUD',
                'description' => 'Pengembangan produk unggulan desa, sertifikasi organik/halal, standardisasi mutu ekspor, dan kemasan higienis.',
                'photo' => null,
            ],
            [
                'id' => 'div_4',
                'name' => 'Agus Suryanto, S.T., M.Eng.',
                'position' => 'Ketua Divisi Diseminasi Alat Tepat Guna',
                'program_slug' => 'dortek',
                'program_name' => 'DORTEK',
                'description' => 'Perekayasaan mesin pascapanen, pengering gabah hibrida, monitoring IoT, dan pelatihan operator pedesaan.',
                'photo' => null,
            ],
        ];

        $defaultStudents = [
            [
                'id' => 'std_1',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Muhammad Raihan Fadhil',
                'identifier' => 'NIM. A1D021088',
                'role' => 'Riset Formulasi Hayati & Mikroba',
                'photo' => null,
            ],
            [
                'id' => 'std_2',
                'program_slug' => 'sinergi',
                'program_name' => 'SINERGI',
                'name' => 'Dinda Ayu Lestari',
                'identifier' => 'NIM. A1A021045',
                'role' => 'Uji Efektivitas Agronomi',
                'photo' => null,
            ],
            [
                'id' => 'std_3',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Bagas Aditya Pratama',
                'identifier' => 'NIM. H1A020032',
                'role' => 'Prototipe Mesin Briket & Manufaktur',
                'photo' => null,
            ],
            [
                'id' => 'std_4',
                'program_slug' => 'ajakan-industri',
                'program_name' => 'AJAKAN INDUSTRI',
                'name' => 'Siti Nurhaliza',
                'identifier' => 'NIM. H1D021019',
                'role' => 'Dokumentasi Teknis & Relasi DUDI',
                'photo' => null,
            ],
            [
                'id' => 'std_5',
                'program_slug' => 'pmupud',
                'program_name' => 'PMUPUD',
                'name' => 'Anisa Rahmawati',
                'identifier' => 'NIM. D1A021067',
                'role' => 'Standardisasi Mutu & Packaging Carica',
                'photo' => null,
            ],
            [
                'id' => 'std_6',
                'program_slug' => 'pmupud',
                'program_name' => 'PMUPUD',
                'name' => 'Rizky Dwi Kurniawan',
                'identifier' => 'NIM. F1A021012',
                'role' => 'Digital Marketing & Branding UMKM',
                'photo' => null,
            ],
            [
                'id' => 'std_7',
                'program_slug' => 'dortek',
                'program_name' => 'DORTEK',
                'name' => 'Fajar Hidayatullah',
                'identifier' => 'NIM. H1A021004',
                'role' => 'Perancangan Rangka & Dinamika Mesin',
                'photo' => null,
            ],
            [
                'id' => 'std_8',
                'program_slug' => 'dortek',
                'program_name' => 'DORTEK',
                'name' => 'Ilham Bintang',
                'identifier' => 'NIM. H1D021055',
                'role' => 'Sistem Kontrol Suhu IoT & Sensor',
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
