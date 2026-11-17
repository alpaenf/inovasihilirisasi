<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Program;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Partner;
use App\Models\PageContent;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin.puskor@unsoed.ac.id'],
            [
                'name' => 'Administrator Inovasi Hilirisasi UNSOED',
                'password' => Hash::make('admin12345'),
            ]
        );

        // 2. The 4 Official Programs based on Open Recruitment Posters
        $pmupud = Program::where('slug', 'pm-upud')->orWhere('slug', 'pmupud')->first() ?: new Program();
        $pmupud->name = 'PM-UPUD';
        $pmupud->slug = 'pm-upud';
        $pmupud->code = 'PM-UPUD';
        $pmupud->full_name = 'Penerapan Teknologi Produksi MOcaf dan Produk Pangan Pokok Alternatif Pengganti Beras dan Terigu untuk Menguatkan Daya Saing Usaha Masyarakat Berbasis Potensi Lokal Unggulan Banjarnegara';
        $pmupud->short_description = 'Program PM-UPUD berfokus pada penerapan teknologi produksi MOcaf dan pengembangan produk pangan pokok alternatif sebagai pengganti beras dan terigu untuk memperkuat daya saing usaha masyarakat berbasis potensi lokal Banjarnegara.';
        $pmupud->description = 'Program PM-UPUD berfokus pada penerapan teknologi produksi MOcaf dan pengembangan produk pangan pokok alternatif sebagai pengganti beras dan terigu. Program ini bertujuan memperkuat daya saing usaha masyarakat melalui pemanfaatan potensi lokal unggulan Kabupaten Banjarnegara.';
        $pmupud->objectives = 'Memperkuat daya saing usaha masyarakat melalui pemanfaatan potensi lokal unggulan Kabupaten Banjarnegara dengan menerapkan teknologi produksi MOcaf, mengembangkan produk pangan pokok alternatif pengganti beras dan terigu, memperkuat pengelolaan usaha dan manajemen bisnis, mengembangkan branding dan pemasaran produk, serta meningkatkan kapasitas ekonomi masyarakat.';
        $pmupud->location = 'Kabupaten Banjarnegara, Jawa Tengah';
        $pmupud->commodities = [
            'Singkong',
            'MOcaf (Modified Cassava Flour)',
            'Produk pangan pokok alternatif',
        ];
        $pmupud->focus_activities = [
            'Penerapan teknologi produksi MOcaf.',
            'Pengembangan produk pangan pokok alternatif berbasis potensi lokal.',
            'Penguatan pengelolaan usaha dan manajemen bisnis.',
            'Pengembangan branding dan pemasaran produk.',
            'Peningkatan daya saing usaha masyarakat.',
        ];
        $pmupud->student_needs = [
            ['major' => 'Agribisnis', 'quota' => '1 orang'],
            ['major' => 'Teknologi Pangan', 'quota' => '1 orang'],
            ['major' => 'Manajemen', 'quota' => '1 orang'],
            ['major' => 'Akuntansi', 'quota' => '1 orang'],
        ];
        $pmupud->logo = null;
        $pmupud->banner = null;
        $pmupud->status = 'published';
        $pmupud->sort_order = 1;
        $pmupud->save();

        $sinergi = Program::where('slug', 'sinergi')->first() ?: new Program();
        $sinergi->name = 'SINERGI';
        $sinergi->slug = 'sinergi';
        $sinergi->code = 'SINERGI';
        $sinergi->full_name = 'Peningkatan Kapasitas Produksi dan Digitalisasi Pemasaran Pangan Fungsional dari Buah Carica bagi Optimalisasi Daya Saing Komoditas Indikasi Geografis Unggulan Dieng';
        $sinergi->short_description = 'Program SINERGI berfokus pada peningkatan kapasitas produksi dan digitalisasi pemasaran produk pangan fungsional berbahan dasar buah carica bagi optimalisasi daya saing komoditas indikasi geografis unggulan Dieng.';
        $sinergi->description = 'Program SINERGI berfokus pada peningkatan kapasitas produksi dan digitalisasi pemasaran produk pangan fungsional berbahan dasar buah carica. Program ini bertujuan mengoptimalkan daya saing produk carica sebagai komoditas indikasi geografis unggulan kawasan Dieng melalui pengembangan proses produksi dan pemanfaatan teknologi digital dalam pemasaran.';
        $sinergi->objectives = 'Mengoptimalkan daya saing produk carica sebagai komoditas indikasi geografis unggulan kawasan Dieng melalui peningkatan kapasitas produksi olahan carica, pengembangan produk pangan fungsional, optimalisasi proses produksi, digitalisasi pemasaran produk, serta penguatan branding komoditas unggulan.';
        $sinergi->location = 'Kabupaten Wonosobo, Jawa Tengah';
        $sinergi->commodities = [
            'Buah carica',
            'Produk pangan fungsional berbahan dasar carica',
        ];
        $sinergi->focus_activities = [
            'Peningkatan kapasitas produksi olahan carica.',
            'Pengembangan produk pangan fungsional.',
            'Optimalisasi proses produksi.',
            'Digitalisasi pemasaran produk.',
            'Penguatan branding dan daya saing komoditas unggulan Dieng.',
        ];
        $sinergi->student_needs = [
            ['major' => 'Teknologi Pangan', 'quota' => '2 orang'],
            ['major' => 'Teknik Pertanian', 'quota' => '1 orang'],
            ['major' => 'Agribisnis', 'quota' => '1 orang'],
            ['major' => 'Teknik Informatika', 'quota' => '1 orang'],
            ['major' => 'Ilmu Komunikasi', 'quota' => '1 orang'],
            ['major' => 'Manajemen / Akuntansi', 'quota' => '1 orang'],
        ];
        $sinergi->logo = null;
        $sinergi->banner = null;
        $sinergi->status = 'published';
        $sinergi->sort_order = 2;
        $sinergi->save();

        $doronganTeknologi = Program::where('slug', 'dorongan-teknologi')->orWhere('slug', 'dortek')->first() ?: new Program();
        $doronganTeknologi->name = 'Dorongan Teknologi';
        $doronganTeknologi->slug = 'dorongan-teknologi';
        $doronganTeknologi->code = 'DORTEK';
        $doronganTeknologi->full_name = 'Produksi Skala Pilot dan Pra-Komersial Mi Fungsional Bebas Gluten Berbasis Tepung Singkong Termodifikasi bagi Peningkatan TKT dan Akselerasi Komersialisasi Industri';
        $doronganTeknologi->short_description = 'Program Dorongan Teknologi berfokus pada produksi skala pilot dan pra-komersial mi fungsional bebas gluten berbasis tepung singkong termodifikasi bagi peningkatan TKT dan akselerasi komersialisasi industri.';
        $doronganTeknologi->description = 'Program Dorongan Teknologi berfokus pada pengembangan produksi mi fungsional bebas gluten berbasis tepung singkong termodifikasi. Program ini diarahkan pada produksi skala pilot dan pra-komersial untuk meningkatkan Tingkat Kesiapterapan Teknologi (TKT) serta mempercepat proses komersialisasi produk di sektor industri pangan.';
        $doronganTeknologi->objectives = 'Meningkatkan Tingkat Kesiapterapan Teknologi (TKT) dan mempercepat akselerasi komersialisasi industri melalui pengembangan mi fungsional bebas gluten, pemanfaatan tepung singkong termodifikasi sebagai bahan baku, pengembangan teknologi produksi mi, serta produksi skala pilot dan pra-komersial.';
        $doronganTeknologi->location = 'Kabupaten Banjarnegara, Jawa Tengah';
        $doronganTeknologi->commodities = [
            'Singkong',
            'Tepung singkong termodifikasi',
            'Mi fungsional bebas gluten',
        ];
        $doronganTeknologi->focus_activities = [
            'Pengembangan mi fungsional bebas gluten.',
            'Pemanfaatan tepung singkong termodifikasi sebagai bahan baku.',
            'Pengembangan teknologi produksi mi.',
            'Produksi skala pilot.',
            'Pengembangan produksi pra-komersial.',
            'Peningkatan Tingkat Kesiapterapan Teknologi (TKT).',
            'Akselerasi komersialisasi produk industri.',
        ];
        $doronganTeknologi->student_needs = [
            ['major' => 'Teknologi Pangan', 'quota' => '2 orang'],
            ['major' => 'Teknik Pertanian', 'quota' => '1 orang'],
            ['major' => 'Agribisnis', 'quota' => '1 orang'],
            ['major' => 'Teknik Informatika', 'quota' => '1 orang'],
            ['major' => 'Ilmu Komunikasi', 'quota' => '1 orang'],
            ['major' => 'Manajemen / Akuntansi', 'quota' => '1 orang'],
        ];
        $doronganTeknologi->logo = null;
        $doronganTeknologi->banner = null;
        $doronganTeknologi->status = 'published';
        $doronganTeknologi->sort_order = 3;
        $doronganTeknologi->save();

        $ajakanIndustri = Program::where('slug', 'ajakan-industri')->first() ?: new Program();
        $ajakanIndustri->name = 'Ajakan Industri';
        $ajakanIndustri->slug = 'ajakan-industri';
        $ajakanIndustri->code = 'AJAKAN INDUSTRI';
        $ajakanIndustri->full_name = 'Hilirisasi Teknologi Pengolahan Buah Nanas Berbasis Zero Waste untuk Meningkatkan Nilai Tambah dan Daya Saing Koperasi Merah Putih di Wilayah Sentra Komoditas';
        $ajakanIndustri->short_description = 'Program Ajakan Industri berfokus pada hilirisasi teknologi pengolahan buah nanas berbasis zero waste untuk meningkatkan nilai tambah dan daya saing Koperasi Merah Putih di wilayah sentra komoditas.';
        $ajakanIndustri->description = 'Program Ajakan Industri berfokus pada hilirisasi teknologi pengolahan buah nanas dengan pendekatan zero waste atau minim limbah. Program ini bertujuan meningkatkan nilai tambah komoditas nanas melalui penerapan teknologi pengolahan serta memperkuat daya saing Koperasi Merah Putih di wilayah sentra komoditas.';
        $ajakanIndustri->objectives = 'Meningkatkan nilai tambah komoditas nanas melalui penerapan teknologi pengolahan buah nanas, pengembangan produk olahan nanas berkualitas tinggi, pemanfaatan hasil samping pengolahan dengan pendekatan zero waste, serta memperkuat daya saing dan kapasitas kelembagaan Koperasi Merah Putih.';
        $ajakanIndustri->location = 'Kabupaten Bengkalis, Provinsi Riau';
        $ajakanIndustri->commodities = [
            'Buah nanas',
            'Produk olahan berbasis nanas',
            'Pemanfaatan hasil samping pengolahan nanas',
        ];
        $ajakanIndustri->focus_activities = [
            'Penerapan teknologi pengolahan buah nanas.',
            'Pengembangan produk olahan nanas.',
            'Pemanfaatan hasil samping pengolahan dengan pendekatan zero waste.',
            'Peningkatan nilai tambah komoditas nanas.',
            'Penguatan daya saing dan kapasitas koperasi.',
        ];
        $ajakanIndustri->student_needs = [
            ['major' => 'Teknologi Pangan', 'quota' => '2 orang'],
            ['major' => 'Teknik Pertanian', 'quota' => '1 orang'],
            ['major' => 'Agribisnis', 'quota' => '1 orang'],
            ['major' => 'Teknik Informatika', 'quota' => '1 orang'],
            ['major' => 'Ilmu Komunikasi', 'quota' => '1 orang'],
            ['major' => 'Manajemen / Akuntansi', 'quota' => '1 orang'],
        ];
        $ajakanIndustri->logo = null;
        $ajakanIndustri->banner = null;
        $ajakanIndustri->status = 'published';
        $ajakanIndustri->sort_order = 4;
        $ajakanIndustri->save();

        // 3. Official Industrial Partners (STRICTLY THE 4 PARTNERS FROM OFFICIAL POSTERS)
        // Clean up any old placeholder partners not in official list
        $allowedPartnerSlugs = [
            'ud-usaha-mandiri',
            'kwt-sinar-tani',
            'cv-gemilang-kencana',
            'koperasi-desa-merah-putih-penampi',
        ];

        // Detach and delete non-official partners
        $oldPartners = Partner::whereNotIn('slug', $allowedPartnerSlugs)->get();
        foreach ($oldPartners as $oldP) {
            $oldP->programs()->detach();
            $oldP->products()->detach();
            $oldP->delete();
        }

        // Define Official Partners
        $partnersData = [
            [
                'name' => 'UD Usaha Mandiri',
                'slug' => 'ud-usaha-mandiri',
                'category' => 'Industri Pengolahan Pangan',
                'logo' => '/images/partners/placeholder.png',
                'short_description' => 'Mitra industri pengolahan singkong, produksi tepung MOcaf, dan mi fungsional bebas gluten di Kabupaten Banjarnegara.',
                'description' => 'UD Usaha Mandiri merupakan mitra industri strategis yang berkolaborasi dalam dua program hilirisasi LPPM UNSOED: Program PM-UPUD (penerapan teknologi produksi MOcaf dan produk pangan pokok alternatif) serta Program Dorongan Teknologi (produksi skala pilot dan pra-komersial mi fungsional bebas gluten berbasis tepung singkong termodifikasi).',
                'address' => 'Kabupaten Banjarnegara, Jawa Tengah',
                'website' => null,
                'email' => 'ud.usahamandiri.bna@gmail.com',
                'phone' => '+62 812-3456-7891',
                'is_featured' => true,
                'status' => 'published',
                'programs' => [$pmupud->id, $doronganTeknologi->id], // PARTNER TO BOTH PM-UPUD & DORONGAN TEKNOLOGI
            ],
            [
                'name' => 'KWT Sinar Tani',
                'slug' => 'kwt-sinar-tani',
                'category' => 'Kelompok Usaha / KWT',
                'logo' => '/images/partners/placeholder.png',
                'short_description' => 'Kelompok Wanita Tani mitra pengembangan pangan pokok alternatif dan pemberdayaan ekonomi masyarakat berbasis potensi lokal Banjarnegara.',
                'description' => 'KWT Sinar Tani merupakan kelompok usaha wanita tani di Kabupaten Banjarnegara yang bermitra dalam Program PM-UPUD. Kemitraan difokuskan pada penerapan teknologi pengolahan singkong menjadi MOcaf, pengembangan produk pangan pokok alternatif pengganti beras dan terigu, serta penguatan manajemen usaha dan pemasaran kelompok.',
                'address' => 'Kabupaten Banjarnegara, Jawa Tengah',
                'website' => null,
                'email' => 'kwt.sinartani.bna@gmail.com',
                'phone' => '+62 813-9876-5431',
                'is_featured' => true,
                'status' => 'published',
                'programs' => [$pmupud->id], // PARTNER TO PM-UPUD
            ],
            [
                'name' => 'CV Gemilang Kencana',
                'slug' => 'cv-gemilang-kencana',
                'category' => 'Industri Pengolahan Pangan',
                'logo' => '/images/partners/placeholder.png',
                'short_description' => 'Mitra industri pengolahan buah carica Dieng dalam peningkatan kapasitas produksi dan digitalisasi pemasaran pangan fungsional.',
                'description' => 'CV Gemilang Kencana merupakan pelaku industri pengolahan komoditas buah carica di Kabupaten Wonosobo. Menjadi mitra industri tunggal dalam Program SINERGI untuk optimalisasi proses produksi pangan fungsional berbahan dasar buah carica, penguatan branding, dan pemanfaatan teknologi digital dalam pemasaran komoditas indikasi geografis unggulan Dieng.',
                'address' => 'Kabupaten Wonosobo, Jawa Tengah',
                'website' => null,
                'email' => 'gemilangkencana.dieng@gmail.com',
                'phone' => '+62 811-2345-6789',
                'is_featured' => true,
                'status' => 'published',
                'programs' => [$sinergi->id], // PARTNER TO SINERGI
            ],
            [
                'name' => 'Koperasi Desa Merah Putih Penampi',
                'slug' => 'koperasi-desa-merah-putih-penampi',
                'category' => 'Koperasi / Sentra Komoditas',
                'logo' => '/images/partners/placeholder.png',
                'short_description' => 'Koperasi sentra nanas yang bermitra dalam hilirisasi teknologi pengolahan buah nanas berbasis zero waste di Kabupaten Bengkalis.',
                'description' => 'Koperasi Desa Merah Putih Penampi berlokasi di sentra komoditas nanas Kabupaten Bengkalis, Provinsi Riau. Bermitra dalam Program Ajakan Industri untuk menerapkan teknologi pengolahan buah nanas terpadu, pemanfaatan hasil samping berprinsip zero waste, peningkatan nilai tambah komoditas, serta penguatan daya saing dan kapasitas kelembagaan koperasi.',
                'address' => 'Kabupaten Bengkalis, Provinsi Riau',
                'website' => null,
                'email' => 'koperasi.merahputih.penampi@gmail.com',
                'phone' => '+62 822-8765-4321',
                'is_featured' => true,
                'status' => 'published',
                'programs' => [$ajakanIndustri->id], // PARTNER TO AJAKAN INDUSTRI
            ],
        ];

        $partnerModels = [];
        foreach ($partnersData as $pData) {
            $programsAttach = $pData['programs'];
            unset($pData['programs']);
            $partner = Partner::updateOrCreate(['slug' => $pData['slug']], $pData);
            $partner->programs()->sync($programsAttach);
            $partnerModels[$partner->slug] = $partner;
        }

        // 4. Products aligned with the 4 Programs and Commodities
        // Reset old products to ensure clean alignment
        Product::query()->delete();

        $products = [
            // PM-UPUD Products
            [
                'program_id' => $pmupud->id,
                'name' => 'Tepung MOcaf Terstandarisasi Grade Pangan Banjarnegara',
                'slug' => 'tepung-mocaf-terstandarisasi-banjarnegara',
                'short_description' => 'Tepung singkong termodifikasi berkualitas tinggi pengganti terigu untuk aneka produk olahan pangan lokal berdaya saing.',
                'description' => 'Produk tepung singkong termodifikasi (MOcaf) yang diproduksi melalui penerapan teknologi fermentasi terstandarisasi di Kabupaten Banjarnegara. Memiliki derajat putih tinggi, aroma netral tanpa bau apek, dan sifat gelatinisasi yang menyerupai terigu, menjadikannya bahan baku substitusi terigu yang sangat potensial untuk industri pangan dan UMKM.',
                'main_image' => '/images/products/gula-semut.jpg',
                'benefits' => "1. Bebas gluten alami (gluten-free) dan kaya serat pangan.\n2. Mengurangi ketergantungan impor gandum/terigu nasional.\n3. Nilai tambah singkong petani meningkat hingga 200%.\n4. Diproduksi sesuai standar higienitas dan keamanan pangan.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['ud-usaha-mandiri']->id, $partnerModels['kwt-sinar-tani']->id],
            ],
            [
                'program_id' => $pmupud->id,
                'name' => 'Produk Pangan Pokok Alternatif Pengganti Beras Berbasis MOcaf',
                'slug' => 'pangan-pokok-alternatif-pengganti-beras-mocaf',
                'short_description' => 'Inovasi pangan pokok alternatif kaya serat pengganti beras dan terigu berbahan dasar potensi lokal Banjarnegara.',
                'description' => 'Produk diversifikasi pangan pokok berbentuk butiran analog beras dan olahan pangan sehat yang diformulasikan dari tepung singkong termodifikasi (MOcaf) dan bahan lokal Banjarnegara. Diciptakan untuk mendukung ketahanan pangan lokal dan memperkuat daya saing usaha KWT Sinar Tani.',
                'main_image' => '/images/products/perajang-tempe.jpg',
                'benefits' => "1. Indeks glikemik lebih rendah dibanding beras putih konvensional.\n2. Sumber energi alternatif sehat bagi masyarakat.\n3. Membuka peluang usaha mandiri bagi kelompok wanita tani (KWT).\n4. Kemasan higienis berdaya simpan lebih lama.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['kwt-sinar-tani']->id, $partnerModels['ud-usaha-mandiri']->id],
            ],

            // SINERGI Products
            [
                'program_id' => $sinergi->id,
                'name' => 'Pangan Fungsional Buah Carica Dieng Antioksidan Tinggi',
                'slug' => 'pangan-fungsional-buah-carica-dieng',
                'short_description' => 'Produk olahan pangan fungsional berbahan dasar buah carica khas Dieng dengan kandungan nutrisi dan antioksidan optimal.',
                'description' => 'Pengembangan produk pangan fungsional berbasis buah carica Dieng melalui optimalisasi proses produksi bersama CV Gemilang Kencana di Wonosobo. Menggunakan proses pasteurisasi terkontrol untuk menjaga kestabilan vitamin C, enzim papain alami, dan senyawa fitokimia buah carica.',
                'main_image' => '/images/products/iot-tambak.jpg',
                'benefits' => "1. Kaya antioksidan, serat alami, dan vitamin esensial.\n2. Menjaga citarasa otentik komoditas indikasi geografis Dieng.\n3. Proses produksi efisien dengan standar mutu industri pangan.\n4. Mendukung daya saing komoditas unggulan Kabupaten Wonosobo.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['cv-gemilang-kencana']->id],
            ],
            [
                'program_id' => $sinergi->id,
                'name' => 'Sistem Digitalisasi Pemasaran Komoditas Carica Dieng',
                'slug' => 'sistem-digitalisasi-pemasaran-carica-dieng',
                'short_description' => 'Platform katalog digital dan ekosistem pemasaran online untuk memperluas jangkauan pasar komoditas unggulan Dieng.',
                'description' => 'Inovasi digitalisasi pemasaran yang dirancang khusus untuk memfasilitasi integrasi pemasaran produk pangan fungsional buah carica CV Gemilang Kencana ke kanal e-commerce dan pasar nasional secara terstruktur dan terukur.',
                'main_image' => '/images/products/solar-dryer.jpg',
                'benefits' => "1. Memperluas akses pasar produk carica ke luar kawasan Dieng.\n2. Manajemen inventori produk dan pesanan terintegrasi.\n3. Penguatan citra merek (branding) komoditas indikasi geografis.\n4. Mempermudah transaksi bagi konsumen retail maupun mitra distributor.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['cv-gemilang-kencana']->id],
            ],

            // Dorongan Teknologi Products
            [
                'program_id' => $doronganTeknologi->id,
                'name' => 'Mi Fungsional Bebas Gluten Berbasis Tepung Singkong Termodifikasi',
                'slug' => 'mi-fungsional-bebas-gluten-singkong-termodifikasi',
                'short_description' => 'Mi sehat bebas gluten skala pilot berbahan baku tepung singkong termodifikasi untuk diversifikasi pangan industri.',
                'description' => 'Produk mi fungsional 100% bebas gluten (gluten-free) yang berhasil dikembangkan hingga skala pilot bersama UD Usaha Mandiri di Banjarnegara. Diformulasikan khusus dari tepung singkong termodifikasi untuk menghasilkan tekstur kenyal dan elastis tanpa bahan tambahan sintetik berbahaya.',
                'main_image' => '/images/products/chopper-pakan.jpg',
                'benefits' => "1. Pilihan pangan sehat bagi penderita alergi gluten dan celiac disease.\n2. Memiliki tekstur kenyal alami tanpa gluten sintetis.\n3. Nilai cerna tinggi dan aman untuk seluruh kelompok usia.\n4. Substitusi strategis mi terigu untuk industri pangan skala menengah-besar.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['ud-usaha-mandiri']->id],
            ],
            [
                'program_id' => $doronganTeknologi->id,
                'name' => 'Lini Produksi Skala Pilot Mi Bebas Gluten Berdaya Saing Industri',
                'slug' => 'lini-produksi-pilot-mi-bebas-gluten',
                'short_description' => 'Sistem permesinan dan rekayasa proses skala pilot untuk akselerasi komersialisasi mi bebas gluten ber-TKT tinggi.',
                'description' => 'Rangkaian teknologi proses produksi mi skala pilot dan pra-komersial yang diimplementasikan di fasilitas UD Usaha Mandiri Banjarnegara. Mencakup unit pengadukan otomatis, ekstrusi suhu rendah, dan pengeringan terukur guna memastikan kesiapterapan teknologi (TKT 7-8).',
                'main_image' => '/images/products/briket-biomassa.jpg',
                'benefits' => "1. Kapasitas produksi skala pilot memenuhi standar uji pasar industri.\n2. Parameter proses tercatat akurat dan konsisten per batch.\n3. Peningkatan kesiapan teknologi (TKT) menuju komersialisasi penuh.\n4. Efisiensi energi proses hingga 30% dibanding sistem manual.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['ud-usaha-mandiri']->id],
            ],

            // Ajakan Industri Products
            [
                'program_id' => $ajakanIndustri->id,
                'name' => 'Produk Olahan Buah Nanas Sentra Bengkalis Higienis',
                'slug' => 'produk-olahan-buah-nanas-sentra-bengkalis',
                'short_description' => 'Inovasi aneka olahan buah nanas bernilai tambah tinggi hasil hilirisasi teknologi bersama Koperasi Merah Putih.',
                'description' => 'Hasil penerapan teknologi pengolahan nanas modern di sentra komoditas Kabupaten Bengkalis bersama Koperasi Desa Merah Putih Penampi. Mengembangkan aneka olahan buah nanas seperti sari nanas murni, selai higienis, dan kripik nanas renyah dengan standar mutu komersial.',
                'main_image' => '/images/products/gula-semut.jpg',
                'benefits' => "1. Meningkatkan nilai tambah buah nanas segar saat musim panen raya.\n2. Mengurangi susut panen (loss) nanas di tingkat petani sentra.\n3. Standar higienis tinggi dengan daya simpan lebih panjang.\n4. Memperkuat portofolio usaha dan omzet Koperasi Desa Merah Putih.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['koperasi-desa-merah-putih-penampi']->id],
            ],
            [
                'program_id' => $ajakanIndustri->id,
                'name' => 'Pakan dan Produk Turunan Hasil Samping Nanas Berbasis Zero Waste',
                'slug' => 'produk-turunan-hasil-samping-nanas-zero-waste',
                'short_description' => 'Teknologi pemanfaatan kulit dan limbah pengolahan nanas menjadi produk bernilai ekonomi tinggi tanpa limbah terbuang.',
                'description' => 'Inovasi penerapan prinsip zero waste dalam industri pengolahan nanas Bengkalis. Kulit nanas, ampas ekstraksi, dan bonggol diolah menggunakan bioteknologi fermentasi menjadi pakan ternak berkualitas dan pupuk organik hayati, sehingga seluruh bagian buah termanfaatkan secara sirkular.',
                'main_image' => '/images/products/solar-dryer.jpg',
                'benefits' => "1. Menghilangkan limbah lingkungan industri pengolahan nanas (zero waste).\n2. Menghasilkan pakan ternak bernutrisi tinggi berbiaya terjangkau.\n3. Sumber pendapatan tambahan bagi koperasi dari hasil samping.\n4. Model percontohan ekonomi sirkular ramah lingkungan di Kabupaten Bengkalis.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['koperasi-desa-merah-putih-penampi']->id],
            ],
        ];

        foreach ($products as $prod) {
            $partnersToAttach = $prod['partners'];
            unset($prod['partners']);
            $productModel = Product::create($prod);
            $productModel->partners()->sync($partnersToAttach);

            ProductGallery::create([
                'product_id' => $productModel->id,
                'image_path' => $prod['main_image'],
                'caption' => 'Dokumentasi ' . $prod['name'],
                'sort_order' => 1,
            ]);
        }

        // 5. Page Contents: Profile & Organization with Accurate Divisions and Student Requirements
        PageContent::updateOrCreate(
            ['page_key' => 'home', 'section_key' => 'hero'],
            [
                'title' => 'Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak.',
                'content' => 'Inovasi Hilirisasi Universitas Jenderal Soedirman mengoordinasikan empat program hilirisasi riset strategis: PM-UPUD, SINERGI, Dorongan Teknologi, dan Ajakan Industri bersama mitra industri dan masyarakat.',
                'image' => '/images/hero-unsoed.jpg',
                'metadata' => [
                    'eyebrow' => 'UNIVERSITAS JENDERAL SOEDIRMAN',
                    'cta_primary' => ['label' => 'Jelajahi Program', 'url' => '/program'],
                    'cta_secondary' => ['label' => 'Lihat Produk', 'url' => '/produk'],
                ],
            ]
        );

        PageContent::updateOrCreate(
            ['page_key' => 'about', 'section_key' => 'profile'],
            [
                'title' => 'Profil Inovasi Hilirisasi Universitas Jenderal Soedirman',
                'content' => 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi berada di bawah Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) Universitas Jenderal Soedirman. Bertindak sebagai akselerator yang menjembatani riset hilirisasi komoditas unggulan daerah ke sektor industri dan masyarakat.',
                'image' => '/images/about-unsoed.jpg',
                'metadata' => [
                    'vision' => 'Menjadi pusat hilirisasi dan alih teknologi unggulan yang mengangkat potensi komoditas lokal dan memperkuat daya saing industri nasional.',
                    'mission' => [
                        'Memfasilitasi hilirisasi hasil riset teknologi sivitas akademika UNSOED ke sektor industri nyata.',
                        'Membangun kemitraan strategis yang berkelanjutan bersama industri dan kelompok usaha masyarakat di sentra komoditas.',
                        'Mengakselerasi peningkatan Kesiapterapan Teknologi (TKT) dan komersialisasi produk pangan lokal terstandar.',
                    ],
                ],
            ]
        );

        PageContent::updateOrCreate(
            ['page_key' => 'about', 'section_key' => 'organization'],
            [
                'title' => 'Struktur Organisasi Inovasi Hilirisasi',
                'content' => 'Struktur kepemimpinan dan pembagian divisi pelaksana empat program unggulan hilirisasi teknologi dan riset terapan di lingkungan LPPM Universitas Jenderal Soedirman.',
                'image' => null,
                'metadata' => [
                    'leaders' => [
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
                            'description' => 'Pengarah operasional pelaksanaan riset terapan, pengabdian masyarakat, dan hilirisasi inovasi.',
                            'photo' => null,
                        ],
                        [
                            'id' => 'leader_3',
                            'name' => 'Dr. Ing. Ridwan, S.T., M.T.',
                            'position' => 'Koordinator Pusat Inovasi Hilirisasi',
                            'category' => 'Pimpinan Eksekutif',
                            'description' => 'Penanggung jawab operasional hilirisasi, koordinasi program, dan fasilitasi kerja sama industri.',
                            'photo' => null,
                        ],
                        [
                            'id' => 'leader_4',
                            'name' => 'Dr. Hendro Prasetiyo, S.T., M.T.',
                            'position' => 'Sekretaris & Penjaminan Mutu',
                            'category' => 'Tata Kelola & Penjaminan Mutu',
                            'description' => 'Pengelolaan administrasi legal, penjaminan mutu program, monitoring evaluasi, dan akuntabilitas hilirisasi.',
                            'photo' => null,
                        ],
                    ],
                    'divisions' => [
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
                    ],
                    'students' => [
                        // PM-UPUD Students (4 orang)
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

                        // SINERGI Students (7 orang)
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

                        // Dorongan Teknologi Students (7 orang)
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

                        // Ajakan Industri Students (7 orang)
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
                    ],
                ],
            ]
        );

        // 6. Settings
        $defaultSettings = [
            ['key' => 'site_name', 'display_name' => 'Nama Website', 'value' => 'Inovasi Hilirisasi Universitas Jenderal Soedirman', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'display_name' => 'Tagline', 'value' => 'Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_email', 'display_name' => 'Email Resmi', 'value' => 'p3t.lppm@unsoed.ac.id', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'display_name' => 'Telepon / WhatsApp', 'value' => '+62 281 635292', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'display_name' => 'Alamat Kantor', 'value' => 'Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto, Jawa Tengah 53122', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'footer_copyright', 'display_name' => 'Teks Hak Cipta', 'value' => '© 2026 Inovasi Hilirisasi Universitas Jenderal Soedirman. Hak Cipta Dilindungi.', 'type' => 'text', 'group' => 'general'],
        ];

        foreach ($defaultSettings as $st) {
            Setting::updateOrCreate(['key' => $st['key']], $st);
        }
    }
}
