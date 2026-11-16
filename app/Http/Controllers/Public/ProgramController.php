<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Inertia\Inertia;
use Inertia\Response;

class ProgramController extends Controller
{
    public function index(): Response
    {
        $programs = Program::where('status', 'published')
            ->withCount('products')
            ->orderBy('sort_order', 'asc')
            ->get();

        return Inertia::render('Public/Programs/Index', [
            'programs' => $programs,
        ]);
    }

    public function show(string $slug): Response
    {
        $program = Program::where('slug', $slug)
            ->where('status', 'published')
            ->with([
                'products' => function ($query) {
                    $query->where('status', 'published')->latest();
                },
                'partners' => function ($query) {
                    $query->where('status', 'published');
                }
            ])
            ->firstOrFail();

        return Inertia::render('Public/Programs/Show', [
            'program' => $program,
        ]);
    }
}

