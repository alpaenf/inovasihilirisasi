<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Models\Program;
use App\Models\Product;
use App\Models\Partner;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function about(): Response
    {
        $aboutContent = PageContent::where('page_key', 'about')->where('section_key', 'profile')->first();
        $aboutOrg = PageContent::where('page_key', 'about')->where('section_key', 'organization')->first();
        $programs = Program::where('status', 'published')->orderBy('sort_order', 'asc')->get();

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

        $stats = [
            'total_programs' => Program::where('status', 'published')->count(),
            'total_products' => Product::where('status', 'published')->count(),
            'total_partners' => Partner::where('status', 'published')->count(),
        ];

        return Inertia::render('Public/About', [
            'about' => [
                'title' => $aboutContent?->title ?? 'Profil Inovasi Hilirisasi Universitas Jenderal Soedirman',
                'content' => $aboutContent?->content ?? 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi (Inovasi Hilirisasi) berada di bawah Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) Universitas Jenderal Soedirman. Inovasi Hilirisasi bertindak sebagai orkestrator yang menjembatani riset akademis para dosen dan peneliti ke dalam implementasi nyata di masyarakat dan industri.',
                'image' => $aboutContent?->image,
                'vision' => $aboutContent?->metadata['vision'] ?? 'Menjadi pusat unggulan koordinasi dan penerapan teknologi tepat guna yang berakar pada kearifan lokal dan berdaya saing global.',
                'mission' => $aboutContent?->metadata['mission'] ?? [
                    'Memfasilitasi hilirisasi hasil riset teknologi civitas akademika UNSOED.',
                    'Membangun kemitraan strategis dengan industri, pemerintah daerah, dan komunitas.',
                    'Mendorong diseminasi teknologi tepat guna untuk pengentasan kemiskinan dan kemandirian desa.',
                ],
            ],
            'organization' => [
                'title' => $aboutOrg?->title ?? 'Struktur Organisasi Inovasi Hilirisasi',
                'content' => $aboutOrg?->content ?? 'Struktur kepemimpinan dan pembagian divisi operasional dalam mengoordinasikan hilirisasi riset, alih teknologi, dan kemitraan industri di lingkungan LPPM UNSOED.',
                'leaders' => $aboutOrg?->metadata['leaders'] ?? $defaultLeaders,
                'divisions' => $aboutOrg?->metadata['divisions'] ?? $defaultDivisions,
                'students' => $aboutOrg?->metadata['students'] ?? $defaultStudents,
            ],
            'programs' => $programs,
            'stats' => $stats,
        ]);
    }
}
