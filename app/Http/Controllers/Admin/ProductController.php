<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Program;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->input('search');
        $programId = $request->input('program_id');

        $query = Product::with('program:id,name');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($programId && $programId !== 'all') {
            $query->where('program_id', $programId);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $programs = Program::orderBy('sort_order', 'asc')->get(['id', 'name']);

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'programs' => $programs,
            'filters' => [
                'search' => $search,
                'program_id' => $programId ?? 'all',
            ],
        ]);
    }

    public function create(): Response
    {
        $programs = Program::where('status', 'published')->orderBy('sort_order', 'asc')->get(['id', 'name']);
        $partners = Partner::where('status', 'published')->orderBy('name', 'asc')->get(['id', 'name']);

        return Inertia::render('Admin/Products/Form', [
            'product' => null,
            'programs' => $programs,
            'partners' => $partners,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'benefits' => ['nullable', 'string'],
            'external_url' => ['nullable', 'url', 'max:500'],
            'is_featured' => ['boolean'],
            'status' => ['required', 'in:draft,published'],
            'partner_ids' => ['nullable', 'array'],
            'partner_ids.*' => ['exists:partners,id'],
            'main_image' => ['nullable', 'image', 'mimes:jpeg,png,webp,jpg', 'max:2048'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$originalSlug}-{$count}";
            $count++;
        }

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products', 'public');
            $validated['main_image'] = '/storage/' . $path;
        } else {
            $validated['main_image'] = '/images/products/placeholder.jpg';
        }

        $partnerIds = $validated['partner_ids'] ?? [];
        unset($validated['partner_ids']);

        $product = Product::create($validated);
        $product->partners()->sync($partnerIds);

        return redirect()->route('admin.products.index')->with('success', 'Produk inovasi berhasil ditambahkan.');
    }

    public function edit(Product $product): Response
    {
        $product->load('partners:id');
        $programs = Program::orderBy('sort_order', 'asc')->get(['id', 'name']);
        $partners = Partner::orderBy('name', 'asc')->get(['id', 'name']);

        return Inertia::render('Admin/Products/Form', [
            'product' => [
                'id' => $product->id,
                'program_id' => $product->program_id,
                'name' => $product->name,
                'slug' => $product->slug,
                'short_description' => $product->short_description,
                'description' => $product->description,
                'benefits' => $product->benefits,
                'external_url' => $product->external_url,
                'main_image' => $product->main_image,
                'is_featured' => (bool)$product->is_featured,
                'status' => $product->status,
                'partner_ids' => $product->partners->pluck('id')->toArray(),
            ],
            'programs' => $programs,
            'partners' => $partners,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'benefits' => ['nullable', 'string'],
            'external_url' => ['nullable', 'url', 'max:500'],
            'is_featured' => ['boolean'],
            'status' => ['required', 'in:draft,published'],
            'partner_ids' => ['nullable', 'array'],
            'partner_ids.*' => ['exists:partners,id'],
            'main_image' => ['nullable', 'image', 'mimes:jpeg,png,webp,jpg', 'max:2048'],
        ]);

        if ($product->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            $originalSlug = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products', 'public');
            $validated['main_image'] = '/storage/' . $path;
        }

        $partnerIds = $validated['partner_ids'] ?? [];
        unset($validated['partner_ids']);

        $product->update($validated);
        $product->partners()->sync($partnerIds);

        return redirect()->route('admin.products.index')->with('success', 'Produk inovasi berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->partners()->detach();
        $product->galleries()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk inovasi berhasil dihapus.');
    }
}

