<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    public function index(): Response
    {
        $homeHero = PageContent::where('page_key', 'home')->where('section_key', 'hero')->first();
        $aboutProfile = PageContent::where('page_key', 'about')->where('section_key', 'profile')->first();

        return Inertia::render('Admin/Pages/Index', [
            'homeHero' => $homeHero,
            'aboutProfile' => $aboutProfile,
        ]);
    }

    public function update(Request $request, string $page_key): RedirectResponse
    {
        $validated = $request->validate([
            'section_key' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'eyebrow' => ['nullable', 'string', 'max:150'],
        ]);

        $pageContent = PageContent::firstOrNew([
            'page_key' => $page_key,
            'section_key' => $validated['section_key'],
        ]);

        $pageContent->title = $validated['title'];
        $pageContent->content = $validated['content'];

        $metadata = $pageContent->metadata ?? [];
        if (isset($validated['eyebrow'])) {
            $metadata['eyebrow'] = $validated['eyebrow'];
        }
        $pageContent->metadata = $metadata;
        $pageContent->save();

        return back()->with('success', 'Konten halaman berhasil diperbarui.');
    }
}

