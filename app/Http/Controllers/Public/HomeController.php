<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Product;
use App\Models\Partner;
use App\Models\PageContent;
use App\Models\Setting;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $heroContent = PageContent::where('page_key', 'home')->where('section_key', 'hero')->first();

        $programs = Program::where('status', 'published')
            ->orderBy('sort_order', 'asc')
            ->get(['id', 'name', 'slug', 'code', 'short_description', 'logo']);

        $featuredProducts = Product::where('status', 'published')
            ->where('is_featured', true)
            ->with('program:id,name,slug')
            ->latest()
            ->take(6)
            ->get(['id', 'program_id', 'name', 'slug', 'short_description', 'main_image']);

        $featuredPartners = Partner::where('status', 'published')
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get(['id', 'name', 'slug', 'category', 'logo', 'short_description']);

        $stats = [
            'total_programs' => Program::where('status', 'published')->count(),
            'total_products' => Product::where('status', 'published')->count(),
            'total_partners' => Partner::where('status', 'published')->count(),
        ];

        // Gallery Items (Dokumentasi Kegiatan & Riset Lapangan)
        $gallery = [
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

        // News & Articles (Berita Terkini)
        $news = [
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

        // Settings / Contact Details
        $settings = Setting::pluck('value', 'key')->toArray();

        return Inertia::render('Public/Home', [
            'hero' => [
                'eyebrow' => $heroContent?->metadata['eyebrow'] ?? 'UNIVERSITAS JENDERAL SOEDIRMAN',
                'headline' => $heroContent?->title ?? 'Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak.',
                'description' => $heroContent?->content ?? 'Inovasi Hilirisasi Universitas Jenderal Soedirman menjadi wadah koordinasi pengembangan dan penerapan teknologi melalui kolaborasi, inovasi, serta pemberdayaan berbagai sektor.',
                'cta_primary' => $heroContent?->metadata['cta_primary'] ?? ['label' => 'Jelajahi Program', 'url' => '/program'],
                'cta_secondary' => $heroContent?->metadata['cta_secondary'] ?? ['label' => 'Lihat Produk', 'url' => '/produk'],
            ],
            'programs' => $programs,
            'featuredProducts' => $featuredProducts,
            'featuredPartners' => $featuredPartners,
            'stats' => $stats,
            'gallery' => $gallery,
            'news' => $news,
            'contact' => [
                'email' => $settings['contact_email'] ?? 'p3t.lppm@unsoed.ac.id',
                'phone' => $settings['contact_phone'] ?? '+62 281 635292',
                'address' => $settings['contact_address'] ?? 'Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto, Jawa Tengah 53122',
                'hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
                'whatsapp' => '+62 812-3456-7890',
            ],
        ]);
    }
}
