<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Primary Metadata Fallback -->
    <title inertia>{{ config('app.name', 'PUSKOR UNSOED') }}</title>
    <meta name="description" content="Pusat Koordinasi Pengembangan dan Penerapan Teknologi (PUSKOR) Universitas Jenderal Soedirman. Wadah kolaborasi inovasi, penerapan teknologi, dan hilirisasi riset kampus.">
    <meta name="author" content="PUSKOR Universitas Jenderal Soedirman">
    <meta name="theme-color" content="#14532D">

    <!-- Open Graph Default Fallback -->
    <meta property="og:site_name" content="PUSKOR Universitas Jenderal Soedirman">
    <meta property="og:locale" content="id_ID">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>
<body class="font-sans antialiased text-[#17231C] bg-[#FFFFFF] min-h-full flex flex-col selection:bg-[#DCFCE7] selection:text-[#14532D]">
    @inertia
</body>
</html>

