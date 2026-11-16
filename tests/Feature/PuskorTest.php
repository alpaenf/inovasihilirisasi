<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Program;
use App\Models\Product;
use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PuskorTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_public_home_page_returns_ok_and_inertia(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('PUSKOR');
    }

    public function test_public_programs_index_returns_ok(): void
    {
        $response = $this->get('/program');
        $response->assertStatus(200);
        $response->assertSee('SINERGI');
    }

    public function test_public_program_detail_returns_ok_for_valid_slug(): void
    {
        $response = $this->get('/program/sinergi');
        $response->assertStatus(200);
    }

    public function test_public_program_detail_returns_404_for_invalid_slug(): void
    {
        $response = $this->get('/program/program-fiktif-123');
        $response->assertStatus(404);
    }

    public function test_public_products_index_with_search_and_filters(): void
    {
        $response = $this->get('/produk?program=dortek&search=gabah');
        $response->assertStatus(200);
    }

    public function test_public_product_detail_returns_ok(): void
    {
        $product = Product::where('status', 'published')->first();
        $this->assertNotNull($product);

        $response = $this->get("/produk/{$product->slug}");
        $response->assertStatus(200);
    }

    public function test_public_partners_index_returns_ok(): void
    {
        $response = $this->get('/mitra');
        $response->assertStatus(200);
    }

    public function test_public_about_returns_ok(): void
    {
        $response = $this->get('/tentang-puskor');
        $response->assertStatus(200);
    }

    public function test_sitemap_xml_returns_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee('urlset');
    }

    public function test_robots_txt_protects_admin(): void
    {
        $response = $this->get('/robots.txt');
        $response->assertStatus(200);
        $response->assertSee('Disallow: /admin/');
    }

    public function test_admin_dashboard_redirects_unauthenticated_user_to_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_authenticate_and_access_dashboard(): void
    {
        $admin = User::where('email', 'admin.puskor@unsoed.ac.id')->first();
        $this->assertNotNull($admin);

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_admin_can_access_crud_lists(): void
    {
        $admin = User::where('email', 'admin.puskor@unsoed.ac.id')->first();

        $this->actingAs($admin)->get('/admin/programs')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/products')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/partners')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/pages')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/settings')->assertStatus(200);
    }
}
