<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->input('search');
        $programSlug = $request->input('program');
        $sort = $request->input('sort', 'latest');

        $query = Product::where('status', 'published')
            ->with('program:id,name,slug');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($programSlug && $programSlug !== 'all') {
            $query->whereHas('program', function ($q) use ($programSlug) {
                $q->where('slug', $programSlug);
            });
        }

        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(9)->withQueryString();

        $programs = Program::where('status', 'published')
            ->orderBy('sort_order', 'asc')
            ->get(['id', 'name', 'slug']);

        return Inertia::render('Public/Products/Index', [
            'products' => $products,
            'programs' => $programs,
            'filters' => [
                'search' => $search,
                'program' => $programSlug ?? 'all',
                'sort' => $sort,
            ],
        ]);
    }

    public function show(string $slug): Response
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'published')
            ->with([
                'program:id,name,slug',
                'partners:id,name,slug,logo,category',
                'galleries' => function ($q) {
                    $q->orderBy('sort_order', 'asc');
                }
            ])
            ->firstOrFail();

        $relatedProducts = Product::where('status', 'published')
            ->where('program_id', $product->program_id)
            ->where('id', '!=', $product->id)
            ->with('program:id,name,slug')
            ->take(3)
            ->get(['id', 'program_id', 'name', 'slug', 'short_description', 'main_image']);

        return Inertia::render('Public/Products/Show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}

