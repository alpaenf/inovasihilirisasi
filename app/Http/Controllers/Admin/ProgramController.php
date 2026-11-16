<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class ProgramController extends Controller
{
    public function index(): Response
    {
        $programs = Program::withCount('products', 'partners')
            ->orderBy('sort_order', 'asc')
            ->get();

        return Inertia::render('Admin/Programs/Index', [
            'programs' => $programs,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Programs/Form', [
            'program' => null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'sort_order' => ['integer', 'min:0'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Program::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$originalSlug}-{$count}";
            $count++;
        }

        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(Program $program): Response
    {
        return Inertia::render('Admin/Programs/Form', [
            'program' => $program,
        ]);
    }

    public function update(Request $request, Program $program): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'sort_order' => ['integer', 'min:0'],
        ]);

        if ($program->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            $originalSlug = $slug;
            $count = 1;
            while (Program::where('slug', $slug)->where('id', '!=', $program->id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program): RedirectResponse
    {
        if ($program->products()->count() > 0) {
            return back()->with('error', 'Program tidak dapat dihapus karena masih memiliki produk terkait.');
        }

        $program->partners()->detach();
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus.');
    }
}

