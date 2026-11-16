<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Product;
use App\Models\Partner;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $stats = [
            'total_programs' => Program::count(),
            'total_products' => Product::count(),
            'total_partners' => Partner::count(),
            'published_products' => Product::where('status', 'published')->count(),
            'draft_products' => Product::where('status', 'draft')->count(),
            'featured_products' => Product::where('is_featured', true)->count(),
        ];

        $recentProducts = Product::with('program:id,name')->latest()->take(5)->get();
        $recentPartners = Partner::latest()->take(5)->get();
        $programs = Program::withCount('products')->orderBy('sort_order', 'asc')->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentProducts' => $recentProducts,
            'recentPartners' => $recentPartners,
            'programs' => $programs,
        ]);
    }
}

