<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PartnerController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $query = Partner::where('status', 'published');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $partners = $query->latest()->paginate(12)->withQueryString();

        $categories = Partner::where('status', 'published')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return Inertia::render('Public/Partners/Index', [
            'partners' => $partners,
            'categories' => $categories,
            'filters' => [
                'search' => $search,
                'category' => $category ?? 'all',
            ],
        ]);
    }

    public function show(string $slug): Response
    {
        $partner = Partner::where('slug', $slug)
            ->where('status', 'published')
            ->with([
                'programs:id,name,slug,short_description',
                'products' => function ($q) {
                    $q->where('status', 'published')->with('program:id,name,slug');
                }
            ])
            ->firstOrFail();

        return Inertia::render('Public/Partners/Show', [
            'partner' => $partner,
        ]);
    }
}

