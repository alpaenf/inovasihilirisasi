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
        $galleryContent = PageContent::where('page_key', 'home')->where('section_key', 'gallery')->first();
        $newsContent = PageContent::where('page_key', 'home')->where('section_key', 'news')->first();
        $contactContent = PageContent::where('page_key', 'home')->where('section_key', 'contact')->first();

        $programs = Program::where('status', 'published')
            ->orderBy('sort_order', 'asc')
            ->get(['id', 'name', 'full_name', 'slug', 'code', 'short_description', 'location', 'commodities', 'logo']);

        $featuredProducts = Product::where('status', 'published')
            ->where('is_featured', true)
            ->with(['program:id,name,slug', 'partners:id,name,slug,category'])
            ->latest()
            ->take(6)
            ->get(['id', 'program_id', 'name', 'slug', 'short_description', 'main_image']);

        $featuredPartners = Partner::where('status', 'published')
            ->where('is_featured', true)
            ->with('programs:id,name,slug')
            ->latest()
            ->take(8)
            ->get(['id', 'name', 'slug', 'category', 'logo', 'short_description', 'address']);

        $stats = [
            'total_programs' => Program::where('status', 'published')->count(),
            'total_products' => Product::where('status', 'published')->count(),
            'total_partners' => Partner::where('status', 'published')->count(),
        ];

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

        // Settings / Contact Details
        $settings = Setting::pluck('value', 'key')->toArray();

        $contactData = [
            'email' => $contactContent?->metadata['email'] ?? ($settings['contact_email'] ?? 'p3t.lppm@unsoed.ac.id'),
            'phone' => $contactContent?->metadata['phone'] ?? ($settings['contact_phone'] ?? '+62 281 635292'),
            'address' => $contactContent?->metadata['address'] ?? ($settings['contact_address'] ?? 'Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto, Jawa Tengah 53122'),
            'hours' => $contactContent?->metadata['hours'] ?? 'Senin - Jumat: 08.00 - 16.00 WIB',
            'whatsapp' => $contactContent?->metadata['whatsapp'] ?? ($settings['contact_whatsapp'] ?? '+62 812-3456-7890'),
        ];

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
            'gallery' => $galleryContent?->metadata['items'] ?? $defaultGallery,
            'news' => $newsContent?->metadata['items'] ?? $defaultNews,
            'contact' => $contactData,
        ]);
    }
}
