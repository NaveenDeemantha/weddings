<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Wedding Invitation') }}</title>

        <!-- Social Media & WhatsApp Link Preview (Open Graph) -->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Wedding of Buddhima &amp; Shavindi">
        <meta property="og:title" content="Holy Matrimony — Buddhima &amp; Shavindi">
        <meta property="og:description" content="Together with our families, we joyfully invite you to celebrate our Holy Matrimony on Tuesday, 29th December 2026.">
        <meta property="og:image" content="{{ asset('images/wedding/og_whatsapp.jpg') }}">
        <meta property="og:image:secure_url" content="{{ asset('images/wedding/og_whatsapp.jpg') }}">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="600">
        <meta property="og:image:height" content="600">
        <meta property="og:image:alt" content="Buddhima &amp; Shavindi">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Holy Matrimony — Buddhima &amp; Shavindi">
        <meta name="twitter:description" content="Together with our families, we joyfully invite you to celebrate our Holy Matrimony on Tuesday, 29th December 2026.">
        <meta name="twitter:image" content="{{ asset('images/wedding/og_whatsapp.jpg') }}">

        <!-- Favicons (Couple Portrait Icon) -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-32x32.png') }}?v=3">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">

        <!-- Bespoke Wedding Typography: Abhaya Libre, Noto Serif Sinhala, Cormorant Garamond, Cinzel, Alex Brush, Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&family=Alex+Brush&family=Cinzel:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Noto+Serif+Sinhala:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-[#1b1511] text-stone-800">
        @inertia
    </body>
</html>
