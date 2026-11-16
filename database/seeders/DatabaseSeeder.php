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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin.puskor@unsoed.ac.id'],
            [
                'name' => 'Administrator PUSKOR UNSOED',
                'password' => Hash::make('admin12345'),
            ]
        );

        // 2. The 4 Core Programs
        $sinergi = Program::updateOrCreate(
            ['slug' => 'sinergi'],
            [
                'name' => 'SINERGI',
                'code' => 'SIN',
                'short_description' => 'Program kolaborasi riset strategis dan transfer teknologi terpadu antara akademisi UNSOED, masyarakat, dan industri.',
                'description' => 'SINERGI merupakan program unggulan PUSKOR Universitas Jenderal Soedirman yang dirancang untuk mengintegrasikan kapabilitas riset laboratorium dengan kebutuhan nyata masyarakat dan industri. Melalui konsorsium riset multipihak, program ini mendorong alih teknologi berkelanjutan untuk meningkatkan daya saing ekonomi berbasis potensi lokal perdesaan dan pesisir.',
                'logo' => null,
                'banner' => null,
                'status' => 'published',
                'sort_order' => 1,
            ]
        );

        $ajakanIndustri = Program::updateOrCreate(
            ['slug' => 'ajakan-industri'],
            [
                'name' => 'AJAKAN INDUSTRI',
                'code' => 'AI',
                'short_description' => 'Inisiatif kemitraan strategis yang menghubungkan tantangan industri komersial dengan solusi teknologi tepat guna kampus.',
                'description' => 'Program AJAKAN INDUSTRI memfasilitasi penjajakan bersama, perancangan prototipe skala industri, rekayasa nilai, hingga komersialisasi teknologi antara peneliti Universitas Jenderal Soedirman dan mitra korporasi nasional maupun multinasional. Program ini memastikan setiap inovasi memiliki kesiapan teknologi (TKT 7-9) untuk diadopsi pasar.',
                'logo' => null,
                'banner' => null,
                'status' => 'published',
                'sort_order' => 2,
            ]
        );

        $pmupud = Program::updateOrCreate(
            ['slug' => 'pmupud'],
            [
                'name' => 'PMUPUD',
                'code' => 'PMU',
                'short_description' => 'Program Pengembangan Usaha Produk Unggulan Daerah berbasis riset teknologi tepat guna UNSOED.',
                'description' => 'PMUPUD berfokus pada pendampingan teknis, transfer mesin peralatan tepat guna, dan peningkatan standar mutu untuk klaster UMKM di wilayah Banyumas Raya dan Jawa Tengah. Inovasi yang diterapkan meningkatkan efisiensi proses, higienitas, kapasitas produksi, dan nilai jual produk unggulan lokal.',
                'logo' => null,
                'banner' => null,
                'status' => 'published',
                'sort_order' => 3,
            ]
        );

        $dortek = Program::updateOrCreate(
            ['slug' => 'dortek'],
            [
                'name' => 'DORTEK',
                'code' => 'DOR',
                'short_description' => 'Diseminasi dan Orientasi Teknologi untuk percepatan adopsi inovasi ramah lingkungan di komunitas masyarakat.',
                'description' => 'DORTEK menghadirkan teknologi tepat guna ramah lingkungan langsung ke tengah masyarakat tani, nelayan, dan pengrajin desa. Melalui pelatihan terstruktur dan pendampingan lapang, masyarakat dibekali keterampilan mengoperasikan serta memelihara teknologi secara mandiri untuk kemandirian ekonomi desa.',
                'logo' => null,
                'banner' => null,
                'status' => 'published',
                'sort_order' => 4,
            ]
        );

        // 3. Partners
        $partners = [
            [
                'name' => 'PT Pupuk Indonesia (Persero)',
                'slug' => 'pt-pupuk-indonesia',
                'category' => 'BUMN',
                'logo' => '/images/partners/pupuk-indonesia.png',
                'short_description' => 'Mitra riset bersama dalam formulasi pupuk hayati berbasis mikroba lokal dan efisiensi serapan hara tanaman pangan.',
                'description' => 'Kolaborasi strategis pengembangan formula biostimulan dan uji efikasi pupuk hayati pada lahan sawah tadah hujan di Jawa Tengah.',
                'address' => 'Jl. Kemanggisan Utama No. 7, Jakarta Barat',
                'website' => 'https://www.pupuk-indonesia.com',
                'email' => 'info@pupuk-indonesia.com',
                'phone' => '+62-21-53654900',
                'is_featured' => true,
                'status' => 'published',
                'programs' => [$sinergi->id, $ajakanIndustri->id],
            ],
            [
                'name' => 'Pemerintah Kabupaten Banyumas',
                'slug' => 'pemkab-banyumas',
                'category' => 'Pemerintah',
                'logo' => '/images/partners/pemkab-banyumas.png',
                'short_description' => 'Dinas Pertanian dan Ketahanan Pangan Kabupaten Banyumas dalam diseminasi teknologi tepat guna pedesaan.',
                'description' => 'Penerapan teknologi pertanian ramah lingkungan, pengering gabah hibrida, dan pengolahan limbah organik terpadu di tingkat kelompok tani.',
                'address' => 'Jl. Kabupaten No. 1, Purwokerto',
                'website' => 'https://banyumaskab.go.id',
                'email' => 'humas@banyumaskab.go.id',
                'phone' => '+62-281-636001',
                'is_featured' => true,
                'status' => 'published',
                'programs' => [$dortek->id, $pmupud->id],
            ],
            [
                'name' => 'PT Charoen Pokphand Indonesia Tbk',
                'slug' => 'pt-charoen-pokphand-indonesia',
                'category' => 'Industri',
                'logo' => '/images/partners/cp-indonesia.png',
                'short_description' => 'Kemitraan industri peternakan terpadu dalam rekayasa formulasi pakan alternatif berbasis limbah agroindustri.',
                'description' => 'Kerjasama riset formulasi konsentrat pakan unggas dan ruminansia memanfaatkan limbah pengolahan singkong dan jagung lokal.',
                'address' => 'Jl. Ancol Barat VIII No. 1, Jakarta Utara',
                'website' => 'https://cp.co.id',
                'email' => 'contact@cp.co.id',
                'phone' => '+62-21-6919999',
                'is_featured' => true,
                'status' => 'published',
                'programs' => [$ajakanIndustri->id],
            ],
            [
                'name' => 'Gapoktan Sri Rejeki Rawalo',
                'slug' => 'gapoktan-sri-rejeki-rawalo',
                'category' => 'UMKM / Komunitas',
                'logo' => '/images/partners/gapoktan.png',
                'short_description' => 'Kelompok tani percontohan adopsi mesin perontok dan pengering gabah hibrida hemat energi.',
                'description' => 'Penerima manfaat program diseminasi DORTEK dalam modernisasi pascapanen padi untuk meminimalisasi susut panen (loss reduction).',
                'address' => 'Kecamatan Rawalo, Kabupaten Banyumas',
                'website' => null,
                'email' => 'gapoktan.srirejeki@gmail.com',
                'phone' => '+62-812-3456-7890',
                'is_featured' => false,
                'status' => 'published',
                'programs' => [$dortek->id],
            ],
            [
                'name' => 'Koperasi Nira Satria Banyumas',
                'slug' => 'koperasi-nira-satria',
                'category' => 'UMKM',
                'logo' => '/images/partners/nira-satria.png',
                'short_description' => 'Klaster produsen gula kelapa kristal organik berstandar ekspor binaan PMUPUD UNSOED.',
                'description' => 'Penerapan kristalisator semi-otomatis dan evaporator hemat bahan bakar untuk produksi gula semut kelapa organik berstandar ekspor.',
                'address' => 'Cilongok, Kabupaten Banyumas',
                'website' => 'https://nirasatria.id',
                'email' => 'sales@nirasatria.id',
                'phone' => '+62-813-9876-5432',
                'is_featured' => true,
                'status' => 'published',
                'programs' => [$pmupud->id],
            ],
        ];

        $partnerModels = [];
        foreach ($partners as $pData) {
            $programsAttach = $pData['programs'];
            unset($pData['programs']);
            $partner = Partner::updateOrCreate(['slug' => $pData['slug']], $pData);
            $partner->programs()->sync($programsAttach);
            $partnerModels[$partner->slug] = $partner;
        }

        // 4. Products Catalog
        $products = [
            [
                'program_id' => $dortek->id,
                'name' => 'Alat Pengering Gabah Tenaga Surya Hibrida Terintegrasi',
                'slug' => 'alat-pengering-gabah-tenaga-surya-hibrida',
                'short_description' => 'Mesin pengering gabah hemat energi dengan kombinasi kolektor surya dan biomassa untuk menjaga kualitas kadar air panen.',
                'description' => 'Alat Pengering Gabah Hibrida dirancang oleh tim peneliti UNSOED untuk mengatasi kendala penjemuran gabah saat musim hujan. Menggunakan penukar panas (heat exchanger) efisiensi tinggi dengan sumber panas ganda: radiasi matahari pada siang hari dan biomassa sekam padi pada malam hari atau cuaca mendung. Mampu menurunkan kadar air gabah dari 25% menjadi 14% dalam waktu 6 jam dengan kapasitas 1 ton per siklus.',
                'main_image' => '/images/products/solar-dryer.jpg',
                'benefits' => "1. Mencegah susut gabah akibat jamur saat musim hujan.\n2. Menghemat konsumsi energi hingga 65% dibanding pengering diesel konvensional.\n3. Mudah dioperasikan oleh operator kelompok tani desa.\n4. Mempertahankan rendemen beras kepala di atas 85%.",
                'external_url' => 'https://lppm.unsoed.ac.id/inovasi/pengering-gabah',
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['pemkab-banyumas']->id, $partnerModels['gapoktan-sri-rejeki-rawalo']->id],
            ],
            [
                'program_id' => $pmupud->id,
                'name' => 'Mesin Kristalisator Gula Semut Kelapa Semi-Otomatis',
                'slug' => 'mesin-kristalisator-gula-semut-semi-otomatis',
                'short_description' => 'Inovasi pengaduk mekanis berkecepatan variabel untuk meningkatkan rendemen dan keseragaman butir gula kelapa kristal.',
                'description' => 'Alat pengaduk dan kristalisasi nira kelapa matang dengan bilah pengaduk stainless steel grade pangan (SS 304). Menggantikan proses pengadukan manual yang melelahkan, meningkatkan rendemen butiran gula semut hingga 92%, dan menurunkan risiko gosong akibat panas berlebih.',
                'main_image' => '/images/products/gula-semut.jpg',
                'benefits' => "1. Standar higienitas tinggi memenuhi sertifikasi HACCP & Organik.\n2. Efisiensi tenaga kerja hingga 70% pada proses kristalisasi.\n3. Kapasitas olah 25 kg nira pekat per batch.\n4. Butiran gula lebih seragam dan cepat larut.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['koperasi-nira-satria']->id],
            ],
            [
                'program_id' => $ajakanIndustri->id,
                'name' => 'Mesin Pencetak Briket Biomassa Limbah Pertanian Kapasitas Tinggi',
                'slug' => 'mesin-pencetak-briket-biomassa-limbah-pertanian',
                'short_description' => 'Mesin pemadat hidrolik bertekanan tinggi untuk mengkonversi limbah tongkol jagung dan sekam padi menjadi bahan bakar industri.',
                'description' => 'Inovasi mesin ekstruder hidrolik briket yang dirancang bekerja sama dengan mitra industri energi hijau. Mampu menghasilkan briket biomassa berkalori 4.800 kcal/kg tanpa bahan pengikat kimia, sangat cocok untuk substitusi batu bara pada boiler industri.',
                'main_image' => '/images/products/briket-biomassa.jpg',
                'benefits' => "1. Nilai kalori tinggi setara sub-bituminus.\n2. Kapasitas output 350 kg/jam.\n3. Emisi sulfur dan abu sangat rendah.\n4. Membuka nilai ekonomi baru bagi limbah pertanian pedesaan.",
                'external_url' => 'https://unsoed.ac.id/riset/briket-biomassa',
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['pt-charoen-pokphand-indonesia']->id],
            ],
            [
                'program_id' => $sinergi->id,
                'name' => 'Sistem IoT Telemetri Pemantauan Kualitas Air Tambak Payau',
                'slug' => 'sistem-iot-telemetri-kualitas-air-tambak-payau',
                'short_description' => 'Perangkat pemantau dissolved oxygen (DO), pH, salinitas, dan suhu air tambak berbasis sensor cerdas dan transmisi LoRaWAN.',
                'description' => 'Stasiun sensor terapung bertenaga panel surya yang memonitor parameter vital air tambak udang vaname secara real-time. Data ditransmisikan secara nirkabel jarak jauh hingga 10 km ke aplikasi smartphone petani dan dashboard monitoring laboratorium.',
                'main_image' => '/images/products/iot-tambak.jpg',
                'benefits' => "1. Peringatan dini (early warning alert) via WhatsApp bila DO turun kritis.\n2. Mengurangi tingkat kematian udang hingga 40%.\n3. Baterai tahan 30 hari tanpa sinar matahari.\n4. Dashboard analitik histori tren parameter air.",
                'external_url' => null,
                'is_featured' => true,
                'status' => 'published',
                'partners' => [$partnerModels['pt-pupuk-indonesia']->id],
            ],
            [
                'program_id' => $dortek->id,
                'name' => 'Chopper Pencacah Pakan Ternak Multifungsi Portabel',
                'slug' => 'chopper-pencacah-pakan-ternak-portabel',
                'short_description' => 'Mesin pencacah rumput gajah, jerami, dan tebon jagung dengan pengatur ukuran cacahan untuk fermentasi silase.',
                'description' => 'Mesin pencacah berbobot ringan yang dapat dipindah dengan mudah di area kandang kelompok peternak. Dilengkapi dengan mata pisau baja tempa berkekuatan tinggi untuk menghasilkan ukuran cacahan seragam 2–3 cm yang ideal untuk pakan fermentasi ruminansia.',
                'main_image' => '/images/products/chopper-pakan.jpg',
                'benefits' => "1. Meningkatkan palatabilitas pakan ternak hingga 95%.\n2. Efisiensi waktu pencacahan jerami dibanding manual.\n3. Konsumsi bahan bakar sangat irit (motor bensin 6.5 HP).\n4. Sistem pengaman operator berstandar K3.",
                'external_url' => null,
                'is_featured' => false,
                'status' => 'published',
                'partners' => [$partnerModels['pemkab-banyumas']->id],
            ],
            [
                'program_id' => $pmupud->id,
                'name' => 'Alat Pembersih dan Perajang Tempe Higienis Stainless Steel',
                'slug' => 'alat-pembersih-perajang-tempe-higienis',
                'short_description' => 'Mesin pengiris tempe otomatis berkecepatan 120 irisan/menit dengan ketebalan presisi untuk produsen keripik tempe.',
                'description' => 'Inovasi peralatan mekanik tepat guna untuk pengrajin keripik tempe khas Purwokerto/Banyumas. Menghasilkan irisan tempe tipis 1.2 mm yang konsisten tanpa hancur, meningkatkan kapasitas goreng dan kerenyahan produk akhir.',
                'main_image' => '/images/products/perajang-tempe.jpg',
                'benefits' => "1. Ketebalan irisan presisi seragam 1.2 mm.\n2. Material seluruhnya Food Grade Stainless Steel 304.\n3. Kapasitas produksi naik 400% dibanding pisau manual.\n4. Mudah dicuci dan dirawat.",
                'external_url' => null,
                'is_featured' => false,
                'status' => 'published',
                'partners' => [$partnerModels['pemkab-banyumas']->id],
            ],
        ];

        foreach ($products as $prod) {
            $partnersToAttach = $prod['partners'];
            unset($prod['partners']);
            $productModel = Product::updateOrCreate(['slug' => $prod['slug']], $prod);
            $productModel->partners()->sync($partnersToAttach);

            // Add sample gallery photos
            ProductGallery::updateOrCreate(
                ['product_id' => $productModel->id, 'image_path' => $prod['main_image']],
                ['caption' => 'Uji Operasional Produk ' . $prod['name'], 'sort_order' => 1]
            );
        }

        // 5. Page Contents (Beranda & Tentang PUSKOR)
        PageContent::updateOrCreate(
            ['page_key' => 'home', 'section_key' => 'hero'],
            [
                'title' => 'Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak.',
                'content' => 'PUSKOR Universitas Jenderal Soedirman menjadi wadah koordinasi pengembangan dan penerapan teknologi melalui kolaborasi, inovasi, serta pemberdayaan berbagai sektor.',
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
                'title' => 'Profil PUSKOR Universitas Jenderal Soedirman',
                'content' => 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi (PUSKOR) berada di bawah Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) Universitas Jenderal Soedirman. PUSKOR bertindak sebagai orkestrator yang menjembatani riset akademis para dosen dan peneliti ke dalam implementasi nyata di masyarakat dan industri.',
                'image' => '/images/about-unsoed.jpg',
                'metadata' => [
                    'vision' => 'Menjadi pusat unggulan koordinasi dan penerapan teknologi tepat guna yang berakar pada kearifan lokal dan berdaya saing global.',
                    'mission' => [
                        'Memfasilitasi hilirisasi hasil riset teknologi civitas akademika UNSOED.',
                        'Membangun kemitraan strategis dengan industri, pemerintah daerah, dan komunitas.',
                        'Mendorong diseminasi teknologi tepat guna untuk pengentasan kemiskinan dan kemandirian desa.',
                    ],
                ],
            ]
        );

        // 6. Settings
        $defaultSettings = [
            ['key' => 'site_name', 'display_name' => 'Nama Website', 'value' => 'PUSKOR Universitas Jenderal Soedirman', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'display_name' => 'Tagline', 'value' => 'Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_email', 'display_name' => 'Email Resmi', 'value' => 'p3t.lppm@unsoed.ac.id', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'display_name' => 'Telepon / WhatsApp', 'value' => '+62 281 635292', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'display_name' => 'Alamat Kantor', 'value' => 'Gedung LPPM UNSOED, Jl. Prof. Dr. HR. Boenyamin No. 708, Purwokerto, Jawa Tengah 53122', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'footer_copyright', 'display_name' => 'Teks Hak Cipta', 'value' => '© 2026 PUSKOR Universitas Jenderal Soedirman. Hak Cipta Dilindungi.', 'type' => 'text', 'group' => 'general'],
        ];

        foreach ($defaultSettings as $st) {
            Setting::updateOrCreate(['key' => $st['key']], $st);
        }
    }
}
