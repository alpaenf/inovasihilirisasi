<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class PartnerController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $query = Partner::withCount('programs', 'products');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $partners = $query->latest()->paginate(10)->withQueryString();
        $categories = Partner::whereNotNull('category')->distinct()->pluck('category');

        return Inertia::render('Admin/Partners/Index', [
            'partners' => $partners,
            'categories' => $categories,
            'filters' => [
                'search' => $search,
                'category' => $category ?? 'all',
            ],
        ]);
    }

    public function create(): Response
    {
        $programs = Program::orderBy('sort_order', 'asc')->get(['id', 'name']);

        return Inertia::render('Admin/Partners/Form', [
            'partner' => null,
            'programs' => $programs,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_featured' => ['boolean'],
            'status' => ['required', 'in:draft,published'],
            'program_ids' => ['nullable', 'array'],
            'program_ids.*' => ['exists:programs,id'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,webp,jpg,svg', 'max:1024'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Partner::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$originalSlug}-{$count}";
            $count++;
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
            $validated['logo'] = '/storage/' . $path;
        } else {
            $validated['logo'] = '/images/partners/placeholder.png';
        }

        $programIds = $validated['program_ids'] ?? [];
        unset($validated['program_ids']);

        $partner = Partner::create($validated);
        $partner->programs()->sync($programIds);

        return redirect()->route('admin.partners.index')->with('success', 'Mitra kolaborasi berhasil ditambahkan.');
    }

    public function edit(Partner $partner): Response
    {
        $partner->load('programs:id');
        $programs = Program::orderBy('sort_order', 'asc')->get(['id', 'name']);

        return Inertia::render('Admin/Partners/Form', [
            'partner' => [
                'id' => $partner->id,
                'name' => $partner->name,
                'slug' => $partner->slug,
                'category' => $partner->category,
                'logo' => $partner->logo,
                'short_description' => $partner->short_description,
                'description' => $partner->description,
                'address' => $partner->address,
                'website' => $partner->website,
                'email' => $partner->email,
                'phone' => $partner->phone,
                'is_featured' => (bool)$partner->is_featured,
                'status' => $partner->status,
                'program_ids' => $partner->programs->pluck('id')->toArray(),
            ],
            'programs' => $programs,
        ]);
    }

    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_featured' => ['boolean'],
            'status' => ['required', 'in:draft,published'],
            'program_ids' => ['nullable', 'array'],
            'program_ids.*' => ['exists:programs,id'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,webp,jpg,svg', 'max:1024'],
        ]);

        if ($partner->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            $originalSlug = $slug;
            $count = 1;
            while (Partner::where('slug', $slug)->where('id', '!=', $partner->id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
            $validated['logo'] = '/storage/' . $path;
        }

        $programIds = $validated['program_ids'] ?? [];
        unset($validated['program_ids']);

        $partner->update($validated);
        $partner->programs()->sync($programIds);

        return redirect()->route('admin.partners.index')->with('success', 'Data mitra berhasil diperbarui.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->programs()->detach();
        $partner->products()->detach();
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Mitra kolaborasi berhasil dihapus.');
    }
}

