<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Product;
use App\Models\Partner;
use App\Models\PageContent;
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

        return Inertia::render('Public/Home', [
            'hero' => [
                'eyebrow' => $heroContent?->metadata['eyebrow'] ?? 'UNIVERSITAS JENDERAL SOEDIRMAN',
                'headline' => $heroContent?->title ?? 'Mendorong Inovasi, Mengembangkan Teknologi, Menciptakan Dampak.',
                'description' => $heroContent?->content ?? 'PUSKOR Universitas Jenderal Soedirman menjadi wadah koordinasi pengembangan dan penerapan teknologi melalui kolaborasi, inovasi, serta pemberdayaan berbagai sektor.',
                'cta_primary' => $heroContent?->metadata['cta_primary'] ?? ['label' => 'Jelajahi Program', 'url' => '/program'],
                'cta_secondary' => $heroContent?->metadata['cta_secondary'] ?? ['label' => 'Lihat Produk', 'url' => '/produk'],
            ],
            'programs' => $programs,
            'featuredProducts' => $featuredProducts,
            'featuredPartners' => $featuredPartners,
            'stats' => $stats,
        ]);
    }
}

