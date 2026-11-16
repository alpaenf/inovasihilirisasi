<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Product;
use App\Models\Partner;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $programs = Program::where('status', 'published')->get();
        $products = Product::where('status', 'published')->get();
        $partners = Partner::where('status', 'published')->get();

        $baseUrl = url('/');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Static routes
        $xml .= "<url><loc>{$baseUrl}/</loc><changefreq>daily</changefreq><priority>1.0</priority></url>";
        $xml .= "<url><loc>{$baseUrl}/program</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>";
        $xml .= "<url><loc>{$baseUrl}/produk</loc><changefreq>daily</changefreq><priority>0.9</priority></url>";
        $xml .= "<url><loc>{$baseUrl}/mitra</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>";
        $xml .= "<url><loc>{$baseUrl}/tentang-puskor</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>";

        // Programs
        foreach ($programs as $prog) {
            $lastMod = $prog->updated_at ? $prog->updated_at->toAtomString() : date('c');
            $xml .= "<url><loc>{$baseUrl}/program/{$prog->slug}</loc><lastmod>{$lastMod}</lastmod><changefreq>weekly</changefreq><priority>0.85</priority></url>";
        }

        // Products
        foreach ($products as $prod) {
            $lastMod = $prod->updated_at ? $prod->updated_at->toAtomString() : date('c');
            $xml .= "<url><loc>{$baseUrl}/produk/{$prod->slug}</loc><lastmod>{$lastMod}</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>";
        }

        // Partners
        foreach ($partners as $part) {
            $lastMod = $part->updated_at ? $part->updated_at->toAtomString() : date('c');
            $xml .= "<url><loc>{$baseUrl}/mitra/{$part->slug}</loc><lastmod>{$lastMod}</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /login\n\n";
        $robots .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($robots, 200)->header('Content-Type', 'text/plain');
    }
}

