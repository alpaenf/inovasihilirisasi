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
        $programs = Program::where('status', 'published')->orderBy('sort_order', 'asc')->get();

        $stats = [
            'total_programs' => Program::where('status', 'published')->count(),
            'total_products' => Product::where('status', 'published')->count(),
            'total_partners' => Partner::where('status', 'published')->count(),
        ];

        return Inertia::render('Public/About', [
            'about' => [
                'title' => $aboutContent?->title ?? 'Profil Inovasi Hilirisasi Universitas Jenderal Soedirman',
                'content' => $aboutContent?->content ?? 'Pusat Koordinasi Pengembangan dan Penerapan Teknologi (Inovasi Hilirisasi) LPPM Universitas Jenderal Soedirman.',
                'image' => $aboutContent?->image,
                'vision' => $aboutContent?->metadata['vision'] ?? null,
                'mission' => $aboutContent?->metadata['mission'] ?? [],
            ],
            'programs' => $programs,
            'stats' => $stats,
        ]);
    }
}

