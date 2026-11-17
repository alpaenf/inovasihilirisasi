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
