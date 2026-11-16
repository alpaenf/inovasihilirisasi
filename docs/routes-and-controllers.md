# SPESIFIKASI ROUTING, CONTROLLER, & INERTIA PROPS
# WEBSITE PUSKOR (PUSAT KOORDINASI PENGEMBANGAN DAN PENERAPAN TEKNOLOGI)
### Universitas Jenderal Soedirman

**Versi:** 1.0  
**Framework:** Laravel 11.x + Inertia.js 2.x  
**Format Komunikasi:** Inertia Response (JSON State + Vue 3 Page Component)

---

## 1. DAFTAR RUTE APLIKASI (ROUTE MAPPING)

### 1.1 Rute Publik (Akses Terbuka / Tanpa Login)

| Method | URI | Route Name | Controller & Action | Komponen Vue 3 |
|---|---|---|---|---|
| `GET` | `/` | `home` | `Public\HomeController@index` | `Public/Home.vue` |
| `GET` | `/program` | `programs.index` | `Public\ProgramController@index` | `Public/Programs/Index.vue` |
| `GET` | `/program/{slug}` | `programs.show` | `Public\ProgramController@show` | `Public/Programs/Show.vue` |
| `GET` | `/produk` | `products.index` | `Public\ProductController@index` | `Public/Products/Index.vue` |
| `GET` | `/produk/{slug}` | `products.show` | `Public\ProductController@show` | `Public/Products/Show.vue` |
| `GET` | `/mitra` | `partners.index` | `Public\PartnerController@index` | `Public/Partners/Index.vue` |
| `GET` | `/mitra/{slug}` | `partners.show` | `Public\PartnerController@show` | `Public/Partners/Show.vue` |
| `GET` | `/tentang-puskor` | `about` | `Public\PageController@about` | `Public/About.vue` |
| `GET` | `/sitemap.xml` | `sitemap` | `Public\SeoController@sitemap` | Raw XML Output |
| `GET` | `/robots.txt` | `robots` | `Public\SeoController@robots` | Raw Plaintext Output |

---

### 1.2 Rute Otentikasi Admin (Laravel Breeze / Fortify)

| Method | URI | Route Name | Controller & Action | Keterangan |
|---|---|---|---|---|
| `GET` | `/login` | `login` | `Auth\AuthenticatedSessionController@create` | Tampilan form login admin |
| `POST` | `/login` | `login.store` | `Auth\AuthenticatedSessionController@store` | Proses validasi kredensial |
| `POST` | `/logout` | `logout` | `Auth\AuthenticatedSessionController@destroy` | Terminasi sesi admin |

---

### 1.3 Rute Dashboard Admin (Middleware: `auth`, Prefix: `admin`)

| Method | URI | Route Name | Controller & Action | Komponen Vue 3 |
|---|---|---|---|---|
| `GET` | `/admin/dashboard` | `admin.dashboard` | `Admin\DashboardController@index` | `Admin/Dashboard.vue` |
| **Manajemen Program** | | | | |
| `GET` | `/admin/programs` | `admin.programs.index` | `Admin\ProgramController@index` | `Admin/Programs/Index.vue` |
| `GET` | `/admin/programs/create` | `admin.programs.create` | `Admin\ProgramController@create` | `Admin/Programs/Form.vue` |
| `POST` | `/admin/programs` | `admin.programs.store` | `Admin\ProgramController@store` | - (Redirect ke index) |
| `GET` | `/admin/programs/{id}/edit` | `admin.programs.edit` | `Admin\ProgramController@edit` | `Admin/Programs/Form.vue` |
| `PUT` | `/admin/programs/{id}` | `admin.programs.update` | `Admin\ProgramController@update` | - (Redirect ke index) |
| `DELETE` | `/admin/programs/{id}` | `admin.programs.destroy` | `Admin\ProgramController@destroy` | - (Redirect ke index) |
| **Manajemen Produk** | | | | |
| `GET` | `/admin/products` | `admin.products.index` | `Admin\ProductController@index` | `Admin/Products/Index.vue` |
| `GET` | `/admin/products/create` | `admin.products.create` | `Admin\ProductController@create` | `Admin/Products/Form.vue` |
| `POST` | `/admin/products` | `admin.products.store` | `Admin\ProductController@store` | - (Redirect ke index) |
| `GET` | `/admin/products/{id}/edit` | `admin.products.edit` | `Admin\ProductController@edit` | `Admin/Products/Form.vue` |
| `PUT` | `/admin/products/{id}` | `admin.products.update` | `Admin\ProductController@update` | - (Redirect ke index) |
| `DELETE` | `/admin/products/{id}` | `admin.products.destroy` | `Admin\ProductController@destroy` | - (Redirect ke index) |
| **Manajemen Mitra** | | | | |
| `GET` | `/admin/partners` | `admin.partners.index` | `Admin\PartnerController@index` | `Admin/Partners/Index.vue` |
| `GET` | `/admin/partners/create` | `admin.partners.create` | `Admin\PartnerController@create` | `Admin/Partners/Form.vue` |
| `POST` | `/admin/partners` | `admin.partners.store` | `Admin\PartnerController@store` | - (Redirect ke index) |
| `GET` | `/admin/partners/{id}/edit` | `admin.partners.edit` | `Admin\PartnerController@edit` | `Admin/Partners/Form.vue` |
| `PUT` | `/admin/partners/{id}` | `admin.partners.update` | `Admin\PartnerController@update` | - (Redirect ke index) |
| `DELETE` | `/admin/partners/{id}` | `admin.partners.destroy` | `Admin\PartnerController@destroy` | - (Redirect ke index) |
| **Manajemen Halaman & Pengaturan** | | | | |
| `GET` | `/admin/pages` | `admin.pages.index` | `Admin\PageController@index` | `Admin/Pages/Index.vue` |
| `PUT` | `/admin/pages/{page_key}` | `admin.pages.update` | `Admin\PageController@update` | - (Redirect/Flash) |
| `GET` | `/admin/settings` | `admin.settings.index` | `Admin\SettingController@index` | `Admin/Settings/Index.vue` |
| `PUT` | `/admin/settings` | `admin.settings.update` | `Admin\SettingController@update` | - (Redirect/Flash) |

