<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\PageContent;
use Inertia\Inertia;
use Inertia\Response;

class ProgramController extends Controller
{
    public function index(): Response
    {
        $programs = Program::where('status', 'published')
            ->withCount('products')
            ->with(['partners:id,name,slug,category,address'])
            ->orderBy('sort_order', 'asc')
            ->get();

        return Inertia::render('Public/Programs/Index', [
            'programs' => $programs,
        ]);
    }

    public function show(string $slug): Response
    {
        $slugAlias = match ($slug) {
            'pmupud' => 'pm-upud',
            'dortek' => 'dorongan-teknologi',
            default => $slug,
        };

        $program = Program::whereIn('slug', [$slug, $slugAlias])
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

        // Load associated students for this program from organization data
        $aboutOrg = PageContent::where('page_key', 'about')->where('section_key', 'organization')->first();
        $allStudents = $aboutOrg?->metadata['students'] ?? [];
        $programStudents = array_values(array_filter($allStudents, function ($s) use ($program, $slug, $slugAlias) {
            $sSlug = $s['program_slug'] ?? '';
            return in_array($sSlug, [$program->slug, $slug, $slugAlias]);
        }));
        $program->setAttribute('students', $programStudents);

        return Inertia::render('Public/Programs/Show', [
            'program' => $program,
        ]);
    }
}