---

## 2. KONTRAK INERTIA PROPS (DATA SCHEMA)

### 2.1 Halaman Beranda (`Public/Home.vue`)
```typescript
interface HomePageProps {
  pageHero: {
    eyebrow: string;
    headline: string;
    description: string;
    ctaPrimary: { label: string; url: string };
    ctaSecondary: { label: string; url: string };
  };
  programs: Array<{
    id: number;
    name: string;
    slug: string;
    short_description: string;
    logo_url: string | null;
  }>;
  featuredProducts: Array<{
    id: number;
    name: string;
    slug: string;
    short_description: string;
    main_image_url: string;
    program_name: string;
  }>;
  featuredPartners: Array<{
    id: number;
    name: string;
    slug: string;
    logo_url: string;
    category: string;
  }>;
}
```

### 2.2 Katalog Produk (`Public/Products/Index.vue`)
```typescript
interface ProductIndexProps {
  products: {
    data: Array<{
      id: number;
      name: string;
      slug: string;
      short_description: string;
      main_image_url: string;
      program: { id: number; name: string; slug: string };
    }>;
    links: Array<{ url: string | null; label: string; active: boolean }>;
    current_page: number;
    last_page: number;
    total: number;
  };
  programs: Array<{ id: number; name: string; slug: string }>;
  filters: {
    search?: string;
    program?: string;
    sort?: 'latest' | 'oldest' | 'name_asc' | 'name_desc';
  };
}
```

### 2.3 Detail Produk (`Public/Products/Show.vue`)
```typescript
interface ProductShowProps {
  product: {
    id: number;
    name: string;
    slug: string;
    short_description: string;
    description: string;
    main_image_url: string;
    benefits: string | null;
    external_url: string | null;
    program: {
      id: number;
      name: string;
      slug: string;
    };
    partners: Array<{
      id: number;
      name: string;
      slug: string;
      logo_url: string;
      role_in_project: string | null;
    }>;
    galleries: Array<{
      id: number;
      image_url: string;
      caption: string | null;
    }>;
  };
  relatedProducts: Array<{
    id: number;
    name: string;
    slug: string;
    main_image_url: string;
    program_name: string;
  }>;
  seo: {
    title: string;
    description: string;
    canonical_url: string;
    image_url: string;
  };
}
```

---

## 3. ATURAN VALIDASI FORM (LARAVEL FORM REQUESTS)

### 3.1 `ProductStoreRequest.php`
```php
public function rules(): array
{
    return [
        'program_id'        => ['required', 'exists:programs,id'],
        'name'              => ['required', 'string', 'max:255'],
        'slug'              => ['nullable', 'string', 'max:255', 'unique:products,slug'],
        'short_description' => ['required', 'string', 'max:500'],
        'description'       => ['required', 'string'],
        'main_image'        => ['required', 'image', 'mimes:jpeg,png,webp,jpg', 'max:2048'],
        'gallery_images.*'  => ['nullable', 'image', 'mimes:jpeg,png,webp,jpg', 'max:2048'],
        'benefits'          => ['nullable', 'string'],
        'external_url'      => ['nullable', 'url', 'max:500'],
        'partner_ids'       => ['nullable', 'array'],
        'partner_ids.*'     => ['exists:partners,id'],
        'is_featured'       => ['boolean'],
        'status'            => ['required', 'in:draft,published'],
    ];
}
```

### 3.2 `PartnerStoreRequest.php`
```php
public function rules(): array
{
    return [
        'name'              => ['required', 'string', 'max:255'],
        'slug'              => ['nullable', 'string', 'max:255', 'unique:partners,slug'],
        'category'          => ['nullable', 'string', 'max:100'],
        'logo'              => ['required', 'image', 'mimes:jpeg,png,webp,jpg,svg', 'max:1024'],
        'short_description' => ['nullable', 'string', 'max:500'],
        'description'       => ['nullable', 'string'],
        'address'           => ['nullable', 'string', 'max:500'],
        'website'           => ['nullable', 'url', 'max:255'],
        'email'             => ['nullable', 'email', 'max:255'],
        'phone'             => ['nullable', 'string', 'max:50'],
        'program_ids'       => ['nullable', 'array'],
        'program_ids.*'     => ['exists:programs,id'],
        'is_featured'       => ['boolean'],
        'status'            => ['required', 'in:draft,published'],
    ];
}
```

